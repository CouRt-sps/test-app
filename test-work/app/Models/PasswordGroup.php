<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PasswordGroup extends Model
{
    use HasFactory;
    protected $guarded = false;

    protected $fillable = ['name'];

    public function passwords(): HasMany
    {
        return $this->hasMany(Password::class, 'group_id');
    }
}
