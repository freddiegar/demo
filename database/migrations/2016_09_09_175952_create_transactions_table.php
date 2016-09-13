<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            // Columna no autoincrementral unsigned, hace referencia a un FK autoincrementtal
            $table->integer('person', false, true);
            $table->char('personType', 2);
            $table->string('transactionID');
            $table->string('transactionState', 20);
            $table->string('trazabilityCode', 40);
            $table->string('sessionID', 32);
            $table->string('returnCode', 30);
            $table->integer('responseCode');
            $table->string('responseReasonCode', 3);
            $table->string('responseReasonText', 255);
            $table->string('reference', 32);
            $table->double('amount');
            $table->string('bankURL', 255);
            $table->string('bankCurrency', 3);
            $table->float('bankFactor');
            $table->foreign('person')->references('id')->on('people');
            $table->foreign('personType')->references('id')->on('person_types');
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
        Schema::dropIfExists('transactions');
    }
}
