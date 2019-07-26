<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->bigIncrements('id')->index();
            $table->string('name_title','15')->nullable();
            $table->string('name',255)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('phone')->nullable();
            $table->string('other_phone')->nullable();
            $table->string('gender')->nullable();
            $table->string('email')->nullable();
            $table->string('other_email')->nullable();
            $table->integer('nationality')->nullable();
            $table->integer('country')->nullable();
            $table->date('visa_expiry_date')->nullable();
            $table->string('campaign')->nullable();
            $table->integer('connected_to_client_id')->default(0);
            $table->integer('location_id')->nullable();
            $table->integer('enquiry_type')->nullable();
            $table->integer('lead_source')->nullable();
            $table->string('text',2000)->nullable();
            $table->string('event',300)->nullable();
            $table->date('event_start_date')->nullable();
            $table->date('event_end_date')->nullable();
            $table->time('event_start_time')->nullable();
            $table->time('event_end_time')->nullable();
            $table->date('appointment_date')->nullable();
            $table->time('appointment_time')->nullable();
            $table->integer('admission_detail_id')->nullable();
            $table->integer('migration_detail_id')->nullable();
            $table->string('rating')->nullable();
            $table->string('current_visa')->nullable();
            $table->integer('language_test_id')->nullable();
            $table->string('language_test_score')->nullable();
            $table->integer('account_manager_id')->nullable();
            $table->date('task_due_date')->nullable();
            $table->integer('assign_to_id')->nullable();
            $table->integer('workflow_member_id')->nullable();
            $table->date('oshc_start_date')->nullable();
            $table->date('oshc_end_date')->nullable();
            $table->string('page')->nullable();
            $table->integer('convert')->default('0')->comment("0=Lead;1=Student;2=Applicant");
            $table->integer('user_group_id')->nullable();
            $table->integer('team_member_id')->nullable();
            $table->string('contact_time')->nullable();
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
        Schema::dropIfExists('leads');
    }
}
