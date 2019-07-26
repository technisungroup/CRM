<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstitutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institutes', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('institute_code')->nullable();
            $table->string('institute_name');
            $table->string('contact_person')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('other_phone')->nullable();
            $table->string('other_email')->nullable();
            $table->string('fax')->nullable();
            $table->string('address',800)->nullable();
            $table->string('address_two',800)->nullable();
            $table->string('website',300)->nullable();
            $table->string('commission')->nullable();
            $table->date('agreement_start_date')->nullable();
            $table->date('agreement_end_date')->nullable();
            $table->date('rto_expiry')->nullable();
            $table->date('cricos_expiry')->nullable();
            $table->integer('institute_promotion_id')->nullable();
            $table->string('minimal_deposit_required')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->integer('country_id')->nullable();
            $table->text('text')->nullable();
            $table->integer('agent_type')->default('0')->comment('0=direct;1=agent');
            $table->date('audit_date')->nullable();
            $table->date('next_audit_date')->nullable();
            $table->string("audit_remark",500)->nullable();
            $table->string('audit_by')->nullable();
            $table->integer('payment_by_us')->default('0')->comment('0=no;1=yes');
            $table->string('payment')->nullable()->comment('if nay payment');
            $table->integer('agent_id')->default('0')->comment('0=no agent');
            $table->integer('worldwide')->default('1')->comment('0=no;1=yes');
            $table->integer('status')->default('1')->comment('0=inactive;1=active');
            $table->integer('user_id');
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
        Schema::dropIfExists('institutes');
    }
}
