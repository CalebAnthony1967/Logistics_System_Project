<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Delivery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\DeliveryNotification;

class DeliveryController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(
            $request->user()->deliveries()->latest()->get()
        );
    }

    public function estimate(Request $request)
    {
        $validated = $request->validate([
            'weight' => 'required|numeric|min:0.1',
            'value' => 'required|numeric|min:0',
            'source' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'urgent' => 'boolean',
        ]);

        // Mock Distance Matrix API response
        $distance = 10; // Hardcoded 10 km for testing
        $rate_per_km = 50; // Ksh/km
        $rate_per_kg = 20; // Ksh/kg
        $urgency_fee = $validated['urgent'] ? 500 : 0; // Ksh
        $insurance_fee = $validated['value'] * 0.01; // 1% of value

        $cost = ($distance * $rate_per_km) + ($validated['weight'] * $rate_per_kg) + $urgency_fee + $insurance_fee;

        return response()->json(['cost' => round($cost, 2)]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'weight' => 'required|numeric|min:0.1',
            'value' => 'required|numeric|min:0',
            'source' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'sender_name' => 'required|string|max:255',
            'sender_email' => 'required|email|max:255',
            'sender_phone' => 'required|string|max:255',
            'sender_address' => 'required|string|max:255',
            'receiver_name' => 'required|string|max:255',
            'receiver_email' => 'required|email|max:255',
            'receiver_phone' => 'required|string|max:255',
            'receiver_address' => 'required|string|max:255',
            'urgent' => 'boolean',
            'special_instructions' => 'nullable|string',
            'preferred_delivery_time' => 'nullable|date',
        ]);

        // Mock Distance Matrix API response
        $distance = 10;
        $rate_per_km = 50;
        $rate_per_kg = 20;
        $urgency_fee = $validated['urgent'] ? 500 : 0;
        $insurance_fee = $validated['value'] * 0.01;
        $cost = ($distance * $rate_per_km) + ($validated['weight'] * $rate_per_kg) + $urgency_fee + $insurance_fee;

        $delivery = $request->user()->deliveries()->create(array_merge($validated, [
            'cost' => $cost,
            'status' => 'pending',
            'payment_status' => 'pending',
        ]));

        // Send notification
        Mail::to($delivery->sender_email)->send(new DeliveryNotification($delivery, 'pending'));
        Mail::to($delivery->receiver_email)->send(new DeliveryNotification($delivery, 'pending'));

        return response()->json(['delivery' => $delivery, 'cost' => $cost], 201);
    }

    public function show(Delivery $delivery)
    {
        $this->authorize('view', $delivery);
        return response()->json($delivery);
    }

    public function update(Request $request, Delivery $delivery)
    {
        $this->authorize('update', $delivery);
        $validated = $request->validate([
            'status' => 'required|in:pending,dispatched,in_transit,delivered,cancelled',
        ]);
        $delivery->update($validated);

        // Send notification
        Mail::to($delivery->sender_email)->send(new DeliveryNotification($delivery, $validated['status']));
        Mail::to($delivery->receiver_email)->send(new DeliveryNotification($delivery, $validated['status']));

        return response()->json($delivery);
    }

    public function rate(Request $request, Delivery $delivery)
    {
        $this->authorize('update', $delivery);
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'rating_comment' => 'nullable|string',
        ]);

        $delivery->update($validated);
        return response()->json(['message' => 'Rating submitted']);
    }

    public function destroy(Delivery $delivery)
    {
        $this->authorize('delete', $delivery);
        $delivery->update(['status' => 'cancelled']);
        return response()->json(null, 204);
    }
}
