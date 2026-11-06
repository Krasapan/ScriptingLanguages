<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('beta_tester_translations', function (Blueprint $table) {
            $table->id();
            // Зовнішній ключ, який видаляє переклади, якщо видалити тестувальника
            $table->foreignId('beta_tester_id')->constrained('beta_testers')->cascadeOnDelete();
            $table->string('locale', 5); // 'uk', 'en'
            $table->text('experience')->nullable();
            $table->timestamps();

            // Унікальність: один тестувальник може мати лише один переклад для конкретної мови
            $table->unique(['beta_tester_id', 'locale']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('beta_tester_translations');
    }
};
