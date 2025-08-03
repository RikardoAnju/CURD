<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtpLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'otp_code',
        'attempts',
        'is_verified',
        'expires_at'
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'is_verified' => 'boolean'
    ];

    // Relationship dengan User
    public function user()
    {
        return $this->belongsTo(User::class, 'email', 'email');
    }

    // Check apakah OTP masih valid
    public function isValid()
    {
        return !$this->is_verified && 
               $this->expires_at->isFuture() && 
               $this->attempts < 3;
    }

    // Increment attempts
    public function incrementAttempts()
    {
        $this->increment('attempts');
    }

    // Mark as verified
    public function markAsVerified()
    {
        $this->update(['is_verified' => true]);
    }
}