<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'amount',
        'per',
        'form_id',
        'additional',
        'active',
    ];

    /**
     * Applicable user titles
     *
     */
    public const PERS = [
        'per plot',
        'per beacon',
        'per lodgement',
        'per copy',
    ];

    /**
     * A fee may belong to a form
     *
     * @var array<string, string>
     */
    public function form()
    {
        return $this->belongsTo(Form::class, 'form_id');
    }
}
