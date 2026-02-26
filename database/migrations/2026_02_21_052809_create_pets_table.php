<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->string('pet_name');
            $table->string('owner_name');
            $table->integer('age_value');
            $table->enum('age_unit', ['Hari', 'Bulan', 'Tahun']);
            $table->enum('gender', ['Jantan', 'Betina']);
            $table->float('weight')->nullable();
            $table->enum('health_status', ['Sehat', 'Sakit', 'Kontrol']);
            $table->date('last_visit');
            $table->text('notes')->nullable();
            $table->string('photo')->nullable();
            $table->timestamps();
            $table->foreignId('species_id')->constrained()->onDelete('cascade');
            $table->foreignId('breed_id')->constrained()->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};
