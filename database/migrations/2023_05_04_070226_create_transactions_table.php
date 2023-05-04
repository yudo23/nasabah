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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("nasabah_id");
            $table->datetime("date");
            $table->string("description",255);
            $table->string("debit_credit_status",1);
            $table->decimal('amount', 16, 4)->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('nasabah_id')
                ->references('id')
                ->on('nasabahs')
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
