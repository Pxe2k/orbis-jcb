<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceApplication extends Model
{
    use HasFactory;
    protected $fillable = [
        'fullName',
        'companyName',
        'phoneNumber',
        'email',
        'address',
        'address2',
        'city',
        'state',
        'zipCode',
        'company_id',
        'product_id',
        'year',
        'location',
        'comment',
    ];
}
