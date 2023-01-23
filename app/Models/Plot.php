<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plot extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'number',
        'category',
        'layout_id',
    ];

    /**
     * Plot categories
     *
     * @var array<int, string>
     */
    public const CATEGORIES = [
        'residential Plots',
        'open space',
        'commercial Plots',
        'Public Plots',
        'full commercial',
        'Utility Plots',
        'health',
        'Commercial/Residential',
        'refuse',
        'security',
        'primary',
        'Corner Shop'
    ];

    /**
     * A plot may belong to a layout
     *
     * @var array<string, string>
     */
    public function layout()
    {
        return $this->belongsTo(Layout::class);
    }
}
