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

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function fundraiser()
    {
        return $this->belongsTo(Fundraiser::class);
    }
    public function Donaturs()
    {
        return $this->hasMany(Donatur::class)->where('is_paid', 1);
    }

    public function totalReachedAmount()
    {
        return $this->Donaturs()->sum('total_amount');
    }
    public function withdrawals()
    {
        return $this->hasMany(FundraisingWithdrawal::class);
    }
}
