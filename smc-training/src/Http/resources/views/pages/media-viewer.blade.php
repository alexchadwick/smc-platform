@extends('smc-training::layouts.training-basic')
@section('content')
    <?php $debug = $debug ?? false ?>
    <div class="mt-3 mb-5">
        <h5>Media Viewer</h5>

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
                <h5>$media</h5>
                <div class="table-responsive">
                    <table class="table table-sm table-responsive">
                        <tbody>
                        <tr>
                            <td><pre>@if(isset($media)){{ json_encode(v, JSON_PRETTY_PRINT) }}@endif</pre></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif

        <div class="card mb-3">
            <div class="card-header text-white bg-theme">
                Media Viewer
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
                </div>`

    </div>
@endsection