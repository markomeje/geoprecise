<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fullname',
        'title',
        'dob',
        'occupation',
        'city',
        'address',
        'state',
        'phone',
        'user_id',
        'status',
    ];

    /**
     * A client belongs to a user
     *
     * @var array<string, string>
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
