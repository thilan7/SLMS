<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFinalTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('final_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('student_id');
            $table->string('book_id');
            $table->date('reserved_date')->nullable();
            $table->date('burrowed_date')->nullable();
            $table->date('returned_date')->nullable();
            $table->date('due_date')->nullable();
            $table->float('fine')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('final_transactions');
    }
}
