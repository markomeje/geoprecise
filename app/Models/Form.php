<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    /**
     * A form has one fee
     *
     * @var array<string, string>
     */
    public function fee()
    {
        return $this->hasOne(Fee::class);
    }
}
