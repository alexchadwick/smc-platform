@extends('smc-training::layouts.training-basic')
@section('content')
    <div class="mt-4 mb-5 ">
        <div class="py-3">
            <a class="btn btn-sm btn-outline-dark" href="{{ url('training-center#!/courseEnrollments') }}">Go back</a>
            <a class="btn btn-sm btn-outline-dark" href="{{ url("/attempt/course/".$courseEnrollment->course['id']) }}">Start course</a>
        </div>

        <div class="table-responsive">
            <table class="table table-sm" style="width: 100%;font-size: 11px">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Status</th>
                    <th>Course</th>
                    <th style="min-width: 300px">Attempts</th>
                    <th>Enrollment Count</th>
                    <th>Assigned By</th>
                    <th>Created At</th>
                </tr>
                </thead>
                <tbody>
                @foreach([$courseEnrollment] as $item)
                    <tr>
                        <th scope="row">{{ $item['id'] }}</th>
                        <td>{!!  $item->completed_at ? $item->completed_at : '<span style="color:red;">Not Completed</span>' !!}</td>
                        <td>{{ $item->course['name'] }}</td>
                        <td>

                                <?php
                                //..
                                $course_enrollments_count = auth()->user()->course_enrollments()->where('course_id', $item->course['id'])->count();

                                $newAttempts = auth()->user()->course_attempts()
                                    ->where('course_id', $item->course['id'])
                                    ->whereDate('course_attempts.created_at', '>=' , $item->created_at)->get();

                                $prevAttempts = auth()->user()->course_attempts()
                                    ->where('course_id', $item->course['id'])
                                    ->whereDate('course_attempts.created_at', '<' , $item->created_at)->get();
                                ?>

                            <h5 style="border-bottom: solid 1px #000">Current Attempts ({{ count($newAttempts) }} Total)</h5>
                            <!-- nested row -->
                            <table style="font-size: 8px">
                                @if(count($newAttempts) == 0)
                                    <span style="color:red;">Zero Current Attempts</span>
                                @endif
                                @foreach($newAttempts as $attemptItem)
                                    <tr>
                                        <td>{{ $attemptItem['id'] }}</td>
                                        <td>{{ $attemptItem['created_at'] }}</td>
                                        <td>{{ $attemptItem['completed_at'] }}</td>
                                        <td>{{ $attemptItem['durationMin'] }}</td>
                                    </tr>
                                @endforeach
                            </table>
                            @if($course_enrollments_count >= 2)
                                <h5 style="border-bottom: solid 1px #000">Previous Attempts ({{ count($prevAttempts) }} Total)</h5>
                                <!-- nested row -->
                                <table style="font-size: 8px">
                                    @if(count($prevAttempts) == 0)
                                        <span style="color:red;">Zero Previous Attempts</span>
                                    @endif
                                    @foreach($prevAttempts as $attemptItem)
                                        <tr>
                                            <td>{{ $attemptItem['id'] }}</td>
                                            <td>{{ $attemptItem['created_at'] }}</td>
                                            <td>{{ $attemptItem['completed_at'] }}</td>
                                            <td>{{ $attemptItem['durationMin'] }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            @endif

                        </td>
                        <td>{{ $course_enrollments_count }}</td>

                        <td>{{ $item->assignedBy ? $item->assignedBy['name'] : 'System'}}</td>
                        <td>{{ $item->created_at }}</td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>


@endsection