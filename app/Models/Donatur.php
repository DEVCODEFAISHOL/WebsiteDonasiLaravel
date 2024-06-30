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
        'notes',
        'fundraising_id',
        'total_amount',
        'phone_number',
        'is_paid',
        'proof',
    ] ;
    
    protected $dates = ['deleted_at'];
        //1 donatur di miliki oleh si fundraising tersebut
    public function fundraising(){
        return $this->belongsTo( Fundraising::class);
    }

}
