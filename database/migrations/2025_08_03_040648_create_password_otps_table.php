<?php

// database/migrations/xxxx_xx_xx_create_otp_logs_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('otp_logs', function (Blueprint $table) {
            $table->id();
            $table->string('email')->index();
            $table->string('otp_code'); // Will be hashed for security
            $table->integer('attempts')->default(0);
            $table->boolean('is_verified')->default(false);
            $table->timestamp('expires_at')->index();
            $table->ipAddress('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->timestamps();
            
            // Composite indexes for better query performance
            $table->index(['email', 'is_verified', 'expires_at']);
            $table->index(['created_at', 'expires_at']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('otp_logs');
    }
};
