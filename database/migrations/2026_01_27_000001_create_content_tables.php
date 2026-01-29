<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentTables extends Migration
{
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('kpis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_id')->constrained()->onDelete('cascade');
            $table->string('label');
            $table->string('value');
            $table->string('trend_value')->nullable();
            $table->string('trend_direction')->nullable(); // up, down, stable
            $table->string('icon')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        Schema::create('charts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_id')->constrained()->onDelete('cascade');
            $table->string('identifier');
            $table->string('title');
            $table->string('type')->default('bar');
            $table->json('labels');
            $table->json('datasets');
            $table->json('options')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        Schema::create('map_markers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->decimal('lat', 10, 8);
            $table->decimal('lng', 11, 8);
            $table->string('color')->nullable();
            $table->text('data')->nullable(); // Popup content
            $table->string('type')->nullable(); // e.g., Airport, Port
            $table->timestamps();
        });

        Schema::create('industry_clusters', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('title');
            $table->json('kpis');
            $table->json('chart_data');
            $table->json('details');
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        Schema::create('data_sources', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('url')->nullable();
            $table->text('description')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        Schema::create('table_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_id')->constrained()->onDelete('cascade');
            $table->string('identifier');
            $table->string('title')->nullable();
            $table->json('headers');
            $table->json('rows');
            $table->text('footer_note')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('table_data');
        Schema::dropIfExists('data_sources');
        Schema::dropIfExists('industry_clusters');
        Schema::dropIfExists('map_markers');
        Schema::dropIfExists('charts');
        Schema::dropIfExists('kpis');
        Schema::dropIfExists('pages');
    }
}
