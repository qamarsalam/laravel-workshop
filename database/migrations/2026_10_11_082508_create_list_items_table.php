<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.// this is where i store the job data in the database, the table is called list_items and it has columns for title, department, description, skills, eligibility_rules, and scoring_weights
     */
    public function up(): void
    {
        Schema::create('list_items', function (Blueprint $table) {
    $table->id();
    $table->string('title');
    $table->string('department');
    $table->text('description');
    $table->text('skills'); 
    $table->text('eligibility_rules')->nullable();
    $table->json('scoring_weights'); 
    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('list_items');
    }
};
