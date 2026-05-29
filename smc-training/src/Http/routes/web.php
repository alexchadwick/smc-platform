<?php
// WEB
use Quiz\Api\Models\Question;
use Quiz\Api\Models\QuestionOption;
use Quiz\Api\Models\QuizQuestion;
use Quiz\Api\Models\QuizAttempt;
use Quiz\Api\Models\QuizAttemptAnswer;

Route::group(['middleware' => ['web',
    'auth'
]], function () {

    Route::get('/enrollments', function () {
        return redirect(url('training-center#!/courseEnrollments'));
        return view('smc-training::pages.enrollments')->with([
            'pageDetails' => [
                'title' => 'Enrollments'
            ]
        ]);
    })->name('enrollments');
    Route::get('/enrollments/{courseEnrollment}', function (\Training\Api\Models\CourseEnrollment $courseEnrollment) {
        return view('smc-training::pages.enrollment')->with([
            'courseEnrollment' => $courseEnrollment,
            'pageDetails' => [
                'title' => 'View Attempts'
            ]
        ]);
    })->name('enrollment');

    Route::get('/course_attempts', function () {
        return view('smc-training::pages.course-attempts')->with([
            'pageDetails' => [
                'title' => 'Course Attempts'
            ]
        ]);
    })->name('courseAttempts');


    Route::get('/training-center', function () {
        return view('smc-training::pages.portal')->with([
            'pageDetails' => [
                'title' => 'Training Center'
            ]
        ]);
    })->name('trainingCenter');

    Route::get('/course/activity', function () {
        return view('smc-training::pages.activity')->with([
            'pageDetails' => [
                'title' => 'Course Activity'
            ]
        ]);
    })->name('courseActivity');

    Route::get('testing/course/seed', function (\Illuminate\Http\Request $request) {
        $course = \Training\Api\Models\Course::factory()->create();

        $enrollment = $request->user()->course_enrollments()->create(['course_id' => $course->id]);

        return response()->json([
            'course' => $course,
            'enrollment' => $enrollment,
        ]);
    })->name('testingCourse');

    Route::get('attempt/course/{course}', function (\Training\Api\Models\Course $course) {

        return redirect('testing/course/'. $course->id);

        //Record attempt
        $attempt = auth()->user()->course_attempts()->create([
            'course_id' => $course->id,
            'last_viewed' => now()
        ]);
        /*
                $attempt->completeCourse();
                return view('smc-training::pages.media')->with([
                    'attempt' => $attempt,
                    'course' => $course,
                    'pageDetails' => [
                        'title' => 'Course Activity'
                    ]
                ]);*/

        return view('smc-training::pages.quiz')->with([
            'quiz' => [],
            'attempt' => $attempt,
            'courseAttempt' => $attempt,
            'course' => $course,
            'pageDetails' => [
                'title' => 'Course Activity'
            ]
        ]);
    })->name('attemptCourse');

    Route::post('attempt/course/{course}/{courseAttempt}/heartbeat', function (\Training\Api\Models\Course $course, \Training\Api\Models\CourseAttempt $courseAttempt) {

        //Update attempt
        $courseAttempt->last_viewed = now();
        $courseAttempt->save();

        return response()->json(['success' => true]);

    })->name('attemptCourseHeartbeat');

    Route::get('testing/course/{course}', function (\Training\Api\Models\Course $course) {

        //Record attempt
        $attempt = auth()->user()->course_attempts()->create([
            'course_id' => $course->id,
            'last_viewed' => now()
        ]);

        /*
        //Create test CourseMediaItem
        $courseMediaItem = \Training\Api\Models\CourseMediaItem::create([
            'name' => 'Sample CourseMediaItem',
            'description' => 'This is description.',
            'version_slug' => '1.0.1',
        ]);

        //Create test CourseMediaItem
        $courseMediaItem2 = \Training\Api\Models\CourseMediaItem::create([
            'name' => 'Sample CourseMediaItem2',
            'description' => 'This is description.',
            'version_slug' => '1.0.2',
            'parent_id' => $courseMediaItem->id,
        ]);

        $courseMediaItem3 = \Training\Api\Models\CourseMediaItem::create([
            'name' => 'Sample CourseMediaItem3',
            'description' => 'This is description.',
            'version_slug' => '1.0.3',
            'parent_id' => $courseMediaItem->id,
        ]);

        //Create test attachment
        $attachment = \Training\Api\Models\Attachment::create([
            'attachable_id' => $courseMediaItem->id,
            'attachable_type' => get_class($courseMediaItem),
            'attachment_file_size' => 1000,
            'attachment_content_type' => 'application/pdf',
            'attachment_file_name' => 'test.pdf',
            'attachment_location' => '/app/attachments/1111.pdf',
        ]);

        $attachment2 = \Training\Api\Models\Attachment::create([
            'attachable_id' => $courseMediaItem2->id,
            'attachable_type' => get_class($courseMediaItem),
            'attachment_file_size' => 1000,
            'attachment_content_type' => 'application/pdf',
            'attachment_file_name' => 'test2.pdf',
            'attachment_location' => '/app/attachments/2222.pdf',
        ]);

        $attachment3 = \Training\Api\Models\Attachment::create([
            'attachable_id' => $courseMediaItem3->id,
            'attachable_type' => get_class($courseMediaItem),
            'attachment_file_size' => 1000,
            'attachment_content_type' => 'application/pdf',
            'attachment_file_name' => 'test3.pdf',
            'attachment_location' => '/app/attachments/3333.pdf',
        ]);


        //Create test Courseable
        $courseable = \Training\Api\Models\Courseable::create([
            'course_id' => $course->id,
            'courseable_id' => $courseMediaItem->id,
            'courseable_type' => get_class($courseMediaItem)
        ]);*/

        $courseables = $course->courseables()->with('courseable')->get();

        if(request()->has('targetCourseable') && !empty(request()->get('targetCourseable')))
        {
            $courseable = $course->courseables()->where('id', request()->get('targetCourseable'))->first();
        }
        else
        {
            //Default - Get the first courseable
            //TODO tory, add sort/order col. on table
            $courseable = $course->courseables()->orderby('id')->first();
        }

        $attempt->completeCourse();

        /**
         * writeHiddeHTMLRequestFields
         * @return void
         */
        function writeHiddeHTMLRequestFields() {
            $items = request()->all();
            foreach ($items as $key => $item) {
                echo '<input type="hidden" name="'.$key.'" value="'.$item.'">';
            }
        }

      /*  $quiz = \Quiz\Api\Models\Quiz::factory()->create([
            'pass_marks' => 2
        ]);
        // Question One And Options
        $question_one = Question::factory()->create([
            'name' => 'What is an algorithm?',
            'question_type_id' => 1,
            'is_active' => true,
        ]);
        // Question Two And Options
        $question_two = Question::factory()->create([
            'name' => 'What is an test?',
            'question_type_id' => 1,
            'is_active' => true,
        ]);
        $question_one_option_one = QuestionOption::factory()->create([
            'question_id' => $question_one->id,
            'name' => 'A computer program that solves a problem.',
            'is_correct' => true,
        ]);

        $question_two_option_one = QuestionOption::factory()->create([
            'question_id' => $question_two->id,
            'name' => 'Correct: A computer program that solves a problem.',
            'is_correct' => true,
        ]);

        $question_two_option_two = QuestionOption::factory()->create([
            'question_id' => $question_two->id,
            'name' => 'False: A computer program that solves a problem.',
            'is_correct' => false,
        ]);

        $question_two_option_three = QuestionOption::factory()->create([
            'question_id' => $question_two->id,
            'name' => 'False: somthing else.',
            'is_correct' => false,
        ]);
        // Add Question to Quiz
        $quiz_question_one =  QuizQuestion::factory()->create([
            'quiz_id' => $quiz->id,
            'question_id' => $question_one->id,
            'marks' => 1,
            'order' => 1,
        ]);

        // Add Question to Quiz
        $quiz_question_two =  QuizQuestion::factory()->create([
            'quiz_id' => $quiz->id,
            'question_id' => $question_two->id,
            'marks' => 1,
            'order' => 2,
        ]);*/

        if($courseable->courseable_type == \Training\Api\Models\CourseQuiz::class) {

            $courseable = \Training\Api\Models\Courseable::with(['courseable','courseable.quiz'])->findOrFail($courseable->id);
            //$courseQuiz = $courseable->courseable()->get();
            //return response()->json($courseable);
            return view('smc-training::pages.quiz')->with([
                'quiz' =>
                    $courseable->courseable->quiz,
                'attempt' => $attempt,
                'courseAttempt' => $attempt,
                'course' => $course,
                'pageDetails' => [
                    'title' => 'Course Activity'
                ]
            ]);

        } else {
            return view('smc-training::pages.media')->with([
                'writeHiddeHTMLRequestFields' => writeHiddeHTMLRequestFields(),
                'courseable' => $courseable,
                'courseables' => $courseables,
                'attempt' => $attempt,
                'course' => $course,
                'pageDetails' => [
                    'title' => 'Course Activity'
                ]
            ]);
        }



/*
       */
    })->name('testingCourse');

    Route::post('submit-quiz/{quizId}', function (\Illuminate\Http\Request $request, $quizId) {

        $quiz = \Quiz\Api\Models\Quiz::findOrFail($quizId);

        // Record Quiz Attempt & Answers
        //Save attempt
        $author = auth()->user();
        $quizAttempt = QuizAttempt::create([
            'quiz_id' => $quiz->id,
            'participant_id' => $author->id,
            'participant_type' => get_class($author)
        ]);

        $courseAttempt = \Training\Api\Models\CourseAttempt::findOrFail($request->get('course_attempt_id'));

        //return response()->json($request->all());

        //Save answers
        if($request->has('quizQuestionAnswerInput')) {
            //return response()->json($request->get('quizQuestionAnswerInput'));
            foreach ( $request->get('quizQuestionAnswerInput') as $key => $data) {
                $quizQuestion = \Quiz\Api\Models\QuizQuestion::findOrFail($key);
                if(is_array($data)){
                    foreach ($data as $item) {
                        $questionOption = \Quiz\Api\Models\QuestionOption::findOrFail($item);
                        QuizAttemptAnswer::create(
                            [
                                'quiz_attempt_id' => $quizAttempt->id,
                                'quiz_question_id' => $quizQuestion->id,
                                'question_option_id' => $questionOption->id,
                                //'answer' => \Quiz\Api\Models\QuestionOption::findOrFail($data)->name
                            ]
                        );
                    }
                } else {
                    $questionOption = \Quiz\Api\Models\QuestionOption::findOrFail($data);
                    $questionType = $questionOption->question->question_type;
                    if($questionType->name == 'multiple_choice_single_answer') {

                        //multiple_choice_single_answer
                        QuizAttemptAnswer::create(
                            [
                                'quiz_attempt_id' => $quizAttempt->id,
                                'quiz_question_id' => $quizQuestion->id,
                                'question_option_id' => $questionOption->id,
                                //'answer' => \Quiz\Api\Models\QuestionOption::findOrFail($data)->name
                            ]
                        );
                    }
                    if($questionType->name == 'multiple_choice_multiple_answer') {
                        //multiple_choice_multiple_answer
                        throw new Exception('invalid multiple_choice_multiple_answer');
                    }
                    if($questionType->name == 'fill_the_blank') {
                        //fill_the_blank
                        QuizAttemptAnswer::create(
                            [
                                'quiz_attempt_id' => $quizAttempt->id,
                                'quiz_question_id' => $key,
                                'question_option_id' => $data,
                                'answer' => \Quiz\Api\Models\QuestionOption::findOrFail($data)->name
                            ]
                        );
                    }

                }

            }

        }

        $pass = (boolean) ($quiz->pass_marks <= $quizAttempt->calculate_score());
        if($pass === true){
           //PASSED
            $courseAttempt->completeCourse();
        }
        $data = [ 'data' => [
            'pass' => $pass,
            'quiz' => $quiz,
            'courseAttempt' => $courseAttempt,
            'quizAttempt' => $quizAttempt,
            'quizAttemptAnswers' => $quizAttempt->answers,
            'quizAttemptAnswerCount' => $quizAttempt->answers()->count(),
            'quizAttemptScore' => $quizAttempt->calculate_score(),
            'validate' => $quizAttempt->validate(),
        ]];
        $json = json_encode(
            $data
            , JSON_PRETTY_PRINT);
        $request->session()->flash('course_results_course_attempt_' . $courseAttempt->id, $data);
        //$payload = ['data' => $json];
        //$payload = ['data' => $json];
        return redirect('course-results/quiz/'.  $courseAttempt->id)->with($data);
        //Return
        return $json;
    })->name('submitQuiz');

    Route::get('course-results/quiz/{courseAttempt}', function (\Illuminate\Http\Request $request, \Training\Api\Models\CourseAttempt $courseAttempt) {

        $courseAttempt;
        //TODO tory, connect quiz to course attempt via relation
        //TODO tory, should sessions expire?
        $sessionKey = 'course_results_course_attempt_' . $courseAttempt->id;
        if (!$request->session()->exists($sessionKey)) {
            return redirect(route('enrollments'));
        }
        $value = session($sessionKey);
        //$sessionData = $request->session('data');
        $json = json_encode(['debug' => [
            'sessionKey' => $sessionKey,
            'value' => $value,
            //'session' => $sessionData,
        ]], JSON_PRETTY_PRINT);
        return view('smc-training::pages.course-results')->with([
            'courseResultData' => $value,
            'courseAttempt' => $courseAttempt,
            'pageDetails' => [
                'title' => 'Course Attempt Results'
            ]
        ]);





    });


    Route::get('report/OpenEnrollmentReport',function (\Illuminate\Http\Request $request){
        $openEnrollments = \Training\Api\Models\CourseEnrollment::where('completed_at', null)->get();

        //return  $openEnrollments;
        return \Training\Api\Http\Resources\OpenEnrollmentReportResource::collection($openEnrollments);
    });

    Route::get('report/EnrollmentReport',function (\Illuminate\Http\Request $request){
        $enrollments = new \Training\Api\Models\CourseEnrollment();
        if($request->has('completed') && ($request->get('completed') == 'true' || $request->get('completed') == '1')){
            $enrollments = $enrollments->where('course_enrollments.completed_at' ,'!=', null);
        }

        $enrollments = $enrollments->get();
        //return  $openEnrollments;
        return \Training\Api\Http\Resources\OpenEnrollmentReportResource::collection($enrollments);
    });

    Route::get('report/CourseReport',function (\Illuminate\Http\Request $request){
        $courses = new \Training\Api\Models\Course();


        $courses = $courses->get();
        //return  $openEnrollments;
        return \Training\Api\Http\Resources\CourseReportResource::collection($courses);
    });

    Route::get('report/CourseDetailReport/{courseId}',function (\Illuminate\Http\Request $request, $courseId){
        $course= \Training\Api\Models\Course::findOrFail($courseId);

        //return  $openEnrollments;
        return new \Training\Api\Http\Resources\CourseDetailReportResource($course);
    });


    //

    Route::get('storage/{folder}/{filename}', function ($folder, $filename)
    {
        $path = storage_path('app/'.$folder .'/' . $filename);
        //return $path;
        //$file = \Illuminate\Support\Facades\Storage::disk('local')->get($path);
        //return file_exists($path);
        if (!file_exists($path)) {
            abort(404);
        }
        return response()
            ->file($path);
            //->header('Content-Type', \Illuminate\Support\Facades\Storage::mimeType($path));
    });

});