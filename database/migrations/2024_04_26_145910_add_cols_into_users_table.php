<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('organization_id')->nullable();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->unsignedBigInteger('position_id')->nullable();

            $table->foreign('organization_id')
                ->references('id')->on('organizations')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('department_id')
                ->references('id')->on('departments')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('position_id')
                ->references('id')->on('positions')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['organization_id']);
            $table->dropColumn('organization_id');

            $table->dropForeign(['department_id']);
            $table->dropColumn('department_id');

            $table->dropForeign(['position_id']);
            $table->dropColumn('position_id');
        });
    }
};
