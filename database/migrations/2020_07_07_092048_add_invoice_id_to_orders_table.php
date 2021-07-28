<?php /** @noinspection PhpUnused */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInvoiceIdToOrdersTable extends Migration
{
    public const ADDING_COLUMN = 'invoice_id';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger(AddInvoiceIdToOrdersTable::ADDING_COLUMN)->unsigned()->nullable()->after('subscription_plan_id');
            $table->foreign(AddInvoiceIdToOrdersTable::ADDING_COLUMN)->references('id')->on('invoices')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign([AddInvoiceIdToOrdersTable::ADDING_COLUMN]);
            $table->dropColumn(AddInvoiceIdToOrdersTable::ADDING_COLUMN);
        });
    }
}
