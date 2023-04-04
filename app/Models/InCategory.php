<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InCategory extends Model
{
    use HasFactory;
    public $timestamps =  false;
    protected $fillable = [
        'novel_id', 'category_id'
    ];
    protected $primaryKey = 'id';
    protected $table = 'incategory';
}
