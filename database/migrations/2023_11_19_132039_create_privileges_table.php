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
        Schema::create('privileges', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('value');
            $table->text("description")->nullable();
            $table->unsignedInteger("creator_id")->nullable();
            $table->timestamps();
            $table->dateTime("deleted_at")->nullable();

            // $table->foreign('belonging_id')->references('id')->on('roles');
            // $table->foreign('creator_id')->references('id')->on('users');

            $table->index(["key","value"]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('privileges');
    }
};
