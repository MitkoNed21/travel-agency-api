<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    public $fillable = [
        "contact_name",
        "phone_number",
    ];

    public function holiday() {
        return $this->belongsTo(Holiday::class);
    }

    public function location() {
        return $this->holiday()->location();
    }
}
