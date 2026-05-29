<!doctype html>
<html lang="en" ng-app="smcSettingsApp">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- THEME COLOR -->
    <meta name="theme-color" content="#7952b3">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">

    <title>SMC - ERP</title>

    <script>
        window.Laravel = {
            api_uri: "/",
        };
    </script>

    <!-- PAGE STYLES -->
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

    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow bg-theme">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 py-0 pt-1 pb-1" href="#">
            <img style="height: 40px;" alt="Home" title="Home" class="navbar-brand-img p-0 m-0" src="{{ asset('logo.png') }}" >
        </a>

        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>


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

    <div class="container-fluid">
        <div class="row">
            <!-- === SIDEBAR ==== -->
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse" style="overflow-y: auto"
                <div class="position-sticky pt-3">
                    <!-- PRIMARY MENU -->
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link " ui-sref-active="active" aria-current="page" ui-sref="dashboard">
                                <i class="bi bi-house-fill"></i>
                                Dashboard
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" ui-sref-active="active" ui-sref="account.profile">
                                <i class="bi bi-person-circle"></i>
                                My Account
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" ui-sref-active="active" ui-sref="reports">
                                <i class="bi bi-graph-up-arrow"></i>
                                Reports
                            </a>
                        </li>
                    </ul>
                    <!-- END -- PRIMARY MENU -->

                    <!-- ADMIN MENU -->
                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                        <span>Administration</span>
                        <span></span>
                    </h6>
                    <ul class="nav flex-column mb-2">

                        <!-- ADMIN MENU ITEMS  -->
                        <li class="nav-item mb-0" ng-repeat="item in [

                            {name:'Orders',uri:'admin.orders'},
                            {name:'ProductionRequests',uri:'admin.productionRequests'},
                            {name:'RecurringProductionRequests',uri:'admin.recurringProductionRequests'},
                            {name:'Users',uri:'admin.users'},
                            {name:'Organizations',uri:'admin.organizations'},
                            {name:'Product Specs',uri:'admin.productSpecs'},
                            {name:'Recipes',uri:'admin.recipes'},
                            {name:'RawMaterials',uri:'admin.rawMaterials'},
                            {name:'Components',uri:'admin.components'},
                            {name:'PurchaseOrders',uri:'admin.purchaseOrders'},
                            {name:'Prices',uri:'admin.prices'},
                            {name:'Inventory',uri:'admin.inventory'},
                            {name:'InventoryLocations',uri:'admin.inventoryLocations'},
                            {name:'InventoryCategories',uri:'admin.inventoryCategories'},
                            {name:'InventoryUPCCodes',uri:'admin.inventoryUPCCodes'},
                            {name:'InventoryLog',uri:'admin.inventoryLog'},
                            {name:'BatchCodes',uri:'admin.batchCodes'},
                            {name:'Production Center',uri:'admin.productionCenters'},
                            {name:'ProductionStatues',uri:'admin.productionStatues'},
                            {name:'ProductionLines',uri:'admin.productionLines'},
                            {name:'ProductionLineSchedules',uri:'admin.productionLineSchedule'},
                            {name:'Equipment',uri:'admin.equipment'},
                            {name:'EquipmentMaintenanceSchedule',uri:'admin.equipmentMaintenanceSchedule'},
                            {name:'EquipmentMaintenanceLog',uri:'admin.equipmentMaintenanceLog'},
                            {name:'Vehicles',uri:'admin.vehicles'},
                            {name:'VehicleInspections',uri:'admin.vehiclesInspections'},
                            {name:'VehicleMaintenanceSchedule',uri:'admin.vehicleMaintenanceSchedule'},

                            {name:'VehicleMaintenanceLog',uri:'admin.vehiclesMaintenanceLog'},
                            {name:'HumanResources',uri:'admin.humanResources'},
                            {name:'HumanResourceSchedules',uri:'admin.humanResourcesSchedules'},
                            {name:'Drivers',uri:'admin.drivers'},
                            {name:'Routes',uri:'admin.routes'},
                            {name:'Map',uri:'admin.map'},
                            {name:'API EndPoints',uri:'admin.endPoints'},

                            {name:'Settings',uri:'admin.settings'}

                        ]">
                            <a class="nav-link mb-0" ui-sref="<% item.uri %>">
                                <span data-feather="file-text"></span>
                                <span ng-bind="item.name"></span>
                            </a>
                        </li>
                        <!-- END -- ADMIN MENU ITEMS  -->

                    </ul>

                    <!-- END --  -->

                    <!-- MISC SIDEBAR MENU -->
                    <ul class="nav flex-column mb-2">
                        <li class="nav-item">
                            <a class="nav-link text-theme" href="{{ url('/') }}">
                                <i class="bi bi-arrow-return-left"></i>
                                Back to intranet home
                            </a>
                        </li>
                    </ul>
                    <!-- END -- MISC SIDEBAR MENU -->
                </div>
            </nav>
            <!-- === END -- SIDEBAR ==== -->

            <!-- === CONTENT ==== -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                @yield('content')
            </main>
            <!-- === END -- CONTENT ==== -->
        </div>
    </div>

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

<script type="text/ng-template" id="alertComingSoon.html">
    <div ng-hide="alertCtrl.data.hide === true">
        <div ng-if="alertCtrl.data.loading !== true">
            <div ng-if="alertCtrl.data.html" class="alert" ng-class="( alertCtrl.data.alertClass ? alertCtrl.data.alertClass : 'alert-warning')" ng-bind-html="(alertCtrl.data.html ?  alertCtrl.data.html : 'Coming Soon') | to_trusted"></div>
            <div ng-if="!alertCtrl.data.html" class="alert" ng-class="( alertCtrl.data.alertClass ? alertCtrl.data.alertClass : 'alert-warning')" ng-bind-html="('Coming Soon') | to_trusted"></div>
        </div>
    </div>
</script>
<script type="text/ng-template" id="alertDialog.html">

    <div ng-hide="alertCtrl.data.hide === true">
        <div ng-if="alertCtrl.data.loading === true" class="alert alert-info">
            <strong>Loading...</strong>
        </div>
        <div ng-if="alertCtrl.data.loading !== true">
            <div ng-if="alertCtrl.data.html" class="alert" ng-class="( alertCtrl.data.alertClass ? alertCtrl.data.alertClass : 'alert-info')" ng-bind-html="alertCtrl.data.html | to_trusted"></div>
            <div ng-if="alertCtrl.data.errors && alertCtrl.data.errors.length > 0" class="alert alert-danger">
                <strong><span ng-bind="( alertCtrl.data.errors.length > 1 ? 'Errors' : 'Error')"></span></strong>
                <span ng-if="alertCtrl.data.errors.length === 1" ng-bind="alertCtrl.data.errors[0]"></span>
                <ul ng-if="alertCtrl.data.errors.length > 1">
                    <li ng-repeat="error in alertCtrl.data.errors" ng-bind="error"></li>
                </ul>
            </div>
        </div>

    </div>

