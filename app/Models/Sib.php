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
        'plan_id',

        'layout_id',
        'plot_numbers',
        'location',
        'phone',
        'layout_id',
        
        'approved',
        'approved_by',
        'approved_at',

        'status',
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
     * Site inspection must belong to a plan
     *
     * @var array<string, string>
     */
    public function plan()
    {
        return $this->belongsTo(Plan::class);
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
