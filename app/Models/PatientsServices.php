<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientsServices extends Model
{
    use HasFactory;
    protected $fillable = ['patient','service','general_comments'];
}
