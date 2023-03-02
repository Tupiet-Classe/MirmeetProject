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
            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade')
            ->constrained();
            $table->foreign('publication_id')
            ->references('id')
            ->on('publications')
            ->onDelete('cascade')
            ->constrained();
            $table->comment('');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('shares');
    }
}

?>
