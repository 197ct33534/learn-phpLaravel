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
        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'sku')) {
                $table->string('sku', 10);
            }
            $table->unique('sku', 'sku_unique'); // tạo field + đánh index + tên index đặt là
            $table->unique('name'); // đánh index cho filed name
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

            $table->dropUnique('sku_unique'); // xóa index theo mình đặt
            $table->dropColumn('sku');
            $table->dropUnique('products_name_unique'); // xóa index theo mặc định của lravel
        });
    }
};
