<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users',function(Blueprint $table){

            $table->integer('user_location_id')->default('0')->comment("0=forAllAdmin")->after('password');
            $table->integer('user_role')->default('0')->comment("0=for all admins;")->after('password');
            $table->integer('user_type')->default('3')->comment("0=SuperAdmin;1=Admin;2=SubAdmin;3=User")->after('password');
            $table->string('phone',100)->nullable()->after('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users',function(Blueprint $table){

            $table->dropColumn('user_location_id');
            $table->dropColumn('user_role');
            $table->dropColumn('user_type');
            $table->dropColumn('phone');
        });
    }
}
