<?php

namespace App\Models;

use App\IsSelfReferencing;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departament extends Model
{
    use HasFactory, IsSelfReferencing;
}
