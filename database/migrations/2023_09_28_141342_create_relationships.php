<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->foreign('type')->references('id')->on('references')->nullOnDelete();
            $table->foreign('status')->references('id')->on('references')->nullOnDelete();
            $table->foreign('priority')->references('id')->on('references')->nullOnDelete();
        });

        Schema::table('ticket_comments', function (Blueprint $table) {
            $table->foreign('ticket_id')->references('id')->on('tickets')->cascadeOnDelete();
        });

        Schema::table('attachments', function (Blueprint $table) {
            $table->foreign('parent_id', 'ticket_attachment_foreign')->references('id')->on('tickets')->cascadeOnDelete();
            $table->foreign('parent_id', 'comment_attachment_foreign')->references('id')->on('ticket_comments')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('relationships');
    }
};