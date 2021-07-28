<?php /** @noinspection PhpUnused */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('external_id');
            $table->string('currency', 3);
            $table->float('price');
            $table->boolean('is_test')->default(false);
            $table->string('status')->nullable();
            $table->string('invoice_time', 20)->nullable();
            $table->string('expiration_time', 20)->nullable();
            $table->string('current_time_string', 20)->nullable();
            $table->string('buyer_provided_email')->nullable();
            $table->string('transaction_currency', 3)->nullable();
            $table->float('amount_paid')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
