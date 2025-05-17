```html
   <!DOCTYPE html>
   <html>
   <head>
       <title>Delivery Status Update</title>
   </head>
   <body>
       <h1>Delivery #{{ $delivery->id }} Status Update</h1>
       <p>Dear {{ $delivery->sender_name }},</p>
       <p>Your delivery has been updated to: <strong>{{ $status }}</strong></p>
       <p><strong>Product:</strong> {{ $delivery->product_name }}</p>
       <p><strong>Destination:</strong> {{ $delivery->destination }}</p>
       <p><strong>Cost:</strong> {{ $delivery->cost }} Ksh</p>
       <p>Thank you for using Logistics Smart System.</p>
   </body>
   </html>
   ```