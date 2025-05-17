```php
   <?php
   namespace App\Mail;

   use App\Models\Delivery;
   use Illuminate\Bus\Queueable;
   use Illuminate\Mail\Mailable;
   use Illuminate\Queue\SerializesModels;

   class DeliveryNotification extends Mailable
   {
       use Queueable, SerializesModels;

       public $delivery;
       public $status;

       public function __construct(Delivery $delivery, $status)
       {
           $this->delivery = $delivery;
           $this->status = $status;
       }

       public function build()
       {
           return $this->subject('Delivery Status Update')
                       ->view('emails.delivery_notification')
                       ->with([
                           'delivery' => $this->delivery,
                           'status' => $this->status,
                       ]);
       }
   }
   ```