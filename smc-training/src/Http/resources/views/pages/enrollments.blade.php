<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Enrollments') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <table class="table" style="width: 100%;font-size: 11px">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Course</th>
                            <th>Attempts</th>
                            <th>Enrollment Count</th>
                            <th>Assigned By</th>
                            <th>Created At</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach(auth()->user()->course_enrollments as $item)
                            <tr>
                                <th scope="row">{{ $item['id'] }}</th>
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

                                <td>{!!  $item->completed_at ? $item->completed_at : '<span style="color:red;">Not Completed</span>' !!}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->assignedBy ? $item->assignedBy['name'] : 'System'}}</td>
                                <td><a href="attempt/course/{{ $item->course['id'] }}">Start course</a></td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>