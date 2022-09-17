<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fullname',
        'user_id',
        'code',
        'title',
        'address',
        'created_by',
        'role',
        'status',
    ];

    /**
     * Staff status
     *
     * @var array<int, string>
     */
    public static $roles = [
        'Secretary',
        'Admin',
        'Manager',
    ];

    /**
     * Staff titles
     *
     * @var array<int, string>
     */
    public static $titles = [
        'Surv',
        'Mr',
        'Miss',
    ];
}
