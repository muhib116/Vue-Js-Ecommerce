<div class="QuizQuestions">
<h3>{{$quizNO}} . {{$question->question_title}} </h3>
<input type="hidden" name="qsn_id" value="{{$question->id}}">
<input type="hidden" name="nextBtn" value="{{$question->answer}}">
<div class="radio">
    <input id="1" required type="radio" value="1" name="answer">
    <label class="radio-label" for="1">{{$question->option_1 }}</label>
</div>
<div class="radio"><input id="2" required type="radio" value="2" name="answer">
    <label class="radio-label" for="2">{{ $question->option_2 }}</label>
</div>
@if ($question->option_3 != null)
<div class="radio"><input id="3" required type="radio" value="3" name="answer">
    <label class="radio-label" for="3">{{$question->option_3 }}</label>
</div>
@endif
@if ($question->option_4 != null) 
<div class="radio"><input id="4" required type="radio" value="4" name="answer">
    <label class="radio-label" for="4">{{ $question->option_4 }}</label>
</div>
@endif

<div id="quizButtons" class="quizButtons large-10 medium-10 columns">
    <div id="next" class="quizButton large-2">
      <button type="submit" id="nextButton" class="buttons">Next question</button>
    </div>
</div>
</div><p style="color: red;" id="errorArea"></p>