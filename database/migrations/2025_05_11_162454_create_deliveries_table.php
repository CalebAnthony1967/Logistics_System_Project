```php
  <?php
  use Illuminate\Database\Migrations\Migration;
  use Illuminate\Database\Schema\Blueprint;
  use Illuminate\Support\Facades\Schema;

  class CreateDeliveriesTable extends Migration
  {
      public function up()
      {
          Schema::create('deliveries', function (Blueprint $table) {
              $table->id();
              $table->foreignId('user_id')->constrained()->onDelete('cascade');
              $table->foreignId('dispatcher_id')->nullable()->constrained('users')->onDelete('set null');
              $table->string('product_name');
              $table->text('description')->nullable();
              $table->float('weight');
              $table->float('value');
              $table->float('cost');
              $table->string('source');
              $table->string('destination');
              $table->string('sender_name');
              $table->string('sender_email');
              $table->string('sender_phone');
              $table->string('sender_address');
              $table->string('receiver_name');
              $table->string('receiver_email');
              $table->string('receiver_phone');
              $table->string('receiver_address');
              $table->boolean('urgent')->default(false);
              $table->text('special_instructions')->nullable();
              $table->dateTime('preferred_delivery_time')->nullable();
              $table->string('payment_status')->default('pending'); // pending, paid, released
              $table->integer('rating')->nullable(); // 1-5
              $table->text('rating_comment')->nullable();
              $table->string('status')->default('pending'); // pending, dispatched, in_transit, delivered, cancelled
              $table->timestamps();
          });
      }

      public function down()
      {
          Schema::dropIfExists('deliveries');
      }
  }
  ```