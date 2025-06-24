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
        Schema::create('guest_submissions', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Guest name
            $table->string('email'); // Guest email
            $table->string('phone')->nullable(); // Guest phone
            $table->string('title'); // Photo/Video title
            $table->text('description')->nullable(); // Description
            $table->enum('type', ['photo', 'video']); // Type of submission
            $table->enum('category', ['Kegiatan', 'Infrastruktur', 'Alam', 'Budaya']); // Category
            $table->string('file_path'); // Path to uploaded file
            $table->string('file_name'); // Original filename
            $table->string('file_size'); // File size
            $table->string('file_type'); // MIME type
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('admin_notes')->nullable(); // Admin review notes
            $table->timestamp('reviewed_at')->nullable(); // When reviewed
            $table->unsignedBigInteger('reviewed_by')->nullable(); // Admin who reviewed
            $table->unsignedBigInteger('gallery_id')->nullable(); // Gallery ID if approved
            $table->timestamps();

            $table->foreign('reviewed_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('gallery_id')->references('id')->on('galleries')->onDelete('set null');

            $table->index(['status', 'type']);
            $table->index(['created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guest_submissions');
    }
};
