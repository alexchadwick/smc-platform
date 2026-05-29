@extends('smc-training::layouts.training-basic')
@section('content')
    <?php $debug = $debug ?? false ?>
    <div class="mt-3 mb-5">
        <h5>Results</h5>

        @if($debug)
        <div>
            <div>
                <h5>$courseAttempt</h5>
                <div class="table-responsive">
                    <table class="table table-sm">
                        <tbody>
                        <tr>
                            <td><pre>@if(isset($courseAttempt)){{ json_encode($courseAttempt, JSON_PRETTY_PRINT) }}@endif</pre></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div>
                <h5>$courseResultData</h5>
                <div class="table-responsive">
                    <table class="table table-sm table-responsive">
                        <tbody>
                        <tr>
                            <td><pre>@if(isset($courseResultData)){{ json_encode($courseResultData, JSON_PRETTY_PRINT) }}@endif</pre></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif


        <div class="card mb-3">
            <div class="card-header text-white bg-theme">
                Results
            </div>
            <div class="card-body">
                <nav class="nav">
                    <a class="nav-link active" aria-current="page" href="{{ url(route('enrollments')) }}">Enrollments</a>
                    {{--<a class="nav-link" href="#">Restart Course</a>--}}
                </nav>
            </div>
        </div>

                <div class="card mb-3">
            <div class="card-header text-white bg-theme">
                Quiz
            </div>

                    <div class="card-body">
                        <dl class="row">

                            <dt class="col-sm-3">Quiz</dt>
                            <dd class="col-sm-9">{{ $courseResultData['data']['quiz']['name'] }}</dd>

                            <dt class="col-sm-3">Status</dt>
                            <dd class="col-sm-9">{{ ($courseResultData['data']['pass'] ? 'Quiz Passed' : 'Quiz Failed') }}</dd>

                            <dt class="col-sm-3">Passing Score</dt>
                            <dd class="col-sm-9">{{ $courseResultData['data']['quiz']['pass_marks'] }}</dd>

                            <dt class="col-sm-3">User Score</dt>
                            <dd class="col-sm-9">{{ $courseResultData['data']['quizAttemptScore'] }}</dd>
                        </dl>
                    </div>
                </div>
        <div class="card mb-3">
            <div class="card-header text-white bg-theme">
                Quiz Attempt Answers
            </div>

            <div class="card-body">

                <ul class="list-group list-group-flush">
                    @foreach($courseResultData['data']['validate'] as $validateItem)


                        <li class="list-group-item">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div style="font-size: 40px">
                                        @if(!$validateItem['is_correct'])
                                            <i class="bi bi-x-square text-danger"></i>
                                        @else
                                            <i class="bi bi-check-square-fill text-success"></i>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">

                                    <dl class="row">

                                        <dt class="col-sm-3">Question Score</dt>
                                        <dd class="col-sm-9">Score: <span class="">{{ $validateItem['score'] }}</span></dd>


                                        <dt class="col-sm-3">Question</dt>
                                        <dd class="col-sm-9">{{ $validateItem['quizQuestion']['question']['name'] }}</dd>

                                        <dt class="col-sm-3">Correct Answer</dt>
                                        <dd class="col-sm-9">{{ $validateItem['correct_answer'] }}</dd>

                                        @if(!$validateItem['is_correct'])
                                            <dt class="col-sm-3 text-danger font-bold">User Answer</dt>
                                            <dd class="col-sm-9 text-danger font-bold">{{ $validateItem['user_answer'] }}</dd>
                                        @endif

                                    </dl>

                                    {{--<div>{{ json_encode($validateItem, JSON_PRETTY_PRINT) }}</div>
--}}

                                </div>
                            </div>
                        </li>

                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection