<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('underlying');
            $table->float('strike');
            $table->integer('transaction_type_id')->unsigned();
            $table->float('cash');
            $table->float('commission')->nullable(true);
            $table->integer('size');
            $table->integer('parent')->nullable(true);
            $table->integer('action_id')->unsigned();
            $table->dateTime('date');
            $table->integer('user_id')->unsigned();
            $table->text('comment')->nullable(true);
            $table->integer('status_id')->unsigned();
            $table->integer('group_id')->unsigned();
            $table->timestamp('updated_at')->useCurrent();

//            $table->foreign('action_id')->references('id')->on('actions');
//            $table->foreign('transaction_type_id')->references('id')->on('transaction_types');
//            $table->foreign('group_id')->references('id')->on('groups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
