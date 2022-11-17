<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'form_id',
        'purchaser_name',
        'purchaser_address',
        'purchaser_phone',

        'seller_name',
        'seller_address',
        'seller_phone',

        'layout_id',
        'document_presented',
        'plot_numbers',

        'approval_comments',
        'approval_name',
        'approval_address',

        'client_id',
        'completed',
        'status',
        'staff_id',
        'agree'
    ];

    /**
     * A survey belongs to a layout
     *
     * @var array<string, string>
     */
    public function layout()
    {
        return $this->belongsTo(Layout::class);
    }

    /**
     * A survey has many document
     *
     * @var array<string, string>
     */
    public function documents()
    {
        return $this->hasMany(Document::class, 'model_id')->where(['model' => 'survey']);
    }

    /**
     * A survey belongs to a form
     *
     * @var array<string, string>
     */
    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    /**
     * A survey has one payment
     *
     * @var array<string, string>
     */
    public function payment()
    {
        return $this->hasOne(Payment::class, 'model_id')->where(['model' => 'survey', 'status' => 'paid']);
    }

    /**
     * A survey belongs to a client
     *
     * @var array<string, string>
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Approver of a particular survey.
     *
     * @var array<string, string>
     */
    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /**
     * Get the staff who recorded the survey.
     */
    public function recorder()
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }

    /**
     * A survey may have one site inspection record.
     */
    public function sib()
    {
        return $this->hasOne(Sib::class, 'survey_id');
    }

    /**
     * A survey has one plan
     *
     * Plan collection form
     * @var array<string, string>
     */
    public function pcf()
    {
        return $this->hasOne(Pcf::class, 'survey_id');
    }
    
}
