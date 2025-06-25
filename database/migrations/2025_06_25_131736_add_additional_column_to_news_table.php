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
        Schema::table('news', function (Blueprint $table) {
            $table->text('excerpt')->nullable()->after('content');
            $table->integer('views_count')->default(0)->after('is_featured');
            $table->string('meta_title')->nullable()->after('views_count');
            $table->text('meta_description')->nullable()->after('meta_title');

            $table->index(['category', 'published_at']);
            $table->index(['is_featured', 'published_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('news', function (Blueprint $table) {
            $table->dropColumn(['excerpt', 'views_count', 'meta_title', 'meta_description']);
        });
    }
};
