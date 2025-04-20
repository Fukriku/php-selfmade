<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Group extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'group_name',
        'owner_id',
        'password',
    ];

    // hasmany->belongsToMany
    public function users()
    {
        return $this->belongsToMany(User::class, 'group_users');
    }
}
