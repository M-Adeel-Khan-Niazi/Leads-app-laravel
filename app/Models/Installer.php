<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Installer extends Model
{
    use HasFactory;
    protected $guarded = ['created_at'];
    protected $casts = ['type' => 'array'];
}
