<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kpis', function (Blueprint $table) {
            $table->integer('year')->default(2024)->after('page_id');
        });

        Schema::table('charts', function (Blueprint $table) {
            $table->integer('year')->default(2024)->after('page_id');
        });

        Schema::table('map_markers', function (Blueprint $table) {
            $table->integer('year')->default(2024)->after('page_id');
        });

        Schema::table('industry_clusters', function (Blueprint $table) {
            $table->integer('year')->default(2024)->after('title');
        });

        Schema::table('data_sources', function (Blueprint $table) {
            $table->integer('year')->default(2024)->after('page_id');
        });

        Schema::table('table_data', function (Blueprint $table) {
            $table->integer('year')->default(2024)->after('page_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kpis', function (Blueprint $table) {
            $table->dropColumn('year');
        });

        Schema::table('charts', function (Blueprint $table) {
            $table->dropColumn('year');
        });

        Schema::table('map_markers', function (Blueprint $table) {
            $table->dropColumn('year');
        });

        Schema::table('industry_clusters', function (Blueprint $table) {
            $table->dropColumn('year');
        });

        Schema::table('data_sources', function (Blueprint $table) {
            $table->dropColumn('year');
        });

        Schema::table('table_data', function (Blueprint $table) {
            $table->dropColumn('year');
        });
    }
};
