<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->string('lastname')->nullable();
            $table->string('firstname');
            $table->string('surname');
            $table->date('birthdate');
            $table->bigInteger('inn');
            $table->string('name_is_responsible');
            $table->enum('status', ['Не в работе', 'В работе', 'Отказ', 'Сделка закрыта'])->default('Не в работе');
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
        Schema::dropIfExists('clients');
    }
}

