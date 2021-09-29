<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Question;

class Response extends Model
{
    use HasFactory;
    protected $fillable = [
        'author_id',
        'question_id',
        'response',
    ];
    
    public function questions(){
        return $this->belongsTo(Question::class,'question_id');
     }

    public function user(){
        return $this->belongsTo(User::class,'author_id');
    } 

}
