<?php
namespace App\Http\Controllers;

use App\Models\Dispatcher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class DispatcherController extends Controller
{
    public function showRegistrationForm()
    {
        return Inertia::render('Auth/DispatcherRegister');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:dispatchers'],
            'phone' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'vehicle_type' => ['required', 'string', 'max:255'],
            'vehicle_capacity' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        Dispatcher::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'vehicle_type' => $request->vehicle_type,
            'vehicle_capacity' => $request->vehicle_capacity,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/login')->with('success', 'Dispatcher registered. Await admin verification.');
    }
}