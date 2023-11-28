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
        Schema::create('sacks', function (Blueprint $table) {
            $table->id();
            $table->string("code");
            $table->unsignedInteger("branch_id");
            $table->unsignedInteger("type_id");
            $table->text("description")->nullable();
            $table->integer("status")->default(0);
            $table->timestamps();
            $table->dateTime("deleted_at")->nullable();

            $table->index(["code","branch_id","type_id","status","deleted_at"]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sacks');
    }
};
