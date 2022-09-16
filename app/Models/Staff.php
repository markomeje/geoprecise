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
        'form_id',
        'plot_numbers',
        'staff_id',
        'completed',
        'description',
        'client_id',
        'status',
    ];

    /**
     * Staff status
     *
     * @var array<int, string>
     */
    public const STATUS = [
        'active',
        'banned',
        'pending',
        'denied',
    ];
}