</script>
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
    <!-- PROFILE -->
    <div>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h3> Profile</h3>
            <div class="btn-toolbar mb-2 mb-md-0">

            </div>
        </div>
        <form>
            <legend>Account details</legend>

            <div class="well">
                <h6>Alert Dialog Tests</h6>

                <p>Alert loading with 3000 ms timeout.</p>
                <div>
                    sample: <span ng-bind="{loading:true}"></span>
                </div>
                <div alert-dialog alert-data="{loading:true}"></div>


                <div ng-init="alertSampleData = {loading:true}">
                    <p>Alert loading set to FALSE.</p>
                    <div>
                        sample: <span ng-bind="alertSampleData"></span>
                    </div>
                    <div alert-dialog alert-data="alertSampleData"></div>
                </div>


                <div ng-init="alertSampleData2 = {hide:false}">
                    <p>Hidden alert. hide set to FALSE.</p>
                    <div>
                        sample: <span ng-bind="alertSampleData2"></span>
                    </div>
                    <div alert-dialog alert-data="alertSampleData2"></div>
                </div>

                <div ng-init="alertSampleData3 = {hide:true}">
                    <p>Hidden alert. hide set to TRUE.</p>
                    <div>
                        sample: <span ng-bind="alertSampleData3"></span>
                    </div>
                    <div alert-dialog alert-data="alertSampleData3"></div>
                </div>

                <div ng-init="alertSampleData4 = {html:'<strong>Success</strong> form has been submitted'}">
                    <p>HTML alert. HTML set.</p>
                    <div>
                        sample: <span ng-bind="alertSampleData4"></span>
                    </div>
                    <div alert-dialog alert-data="alertSampleData4"></div>
                </div>


                <div ng-init="alertSampleData5 = {alertClass:'alert-warning',html:'<strong>Success</strong> form has been submitted'}">
                    <p>HTML warning alert. WARNING context. HTML set.</p>
                    <div>
                        sample: <span ng-bind="alertSampleData5"></span>
                    </div>
                    <div alert-dialog alert-data="alertSampleData5"></div>
                </div>


                <p>Alert with errors.</p>
                <div>
                    sample: <span ng-bind="alertData"></span>
                </div>
                <div alert-dialog alert-data="alertData"></div>
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Organization Name <span class="text-danger">*</span></label>
                <input type="text" placeholder="Enter organization.." class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">Enter organization name.</div>
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">First Name <span class="text-danger">*</span></label>
                <input type="text" placeholder="Enter first.." class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">Enter first name.</div>
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Last Name <span class="text-danger">*</span></label>
                <input type="text" placeholder="Enter last.." class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">Enter last name.</div>
            </div>


            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address <span class="text-danger">*</span></label>
                <input type="email" placeholder="Enter email.." class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Phone </label>
                <input type="text" placeholder="Enter phone.." class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">Enter office primary phone number.</div>
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Mobile Phone <span class="text-danger">*</span></label>
                <input type="text" placeholder="Enter mobile phone.." class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">Enter mobile phone number.</div>
            </div>

            <legend>Billing details</legend>


            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>
    <!-- END -- PROFILE -->

</script>


<!-- APP VIEW -->
<script type="text/ng-template" id="parts.welcome.html">

    <div class="alert alert-dark bg-dark rounded-3 p-5 text-white alert-dismissible fade show" role="alert">
        <div>
            <h2>Welcome <!-- TODO --><span ng-if="false">New User</span>!</h2>
            <p>Complete your <a ui-sref="account.profile">account profile</a>, or select "Getting Started" below to view our support center.</p>

        </div>


        <!-- TODO conntect onlick method to dismiss and save in DB-->
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

</script>
<script type="text/ng-template" id="parts.help.html">
    <div class="bd-toc mt-5 mb-5 my-md-0 ps-xl-3 mb-lg-5 text-muted pt-3">
        <strong class="d-block h6 my-2 pb-2 border-bottom">Need Help?</strong>
        <p>Ask questions, view guides and more</p>
        <div class="d-grid gap-2">
            <a ui-sref="help">Find support</a>
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
    <div class="row" >
        <div class="col-sm-8">
            <h2 class="mt-2 mb-2"><i class="bi bi-house-fill"></i> SMC ERP</h2>

            <div class="card mb-3">

                <div class="card-body">
                    <div class="alert alert-warning">
                        Dashboard Report Cards Coming Soon!
                    </div>
                </div>
            </div>

            <div ng-include="'parts.welcome.html'"/></div>
        </div>

        <!-- DASHBOARD MISC MENU -->
        <div class="col-sm-4">
            <div ng-include="'parts.help.html'"/></div>
        </div>
        <!-- END -- DASHBOARD MISC MENU -->
    </div>
</script>

<!-- REPORTS VIEW -->
<script type="text/ng-template" id="reports.html">

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h5 class="h5"><i class="bi bi-gear"></i> Reports</h5>
        <div class="btn-toolbar mb-2 mb-md-0">
            <!-- Admin toolbar -->
        </div>
    </div>

    <div>

    </div>
</script>

<!-- HELP VIEW -->
<script type="text/ng-template" id="help.html">

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h5 class="h5"><i class="bi bi-gear"></i> Help</h5>
        <div class="btn-toolbar mb-2 mb-md-0">
            <!-- Admin toolbar -->
        </div>
    </div>

    <div>

        <pre>
            Forgot user password
1. Navigate to /login
2. Select “Forgot password”
3. Complete form.
4. Submit user form
5. Follow steps in email to complete password reset

Change user password
1. Navigate to /account/security
2. Complete form, enter current password.
3. Submit user form to update user password

How to login
1. User navigates to website url /login
2. User input “username” ( usually email ) and their “password”
3. Submit form to sign in
    1. Users will be routes to the /dashboard by default

Access training module
1. Once signed-in, from the dashboard select “Training Center”.
    1. Or navigate using /training-center

