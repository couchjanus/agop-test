<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::table('category_product')->truncate();
        \DB::table('products')->truncate();
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('brand_id')->index();
            $table->boolean('status')->default(1);
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropIndex(['brand_id']);
            $table->dropColumn(['status','brand_id']);
        });
    }
}
