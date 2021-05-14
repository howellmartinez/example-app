<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesDeliveryDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_delivery_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sales_delivery_id')->constrained()->onDelete('CASCADE');
            $table->foreignId('sales_order_detail_id')->nullable()->constrained()->onDelete('SET NULL');
            $table->foreignId('warehouse_product_id')->constrained('warehouse_products');
            $table->decimal('quantity', 15, 2);
            $table->integer('unit_price');
            $table->integer('line_total');
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
        Schema::dropIfExists('sales_delivery_details');
    }
}
