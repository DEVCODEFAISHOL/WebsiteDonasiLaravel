<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class FundraisingWithdrawal extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        "proof",
        "bank_name",
        "bank_account_name",
        "bank_account_number",
        "amount_requested",
        "has_set",
        "amount_received",
        "has_received",
        "fundraiser_id",
        "fundraising_id",
    ];
    
    protected $dates = ['deleted_at'];

    public function fundraising(){
        return $this->belongsTo(Fundraising::class);
    }
    public function fundraiser(){
        return $this->belongsTo(Fundraiser::class);
    }

}
