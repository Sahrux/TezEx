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
        Schema::create('role_privileges', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger("role_id");
            $table->unsignedInteger("privilege_id");
            $table->unsignedInteger("creator_id")->nullable();
            $table->timestamps();
            $table->dateTime("deleted_at")->nullable();

            $table->index(["role_id","privilege_id"]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_privileges');
    }
};
