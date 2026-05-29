<!doctype html>
<html lang="en" ng-app="smcActivityApp">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- THEME COLOR -->
    <meta name="theme-color" content="#7952b3">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">

    <title>SMC - Quiz</title>

    <!-- PAGE STYLES -->
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>

    <script>
        window.Laravel = {
            api_uri: "/",
        };
    </script>

    <style>
        body {
            font-size: .875rem;
        }

        .feather {
            width: 16px;
            height: 16px;
            vertical-align: text-bottom;
        }

        /*
         * Sidebar
         */

        .sidebar {
            position: fixed;
            top: 0;
            /* rtl:raw:
            right: 0;
            */
            bottom: 0;
            /* rtl:remove */
            left: 0;
            z-index: 100; /* Behind the navbar */
            padding: 48px 0 0; /* Height of navbar */
            box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
        }

        @media (max-width: 767.98px) {
            .sidebar {
                top: 5rem;
            }
        }

        .sidebar-sticky {
            position: relative;
            top: 0;
            height: calc(100vh - 48px);
            padding-top: .5rem;
            overflow-x: hidden;
            overflow-y: auto; /* Scrollable contents if viewport is shorter than content. */
        }

        .sidebar .nav-link {
            font-weight: 500;
            color: #333;
        }

        .sidebar .nav-link .feather {
            margin-right: 4px;
            color: #727272;
        }

        .sidebar .nav-link.active {
            color: #2470dc;
        }

        .sidebar .nav-link:hover .feather,
        .sidebar .nav-link.active .feather {
            color: inherit;
        }

        .sidebar-heading {
            font-size: .75rem;
            text-transform: uppercase;
        }

        /*
         * Navbar
         */

        .navbar-brand {
            padding-top: .75rem;
            padding-bottom: .75rem;
            font-size: 1rem;
            background-color: rgba(0, 0, 0, .25);
            box-shadow: inset -1px 0 0 rgba(0, 0, 0, .25);
        }

        .navbar .navbar-toggler {
            top: .25rem;
            right: 1rem;
        }

        .navbar .form-control {
            padding: .75rem 1rem;
            border-width: 0;
            border-radius: 0;
        }

        .form-control-dark {
            color: #fff;
            background-color: rgba(255, 255, 255, .1);
            border-color: rgba(255, 255, 255, .1);
        }

        .form-control-dark:focus {
            border-color: transparent;
            box-shadow: 0 0 0 3px rgba(255, 255, 255, .25);
        }
    </style>

    <style>
        .text-theme {
            color: #b31f1f !important;
        }
    </style>

    <!-- SMC STYLES -->
    <style>
        .text-theme {
            color: #351e0e;
        }

        .bg-theme {
            background-color: #351e0e !important;
        }

        .border-theme {
            border-color: #351e0e;
        }
    </style>

</head>
<body>

