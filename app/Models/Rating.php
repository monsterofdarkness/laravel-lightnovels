<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    public $timestamps =  false;
    protected $fillable = [
        'novel_id', 'user_id', 'rating_star'
    ];
    protected $primaryKey = 'id';
    protected $table = 'rating';

}
