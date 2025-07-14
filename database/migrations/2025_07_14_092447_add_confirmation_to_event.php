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
        if(Schema::hasTable('events')) {
            Schema::table('events', function (Blueprint $table) {
                $table->boolean('finished')->default(false);
                $table->float('satisfaction', 1)->nullable();
                $table->text('satisfaction_observations')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        
    }
};
