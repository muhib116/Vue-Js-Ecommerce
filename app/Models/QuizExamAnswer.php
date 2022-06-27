<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizExamAnswer extends Model
{
    use HasFactory;
    public function quizQuestion(){
        return $this->belongsTo(QuizQuestion::class, 'question_id');
    }
    
    public function user(){
        return $this->belongsTo(\App\User::class, 'user_id');
    }
}
