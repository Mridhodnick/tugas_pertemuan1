<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Cresponse;

class Course extends Model
{
    use HasFactory;
    protected $table = 'courses';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'chapter_title',
        'user_id',
        'description',
        'body',
    ];
    
    public function trainers(){
       return $this->belongsTo(User::class,'author_id');
    }

}
