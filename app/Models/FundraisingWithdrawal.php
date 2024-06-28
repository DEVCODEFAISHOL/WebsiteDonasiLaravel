<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FundraisingWithdrawal extends Model
{
    use HasFactory;

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
}
