<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;
    public $timestamps =  false;
    protected $fillable = [
        'novel_id', 'user_id'
    ];
    protected $primaryKey = 'id';
    protected $table = 'favorite';

    public function novel() {
        return $this->belongsTo(Novel::class, 'novel_id', 'id');
    }

}
