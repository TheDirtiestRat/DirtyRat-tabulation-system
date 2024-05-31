<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    protected $fillable = [
        // 'contestant_no',
        // 'firstname',
        // 'middlename',
        // 'lastname',
        // 'gender',
        'candidate_no',
        'name',
        'photo',
    ];
}