How to create a new course
* Create a document course
* Create a video course
* Creat a quiz

How to edit/modify an existing course
1. Go to /admin/courses
2. Expand “actions”, Select “Edit”, this will navigate to admin/courses/{id}/edit
    1. Complete the Edit form
    2. Submit form to save changes

How to delete a course
1. Go to /admin/courses
2. Expand “actions”, Select “Delete”, this will navigate to admin/courses/{id}/delete
3. Confirm to delete item

How to assign a course to individual users
1. Go to /admin/users
2. Expand “actions”, Select “Edit”, this will navigate to admin/users/{id}/edit
3. Select the checkbox for each course that should be assigned to user
4. Submit form to save changes

Start a assigned course
1. Go to /dashboard
2. Select course from “Available Courses” or restart a completed course from “Completed Courses”
3. Complete course steps
4. After course completion if requirements met, the course will appear under “Completed Courses”.

View report on assigned courses
1. Go to /reports
2. View available reports

        </pre>
    </div>
</script>

<!-- VIEW GROUP - ADMIN  -->
<script type="text/ng-template" id="admin.html">
    <!-- ADMIN -->
    <div>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h5 class="h5"><i class="bi bi-gear"></i> Administration</h5>
            <div class="btn-toolbar mb-2 mb-md-0">
                <!-- Admin toolbar -->
            </div>
        </div>

        <div class="row">
            {{--            <div class="col-md-4 ">--}}
            {{--                <!-- ADMIN TABS -->--}}
            {{--                <div class="list-group mb-2">--}}
            {{--                    <a ui-sref-active="active" ui-sref="admin.orderForms" class="list-group-item list-group-item-action">Order Forms</a>--}}

            {{--                </div>--}}
            {{--                <!-- END -- ADMIN TABS -->--}}

            {{--                <!-- EXTRA ACCOUNT TABS -->--}}
            {{--                <div class="list-group mb-2">--}}
            {{--                    <a ui-sref-active="active" ui-sref="account.developer" class="list-group-item list-group-item-action">Developer Settings</a>--}}
            {{--                </div>--}}
            {{--                <!-- END -- EXTRA ACCOUNT TABS -->--}}
            {{--            </div>--}}
            <!-- ADMIN MAIN -->
            <div class="col-md-12">
                <div ui-view=""></div>
            </div>
            <!-- END -- ADMIN MAIN -->
        </div>
    </div>
    <!-- END -- ADMIN -->
</script>

<script type="text/ng-template" id="admin.courses.html">
    <!-- DATA -->
    <div>
        <!-- DATA TABLE -->
        <div viewbox-table viewbox-table-data="viewboxTableData"></div>
        <!-- END -- DATA TABLE -->
    </div>
    <!-- END -- DATA -->
</script>

<!-- Basic Template -->
<script type="text/ng-template" id="admin.basic-viewbox-tabledata.html">
    <!-- DATA -->
    <div>
        <!-- DATA TABLE -->
        <div viewbox-table viewbox-table-data="viewboxTableData"></div>
        <!-- END -- DATA TABLE -->
    </div>
    <!-- END -- DATA -->
</script>

<!-- DATA VIEWER v1 -->
<script type="text/ng-template" id="dataViewer.html">

    <!-- DATA TABLE -->
    <div class="orders-table">

        <!-- DATA TABLE HEADER -->
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            {{--<h1 class="h2" ng-bind-html=" Ctrl.data.data.headerDisplayText | to_trusted">
            --}}
            <h2 class="h2">Template</h2>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2" ng-repeat="itemX in Ctrl.data.data.headerToolbarOptions" ng-bind-html="itemX | to_trusted"></div>
                {{-- <div class="btn-group me-2">
                     <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                     <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
                 </div>
                 <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                     <span data-feather="calendar"></span>
                     This week
                 </button>--}}
            </div>
        </div>
        <!-- END -- DATA TABLE HEADER -->

        <!-- DATA TABLE TOOLBAR -->
        <div class="btn-toolbar mb-2">
            <div class="btn-group me-2" ng-repeat="itemX in Ctrl.data.data.toolbarOptions" ng-bind-html="itemX | to_trusted">
            </div>
        </div>
        <!-- END -- DATA TABLE TOOLBAR -->

        <!-- SEARCH -->
        <div>
            <div class="row" style="margin-bottom: 10px">
                <div class="col-sm-8"></div>
                <div class="col-xs-12 col-sm-4">
                    <form ng-submit="submitSearchForward()">
                        <div class="input-group input-group-sm">
                            <input ng-change="submitSearchForward()" ng-model-options="{ debounce: 200 }" ng-model="searchData.text" type="text" class="form-control" placeholder="Search for.." required="required">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="submit">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div style="margin-bottom: 10px;font-weight: bolder;" ng-if="searchData.text">
                <div style="display: inline-block;  vertical-align: top;font-weight: 400;" >Searching for </div> "<div style="display: inline-block;vertical-align: top;max-width: 100px;font-weight: 400;" class="text-truncate" ng-bind="searchData.text"></div>"
            </div>
        </div>
        <!-- END -- SEARCH -->

        <!-- DATA TABLE VIEW -->
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                <tr>
                    <th scope="col" style="min-width: 120px">Template</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Template</td>
                </tr>

                {{-- <tr ng-repeat=" item in [
                     {id: '23423-234ea-2343a',tag:'one',url:'https://finao.com/order/one',custom_css:'',footer_html:'3243',header_html:'343454'},
                     {id: 'e3423-234ea-2333a',tag:'next-one',url:'https://finao.com/order/next-one',custom_css:'werwer',footer_html:'3243',header_html:'343454'},
                         {}]">
                     <th scope="row" ng-bind="(item.id ? item.id : 'Error:Unassigned ID')"></th>
                     --}}{{--<td>
                         <span class="badge bg-dark text-white">SHIPPED</span>
                     </td>

                     <td class="text-end fw-bold">$200.00</td>--}}{{--


                     <td class=" fw-bold" ng-bind="item.tag"></td>
                     <td class="" ng-bind="item.url"></td>
                     <td>
                         <span class="badge " ng-class="(item.footer_html != '' ? 'bg-success text-white' : 'bg-dark text-white')">FOOTER HTML</span>
                         <span class="badge " ng-class="(item.header_html != '' ? 'bg-success text-white' : 'bg-dark text-white')">HEADER HTML</span>
                         <span class="badge " ng-class="(item.custom_css != '' ? 'bg-success text-white' : 'bg-dark text-white')">CUSTOM CSS</span>
                     </td>
                     <td class="text-end">
                         <!-- Default dropstart button -->
                         <div class="btn-group dropstart">
                             <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                 Actions
                             </button>
                             <ul class="dropdown-menu">
                                 <!-- Dropdown menu links -->
                                 <li><a class="dropdown-item" href="#">Edit</a></li>
                                 <li><a class="dropdown-item" href="#">View</a></li>
                                 <li><a class="dropdown-item" href="#">Delete</a></li>
                             </ul>
                         </div>

                     </td>
                 </tr>--}}

                </tbody>
            </table>
        </div>
        <!-- END -- DATA TABLE VIEW -->

        <!-- PAGINATION -->
        <div>
            <div class="d-block d-sm-flex justify-content-end justify-content-sm-between">
                <div>
                    <p class="align-self-center mb-2 mt-2">Page <span ng-bind="Ctrl.data.data.itemData.meta.current_page"></span> of <span ng-bind="Ctrl.data.data.itemData.meta.last_page"></span>, showing <span ng-bind="Ctrl.data.data.itemData.data.length"></span> of <span ng-bind="Ctrl.data.data.itemData.meta.total"></span> results</p>
                </div>
                <div>
                    <nav>
                        <ul class="pagination justify-content-center justify-content-sm-end ">
                            <li ng-class="( 1 === Ctrl.data.data.itemData.meta.current_page ? 'disabled' : '')"  class="page-item ">
                                <a ng-disabled="1 === itemData.meta.current_page" class="page-link" href="" ng-click="Ctrl.data.data.prev()" tabindex="-1">Previous</a>
                            </li>

                            <li ng-class="( Ctrl.data.data.itemData.meta.last_page === Ctrl.data.data.itemData.meta.current_page ? 'disabled' : '')" class="page-item">
                                <a ng-disabled="Ctrl.data.data.itemData.meta.last_page === Ctrl.data.data.itemData.meta.current_page" class="page-link" href="" ng-click="Ctrl.data.data.next()">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- END -- PAGINATION -->

    </div>
    <!-- END -- DATA TABLE -->

