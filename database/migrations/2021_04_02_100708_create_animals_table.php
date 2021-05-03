<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->string('name', 15);
            $table->date('date_of_birth');
            $table->enum('animal_type', ['cat', 'dog', 'hamster', 'snake', 'horse', 'fish', 'lizard', 'bird', 'other']);
            $table->string('species', 25)->nullable();
            $table->string('description', 150)->nullable();
            $table->string('image', 256);
            $table->string('image2', 256);
            $table->string('image3', 256);
            $table->enum('available',['yes', 'no']);
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
        Schema::dropIfExists('animals');
    }
}
