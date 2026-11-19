<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('beta_tester_game', function (Blueprint $table) {
            // Зовнішні ключі з каскадним видаленням
            $table->foreignId('beta_tester_id')->constrained('beta_testers')->cascadeOnDelete();
            $table->foreignId('game_id')->constrained('games', 'game_id')->cascadeOnDelete();

            // Складений первинний ключ
            $table->primary(['beta_tester_id', 'game_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beta_tester_game');
    }
};
