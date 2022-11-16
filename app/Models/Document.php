<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'url',
        'model_id',
        'format',
        'filename',
        'public_id',
        'type',
        'client_id',
        'model',
    ];

    /**
     * Applicable document types
     *
     */
    public const TYPES = [
        'Certificate of Plot Allocation',
        'Land Sales Receipt or Agreement',
        'Deed of Lease',
        'Deed of Assignment',
        'Irrevocable Power of Attorney',
        'Authority to Lift',
        'Certificate of Occupancy',
    ];

    /**
     * Applicable document formats
     *
     */
    public const FORMATS = [
    ];
}
