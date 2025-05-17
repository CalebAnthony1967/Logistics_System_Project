```php
   <?php
   namespace App\Http\Controllers\Api;

   use App\Http\Controllers\Controller;
   use App\Models\Delivery;
   use Illuminate\Http\Request;

   class PaymentController extends Controller
   {
       public function store(Request $request)
       {
           $validated = $request->validate([
               'phone_number' => 'required|string|max:255',
               'delivery_id' => 'required|exists:deliveries,id',
               'amount' => 'required|numeric|min:0',
           ]);

           $delivery = Delivery::find($validated['delivery_id']);
           $this->authorize('update', $delivery);

           // Mock M-Pesa API call
           $delivery->update(['payment_status' => 'paid']);

           return response()->json(['message' => 'Payment initiated'], 201);
       }
   }
   ```