<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionPlans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_plans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->float('price');
            $table->integer('days', false, true);
            $table->foreign('product_id')->references('id')->on('products');
            $table->timestamps();
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('subscription_days');
            $table->dropColumn('price');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('subscription_plan_id')->after('product_id');
            $table->foreign('subscription_plan_id')->references('id')->on('subscription_plans');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscription_plans');
    }
}
