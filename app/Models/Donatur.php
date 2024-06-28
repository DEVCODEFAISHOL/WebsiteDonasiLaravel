<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Donatur extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'name',
        'fundraising_id',
        'total_amount',
        'phone_number',
        'notes',
        'is_paid',
        'proof',
    ] ;
    
    protected $dates = ['deleted_at'];
}
