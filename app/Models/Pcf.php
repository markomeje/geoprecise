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
        'plan_number',
        'location',
        'completed',
        'plan_title',
        'issued',
        'client_id',
        'recorded_by',
        'status',
        'survey_id',
        'recorder_type',
        'issued_by',
        'issued_at',
    ];

    /**
     * A plan belongs to a form
     *
     * @var array<string, string>
     */
    public function form()
    {
        return $this->belongsTo(Form::class);
    }

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
     * Issued of a particular plan.
     *
     * @var array<string, string>
     */
    public function issuer()
    {
        return $this->belongsTo(User::class, 'issued_by');
    }

    /**
     * Get the staff who recorded the plan.
     */
    public function recorder()
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }
}
