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

    <title>SMC - Training</title>

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
            <main class="col-md-10 offset-1 ms-sm-auto col-lg-10 px-md-4">
                @yield('content')
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
<script type="text/ng-template" id="test.html">
    <div>
        <h3>DEBUG:</h3>

        <div>
            <h5>SESSION:</h5>
            <ul>
                <li ng-repeat="udata in authUserData" ng-bind="udata">

                </li>
            </ul>
        </div>
    </div>
</script>

<!-- APP VIEW -->
<script type="text/ng-template" id="app.html">
    <h3>Root</h3>
    <div>
        <div ui-sref="app"></div>
    </div>
</script>

<!-- DASHBOARD VIEW -->
<script type="text/ng-template" id="dashboard.html">

</script>
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
        'ui.router'
    ]);

    /** Root Controller */
    app.run(function AppRun($rootScope, smcAppService, $timeout) {

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


        //## Users
        //## OrderForm
        /**
         * Get list of Users
         * @param postData
         * @returns {*}
         */
        this.getUsers = function (postData) {
            return $http.get(appConfig.api_host + 'api/v1/users', {
                params:postData
            });
        };

        this.getCourses = function (postData) {
            return $http.get(appConfig.api_host + 'api/v1/courses', {
                params:postData
            });
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
    app.config(function($stateProvider, $urlRouterProvider) {
        console.log("Configuring app..");

        $stateProvider
            .state('test', {
                url: '/test',
                controller: (function ($scope)  {
                    $scope.alertData = {
                        errors: [
                            'Passowrd is invalid',
                            'New password and new password confirmtion do not match'
                        ]
                    }
                }),
                templateUrl : "test.html"
            })
            .state('dashboard', {
                name: 'dashboard',
                url: '/dashboard',
                controller: "DashboardController",
                templateUrl : "dashboard.html"
            })

        ;

        //REDIRECTED ROUTES
        $urlRouterProvider.when('/account', '/account/profile');

        //DEFAULT ROUTE
        $urlRouterProvider.otherwise('/dashboard');

    });

    /*
     * Controllers
     */

    app.controller('GlobalController', function (){
        console.log('GlobalController init..');
    });

    app.controller('DashboardController', function (){
        console.log('DashboardController init..');
    });

    /*
         * Required
         */

    app.filter('to_trusted', ['$sce', function($sce){
        return function(text) {
            return $sce.trustAsHtml(text);
        };
    }])

</script>
<!-- END -- APP -->
<!-- END -- PAGE INLINE SCRIPTS -->
</body>
</html>