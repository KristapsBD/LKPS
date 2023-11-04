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
        Schema::create('parcels', function (Blueprint $table) {
            $table->id();
            $table->string('parcel_size');
            $table->float('parcel_weight');
            $table->text('additional_notes')->nullable();
            $table->unsignedBigInteger('sender_user_id')->nullable();
            $table->foreign('sender_user_id')
                ->references('id')
                ->on('users')
                ->nullable()
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unsignedBigInteger('sender_client_id')->nullable();
            $table->foreign('sender_client_id')
                ->references('id')
                ->on('clients')
                ->nullable()
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('parcels', function (Blueprint $table) {
            $table->dropForeign(['sender_client_id']);
        });

        Schema::table('parcels', function (Blueprint $table) {
            $table->dropForeign(['sender_user_id']);
        });

        Schema::dropIfExists('parcels');
    }
};