<!-- APP BODY -->
<div ng-controller="GlobalController">
    <!-- HEADER -->
    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow bg-theme">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 py-0 pt-1 pb-1" href="/dashboard">
            <img style="height: 40px;" alt="Home" title="Home" class="navbar-brand-img p-0 m-0" src="{{ asset('logo.png') }}" >
        </a>

        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!--- NAV -->
        <div class="navbar-nav">
            <!-- LOG OUT FORM -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <!-- LOG OUT BUTTON -->
                <div class="nav-item text-nowrap">
                    <a href="route('logout')"
                       onclick="event.preventDefault();
                                                    this.closest('form').submit();" class="nav-link px-3" ><i class="bi bi-box-arrow-left"></i> {{ __('Log Out') }}</a>
                </div>
                <!-- END -- LOG OUT BUTTON -->
            </form>
            <!-- END -- LOG OUT FORM -->
        </div>
    </header>
    <!-- END -- HEADER -->

    <!-- CONTENT -->
    <div class="container-fluid">
        <div class="row">
            <!-- === CONTENT ==== -->
            <main class="col-md-10 offset-1  col-lg-10 px-md-4">


                <?php
                    //..
                    $viewHTMLContentRAW = View::make('smc-quizzes::quiz', array('quiz' => $quiz,'additionalHiddenFields' => ['course_attempt_id' => $courseAttempt->id]));
                if(config('smc-training.translation_mode') === 'google'){
                    //if translate requested.
                    if(request()->has('translate') && (request()->get('translate') == 'true' || request()->get('translate') == '1')) {
                        abort_unless(request()->has('targetLanguage'), 500, "invalid targetLanguage");
                        $targetLanguage = request()->get('targetLanguage');
                        $path = storage_path('app/google/spring-cab-377313-5293968e24ad.json');
                        abort_unless(file_exists($path), 500 , 'Google ApiKey JSON Missing');
                        putenv("GOOGLE_APPLICATION_CREDENTIALS=". $path);
                        $projectId = "spring-cab-377313";
                        $translationClient = new \Google\Cloud\Translate\V3\TranslationServiceClient([
                            'projectId' => $projectId,
                            //'keyFilePath' => $this->keyFilePath

                        ]);

                        $array = [
                            (string) $viewHTMLContentRAW
                        ];

                        $response = $translationClient->translateText(
                            $array,
                            $targetLanguage,
                            \Google\Cloud\Translate\V3\TranslationServiceClient::locationName($projectId, 'global')
                        );
                        $newContent = '';
                        //View response
                        foreach ($response->getTranslations() as $key => $translation) {
                            $newContent .= $translation->getTranslatedText(). PHP_EOL;
                        }
                        $viewHTMLContentRAW = (!empty($newContent) ? $newContent :  $viewHTMLContentRAW);

                    }
                }
                /*//use Google\Cloud\Translate\V2\TranslateClient;
                if(config('smc-training.translation_mode')){
                    //if translate requested.
                    if(request()->has('translate')  ) {
                        //TranslateClient
                        $translate = new TranslateClient(['key' => config('smc-training.googleAPIKey')]);
                        ///..
                        $translateTarget = request()->get('translate');
                        $viewHTMLContentRAW = $translate->translate($viewHTMLContentRAW, [
                            'target' => $translateTarget
                        ]);
                    }

                }*/

                    ?>


                <div class="card mt-3 mb-5">
                    <div class="card-header">
                        <h5 class="text-center">Skills Test</h5>
                    </div>
                    <div class="card-body">
                        @if(config('smc-training.translation_mode') === 'google')
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
                        @endif
                        {!! $viewHTMLContentRAW !!}
                    </div>
                </div>

            </main>
            <!-- === END -- CONTENT ==== -->
        </div>
    </div>
    <!-- END -- CONTENT -->
</div>
<!-- END -- APP BODY -->

<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
-->
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>

<script src="//unpkg.com/@uirouter/angularjs/release/angular-ui-router.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular-route.js"></script>

<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>

<!-- PAGE INLINE SCRIPTS -->
<!-- ===|| TEMPLATES ||=== --->
<!-- ===|| END -- TEMPLATES ||=== --->

