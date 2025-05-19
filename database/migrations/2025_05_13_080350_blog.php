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
        Schema::create('blog', function ( Blueprint $table ){
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->string('author');
            $table->timestamps();
        } );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the blog_posts table
        Schema::dropIfExists('blog_posts');
        // Drop any other related tables if necessary
    }
};
