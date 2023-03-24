<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('message_id')->constrained();
            $table->foreignId('share_id')->nullable()->constrained();
            $table->foreignId('like_id')->nullable()->constrained();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('publication_id')->constrained();
            $table->date('hidden')->nullable()->default(null);
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
        Schema::dropIfExists('notifications');
    }
};
