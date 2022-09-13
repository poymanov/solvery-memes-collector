<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vk_parsing_sources', function (Blueprint $table) {
            $table->text('parsing_status_description')->nullable()->after('parsing_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vk_parsing_sources', function (Blueprint $table) {
            $table->dropColumn('parsing_status_description');
        });
    }
};
