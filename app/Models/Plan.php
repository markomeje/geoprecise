<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'client_name',
        'plot_numbers',
        'layout_id',
        'plan_number',
        'address'
    ];

     /**
     * A plan may belong to a layout
     *
     * @var array<string, string>
     */
    public function layout()
    {
        return $this->belongsTo(Layout::class);
    }
}