</script>
<script type="text/ng-template" id="dataViewer.search.html">

    <!-- DATA TABLE -->
    <!-- SEARCH -->
    <div>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-sm-8"></div>
            <div class="col-xs-12 col-sm-4">
                <form ng-submit="submitSearchForward()">
                    <div class="input-group input-group-sm">
                        <input ng-change="submitSearchForward()" ng-model-options="{ debounce: 200 }" ng-model="searchData.text" type="text" class="form-control" placeholder="Search for.." required="required">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div style="margin-bottom: 10px;font-weight: bolder;" ng-if="searchData.text">
            <div style="display: inline-block;  vertical-align: top;font-weight: 400;" >Searching for </div> "<div style="display: inline-block;vertical-align: top;max-width: 100px;font-weight: 400;" class="text-truncate" ng-bind="searchData.text"></div>"
        </div>
    </div>
    <!-- END -- SEARCH -->
    <!-- END -- DATA TABLE -->

</script>
<script type="text/ng-template" id="dataViewer.pagination.html">

    <!-- DATA TABLE -->
    <!-- PAGINATION -->
    <div>
        <div class="d-block d-sm-flex justify-content-end justify-content-sm-between">
            <div>
                <p class="align-self-center mb-2 mt-2">Page <span ng-bind="Ctrl.data.data.itemData.meta.current_page"></span> of <span ng-bind="Ctrl.data.data.itemData.meta.last_page"></span>, showing <span ng-bind="Ctrl.data.data.itemData.data.length"></span> of <span ng-bind="Ctrl.data.data.itemData.meta.total"></span> results</p>
            </div>
            <div>
                <nav>
                    <ul class="pagination justify-content-center justify-content-sm-end ">
                        <li ng-class="( 1 === Ctrl.data.data.itemData.meta.current_page ? 'disabled' : '')"  class="page-item ">
                            <a ng-disabled="1 === itemData.meta.current_page" class="page-link" href="" ng-click="Ctrl.data.data.prev()" tabindex="-1">Previous</a>
                        </li>

                        <li ng-class="( Ctrl.data.data.itemData.meta.last_page === Ctrl.data.data.itemData.meta.current_page ? 'disabled' : '')" class="page-item">
                            <a ng-disabled="Ctrl.data.data.itemData.meta.last_page === Ctrl.data.data.itemData.meta.current_page" class="page-link" href="" ng-click="Ctrl.data.data.next()">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <!-- END -- PAGINATION -->
    <!-- END -- DATA TABLE -->

</script>

<!-- ACCOUNT SETTINGS -->
<!-- ACCOUNT VIEW -->
<script type="text/ng-template" id="account.overview.html">
    <h3>Overview</h3>
</script>

<script type="text/ng-template" id="account.html">
    <!-- ACCOUNT -->
    <div>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2"><i class="bi bi-person-circle"></i> My Account</h1>
            <div class="btn-toolbar mb-2 mb-md-0">

            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <!-- ACCOUNT TABS -->
                <div class="list-group mb-2">
                    <a ui-sref-active="active" ui-sref="account.profile" class="list-group-item list-group-item-action">Profile</a>
                    <a ui-sref-active="active" ui-sref="account.security" class="list-group-item list-group-item-action">Security</a>

                </div>
                <!-- END -- ACCOUNT TABS -->

                <!-- EXTRA ACCOUNT TABS -->
                <div class="list-group mb-2">
                    <a ui-sref-active="active" ui-sref="account.developer" class="list-group-item list-group-item-action">Developer Settings</a>
                </div>
                <!-- END -- EXTRA ACCOUNT TABS -->
            </div>
            <!-- MY ACCOUNT MAIN -->
            <div class="col-md-8 mb-5">
                <div ui-view=""></div>
            </div>
            <!-- END -- MY ACCOUNT MAIN -->
        </div>

    </div>
    <!-- END -- ACCOUNT -->
</script>

