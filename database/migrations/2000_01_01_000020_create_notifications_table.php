<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('message_id')
            ->references('id')
            ->on('messages')
            ->onDelete('cascade')
            ->constrained();
            $table->foreignId('share_id')
            ->references('id')
            ->on('shares')
            ->onDelete('cascade')
            ->constrained();
            $table->foreignId('like_id')
            ->references('id')
            ->on('likes')
            ->onDelete('cascade')
            ->constrained();
            $table->foreignId('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade')
            ->constrained();
            $table->foreignId('publication_id')
            ->references('id')
            ->on('publications')
            ->onDelete('cascade')
            ->constrained();
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
