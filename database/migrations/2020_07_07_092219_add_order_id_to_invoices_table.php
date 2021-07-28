<?php /** @noinspection PhpUnused */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrderIdToInvoicesTable extends Migration
{
    public const ADDING_COLUMN = 'order_id';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->unsignedBigInteger(AddOrderIdToInvoicesTable::ADDING_COLUMN)->unsigned()->nullable()->after('external_id');
            $table->foreign(AddOrderIdToInvoicesTable::ADDING_COLUMN)->references('id')->on('orders')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropForeign([AddOrderIdToInvoicesTable::ADDING_COLUMN]);
            $table->dropColumn(AddOrderIdToInvoicesTable::ADDING_COLUMN);
        });
    }
}
