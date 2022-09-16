<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pcf extends Model
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
     * A property search request must belong to a client
     *
     * @var array<string, string>
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * A Plan collection must be issued by a staff.
     *
     * @var array<string, string>
     */
    public function staff()
    {
        return $this->belongsTo(Staff::class, 'issued_by');
    }
}
