<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model {
    use HasFactory;

    protected $fillable = ['user_id','title', 'start_date', 'start_time', 'end_date', 'end_time', 'location'];
}
