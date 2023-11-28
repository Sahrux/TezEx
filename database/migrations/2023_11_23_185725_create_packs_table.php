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
        Schema::create('packs', function (Blueprint $table) {
            $table->id();
            $table->string("tracking_id");
            $table->unsignedInteger("customer_id");
            $table->unsignedInteger("branch_id")->default(1);
            $table->unsignedInteger("sack_id")->nullable();
            $table->unsignedInteger("category_id")->nullable();
            $table->text("description")->nullable();
            $table->integer("status")->default(0);//not sorted
            $table->timestamps();
            $table->dateTime("deleted_at")->nullable();

            $table->index(["tracking_id","customer_id","branch_id"]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packs');
    }
};
