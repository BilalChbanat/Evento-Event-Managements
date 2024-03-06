<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = 'events';

    protected $fillable = [
        'image',
        'title',
        'location',
        'capacity',
        'availableSeats',
        'price',
        'acceptance',
        'status',
        'description',
        'date',
        'user_id',
        'category_id'
    ];
}
