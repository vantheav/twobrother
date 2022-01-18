<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supporter extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'city',
        'phone',
        'ABA_number',
        'ABA_name',
        'money',
    ];
}
