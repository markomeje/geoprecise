<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sib extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'form_id',
        'client_id',
        'completed',
        'survey_id',
        'approved',
        'approved_by',
        'approved_at',
        'recorder_type',
        'status',
        'recorded_by',
        'comments',
    ];

    /**
     * A sib belongs to a form
     *
     * @var array<string, string>
     */
    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    /**
     * A sib has one payment
     *
     * @var array<string, string>
     * cd xamc
     */
    public function payment()
    {
        return $this->hasOne(Payment::class, 'model_id')->where(['model' => 'sib', 'status' => 'paid']);
    }
    

    /**
     * A sib belongs to a layout
     *
     * @var array<string, string>
     */
    public function layout()
    {
        return $this->belongsTo(Layout::class);
    }

    /**
     * Site inspection must belong to a client
     *
     * @var array<string, string>
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Approver of a particular site inspection.
     *
     * @var array<string, string>
     */
    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

     /**
     * Get the staff who recorded the site inspection.
     */
    public function recorder()
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }

    /**
     * Site inspection must belong to a survey
     *
     * @var array<string, string>
     */
    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }

}
