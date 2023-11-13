<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Password extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'password',
        'access',
        'user_id',
        'group_id',
    ];

    public function group()
    {
        return $this->belongsTo(PasswordGroup::class, 'group_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
