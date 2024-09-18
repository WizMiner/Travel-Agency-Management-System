<?php

namespace App\Models\Country;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;


    protected $table = 'countrie';

    protected $fillable = [
        "name",
        "population",
        "territory",
        "avg_price",
        "description",
        "image",
        "continent",
    ];

    public $timestamps = true;
}
