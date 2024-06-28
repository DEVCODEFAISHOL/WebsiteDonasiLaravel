<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fundraising extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        "name",
        "slug",
        "thumbnail",
        "category_id",
        "fundraiser_id",
        "about",
        "is_active",
        "has_finished",
        "target_amount",
    ];
    
    protected $dates = ['deleted_at'];
}
