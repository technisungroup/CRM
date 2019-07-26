<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agents', function (Blueprint $table) {
            
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->integer('agent_type_id');
            $table->string('website',255)->nullable();
            $table->string('phone',25)->nullable();
            $table->string('other_phone',25)->nullable();
            $table->string('email',150)->nullable();
            $table->string('other_email',150)->nullable();
            $table->string('contact_name',150)->nullable();
            $table->string('location')->nullable();
            $table->integer('nationality_id')->nullable();
            $table->integer('status')->comment('0=inactive;1=active');
            $table->text('text')->nullable();
            $table->integer('service_id')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('agents');
    }
}
