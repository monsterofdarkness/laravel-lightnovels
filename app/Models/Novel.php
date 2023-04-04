<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Novel extends Model
{
    use HasFactory;

    protected $dates = [
      'created_at', 'updated_at'
    ];

    public $timestamps =  false;
    
    protected $fillable = [
        'user_id', 'novelname', 'slug_novelname', 'author', 'slug_author', 'summary', 'novel_views','type_id', 'state', 'image', 'status', 'created_at', 'updated_at'
    ];
    protected $primaryKey = 'id';
    protected $table = 'novel';

    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function chapter(){
        return $this->hasMany('App\Models\Chapter', 'novel_id', 'id');
    }

    public function belongstomanycategory(){
        return $this->belongsToMany(Category::class, 'incategory','novel_id', 'category_id');
    }

    public function favorite(){
        return $this->belongsToMany(Favorite::class, 'favorite','novel_id', 'user_id');
    }

    public function report(){
        return $this->belongsToMany(Report::class, 'report','novel_id', 'user_id');
    }

    public function comment() {
        return $this->hasMany(Comment::class, 'novel_id', 'id');
    }

}
