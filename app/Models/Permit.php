<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permit extends Model
{
    use HasFactory;

    protected $fillable = ['eatery_id', 'permit_no', 'expires_on'];

    protected $casts = ['expires_on' => 'date'];

    public function eatery()
    {
        return $this->belongsTo(Eatery::class);
    }
}
