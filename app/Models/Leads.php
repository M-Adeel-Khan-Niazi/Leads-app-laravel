<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leads extends Model
{
    use HasFactory;

    protected $guarded = ['created_at'];

    public function created_by_user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function details()
    {
        return $this->belongsTo(LeadDetails::class, 'id', 'lead_id');
    }

    public function data_matched()
    {
        return $this->belongsTo(LeadDataMatches::class, 'id', 'lead_id');
    }

    public function retrofit()
    {
        return $this->belongsTo(LeadRetrofit::class, 'id', 'lead_id');
    }

    public function agent_details()
    {
        return $this->belongsTo(User::class, 'agent_id', 'id');
    }

    public function pictures()
    {
        return $this->hasMany(FileUploads::class, 'lead_id', 'id');
    }

    public function other_pictures()
    {
        return $this->pictures()->where('type', 'other');
    }

    public function property_check_pictures()
    {
        return $this->pictures()->where('type', 'property_check');
    }

    public function data_match_pictures()
    {
        return $this->pictures()->where('type', 'data_match');
    }

    public function benefit_proof_pictures()
    {
        return $this->pictures()->where('type', 'benefit_proof');
    }

    public function address_proof_pictures()
    {
        return $this->pictures()->where('type', 'address_proof');
    }
}
