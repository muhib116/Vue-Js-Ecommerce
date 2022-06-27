<table class="table display table-bordered table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Question</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>

    @if(count($participantAnswers)>0)
        @foreach($participantAnswers as $index => $participantAnswer)
        <tr>
        	<td>{{$index+1 }}</td>
            <td>{{$participantAnswer->quizQuestion->question_title}}</td>
            <td>
                @if($participantAnswer->right_answer == 1)
                <i style="color:green;" class="fa fa-check"></i>
                @else
                 <i style="color:red;" class="fa fa-times"></i>
                @endif
            </td>
        </tr>
       @endforeach
    @else <tr><td colspan="8"> <h1>No answer found.</h1></td></tr>@endif

    </tbody>
</table>