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
        'plot_ids',
        'layout_id',
        'user_id',
        'completed',
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
}
