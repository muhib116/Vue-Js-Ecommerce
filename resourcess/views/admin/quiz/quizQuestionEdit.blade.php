<input type="hidden" value="{{$quizQuestion->id}}" name="id">
<div class="col-md-12">
	<div class="form-group">
	    <label for="question_title">Question title</label>
	    <textarea placeholder="Enter Title" name="question_title" id="question_title" class="form-control" rows="1" style="resize: vertical !important"  required="">{!! $quizQuestion->question_title !!}</textarea>
	</div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label class="required" for="option1">1.Option</label>
        <input type="text" required="" value="{{$quizQuestion->option_1}}" placeholder="Enter Option" name="option1" id="option1" class="form-control ">
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label  class="required" for="option2">2.Option</label>
        <input type="text" value="{{$quizQuestion->option_2}}" required placeholder="Enter Option" name="option2" id="option2" class="form-control ">
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label  for="option3">3.Option</label>
        <input type="text" value="{{$quizQuestion->option_3}}" placeholder="Enter Option" name="option3" id="option3" class="form-control ">
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label  for="option4">4.Option </label>
        <input type="text" value="{{$quizQuestion->option_4}}" placeholder="Enter Option" name="option4" id="option4" class="form-control ">
    </div>
</div>


<div class="col-md-4">
    <div class="form-group">
       <label class="required" for="answer">Answer</label>
        <input type="number" value="{{$quizQuestion->answer}}" placeholder="Enter answer number" name="answer" id="answer" required=""  class="form-control ">
       
    </div>
</div>
<div class="col-md-4">
    <div class="form-group"> 
        <label lass="required">Question Category</label>
        <select required name="category" class="form-control">
            <option @if($quizQuestion->category == 1) selected @endif value="1">Woadi related</option>
            <option @if($quizQuestion->category == 2) selected @endif value="2">National</option>
            <option @if($quizQuestion->category == 3) selected @endif value="3">International</option>
            <option @if($quizQuestion->category == 4) selected @endif value="4">General knowledge</option>
            <option @if($quizQuestion->category == 5) selected @endif value="5">Sports</option>
            <option @if($quizQuestion->category == 6) selected @endif value="6">Technology</option>
        </select>
    </div>
</div>

<div class="col-md-4">
    <div class="form-group"> 
        <label lass="required">Question level</label>
        <select required name="level" class="form-control">
            <option @if($quizQuestion->level == 'beginner') selected @endif value="beginner">Beginner</option>
            <option @if($quizQuestion->level == 'Easy') selected @endif value="easy">Easy</option>
            <option @if($quizQuestion->level == 'normal') selected @endif value="normal">Normal</option>
            <option @if($quizQuestion->level == 'hard') selected @endif value="hard">Hard</option>
            <option @if($quizQuestion->level == 'challenging') selected @endif value="challenging">Challenging</option>
        </select>
    </div>
</div>
