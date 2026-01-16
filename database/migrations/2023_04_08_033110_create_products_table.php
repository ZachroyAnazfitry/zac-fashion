<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('brands_id');
            $table->integer('category_id');
            $table->integer('sub_category_id'); // no section yet
            $table->integer('vendor_id')->nullable();

            $table->string('products_name')->nullable();
            $table->string('products_slug')->nullable();
            $table->string('code')->nullable();
            $table->string('quantity')->nullable();
            $table->string('tags')->nullable();
            $table->string('size')->nullable();
            $table->string('color')->nullable();
            $table->text('description')->nullable();
            $table->text('specification')->nullable();
            $table->string('price')->nullable();
            $table->string('discount_price')->nullable();
            $table->string('picture')->nullable();      // products image
            $table->string('thumbnails')->nullable(); // product multiple images
            $table->integer('hot_deals')->nullable();
            $table->integer('special_offer')->nullable();
            $table->integer('status')->default(0)->nullable();

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
        Schema::dropIfExists('products');
    }
};
