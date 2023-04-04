<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    protected $dates = [
        'created_at', 'updated_at'
    ];

    public $timestamps =  false;
    protected $fillable = [
        'novel_id', 'title', 'content', 'slug_chapter', 'status', 'created_at', 'updated_at'
    ];
    protected $primaryKey = 'id';
    protected $table = 'chapter';

    public function novel(){
        return $this->belongsTo('App\Models\Novel');
    }

}
