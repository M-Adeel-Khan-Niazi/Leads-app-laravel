<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadDetails extends Model
{
    use HasFactory;
    protected $guarded = ['created_at'];

    public function measure_categories()
    {
        return $this->hasMany(LeadMeasureCategories::class, 'lead_id', 'lead_id');
    }
}