<script type="text/ng-template" id="account.security.html">
    <!-- SECURITY -->
    <div>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h3> Security</h3>
            <div class="btn-toolbar mb-2 mb-md-0">

            </div>
        </div>
        <form ng-submit="submitForm()">
            <legend>Update security</legend>

            <div alert-dialog alert-data="alertData"></div>

            <div class="mb-3">
                <label for="editAccountPasswordCurrent" class="form-label">Current Password <span class="text-danger">*</span></label>
                <input type="password" placeholder="Enter current password.." class="form-control" id="editAccountPasswordCurrent" required>
                <div id="emailHelp" class="form-text">Enter current account password.</div>
            </div>

            <div class="mb-3">
                <label for="editAccountPasswordNew" class="form-label">New Password <span class="text-danger">*</span></label>
                <input type="password" placeholder="Enter new password.." class="form-control" id="editAccountPasswordNew" required>
                <div id="emailHelp" class="form-text">Enter new account password.</div>
            </div>

            <div class="mb-3">
                <label for="editAccountPasswordConfirm" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                <input type="password" placeholder="Confirm password.." class="form-control" id="editAccountPasswordConfirm" required>
                <div id="emailHelp" class="form-text">Confirm new account password.</div>
            </div>

            <p>Make sure it's at least 15 characters OR at least 8 characters including a number and a lowercase letter.</p>

            <button
                    ng-disabled="alertData.loading"
                    ng-class="( alertData.loading === true  ? 'btn-dark' : 'btn-primary')"
                    type="submit" class="btn">Change password</button>
        </form>
    </div>
    <!-- END -- SECURITY -->
</script>

<script type="text/ng-template" id="account.profile.html">

    <!-- PROFILE -->
    <div>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h3> Profile</h3>
            <div class="btn-toolbar mb-2 mb-md-0">

            </div>
        </div>
        <form ng-submit="submitForm()">
            <legend>Account details</legend>

            <div alert-dialog alert-data="alertData"></div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Organization Name <span class="text-danger">*</span></label>
                <input type="text" placeholder="Enter organization.."
                       ng-model="editAccountData.account.name"
                       class="form-control" id="exampleInputEmail1"
                       aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">Enter organization name.</div>
            </div>

            <div class="mb-3">
                <label for="editAccountName" class="form-label">Name <span class="text-danger">*</span></label>
                <input type="text" placeholder="Enter name.."
                       ng-model="editAccountData.name"
                       class="form-control" id="editAccountName" aria-describedby="nameHelp">
                <div id="emailHelp" class="form-text">Enter name.</div>
            </div>

            {{--      <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Last Name <span class="text-danger">*</span></label>
                      <input type="text" placeholder="Enter last.." class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                      <div id="emailHelp" class="form-text">Enter last name.</div>
                  </div>--}}

            <div class="mb-3">
                <label for="editAccountEmail" class="form-label">Email address <span class="text-danger">*</span></label>
                <input type="email" placeholder="Enter email.."
                       ng-model="editAccountData.email"
                       class="form-control" id="editAccountEmail" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>

            <div class="mb-3">
                <label for="editAccountPhone" class="form-label">Phone </label>
                <input type="text" placeholder="Enter phone.."
                       ng-model="editAccountData.office_phone"
                       class="form-control" id="editAccountPhone" aria-describedby="editAccountPhoneHelp">
                <div id="editAccountPhoneHelp" class="form-text">Enter office primary phone number.</div>
            </div>

            <div class="mb-3">
                <label for="editAccountMobilePhone" class="form-label">Mobile Phone <span class="text-danger">*</span></label>
                <input type="text" placeholder="Enter mobile phone.."
                       ng-model="editAccountData.mobile_phone"
                       class="form-control" id="editAccountMobilePhone" aria-describedby="editAccountMobilePhoneHelp">
                <div id="editAccountMobilePhoneHelp" class="form-text">Enter mobile phone number.</div>
            </div>

            {{-- <legend>Billing details</legend>

             <div class="mb-3 form-check">
                 <input type="checkbox" class="form-check-input" id="exampleCheck1">
                 <label class="form-check-label" for="exampleCheck1">Check me out</label>
             </div>
             --}}

            <button
                    ng-disabled="alertData.loading"
                    ng-class="( alertData.loading === true  ? 'btn-dark' : 'btn-primary')"
                    type="submit" class="btn ">Save Changes</button>
        </form>
    </div>
    <!-- END -- PROFILE -->

</script>

<!-- END -- ACCOUNT VIEW -->
<!-- END -- ACCOUNT SETTINGS -->

<!-- ===|| END -- TEMPLATES ||=== --->

