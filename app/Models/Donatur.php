<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donatur extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'fundraising_id',
        'total_amount',
        'phone_number',
        'notes',
        'is_paid',
        'proof',
    ] ;
}
