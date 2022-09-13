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
        Schema::create('memes', function (Blueprint $table) {
            $table->id();
            $table->enum('source_type', ['vk']);
            $table->string('source_alias');
            $table->string('external_id');
            $table->text('text')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['source_type', 'source_alias', 'external_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('memes');
    }
};
