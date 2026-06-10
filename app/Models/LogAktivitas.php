<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogAktivitas extends Model
{
    use HasFactory;

    protected $table = 'log_aktivitas';

    protected $fillable = [
        'user_id',
        'aktivitas',
        'ip_address'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function log($userId, $aktivitas, $ipAddress = null)
    {
        return self::create([
            'user_id' => $userId,
            'aktivitas' => $aktivitas,
            'ip_address' => $ipAddress ?? request()->ip()
        ]);
    }
}