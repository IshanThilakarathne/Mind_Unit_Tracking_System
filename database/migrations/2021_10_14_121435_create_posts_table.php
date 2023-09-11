<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->string('product_name');
            $table->integer('seller_id');
            $table->integer('clark_id');
            $table->string('receiver_f_name');
            $table->string('receiver_l_name');
            $table->string('receiver_phone_no');
            $table->string('receiver_address');

            $table->boolean('bar_code_print')->nullable();

            $table->string('Package_Processing_Started');
            $table->datetime('Package_Processing_Started_d_t')->nullable();

            $table->string('Package_Being_Prepared');
            $table->datetime('Package_Being_Prepared_d_t')->nullable();

            $table->string('Pickup_In_Progress');
            $table->datetime('Pickup_In_Progress_d_t')->nullable();

            $table->string('Arrived_at_Our_Warehouse');
            $table->datetime('Arrived_at_Our_Warehouse_d_t')->nullable();

            $table->string('Shipped');
            $table->datetime('Shipped_d_t')->nullable();

            $table->string('Out_For_Delivery');
            $table->datetime('Out_For_Delivery_d_t')->nullable();

            $table->string('Delivered');
            $table->datetime('Delivered_d_t')->nullable();

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
        Schema::dropIfExists('posts');
    }
}
