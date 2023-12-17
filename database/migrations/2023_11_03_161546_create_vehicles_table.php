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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('registration_number');
            $table->integer('type');
            $table->unsignedBigInteger('driver_id')->nullable();
            $table->foreign('driver_id')
                ->references('id')
                ->on('users')
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
        if(Schema::hasTable('vehicles')) {
            Schema::table('vehicles', function (Blueprint $table) {
                $table->dropForeign(['driver_id']);
            });
        }

        Schema::dropIfExists('vehicles');
    }
};
