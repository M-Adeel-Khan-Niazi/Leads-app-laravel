<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadMeasureCategories extends Model
{
    use HasFactory;

    protected $fillable = ['m2', 'category', 'start_date', 'measure_status', 'completion_date', 'is_warranty_applied',
        'ibg_cost', 'lead_id', 'installer_id', 'is_customer_informed','is_pibi','is_design','is_tech_survey'];

    public function category_types()
    {
        return $this->hasMany(LeadMeasureCategoryTypes::class, 'measure_category_id', 'id');
    }
}
