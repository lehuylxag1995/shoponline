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
            $table->foreignId('menu_id')
                ->nullable()
                ->constrained('menus')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('name', 100)
                ->nullable(false)
                ->unique();
            $table->string('slug', 100);
            $table->text('description');
            $table->longText('content');
            $table->decimal('price')
                ->nullable(false)
                ->default(0);
            $table->decimal('price_sale')
                ->nullable(false)
                ->default(0);
            $table->string('thumb', 255);
            $table->boolean('active')->default(true);
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
