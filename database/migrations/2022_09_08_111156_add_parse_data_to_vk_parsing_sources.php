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
            $table->enum('parsing_status', ['not_parsed', 'success', 'failed'])->default('not_parsed')->after('url');
            $table->timestamp('parsed_at')->nullable()->after('deleted_at');
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
            $table->dropColumn('parsing_status');
            $table->dropColumn('parsed_at');
        });
    }
};
