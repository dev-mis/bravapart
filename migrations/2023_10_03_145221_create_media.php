<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateMedia extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('media', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->morphs('mediable');
            $table->string('content_type')->nullable();
            $table->string('name');
            $table->text('path');
            $table->string('file_name');
            $table->string('type');
            $table->string('mime_type')->nullable();
            $table->string('extension');
            $table->string('disk');
            $table->double('size');
            $table->datetimes();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
    }
}
