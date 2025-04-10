<?php
// First migration: projects table
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('project_name');
            $table->text('description')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->foreignId('assigned_team_id')->nullable()->constrained('teams')->onDelete('set null');
            $table->enum('status', ['Not Started', 'In Progress', 'Completed'])->default('Not Started');
            $table->unsignedBigInteger('linked_lead_id')->nullable(); // Add this column
            $table->foreign('linked_lead_id')->references('lead_id')->on('leads')->onDelete('cascade'); // Change the reference to lead_id
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('projects');
    }
};
