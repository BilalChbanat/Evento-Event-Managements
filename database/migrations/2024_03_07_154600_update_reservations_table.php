<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            // Change 'status' column to 'reservation_status' with enum values
            $table->enum('reservation_status', ['accepted', 'pending', 'refused'])->default('pending')->change();

            // You can add other modifications here if needed

            // Remove the 'reference' column (just for the example, modify as needed)
            $table->dropColumn('reference');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            // Reverse the changes made in the 'up' method
            $table->string('status')->default('pending')->change();
            $table->string('reference')->nullable();
        });
    }
}
