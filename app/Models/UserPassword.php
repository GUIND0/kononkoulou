<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPassword extends Model
{
    use HasFactory;

    protected $table = 'userpassword';

    protected $fillable = [
        'users_id',
        'expired_at',
        'token',
        'statut',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
