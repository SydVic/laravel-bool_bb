<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('slug', 255)->unique();
            $table->decimal('price', 6, 2)->unsigned();
            $table->string('title', 255);
            $table->text('description')->nullable();
            $table->tinyInteger('rooms_number')->unsigned();
            $table->tinyInteger('bathrooms_number')->unsigned();
            $table->tinyInteger('beds_number')->unsigned();
            $table->smallInteger('mqs')->unsigned();
            $table->decimal('latitude', 8, 6);
            $table->decimal('longitude', 9, 6);
            $table->string('address', 255);
            $table->string('image', 255);
            $table->boolean('visibility')->default(true);
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apartments');
    }
}
