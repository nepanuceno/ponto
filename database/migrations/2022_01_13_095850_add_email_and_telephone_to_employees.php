<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEmailAndTelephoneToEmployees extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Employees', function (Blueprint $table) {
            $table->string('email')->nullable()->unique();
            $table->string('telephone')->nullable()->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Employees', function (Blueprint $table) {
            $table->dropColumn('email');
            $table->dropColumn('telephone');
        });
    }
}
