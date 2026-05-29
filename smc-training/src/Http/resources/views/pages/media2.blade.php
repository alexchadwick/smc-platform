<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Media') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form method="GET" action="{{ htmlspecialchars($_SERVER["PHP_SELF"]) }}">
                        <input type="hidden" name="translate" value="true">
                        <select name="targetLanguage" required>
                            <option>Select language..</option>
                            <?php

                            $listLangPath = storage_path('app/google/languages.json');
                            abort_unless(file_exists($listLangPath), 500 , 'Google languages JSON Missing');
                            $langData = json_decode(file_get_contents($listLangPath), true)

                            ?>
                            @foreach($langData['data'] as $lang)
                                <option value="{{ $lang['code'] }}" @if(request()->has('targetLanguage') && request()->get('targetLanguage') == $lang['code']) selected @endif>{{ $lang['language'] }}</option>
                            @endforeach
                            {{--<option value="af">Afrikaans</option>
                            <option value="sq">Albanian</option>
                            <option value="ar">Arabic</option>
                            <option value="az">Azerbaijani</option>
                            <option value="eu">Basque</option>
                            <option value="bn">Bengali</option>
                            <option value="be">Belarusian</option>
                            <option value="bg">Bulgarian</option>
                            <option value="ca">Catalan</option>
                            <option value="zh-CN">Chinese Simplified</option>
                            <option value="zh-TW">Chinese Traditional</option>
                            <option value="hr">Croatian</option>
                            <option value="cs">Czech</option>
                            <option value="da">Danish</option>
                            <option value="nl">Dutch</option>
                            <option value="en">English</option>
                            <option value="eo">Esperanto</option>
                            <option value="et">Estonian</option>
                            <option value="tl">Filipino</option>
                            <option value="fi">Finnish</option>
                            <option value="fr">French</option>
                            <option value="gl">Galician</option>
                            <option value="ka">Georgian</option>
                            <option value="de">German</option>
                            <option value="el">Greek</option>
                            <option value="gu">Gujarati</option>
                            <option value="ht">Haitian Creole</option>
                            <option value="iw">Hebrew</option>
                            <option value="hi">Hindi</option>
                            <option value="hu">Hungarian</option>
                            <option value="is">Icelandic</option>
                            <option value="id">Indonesian</option>
                            <option value="ga">Irish</option>
                            <option value="it">Italian</option>
                            <option value="ja">Japanese</option>
                            <option value="kn">Kannada</option>
                            <option value="ko">Korean</option>
                            <option value="la">Latin</option>
                            <option value="lv">Latvian</option>
                            <option value="lt">Lithuanian</option>
                            <option value="mk">Macedonian</option>
                            <option value="ms">Malay</option>
                            <option value="mt">Maltese</option>
                            <option value="no">Norwegian</option>
                            <option value="fa">Persian</option>
                            <option value="pl">Polish</option>
                            <option value="pt">Portuguese</option>
                            <option value="ro">Romanian</option>
                            <option value="ru">Russian</option>
                            <option value="sr">Serbian</option>
                            <option value="sk">Slovak</option>
                            <option value="sl">Slovenian</option>
                            <option value="es">Spanish</option>
                            <option value="sw">Swahili</option>
                            <option value="sv">Swedish</option>
                            <option value="ta">Tamil</option>
                            <option value="te">Telugu</option>
                            <option value="th">Thai</option>
                            <option value="tr">Turkish</option>
                            <option value="uk">Ukrainian</option>
                            <option value="ur">Urdu</option>
                            <option value="vi">Vietnamese</option>
                            <option value="cy">Welsh</option>
                            <option value="yi">Yiddish</option>--}}
                        </select>
                        <button type="submit">Translate</button>
                    </form>

                    @foreach($courseables as $item)
                        <div id="courseableViewBox{{ $item->id }}">
                            
                        </div>
                    @endforeach

                    @foreach($courseables as $courseable)
                        <h3>test</h3>
                        <div id="courseableViewBox{{ $courseable->id }}">
                        @if(get_class($courseable->courseable) === \Training\Api\Models\CourseMediaItem::class)
                            <form method="GET" action="{{ htmlspecialchars($_SERVER["PHP_SELF"]) }}">
                                <input type="hidden" name="translate" value="true">
                                <select name="targetLanguage" required>
                                    <option>Select version..</option>
                                        <?php
                                        $children = $courseable->courseable->children;
                                        $childrenArray = $children->toArray();

                                        $allVersionsArray = $childrenArray;
                                        $allVersionsArray[] = $courseable->courseable;
                                        $versionData = [
                                            'data' => $allVersionsArray
                                        ]
                                        ?>
                                    @foreach($versionData['data'] as $verItem)
                                        <option value="{{ $verItem['version_slug'] }}" @if(request()->has('targetVersion') && request()->get('targetVersion') == $verItem['version_slug']) selected @endif>{{ $verItem['version_slug'] }}</option>
                                    @endforeach
                                </select>
                                <button type="submit">Change version</button>
                            </form>
                            @if(
    $courseable
->courseable
->attachment->attachment_content_type === 'application/pdf')

                                <iframe style="width: 100%;min-height: 500px;height: 100%" src="{{ asset($courseable
->courseable
->attachment
->attachment_location) }}">
                            @endif
                            @endif
                        </div>
                    @endforeach

                   {{-- <div>

                        <iframe style="width:100%; height:500px;" frameborder="0"
                                src="{{ asset('media/holiday-deadline-calendar-2022.pdf') }}"></iframe>

                        <hr>

                        <iframe src="//translate.google.com/translate?sl=auto&tl=ar&u=https://www.finao.com/resources/holiday-deadline-calendar-2022.pdf"
                                style="width:100%; height:500px;" frameborder="0"></iframe>

                        <hr>

                        <iframe src="http://docs.google.com/gview?url=https://www.finao.com/resources/holiday-deadline-calendar-2022.pdf&embedded=true"
                                style="width:100%; height:500px;" frameborder="0"></iframe>

                    </div>--}}


                </div>
            </div>
        </div>
    </div>
</x-app-layout>