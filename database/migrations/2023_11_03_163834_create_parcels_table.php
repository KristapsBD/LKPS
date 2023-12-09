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
            $table->string('size');
            $table->float('weight');
            $table->text('notes')->nullable();
            $table->integer('status')->default(0);
            $table->string('tracking_code')->nullable();
            $table->unsignedBigInteger('sender_id')->nullable();
            $table->foreign('sender_id')
                ->references('id')
                ->on('users')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unsignedBigInteger('receiver_id')->nullable();
            $table->foreign('receiver_id')
                ->references('id')
                ->on('clients')
                ->nullable()
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unsignedBigInteger('source')->nullable();
            $table->foreign('source')
                ->references('id')
                ->on('addresses')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unsignedBigInteger('destination')->nullable();
            $table->foreign('destination')
                ->references('id')
                ->on('addresses')
                ->nullable()
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unsignedBigInteger('vehicle_id')->nullable();
            $table->foreign('vehicle_id')
                ->references('id')
                ->on('vehicles')
                ->nullable()
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unsignedBigInteger('tariff_id')->nullable();
            $table->foreign('tariff_id')
                ->references('id')
                ->on('tariffs')
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
        if(Schema::hasTable('parcels')){
            Schema::table('parcels', function (Blueprint $table) {
                $table->dropForeign(['receiver_id']);
            });

            Schema::table('parcels', function (Blueprint $table) {
                $table->dropForeign(['sender_id']);
            });

            Schema::table('parcels', function (Blueprint $table) {
                $table->dropForeign(['source']);
            });

            Schema::table('parcels', function (Blueprint $table) {
                $table->dropForeign(['destination']);
            });

            Schema::table('parcels', function (Blueprint $table) {
                $table->dropForeign(['vehicle_id']);
            });

            Schema::table('parcels', function (Blueprint $table) {
                $table->dropForeign(['tariff_id']);
            });
        }

        Schema::dropIfExists('parcels');
    }
};
