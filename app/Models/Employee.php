<?php

namespace App\Models;

use App\Models\Position;
use App\Models\Departament;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;

    public function getDepartament() {
        return $this->belongsTo(Departament::class, 'departament_id');
    }

    public function getPosition() {
        return $this->belongsTo(Position::class, 'position_id');
    }

    public function getImage()
    {
        return asset('images/avatar.png');
    }
}
