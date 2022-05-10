<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private const TABLE_NAME = 'zip_codes';

    public function up()
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->id();
            $table->string('zip_code')->index();
            $table->string('locality');
            $table->unsignedInteger('federal_entity_key');
            $table->string('federal_entity_name');
            $table->string('federal_entity_code')->nullable()->default(null);
            $table->unsignedInteger('municipality_key');
            $table->string('municipality_name');
        });
    }

    public function down()
    {
        Schema::dropIfExists(self::TABLE_NAME);
    }
};
