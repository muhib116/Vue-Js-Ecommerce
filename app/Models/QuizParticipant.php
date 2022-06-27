<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizParticipant extends Model
{
    use HasFactory;
    public  function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function quizAnswers(){
        return $this->hasMany(QuizExamAnswer::class, 'participant_id');
    }
    public function TotalRightAnswers(){
        return $this->hasMany(QuizExamAnswer::class, 'user_id', 'user_id')->where('right_answer', 1);
    }
    public function TotalWrongAnswers(){
        return $this->hasMany(QuizExamAnswer::class, 'user_id', 'user_id')->where('right_answer', 0);
    }
    public function get_division(){
        return $this->belongsTo(State::class, 'division');
    }
    public function get_city(){
        return $this->belongsTo(City::class, 'city');
    }
    
    public function offer(){
        return $this->belongsTo(Offer::class, 'quiz_id');
    }
}
