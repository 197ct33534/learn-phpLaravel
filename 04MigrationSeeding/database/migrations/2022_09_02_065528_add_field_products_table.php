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
            if (!Schema::hasColumn('products', 'content')) {
                $table->text('content')->after('description')->nullable();
            }
            if (!Schema::hasColumn('products', 'status')) {
                $table->boolean('status')->after('content')->default(0)->comment('Trạng thái 0: chưa duyệt - 1: đã duyệt');
            }
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
            if (!Schema::hasColumn('products', 'content')) {
                $table->dropColumn('content');
            }
            if (!Schema::hasColumn('products', 'status')) {
                $table->dropColumn('status');
            }
        });
    }
};
