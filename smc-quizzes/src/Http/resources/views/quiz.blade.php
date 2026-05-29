<form method="POST" action="{{ url('/submit-quiz/'.  $quiz->id) }}">
    @csrf
    @if(isset($additionalHiddenFields) && is_array($additionalHiddenFields))
        @foreach($additionalHiddenFields as $key => $additionalHiddenField)
            <input type="hidden" name="{{ $key }}" value="{{ $additionalHiddenField }}">
        @endforeach
        @endif
    @foreach($quiz->questions()->with('question','question.options')->get() as $quizQuestion)
            <?php $question = $quizQuestion->question; ?>
                <!-- QUESTION FIELDSET #{{$question['id']}} -->
        <fieldset class="row mb-3">
            <legend class="col-form-label col-sm-12 pt-0">{{ ( isset($question['label']) ? $question['label'] : 'Error: Label Undefined') }}</legend>
            <div class="col-sm-12">
                @foreach($question->options->shuffle() as $key => $questionOption)
                        <?php $fieldName = 'question' . $quizQuestion['id'] .'gridRadio' . $loop->index  ?>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="quizQuestionAnswerInput[{{ $quizQuestion['id'] }}]" id="{{$fieldName}}" value="{{ $questionOption['id'] }}">
                        <label class="form-check-label" for="{{$fieldName}}">
                            {{ ( isset($questionOption['label']) ? $questionOption['label'] : 'Error: Label Undefined') }}
                        </label>
                    </div>
                @endforeach

            </div>
        </fieldset>
        <!-- END -- QUESTION FIELDSET #{{$question['id']}} -->
    @endforeach

    <div class="row mt-5">
        <div class="col-8 offset-2">
            <div class="d-grid gap-1">
                <button type="submit" class="btn btn-block btn-lg btn-primary">Submit</button>
            </div>
        </div>
    </div>


</form>