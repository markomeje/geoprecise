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
        'address',
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
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * A user may have many psrs
     *
     * @var array<string, string>
     */
    public function psrs()
    {
        return $this->hasMany(Psrs::class, 'client_id');
    }
}
