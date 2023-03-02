<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('shares', function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('publication_id');
            $table->comment('');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('publication_id')->references('id')->on('publications');

        });
    }
    public function down()
    {
        Schema::dropIfExists('shares');
    }
}

?>
