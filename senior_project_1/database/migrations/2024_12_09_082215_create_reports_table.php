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
        
            Schema::create('reports', function (Blueprint $table) {
                $table->id();
                $table->string('report_type');
                $table->string('generated_by');
                $table->unsignedBigInteger('target_user_id');
                $table->text('metrics');
                $table->timestamps();
            
                $table->foreign('target_user_id')->references('id')->on('users')->onDelete('cascade');
            });
    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
