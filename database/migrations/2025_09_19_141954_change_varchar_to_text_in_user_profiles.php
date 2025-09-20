<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('user_profiles', function (Blueprint $table) {

        $columns = DB::select("
            SELECT COLUMN_NAME
            FROM INFORMATION_SCHEMA.COLUMNS
            WHERE TABLE_NAME = 'user_profiles'
            AND DATA_TYPE = 'varchar'
        ");

        Schema::table('user_profiles', function (Blueprint $table) use ($columns) {
            foreach ($columns as $column) {
                $table->text($column->COLUMN_NAME)->change()->nullable();
            }
        });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $columns = DB::select("
            SELECT COLUMN_NAME
            FROM INFORMATION_SCHEMA.COLUMNS
            WHERE TABLE_NAME = 'user_profiles'
            AND DATA_TYPE = 'text'
        ");

        Schema::table('user_profiles', function (Blueprint $table) use ($columns) {
            foreach ($columns as $column) {
                $table->string($column->COLUMN_NAME, 255)->change()->nullable();
            }
        });
    }
};
