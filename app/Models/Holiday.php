<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    use HasFactory;

    public $fillable = [
        "title",
        "start_date",
        "duration",
        "price",
        "free_slots",
    ];

    public function location() {
        return $this->bekongsTo(Location::class);
    }

    public function reservations() {
        return $this->hasMany(Reservation::class);
    }
}
