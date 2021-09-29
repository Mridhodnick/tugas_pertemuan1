<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Question extends Model
{
    use HasFactory;
    protected $fillable = [
      'question_id',
      'author_id',
      'questions',
      ];
    public function responses(){
      return $this->hasMany(Response::class);
     }

     public function user(){
        return $this->belongsTo(User::class, 'author_id');
     }

}
