<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('type_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('name', 200);
            $table->string('cpf_cnpj', 20);
            $table->string('email', 150);
            $table->string('phone', 20);
            $table->char('type', 1)->comment('C = cliente, F = fornecedor');

            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();

            $table->timestamps();
        });

        DB::statement("ALTER TABLE type_accounts ADD CONSTRAINT chk_type_accounts_type CHECK (type IN ('C', 'F'))");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('type_accounts', function (Blueprint $table) {
            $table->dropConstrainedForeignId('user_id');
        });

        Schema::dropIfExists('type_accounts');
    }
};
