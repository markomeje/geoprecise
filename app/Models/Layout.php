<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layout extends Model
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
        'active',
        'address',
        'plot_sizes'
    ];

    /**
     * The status of the layout
     *
     * @var array<int, string>
     */
    public static $status = [
        'active' => true,
        'inactive' => false,
    ];

    /**
     * A layout has many plots
     *
     * @var array<string, string>
     */
    public function plots()
    {
        return $this->hasMany(Plot::class);
    }
}
