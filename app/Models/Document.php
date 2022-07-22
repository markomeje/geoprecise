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
        'type',
        'description',
        'user_id',
    ];

    /**
     * Applicable document types
     *
     */
    public const TYPES = [
        'Certificate of Plot Allocation',
        'Land Sales Receipt or Agreement',
        'Deed of Lease, Assignment or Irrevocable Power of Attorney',
    ];
}
