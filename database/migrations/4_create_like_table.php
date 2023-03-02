<?php 

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('likes', function(Blueprint $table){
            $table->id();
            $table->dateTime('date')->nullable();
            $table->foreignId('publication_id')->constrained();
            $table->date('hidden')->nullable()->default(null);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('likes');
    }
}
?>
