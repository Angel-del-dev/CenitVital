<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if(Schema::hasTable('users')) {
            Schema::create('events', function(Blueprint $table) {
                $table->id();
                $table->dateTime('date');
                $table->foreignId('user_id');
                $table->foreignId('activities_id');
                $table->string('subject', 100);
                $table->text('observation')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
