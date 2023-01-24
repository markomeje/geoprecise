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
        'Residential Plots' => '',
        'Open space' => 'OS',
        'Commercial Plots' => 'C',
        'Public Use Plots' => 'P',
        'full commercial' => 'P',
        'Police Post' => 'PP',
        'Utility Plots' => 'UT',
        'Health' => '',
        'Commercial Residential Plots' => 'CR',
        'Refuse Collection Point' => 'RCP',
        'Security Post' => 'P',
        'Primary School' => 'P',
        'Corner Shop' => 'CS',
        'Refuse Dump Disposal' => 'RDD',
        'Industrial Plots' => 'IN',
        'Petrol Filling Station' => 'PFS',
        'Service Shops' => 'SS',
        'Special Plots' => 'S'
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
