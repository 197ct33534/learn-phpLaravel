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
            // $table->id(); // bigint ,auto_Increment , primary key, tên field id
            $table->increments('id'); // int , primary key, auto_Increment
            $table->string('name', 200); // varchar 200 , tên field name
            $table->text('description')->nullable(); // text, tên field description
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
