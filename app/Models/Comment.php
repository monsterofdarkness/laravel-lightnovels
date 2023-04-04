<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $dates = [
        'created_at', 'updated_at'
    ];
    
    public $timestamps =  false;
    protected $fillable = [
        'novel_id', 'user_id', 'comment_parent_id', 'content', 'status', 'created_at', 'updated_at'
    ];
    protected $primaryKey = 'id';
    protected $table = 'comment';

    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function replies() {
        return $this->hasMany(Comment::class, 'comment_parent_id', 'id');
    }


}
