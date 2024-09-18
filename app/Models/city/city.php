<?php

namespace App\Models\city;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class city extends Model
{
    use HasFactory;

    protected $cities = [
        "name",
        "image",
        "price",
        "num_days",
        "country_id",
    ];

    public $timestamps = true;
}
