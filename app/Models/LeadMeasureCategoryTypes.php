<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadMeasureCategoryTypes extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'cost', 'lead_id', 'measure', 'type'];
    protected $casts = ['measure' => 'array'];
}
