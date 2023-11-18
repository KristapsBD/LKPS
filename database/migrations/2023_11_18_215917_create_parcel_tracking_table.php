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
        Schema::create('parcel_trackings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parcel_id');
            $table->foreign('parcel_id')
                ->references('id')
                ->on('parcels')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('status');
            $table->string('location')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if(Schema::hasTable('parcel_trackings')) {
            Schema::table('parcel_trackings', function (Blueprint $table) {
                $table->dropForeign(['parcel_id']);
            });
        }

        Schema::dropIfExists('parcel_trackings');
    }
};