<!-- APP -->
<script>
    //..
    console.log('page load..');

    /***
     * ======================
     * == APP ==
     * ======================
     */

    /** Primary App Module */
    app = angular.module('smcActivityApp', [
        //..
        //'ngRoute'
        //'ui.router'
    ]);

    /** Root Controller */
    app.run(function AppRun($rootScope, smcAppService, $timeout, $interval) {

        $rootScope.authUserData = null;

        var AppConstants = {
            //api: 'https://conduit.productionready.io/api',
            // api: 'http://localhost:3000/api',
            //jwtKey: 'jwtToken',
            //appName: 'Conduit',
        };

        //'ngInject';


        // change page title based on state
        /*$rootScope.$on('$stateChangeSuccess', function (event, toState) {
            $rootScope.setPageTitle(toState.title);
        });*/

        // Helper method for setting the page's title
        /**
         * Set page title
         * @param title
         */
        $rootScope.setPageTitle = function (title) {
            $rootScope.pageTitle = '';
            if (title) {
                $rootScope.pageTitle += title;
                $rootScope.pageTitle += ' \u2014 ';
            }
            $rootScope.pageTitle += AppConstants.appName;
        };


        /**
         * App ready state event handler
         */
        function callAppReadyState() {
            console.log('ready.');

            function showDebugMessages() {
                console.log({
                    debug:{
                        $rootScope:$rootScope
                    }
                })
            }
            //TODO remove if prod
            showDebugMessages();
        }

        /**
         * Init App
         */
        $rootScope.init = function (){
            //Write to console..
            console.log('running..');

            //Get current user
            smcAppService.getAuthUser().then(function (res) {
                $rootScope.authUserData = res.data;
                $timeout(function () {
                    callAppReadyState()
                }, 5);
            });

            smcAppService.updateCourseAttemptHeartbeat({}, '{{ $courseAttempt->course_id }}','{{ $courseAttempt->id }}').then(function (res){
                console.log('updateCourseAttemptHeartbeat:', res.data);
            });

            $interval(function() {
                console.log('updateCourseAttemptHeartbeat');
                smcAppService.updateCourseAttemptHeartbeat({}, '{{ $courseAttempt->course_id }}','{{ $courseAttempt->id }}').then(function (res){
                    console.log('updateCourseAttemptHeartbeat:', res.data);
                });
            }, 30*1000); // run every 30 seconds

        }
        //run app
        console.log('init..');
        $rootScope.init();

    });

    //Config
    app.constant('appConfig', {
        api_host: window.Laravel.api_uri,
    }).constant('DEFAULT_TIMEOUT', 1000);
    //END -- Config
    app.service('smcAppService', ['$http', 'appConfig', function($http, appConfig) {

        this.updateCourseAttemptHeartbeat = function (postData, courseId, courseAttemptId) {
            return $http.post(appConfig.api_host + 'attempt/course/'+courseId+'/'+courseAttemptId+'/heartbeat', postData);
        };

        //## Auth User
        this.getAuthUser = function (postData) {
            return $http.get(appConfig.api_host + 'api/v1/user', {
                params:postData
            });
        };

        //## Account
        this.updateAuthUser = function (postData) {
            return $http.put(appConfig.api_host + 'api/v1/user', postData);
        };

        this.updateAuthUserPassword = function (postData) {
            return $http.put(appConfig.api_host + 'api/v1/user/password', postData);
        };


    }]);

    /*
     * Config
     */

    app.config(function($interpolateProvider) {
        // To prevent the conflict of blade interpolate symbols
        // between Blade template engine and AngularJS templating we need
        // to use different symbols for AngularJS.
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });

    /*
     * Controllers
     */

    app.controller('GlobalController', function (){
        console.log('GlobalController init..');
    });
    /*
         * Required
         */

    app.filter('to_trusted', ['$sce', function($sce){
        return function(text) {
            return $sce.trustAsHtml(text);
        };
    }]);

    // http interceptor to handle redirection to login on 401 response from API
    app.config(function($httpProvider) {
        $httpProvider.interceptors.push('httpResponseInterceptor');
    });
    app.factory('httpResponseInterceptor', ['$q', '$rootScope', '$window','$timeout', function($q, $rootScope, $window, $timeout) {
        return {
            responseError: function(rejection) {
                console.log('401ERROR');
                if (rejection.status === 401) {
                    console.log('REDIRECT');
                    // Something like below:
                    $timeout(function(){

                        $window.location.assign('/login?invalidSession');
                        //$location.path('/login?invalidSession');
                    },1);

                }
                return $q.reject(rejection);
            }
        };
    }]);

</script>
<!-- END -- APP -->
<!-- END -- PAGE INLINE SCRIPTS -->
</body>
</html>