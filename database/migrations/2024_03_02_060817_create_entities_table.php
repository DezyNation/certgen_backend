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
        Schema::create('entities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('template_id')->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();
            $table->string('entity');
            $table->decimal('x_coordinate')->default(0);
            $table->decimal('y_coordinate')->default(0);
            $table->string('color')->default('#0000');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entities');
    }
};
