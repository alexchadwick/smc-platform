<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Course Attempts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <table class="table" style="width: 100%">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Course</th>
                            <th>Status</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach(auth()->user()->course_attempts as $item)
                            <tr>
                                <th scope="row">{{ $item['id'] }}</th>
                                <td>{{ $item->course['name'] }}</td>
                                <td>{!!  $item->completed_at ? $item->completed_at : '<span style="color:red;">Not Completed</span>' !!}</td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>