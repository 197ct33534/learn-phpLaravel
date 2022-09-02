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
        Schema::table('laravel.users', function (Blueprint $table) {
            $table->foreign('groups_id')->references('id')->on('laravel.user_groups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('laravel.users', function (Blueprint $table) {
            $table->dropForeign('laravel_users_groups_id_foreign');
        });
    }
};
