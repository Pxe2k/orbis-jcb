<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerApplication extends Model
{
    use HasFactory;
    protected $fillable = [
        'fullName',
        'phoneNumber',
        'email',
        'position',
        'comment',
        'file',
    ];
}
