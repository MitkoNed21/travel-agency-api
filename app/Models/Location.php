<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        "street",
        "number",
        "city",
        "country",
        "image_url",
    ];

    public function holidays() {
        return $this->hasMany(Holiday::class);
    }
}
