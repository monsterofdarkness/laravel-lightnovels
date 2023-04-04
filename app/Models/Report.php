<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    public $timestamps =  false;
    protected $fillable = [
        'user_id', 'novel_id', 'reason', 'created_at', 'approved_at'
    ];
    protected $primaryKey = 'id';
    protected $table = 'report';

    public function novel() {
        return $this->belongsTo(Novel::class, 'novel_id', 'id');
    }

    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
