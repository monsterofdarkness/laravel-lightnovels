<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    protected $dates = [
        'created_at', 'updated_at'
    ];

    public $timestamps =  false;

    protected $fillable = [
        'user_id', 'title', 'slug_title','content', 'type_topic', 'created_at', 'updated_at'
    ];
    protected $primaryKey = 'id';
    protected $table = 'topic';

    public function comment_topic() {
        return $this->hasMany(CommentTopic::class, 'topic_id', 'id');
    }

    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

}
