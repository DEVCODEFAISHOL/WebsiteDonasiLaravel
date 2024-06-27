<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FundraisingPhase extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "photo",
        "notes",
        "photo",
        "fundraising_id",
        
    ];
}