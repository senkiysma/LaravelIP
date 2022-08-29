<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = [
        "checked_out"=>"datetime"
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getOrderAttribute()
    {
        $ls = explode("|",$this->full_address);
        unset($ls[0]);
        unset($ls[1]);
        unset($ls[2]);
        return implode($ls);
    }
}
