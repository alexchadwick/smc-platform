@extends('smc-training::layouts.training-media')
@section('content')
    <style>
        body, html {width: 100%; height: 100%; margin: 0; padding: 0}
        .page-row-container {display: flex; width: 100%; height: 100%; flex-direction: column;  overflow: hidden;}
        .page-row-container .first-row { }
        .page-row-container .second-row { flex-grow: 1; border: none; margin: 0; padding: 0; }
    </style>
    <!-- PAGE -->
    <div class="page-row-container">
        <!-- END -- PAGE -->
        <div class="first-row">
            <div class="hstack gap-3">
                <div class="bg-body-tertiary border">
                    <!-- FORMS -->
                    <div id="courseableForms">
                        <!-- TRANSLATION FORM -->
                        @if(config('smc-training.translation_mode') === 'google')
                            <form method="GET" action="{{ htmlspecialchars($_SERVER["PHP_SELF"])  }}?">
                                <input type="hidden" name="translate" value="true">
                                {!! $writeHiddeHTMLRequestFields !!}
                                <div class="hstack gap-3">
                                    <select class="form-control form-control-sm me-auto py-0" name="targetLanguage" required>
                                        <option disabled selected value>Select language..</option>
                                            <?php
                                            //Get languages
                                            $listLangPath = storage_path('app/google/languages.json');
                                            abort_unless(file_exists($listLangPath), 500 , 'Google languages JSON Missing');
                                            $langData = json_decode(file_get_contents($listLangPath), true)
                                            ?>
                                        @foreach($langData['data'] as $lang)
                                            <option value="{{ $lang['code'] }}" @if(request()->has('targetLanguage') && request()->get('targetLanguage') == $lang['code']) selected @endif>{{ $lang['language'] }}</option>
                                        @endforeach
                                    </select>
                                    <div class="vr"></div>
                                    <button type="submit" style="min-width: 100px" class="btn btn-sm btn-info py-0">Translate</button>
                                </div>

                                {{-- <select name="targetLanguage" required>
                                     <option disabled selected value>Select language..</option>
                                         <?php
                                         //Get languages
                                         $listLangPath = storage_path('app/google/languages.json');
                                         abort_unless(file_exists($listLangPath), 500 , 'Google languages JSON Missing');
                                         $langData = json_decode(file_get_contents($listLangPath), true)
                                         ?>
                                     @foreach($langData['data'] as $lang)
                                         <option value="{{ $lang['code'] }}" @if(request()->has('targetLanguage') && request()->get('targetLanguage') == $lang['code']) selected @endif>{{ $lang['language'] }}</option>
                                     @endforeach
                                 </select>
                                 <button type="submit">Translate</button>--}}
                            </form>
                        @endif
                        <!-- END -- TRANSLATION FORM -->
                        <!-- COURSEABLE FORM -->
                        @if($course->courseables()->count() > 1 )
                            <form method="GET" action="{{ htmlspecialchars($_SERVER["PHP_SELF"]) }}">
                                {!! $writeHiddeHTMLRequestFields !!}
                                <input type="hidden" name="change_courseable" value="true">
                                <div class="hstack gap-3">
                                    <select aria-label="select courseable..." class="form-control form-control-sm me-auto" name="targetCourseable" required>
                                        <option disabled selected value>Select courseable..</option>
                                        @foreach($course->courseables()->get() as $item)
                                            <option value="{{ $item['id'] }}" @if( $item['id']|| (request()->has('targetCourseable') && request()->get('targetCourseable') == $item['id'])) selected @endif>{{ $item['id'] }}</option>
                                        @endforeach
                                    </select>
                                    <div class="vr"></div>
                                    <button type="submit" style="min-width: 100px" class="btn btn-sm btn-secondary py-0">Change</button>
                                </div>

                                {{--
                                                        <select name="targetCourseable" required>
                                                            <option disabled selected value>Select courseable..</option>
                                                            @foreach($course->courseables()->get() as $item)
                                                                <option value="{{ $item['id'] }}" @if( $item['id']|| (request()->has('targetCourseable') && request()->get('targetCourseable') == $item['id'])) selected @endif>{{ $item['id'] }}</option>
                                                            @endforeach
                                                        </select>
                                                        <button type="submit">Change courseable</button>--}}
                            </form>
                            <!-- COURSEABLE FORM -->
                        @endif
                        <!-- FORM -->
                    <?php
                    $children = $courseable->courseable->children()->get();
                    $allVersionsArray = $children->toArray();
                    $allVersionsArray[] = $courseable->courseable;
                    $versionData = [
                        'data' => $allVersionsArray
                    ]
                    ?>
                        @if(count($allVersionsArray) > 1)
                            <!-- Version FORM -->
                            <form method="GET" action="{{ htmlspecialchars($_SERVER["PHP_SELF"]) }}">
                                <input type="hidden" name="change_version" value="true">
                                {!! $writeHiddeHTMLRequestFields !!}
                                <select name="targetVersion" required>
                                    <option disabled selected value>Select version..</option>

                                    @foreach($versionData['data'] as $verItem)
                                        <option value="{{ $verItem['version_slug'] }}" @if(!request()->has('targetVersion') && $courseable->courseable->version_slug == $verItem['version_slug'] || request()->has('targetVersion') && request()->get('targetVersion') == $verItem['version_slug']) selected @endif>{{ $verItem['version_slug'] }}</option>
                                    @endforeach
                                </select>
                                <button type="submit">Change version</button>
                            </form>
                            <!-- END -- Version FORM -->
                        @endif
                    </div>
                    <!-- END -- FORMS -->
                </div>
                <div class="bg-body-tertiary border ms-auto">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Help
                    </button>
                </div>
                <div class="vr"></div>
                <div class="bg-body-tertiary border">
                    <a href="#" id="openExternalLink" class="btn btn-primary">Open external</a>
                    <a href="#" id="openNextLink" class="btn btn-success"><i class="bi bi-check-circle"></i> Next</a>
                </div>
            </div>
        </div>

        <!-- viewBox-->
        <div class="second-row" id="courseableViewBox{{ $courseable->id }}">
            @if(get_class($courseable->courseable) === \Training\Api\Models\CourseMediaItem::class)
                    <?php
                    //LOAD ASSET
                    $courseMediaType = null;
                    if(request()->has('targetVersion')
                        && !empty(request()->get('targetVersion')))
                    {
                        $courseMediaType = $courseable->courseable->children()->where('version_slug',request()->get('targetVersion'))->first();
                    }
                    if (!isset($courseMediaType)) {
                        $courseMediaType = $courseable->courseable;
                    }

                    $attachment = $courseMediaType->attachment;
                    if(request()->has('targetLanguage')
                        && !empty(request()->get('targetLanguage')))
                    {
                        $attachment = $courseMediaType->translateAttachment(request()->get('targetLanguage'));

                    }
                    ?>
                <!-- SHOW MEDIA -->
                <div style="height: 100%">
                    @if($attachment->attachment_content_type === 'video/mp4')
                        <video width="100%" height="400" controls>
                            <source src="{{ asset('storage/'.$attachment->attachment_location) }}" type="{{ $attachment->attachment_content_type }}">
                            Your browser does not support the video tag.
                        </video>
                    @endif
                    @if($attachment->attachment_content_type === 'application/pdf')
                        <iframe style="width: 100%;height: 100%" src="{{ asset('storage/'.$attachment->attachment_location) }}"></iframe>
                    @endif


                </div>
                <!-- END -- SHOW MEDIA -->
            @endif
        </div>
        <!-- END - viewBox -->
    </div> <!-- END -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Help & Support</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Nothing here yet
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        var link = document.getElementById("openExternalLink");
        var nextLink = document.getElementById("openNextLink");
        link.setAttribute('href', "{{ asset('storage/'.$attachment->attachment_location) }}");
        nextLink.setAttribute('href', "{{ url(route('enrollments')) }}");
    </script>
@endsection