<script>
    //..
    console.log('page load..');

    /***
     * ======================
     * == APP ==
     * ======================
     */

    /** Primary App Module */
    app = angular.module('smcSettingsApp', [
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

        //## Organizations

        /**
         * Get list of Organizations
         * @param postData
         * @returns {*}
         */
        this.getOrganizations = function (postData) {
            return $http.get(appConfig.api_host + 'api/v1/organizations', {
                params:postData
            });
        };

    }]);

    /*app.config(function($routeProvider
        //, $locationProvider
    ) {
        // configure html5 to get links working on jsfiddle
        //$locationProvider.html5Mode(true);

        $routeProvider
           /!* .when("/", {
                templateUrl : "appLayout.html"
            })*!/
            .when("/", {
                templateUrl : "dashboard.html"
            })
            .when("/orders", {
                templateUrl : "orders.html",
                controller : "OrderController",
                resolve: {
                    // I will cause a 1 second delay
                    delay: function($q, $timeout) {
                        var delay = $q.defer();
                        $timeout(delay.resolve, 1000);
                        return delay.promise;
                    }
                }
            })
            .when('/orders/:ordersId', {
                templateUrl: 'orders.create.html',
                controller: "OrderController",
                controllerAs: 'orderCtrl'
            });
    });*/

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
            .state('help', {
                name: 'help',
                url: '/help',
                controller: function (){},
                templateUrl : "help.html"
            })
            .state('admin', {
                name: 'admin',
                url: '/admin',
                abstract:true,
                controller: (function ($scope){
                    //..
                }),
                templateUrl : "admin.html",
            })
            .state('admin.organizations', {
                name: 'admin.organizations',
                url: '/admin/organizations',
                controller: (function ($scope, $timeout, $http, smcAppService){
                    //..
                    $scope.currentTab = 'all';
                    //$scope.statusFilter = 'all';

                    $scope.itemDataError = false;
                    $scope.itemDataLoading = false;

                    $scope.itemData = {
                        last_page: 1,
                        current_page: 1,
                        data : [],
                        per_page : 0,
                        total : 0
                    };
                    $scope.searchData = {
                        text: null
                    };

                    $scope.next = function () {
                        if($scope.itemData.meta.current_page !== $scope.itemData.meta.last_page ) {
                            $scope.refreshData($scope.itemData.meta.current_page + 1);
                        }
                    };
                    $scope.prev = function () {
                        if($scope.itemData.meta.current_page > 1 ) {
                            $scope.refreshData($scope.itemData.meta.current_page - 1);
                        }
                    };

                    /**
                     * Search handle
                     */
                    $scope.submitSearch = function (searchText) {
                        if(searchText != null){
                            $scope.searchData.text = searchText;
                        }
                        $scope.refreshData();
                    };

                    /**
                     * Refresh handle
                     */
                    $scope.refreshData = function (page) {
                        $scope.itemDataError = false;
                        $scope.itemDataLoading = true;

                        var postData = {
                            page: (page?page:1),
                            search: $scope.searchData.text,
                            //status: $scope.statusFilter,
                        };

                        smcAppService.getOrganizations(postData).then(function (response) {
                            console.log(response.data);
                            $scope.itemData = response.data;


                        }, function() {
                            $scope.itemDataError = true;
                        }).finally(function () {
                            $timeout(function () {
                                $scope.itemDataLoading = false;
                            }, 10)
                        })
                    };

                    $scope.$watch('itemData', function() {
                        // listen to itemData changes then pass them to viewboxTable...
                        console.log("$watch('itemData')");
                        $scope.viewboxTableData.data.itemData = $scope.itemData;
                        console.log("$scope.viewboxTableData", $scope.viewboxTableData);
                    });

                    //ViewboxTable
                    $scope.viewboxTableData = {
                        data : {
                            next: $scope.next,
                            prev: $scope.prev,
                            submitSearch: $scope.submitSearch,
                            refreshData: $scope.refreshData,
                            //prev: prev(),
                            //submitSearch: submitSearch(),
                            itemData : {},
                            theadContent: '<thead><tr><th scope="col" style="min-width: 120px">#</th><th scope="col" style="min-width: 150px">Name</th><th scope="col" style="min-width: 200px">Description</th><th scope="col" style="min-width: 150px" class="text-center">Actions</th></tr></thead>',
                            tbodyContent : '<tbody><tr ng-repeat=" item in Ctrl.data.data.itemData.data"><th scope="row" ng-bind="item.id"></th><td ng-bind="item.name"></td><td class="text-truncate" ng-bind="item.description"></td><td class="text-end"><!-- drop-button --><div class="btn-group dropstart"><button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Actions</button><ul class="dropdown-menu"><!-- Dropdown menu links --><li><a class="dropdown-item" href="#">Edit</a></li><li><a class="dropdown-item" href="#">View</a></li><li><a class="dropdown-item" href="#">Delete</a></li></ul></div></td></tr></tbody>',
                            headerDisplayText : '<h2 class="h2"><i class="bi bi-card-checklist"></i> Organizations</h2>',
                            headerToolbarOptions : [
                                '<button type="button" ui-sref="admin.orderFormsCreate" class="btn btn-sm btn-primary"><i class="bi bi-plus"></i> Create New</button>'
                            ],
                            toolbarOptions : [
                                '<button type="button" ui-sref="admin.orderFormsCreate" class="btn btn-sm btn-primary"><i class="bi bi-plus"></i> Create New</button>'
                            ]
                        }
                    }

                    //init
                    $scope.refreshData();

                }),
                templateUrl : "admin.basic-viewbox-tabledata.html"
            })
            .state('admin.organizations.contacts', {
                name: 'admin.organizations.contacts',
                url: '/contacts',
                controller: (function ($scope, $timeout, $http, smcAppService){
                    //..
                    $scope.currentTab = 'all';
                    //$scope.statusFilter = 'all';

                    $scope.itemDataError = false;
                    $scope.itemDataLoading = false;

                    $scope.itemData = {
                        last_page: 1,
                        current_page: 1,
                        data : [],
                        per_page : 0,
                        total : 0
                    };
                    $scope.searchData = {
                        text: null
                    };

                    $scope.next = function () {
                        if($scope.itemData.meta.current_page !== $scope.itemData.meta.last_page ) {
                            $scope.refreshData($scope.itemData.meta.current_page + 1);
                        }
                    };
                    $scope.prev = function () {
                        if($scope.itemData.meta.current_page > 1 ) {
                            $scope.refreshData($scope.itemData.meta.current_page - 1);
                        }
                    };

                    /**
                     * Search handle
                     */
                    $scope.submitSearch = function (searchText) {
                        if(searchText != null){
                            $scope.searchData.text = searchText;
                        }
                        $scope.refreshData();
                    };

                    /**
                     * Refresh handle
                     */
                    $scope.refreshData = function (page) {
                        $scope.itemDataError = false;
                        $scope.itemDataLoading = true;

                        var postData = {
                            page: (page?page:1),
                            search: $scope.searchData.text,
                            //status: $scope.statusFilter,
                        };

                        smcAppService.getCourses(postData).then(function (response) {
                            console.log(response.data);
                            $scope.itemData = response.data;


                        }, function() {
                            $scope.itemDataError = true;
                        }).finally(function () {
                            $timeout(function () {
                                $scope.itemDataLoading = false;
                            }, 10)
                        })
                    };

                    //Watch
                    $scope.$watch('itemData', function() {
                        // listen to itemData changes then pass them to viewboxTable...
                        console.log("$watch('itemData')");
                        $scope.viewboxTableData.data.itemData = $scope.itemData;
                        console.log("$scope.viewboxTableData", $scope.viewboxTableData);
                    });

                    //Data
                    $scope.viewboxTableData = {
                        data : {
                            next: $scope.next,
                            prev: $scope.prev,
                            submitSearch: $scope.submitSearch,
                            refreshData: $scope.refreshData,
                            //prev: prev(),
                            //submitSearch: submitSearch(),
                            itemData : {},
                            theadContent: '<thead><tr><th scope="col" style="min-width: 120px">#</th><th scope="col" style="min-width: 150px">Course</th><th scope="col" style="min-width: 200px">Description</th><th scope="col" style="min-width: 150px" class="text-center">Actions</th></tr></thead>',
                            tbodyContent : '<tbody><tr ng-repeat=" item in Ctrl.data.data.itemData.data"><th scope="row" ng-bind="item.id"></th><td ng-bind="item.name"></td></td><td class="text-truncate" ng-bind="item.description"></td><td><span class="badge bg-danger text-white" ng-if="item.has_footer_html == true">FOOTER HTML</span><span class="badge bg-danger text-white" ng-if="item.has_header_html == true">HEADER HTML</span></td><td class="text-end"><!-- drop-button --><div class="btn-group dropstart"><button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Actions</button><ul class="dropdown-menu"><!-- Dropdown menu links --><li><a class="dropdown-item" href="#">Edit</a></li><li><a class="dropdown-item" href="#">View</a></li><li><a class="dropdown-item" href="#">Delete</a></li></ul></div></td></tr></tbody>',
                            headerDisplayText : '<h2 class="h2"><i class="bi bi-books"></i> Courses</h2>',
                            headerToolbarOptions : [
                                '<button type="button" ui-sref="admin.courseCreate" class="btn btn-sm btn-primary"><i class="bi bi-plus"></i> Create New</button>'
                            ],
                            toolbarOptions : [
                                '<button type="button" ui-sref="admin.courseCreate" class="btn btn-sm btn-primary"><i class="bi bi-plus"></i> Create New</button>'
                            ]
                        }
                    }

                    //init
                    $scope.refreshData();

                }),
                templateUrl : "admin.courses.html"
            })


            .state('account', {
                name: 'account',
                url: '/account',
                abstract:true,
                controller: (function ($scope){
                    //..
                }),

                templateUrl : "account.html",
            })
            .state('account.overview', {
                name: 'account.overview',
                url: '/account/overview',
                controller: (function ($scope){
                    //..
                }),
                templateUrl : "account.overview.html"
            })
            .state('account.profile', {
                url: '/profile',
                controller: (function ($scope, $rootScope, $timeout, smcAppService)  {
                    //init var(s)
                    $scope.alertData = {
                        html: null,
                        alertClass: null,
                        errors: null,
                        loading:false
                    }
                    $scope.editAccountData = null;

                    /**
                     * Submit form
                     */
                    $scope.submitForm = function (){
                        // Scroll top
                        window.scrollTo({ top: 0, behavior: 'smooth' });

                        //Debug
                        console.log('Updating profile...', [$scope.editAccountData]);

                        //Reset alert dialog
                        $scope.alertData['errors'] = null;
                        $scope.alertData['html'] = null;
                        $scope.alertData['alertClass'] = null;
                        //Set to true
                        $scope.alertData['loading'] = true;

                        //Update current user
                        smcAppService.updateAuthUser($scope.editAccountData).then(
                            function (response) {
                            console.log('res.data', response.data)
                            //Check for API errors
                            if(typeof response.data.errors == "undefined") {
                                //Success --

                                //Show success alert
                                $timeout(function() {

                                    $scope.alertData['loading'] = false;
                                    $scope.alertData['errors'] = null;
                                    $scope.alertData['html'] = 'Account updated.';
                                    $scope.alertData['alertClass'] = 'alert-success';
                                }, 1000);
                            } else {
                                //Display errors
                                //$scope.itemDataError = true;
                                $scope.alertData = {
                                    errors: response.data.errors
                                }
                                //$scope.itemDataErrors = response.data.errors;
                            }

                            //TODO -- Refresh user data at $rootScope

                        },
                            function(data) {
                            // Handle error here
                            $scope.alertData = {
                                errors: [
                                    'Something went wrong.'
                                ]
                            }
                        }).finally(function() {
                            $timeout(function() {
                                $scope.alertData['loading'] = false;
                            }, 1000);
                        });

                    }

                    /**
                     * Refresh controller data
                     * */
                    $scope.refreshData = function (){
                        $scope.editAccountData = $rootScope.authUserData.data;
                    }

                    /**
                     * init controller
                     * */
                    $scope.init = function (){
                        //Refresh
                        $scope.refreshData();

                        console.log("$scope.editAccountData", $scope.editAccountData)
                    }

                    //init..
                    $scope.init();

                }),
                templateUrl : "account.profile.html"
            })
            .state('account.security', {
                url: '/security',
                controller: (function ($scope, $rootScope, $timeout, smcAppService)  {
                    //init var(s)
                    $scope.alertData = {
                        html: null,
                        alertClass: null,
                        errors: null,
                        loading:false
                    }
                    $scope.editAccountData = null;

                    /**
                     * Submit form
                     */
                    $scope.submitForm = function (){
                        // Scroll top
                        window.scrollTo({ top: 0, behavior: 'smooth' });

                        //Debug
                        console.log('Updating account security...', [$scope.editAccountData]);

                        //Reset alert dialog
                        $scope.alertData['errors'] = null;
                        $scope.alertData['html'] = null;
                        $scope.alertData['alertClass'] = null;
                        //Set to true
                        $scope.alertData['loading'] = true;

                        //Update current user
                        smcAppService.updateAuthUserPassword($scope.editAccountData).then(
                            function (response) {
                                console.log('res.data', response.data)
                                //Check for API errors
                                if(typeof response.data.errors == "undefined") {
                                    //Success --

                                    //Show success alert
                                    $timeout(function() {

                                        $scope.alertData['loading'] = false;
                                        $scope.alertData['errors'] = null;
                                        $scope.alertData['html'] = 'Account updated.';
                                        $scope.alertData['alertClass'] = 'alert-success';
                                    }, 1000);
                                } else {
                                    //Display errors
                                    //$scope.itemDataError = true;
                                    $scope.alertData = {
                                        errors: response.data.errors
                                    }
                                    //$scope.itemDataErrors = response.data.errors;
                                }

                            },
                            function(data) {
                                // Handle error here
                                $scope.alertData = {
                                    errors: [
                                        'Something went wrong.'
                                    ]
                                }
                            }).finally(function() {
                            $timeout(function() {
                                $scope.alertData['loading'] = false;
                            }, 1000);
                        });

                    }

                    /**
                     * Refresh controller data
                     * */
                    $scope.refreshData = function (){
                        $scope.editAccountData = $rootScope.authUserData.data;
                    }

                    /**
                     * init controller
                     * */
                    $scope.init = function (){
                        //Refresh
                        $scope.refreshData();

                        console.log("$scope.editAccountData", $scope.editAccountData)
                    }

                    //init..
                    $scope.init();

                }),

                templateUrl : "account.security.html"
            })

            .state('reports', {
                name: 'reports',
                url: '/reports',
                controller: (function ($scope){
                    //..
                }),
                templateUrl : "reports.html"
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

    app.controller('AccountController', function (){
        console.log('AccountController init..');
    });

    /*
         * Required
         */

    app.directive('alertDialog', ['$http', '$timeout', function($http, $timeout) { return {
        restrict: 'AE',
        templateUrl : "alertDialog.html",
        link: function(scope,elem,attr){
            // code goes here ...


         /*   var alertNode = document.querySelector('.alert')
            var alert = bootstrap.Alert.getInstance(alertNode)
            alert.close()*/

            //Config
            scope.alertCtrl = {
                data: scope.alertData
            };

            scope.$watch('alertData', function() {
                // all the code here...
                console.log("$watch('alertData')");
                scope.alertCtrl = {
                    data: scope.alertData
                };
                console.log(scope.alertCtrl);
            });

            /**
             * Init part
             */
            scope.initD = function(){
                console.log('alertDialog', {
                    scope: scope
                })
            };

            //init
            scope.initD();
        },
        controller: function($scope){},
        scope: {
            'alertData':'='
        },
    }}])

    app.directive('alertComingSoon', ['$http', '$timeout', function($http, $timeout) { return {
        restrict: 'AE',
        templateUrl : "alertComingSoon.html",
        link: function(scope,elem,attr){
            // code goes here ...

            //Config
            scope.alertCtrl = {
                data: scope.alertData
            };

            /**
             * Init part
             */
            scope.initD = function(){
                console.log('alertDialog', {
                    scope: scope
                })
            };

            //init
            scope.initD();
        },
        controller: function($scope){},
        scope: {
            'alertData':'='
        },
    }}])

    app.filter('to_trusted', ['$sce', function($sce){
        return function(text) {
            return $sce.trustAsHtml(text);
        };
    }])

    //dataViewer
    app.directive('viewboxTable', [
        '$compile',
        //'$http', '$timeout',
        function(
            $compile
            //$http, $timeout
        ) { return {
            restrict: 'AE',
            templateUrl : "dataViewer.html",
            link: function(scope,elem,attr){
                // code goes here ...

                //header
                var template = $compile(scope.viewboxTableData.data.headerDisplayText)(scope);
                var headerText = elem.find("h2");
                headerText.replaceWith(template);

                //tbody
                var templateTbody = $compile(scope.viewboxTableData.data.tbodyContent)(scope);
                var tbodyContent = elem.find("tbody");
                tbodyContent.replaceWith(templateTbody);

                //thead
                var templateThead = $compile(scope.viewboxTableData.data.theadContent)(scope);
                var theadContent = elem.find("thead");
                theadContent.replaceWith(templateThead);


                //Config
                scope.Ctrl = {
                    data: scope.viewboxTableData
                };

                scope.$watch('viewboxTableData', function() {
                    // all the code here...
                    console.log("$watch('viewboxTableData')");
                    scope.Ctrl = {
                        data: scope.viewboxTableData
                    };
                    console.log("scope.viewboxTableData", scope.viewboxTableData);
                });


                scope.searchData = {
                    text: ''
                };
                /**
                 * submitSearchForward
                 */
                scope.submitSearchForward = function (){
                    //alert('forward');
                    scope.Ctrl.data.data.submitSearch(scope.searchData.text);
                }

                /**
                 * Init part
                 */
                scope.initD = function(){
                    console.log('init Viewer', {
                        scope: scope
                    });
                };

                //init
                scope.initD();
            },
            controller: function($scope){},
            scope: {
                'viewboxTableData':'='
            },
        }}])

    //dataViewer.search
    app.directive('viewboxTableSearch', [
        '$compile',
        //'$http', '$timeout',
        function(
            $compile
            //$http, $timeout
        ) { return {
            restrict: 'AE',
            templateUrl : "dataViewer.search.html",
            link: function(scope,elem,attr){
                // code goes here ...

                //Config
                scope.Ctrl = {
                    data: scope.viewboxTableData
                };

                //Listen for changes, fire events locally
                scope.$watch('viewboxTableData', function() {
                    // all the code here...
                    console.log("$watch('viewboxTableData')");
                    scope.Ctrl = {
                        data: scope.viewboxTableData
                    };
                    console.log("scope.viewboxTableData", scope.viewboxTableData);
                });

                //Local scope
                scope.searchData = {
                    text: ''
                };
                /**
                 * submitSearchForward
                 */
                scope.submitSearchForward = function (){
                    //alert('forward');
                    scope.Ctrl.data.data.submitSearch(scope.searchData.text);
                }

                /**
                 * Init part
                 */
                scope.initD = function(){
                    console.log('init Viewer Search Form', {
                        scope: scope
                    });

                    //overrideTemplate
                    if(scope.viewboxTableData.data.overideDefaultSearchTemplate != null) {
                        var newTemplate = $compile(scope.viewboxTableData.data.overideDefaultSearchTemplate)(scope);
                        var mainDiv = elem.find("div");
                        mainDiv.replaceWith(newTemplate);
                    }
                };

                //init
                scope.initD();
            },
            controller: function($scope){},
            scope: {
                'viewboxTableData':'='
            },
        }}])

    //dataViewer.pagination
    app.directive('viewboxTablePagination', [
        '$compile',
        //'$http', '$timeout',
        function(
            $compile
            //$http, $timeout
        ) { return {
            restrict: 'AE',
            templateUrl : "dataViewer.pagination.html",
            link: function(scope,elem,attr){
                // code goes here ...

                //Config
                scope.Ctrl = {
                    data: scope.viewboxTableData
                };

                //Listen for changes, fire events locally
                scope.$watch('viewboxTableData', function() {
                    // all the code here...
                    console.log("$watch('viewboxTableData')");
                    scope.Ctrl = {
                        data: scope.viewboxTableData
                    };
                    console.log("scope.viewboxTableData", scope.viewboxTableData);
                });

                //Local scope


                /**
                 * Init part
                 */
                scope.initD = function(){
                    console.log('init Viewer Search Form', {
                        scope: scope
                    });

                    //overrideTemplate
                    if(scope.viewboxTableData.data.overideDefaultPaginationTemplate != null) {
                        var newTemplate = $compile(scope.viewboxTableData.data.overideDefaultPaginationTemplate)(scope);
                        var mainDiv = elem.find("div");
                        mainDiv.replaceWith(newTemplate);
                    }
                };

                //init
                scope.initD();
            },
            controller: function($scope){},
            scope: {
                'viewboxTableData':'='
            },
        }}])

</script>
<!-- END -- PAGE INLINE SCRIPTS -->
</body>
</html>