<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>SimpleAdmin - Responsive Admin Dashboard Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- Plugins css-->
        <link href="assets/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css" rel="stylesheet" />
        <link rel="stylesheet" href="assets/plugins/switchery/switchery.min.css">
        <link href="assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
		<link href="assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet">
		<link href="assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
		<link href="assets/plugins/clockpicker/css/bootstrap-clockpicker.min.css" rel="stylesheet">
		<link href="assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
        <!-- Summernote css -->
        <link href="assets/plugins/summernote/summernote.css" rel="stylesheet" />


        <!-- Bootstrap core CSS -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
        <!-- MetisMenu CSS -->
        <link href="assets/css/metisMenu.min.css" rel="stylesheet">
        <!-- Icons CSS -->
        <link href="assets/css/icons.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="assets/css/style.css" rel="stylesheet">

    </head>


    <body>

        <div id="page-wrapper">

            <!-- Top Bar Start -->
            <div class="topbar">

                <!-- LOGO -->
                <div class="topbar-left">
                    <div class="">
                        <a href="index.html" class="logo">
                            <img src="assets/images/logo.png" alt="logo" class="logo-lg" />
                            <img src="assets/images/logo_sm.png" alt="logo" class="logo-sm hidden" />
                        </a>
                    </div>
                </div>

                <!-- Top navbar -->
                <div class="navbar navbar-default" role="navigation">
                    <div class="container">
                        <div class="">

                            <!-- Mobile menu button -->
                            <div class="pull-left">
                                <button type="button" class="button-menu-mobile visible-xs visible-sm">
                                    <i class="fa fa-bars"></i>
                                </button>
                                <span class="clearfix"></span>
                            </div>

                            <!-- Top nav left menu -->
                            <ul class="nav navbar-nav hidden-sm hidden-xs top-navbar-items">
                                <li><a href="forms-advanced.html#">About</a></li>
                                <li><a href="forms-advanced.html#">Help</a></li>
                                <li><a href="forms-advanced.html#">Contact</a></li>
                            </ul>

                            <!-- Top nav Right menu -->
                            <ul class="nav navbar-nav navbar-right top-navbar-items-right pull-right">
                                <li class="hidden-xs">
                                    <form role="search" class="navbar-left app-search pull-left">
                                         <input type="text" placeholder="Search..." class="form-control">
                                         <a href=""><i class="fa fa-search"></i></a>
                                    </form>
                                </li>
                                <li class="dropdown top-menu-item-xs">
                                    <a href="forms-advanced.html#" data-target="#" class="dropdown-toggle menu-right-item" data-toggle="dropdown" aria-expanded="true">
                                        <i class="mdi mdi-bell"></i> <span class="label label-danger">3</span>
                                    </a>
                                    <ul class="dropdown-menu p-0 dropdown-menu-lg">
                                        <!--<li class="notifi-title"><span class="label label-default pull-right">New 3</span>Notification</li>-->
                                        <li class="list-group notification-list" style="height: 267px;">
                                           <div class="slimscroll">
                                               <!-- list item-->
                                               <a href="javascript:void(0);" class="list-group-item">
                                                  <div class="media">
                                                     <div class="media-left p-r-10">
                                                        <em class="fa fa-diamond bg-primary"></em>
                                                     </div>
                                                     <div class="media-body">
                                                        <h5 class="media-heading">A new order has been placed A new order has been placed</h5>
                                                        <p class="m-0">
                                                            <small>There are new settings available</small>
                                                        </p>
                                                     </div>
                                                  </div>
                                               </a>

                                               <!-- list item-->
                                               <a href="javascript:void(0);" class="list-group-item">
                                                  <div class="media">
                                                     <div class="media-left p-r-10">
                                                        <em class="fa fa-cog bg-warning"></em>
                                                     </div>
                                                     <div class="media-body">
                                                        <h5 class="media-heading">New settings</h5>
                                                        <p class="m-0">
                                                            <small>There are new settings available</small>
                                                        </p>
                                                     </div>
                                                  </div>
                                               </a>

                                               <!-- list item-->
                                               <a href="javascript:void(0);" class="list-group-item">
                                                  <div class="media">
                                                     <div class="media-left p-r-10">
                                                        <em class="fa fa-bell-o bg-custom"></em>
                                                     </div>
                                                     <div class="media-body">
                                                        <h5 class="media-heading">Updates</h5>
                                                        <p class="m-0">
                                                            <small>There are <span class="text-primary font-600">2</span> new updates available</small>
                                                        </p>
                                                     </div>
                                                  </div>
                                               </a>

                                               <!-- list item-->
                                               <a href="javascript:void(0);" class="list-group-item">
                                                  <div class="media">
                                                     <div class="media-left p-r-10">
                                                        <em class="fa fa-user-plus bg-danger"></em>
                                                     </div>
                                                     <div class="media-body">
                                                        <h5 class="media-heading">New user registered</h5>
                                                        <p class="m-0">
                                                            <small>You have 10 unread messages</small>
                                                        </p>
                                                     </div>
                                                  </div>
                                               </a>

                                                <!-- list item-->
                                               <a href="javascript:void(0);" class="list-group-item">
                                                  <div class="media">
                                                     <div class="media-left p-r-10">
                                                        <em class="fa fa-diamond bg-primary"></em>
                                                     </div>
                                                     <div class="media-body">
                                                        <h5 class="media-heading">A new order has been placed A new order has been placed</h5>
                                                        <p class="m-0">
                                                            <small>There are new settings available</small>
                                                        </p>
                                                     </div>
                                                  </div>
                                               </a>

                                               <!-- list item-->
                                               <a href="javascript:void(0);" class="list-group-item">
                                                  <div class="media">
                                                     <div class="media-left p-r-10">
                                                        <em class="fa fa-cog bg-warning"></em>
                                                     </div>
                                                     <div class="media-body">
                                                        <h5 class="media-heading">New settings</h5>
                                                        <p class="m-0">
                                                            <small>There are new settings available</small>
                                                        </p>
                                                     </div>
                                                  </div>
                                               </a>
                                           </div>
                                        </li>
                                        <!--<li>-->
                                            <!--<a href="javascript:void(0);" class="list-group-item text-right">-->
                                                <!--<small class="font-600">See all notifications</small>-->
                                            <!--</a>-->
                                        <!--</li>-->
                                    </ul>
                                </li>

                                <li class="dropdown top-menu-item-xs">
                                    <a href="" class="dropdown-toggle menu-right-item profile" data-toggle="dropdown" aria-expanded="true"><img src="assets/images/users/avatar-1.jpg" alt="user-img" class="img-circle"> </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="javascript:void(0)"><i class="ti-user m-r-10"></i> Profile</a></li>
                                        <li><a href="javascript:void(0)"><i class="ti-settings m-r-10"></i> Settings</a></li>
                                        <li><a href="javascript:void(0)"><i class="ti-lock m-r-10"></i> Lock screen</a></li>
                                        <li class="divider"></li>
                                        <li><a href="javascript:void(0)"><i class="ti-power-off m-r-10"></i> Logout</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div> <!-- end container -->
                </div> <!-- end navbar -->
            </div>
            <!-- Top Bar End -->


            <!-- Page content start -->
            <div class="page-contentbar">

                <!--left navigation start-->
                <aside class="sidebar-navigation">
                    <div class="scrollbar-wrapper">
                        <div>
                            <button type="button" class="button-menu-mobile btn-mobile-view visible-xs visible-sm">
                                <i class="mdi mdi-close"></i>
                            </button>
                            <!-- User Detail box -->
                            <div class="user-details">
                                <div class="pull-left">
                                    <img src="assets/images/users/avatar-1.jpg" alt="" class="thumb-md img-circle">
                                </div>
                                <div class="user-info">
                                    <a href="forms-advanced.html#">Stanley Jones</a>
                                    <p class="text-muted m-0">Administrator</p>
                                </div>
                            </div>
                            <!--- End User Detail box -->

                            <!-- Left Menu Start -->
                            <ul class="metisMenu nav" id="side-menu">
                                <li><a href="index.html"><i class="ti-home"></i> Dashboard </a></li>

                                <li><a href="ui-elements.html"><span class="label label-custom pull-right">11</span> <i class="ti-paint-bucket"></i> UI Elements </a></li>

                                <li>
                                    <a href="javascript: void(0);" aria-expanded="true"><i class="ti-light-bulb"></i> Components <span class="fa arrow"></span></a>
                                    <ul class="nav-second-level nav" aria-expanded="true">
                                        <li><a href="components-range-slider.html">Range Slider</a></li>
                                        <li><a href="components-alerts.html">Alerts</a></li>
                                        <li><a href="components-icons.html">Icons</a></li>
                                        <li><a href="components-widgets.html">Widgets</a></li>
                                    </ul>
                                </li>

                                <li><a href="typography.html"><i class="ti-spray"></i> Typography </a></li>

                                <li>
                                    <a href="javascript: void(0);" aria-expanded="true"><i class="ti-pencil-alt"></i> Forms <span class="fa arrow"></span></a>
                                    <ul class="nav-second-level nav" aria-expanded="true">
                                        <li><a href="forms-general.html">General Elements</a></li>
                                        <li><a href="forms-advanced.html">Advanced Form</a></li>
                                    </ul>
                                </li>

                                <li>
                                    <a href="javascript: void(0);" aria-expanded="true"><i class="ti-menu-alt"></i> Tables <span class="fa arrow"></span></a>
                                    <ul class="nav-second-level nav" aria-expanded="true">
                                        <li><a href="tables-basic.html">Basic tables</a></li>
                                        <li><a href="tables-advanced.html">Advanced tables</a></li>
                                    </ul>
                                </li>

                                <li><a href="charts.html"><span class="label label-custom pull-right">5</span> <i class="ti-pie-chart"></i> Charts </a></li>

                                <li><a href="maps.html"><i class="ti-location-pin"></i> Maps </a></li>

                                <li>
                                    <a href="javascript: void(0);" aria-expanded="true"><i class="ti-files"></i> Pages <span class="fa arrow"></span></a>
                                    <ul class="nav-second-level nav" aria-expanded="true">
                                        <li><a href="pages-login.html">Login</a></li>
                                        <li><a href="pages-register.html">Register</a></li>
                                        <li><a href="pages-forget-password.html">Forget Password</a></li>
                                        <li><a href="pages-lock-screen.html">Lock-screen</a></li>
                                        <li><a href="pages-blank.html">Blank page</a></li>
                                        <li><a href="pages-404.html">Error 404</a></li>
                                        <li><a href="pages-confirm-mail.html">Confirm Mail</a></li>
                                        <li><a href="pages-session-expired.html">Session Expired</a></li>
                                    </ul>
                                </li>

                                <li>
                                    <a href="javascript: void(0);" aria-expanded="true"><i class="ti-widget"></i> Extra Pages <span class="fa arrow"></span></a>
                                    <ul class="nav-second-level nav" aria-expanded="true">
                                        <li><a href="extras-timeline.html">Timeline</a></li>
                                        <li><a href="extras-invoice.html">Invoice</a></li>
                                        <li><a href="extras-profile.html">Profile</a></li>
                                        <li><a href="extras-calendar.html">Calendar</a></li>
                                        <li><a href="extras-faqs.html">FAQs</a></li>
                                        <li><a href="extras-pricing.html">Pricing</a></li>
                                        <li><a href="extras-contacts.html">Contacts</a></li>
                                    </ul>
                                </li>

                                <li>
                                    <a href="javascript: void(0);" aria-expanded="true"><i class="ti-share"></i> Multi Level <span class="fa arrow"></span></a>
                                    <ul class="nav-second-level nav" aria-expanded="true">
                                        <li><a href="javascript: void(0);">Level 1.1</a></li>
                                        <li><a href="javascript: void(0);" aria-expanded="true">Level 1.2 <span class="fa arrow"></span></a>
                                            <ul class="nav-third-level nav" aria-expanded="true">
                                                <li><a href="javascript: void(0);">Level 2.1</a></li>
                                                <li><a href="javascript: void(0);">Level 2.2</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div><!--Scrollbar wrapper-->
                </aside>
                <!--left navigation end-->

                <!-- START PAGE CONTENT -->
                <div id="page-right-content">

                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="p-20 m-b-20">
                                    <h4 class="header-title m-t-0 m-b-0">Switchery</h4>

                                    <h6>Basic</h6>
                                    <p class="text-muted m-b-20 font-13">
                                        Add an attribute <code>
                                            data-plugin="switchery" data-color="@colors"</code>
                                        to your input element and it will be converted into switch.
                                    </p>

                                    <div class="switchery-demo">
                                        <input type="checkbox" checked data-plugin="switchery" data-color="#039cfd"/>
                                        <input type="checkbox" checked data-plugin="switchery" data-color="#f1b53d"/>
                                        <input type="checkbox" checked data-plugin="switchery" data-color="#1bb99a"/>
                                        <input type="checkbox" checked data-plugin="switchery" data-color="#ff5d48"/>
                                        <input type="checkbox" checked data-plugin="switchery" data-color="#3db9dc"/>
                                        <input type="checkbox" checked data-plugin="switchery" data-color="#2b3d51"/>
                                        <input type="checkbox" checked data-plugin="switchery" data-color="#9261c6"/>
                                        <input type="checkbox" checked data-plugin="switchery" data-color="#ff7aa3"/>
                                        <input type="checkbox" checked data-plugin="switchery" data-color="#98a6ad"/>
                                    </div>


                                    <h6 class="m-t-30">Sizes & Secondary color</h6>
                                    <p class="text-muted m-b-30 font-13">
                                        Add an attribute <code>
                                             data-size="small",data-size="large"</code>
                                        to your input element and it will be converted into switch.
                                        Add an attribute <code>
                                            data-color="@color" data-secondary-color="@color"</code>
                                        to your input element and it will be converted into switch.
                                    </p>

                                    <div class="switchery-demo">
                                        <input type="checkbox" checked data-plugin="switchery" data-color="#64b0f2" data-size="small"/>
                                        <input type="checkbox" checked data-plugin="switchery" data-color="#ff7aa3"/>
                                        <input type="checkbox" checked data-plugin="switchery" data-color="#2b3d51" data-size="large"/>
                                        <input type="checkbox" data-plugin="switchery" data-color="#1bb99a" data-secondary-color="#ff5d48" />
                                        <input type="checkbox" data-plugin="switchery" data-color="#9261c6"  data-secondary-color="#ff7aa3" checked />
                                    </div>


                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="p-20 m-b-20">
                                    <h4 class="header-title m-t-0 m-b-20">Tags Input</h4>

                                    <h6>Input Tags</h6>
                                    <p class="text-muted m-b-20 font-13">
                                        Just add <code>data-role="tagsinput"</code> to your input field to automatically change it to a tags input field.
                                    </p>
                                    <div class="tags-default">
                                        <input type="text" value="Amsterdam,Washington,Sydney" data-role="tagsinput" placeholder="add tags"/>
                                    </div>

                                    <h6 class="m-t-30">True multi value</h6>
                                    <p class="text-muted m-b-20 font-13">
                                          Use a <code>&lt;select multiple /&gt;</code> as your input element for a tags input, to gain true multivalue support.
                                           Instead of a comma separated string, the values will be set in an array. Existing <code>&lt;option /&gt;</code>
                                           elements will automatically be set as tags. This makes it also possible to create tags containing a comma.
                                    </p>
                                    <div class="m-b-0">
                                        <select multiple data-role="tagsinput">
                                            <option value="Amsterdam">Amsterdam</option>
                                            <option value="Washington">Washington</option>
                                            <option value="Sydney">Sydney</option>
                                        </select>
                                    </div>
                                </div>

                            </div>

                        </div><!-- end row -->


                        <div class="row">
                            <div class="col-md-6">

                                <div class="p-20 m-b-20">
                                    <h4 class="header-title m-t-0 m-b-20">Select2</h4>

                                    <h6 class="text-muted">Single Select</h6>
                                    <p class="text-muted m-b-15 font-13">
                                        Select2 can take a regular select box like this...
                                    </p>

                                    <select class="form-control select2">
                                        <option>Select</option>
                                        <optgroup label="Alaskan/Hawaiian Time Zone">
                                            <option value="AK">Alaska</option>
                                            <option value="HI">Hawaii</option>
                                        </optgroup>
                                        <optgroup label="Pacific Time Zone">
                                            <option value="CA">California</option>
                                            <option value="NV">Nevada</option>
                                            <option value="OR">Oregon</option>
                                            <option value="WA">Washington</option>
                                        </optgroup>
                                        <optgroup label="Mountain Time Zone">
                                            <option value="AZ">Arizona</option>
                                            <option value="CO">Colorado</option>
                                            <option value="ID">Idaho</option>
                                            <option value="MT">Montana</option>
                                            <option value="NE">Nebraska</option>
                                            <option value="NM">New Mexico</option>
                                            <option value="ND">North Dakota</option>
                                            <option value="UT">Utah</option>
                                            <option value="WY">Wyoming</option>
                                        </optgroup>
                                        <optgroup label="Central Time Zone">
                                            <option value="AL">Alabama</option>
                                            <option value="AR">Arkansas</option>
                                            <option value="IL">Illinois</option>
                                            <option value="IA">Iowa</option>
                                            <option value="KS">Kansas</option>
                                            <option value="KY">Kentucky</option>
                                            <option value="LA">Louisiana</option>
                                            <option value="MN">Minnesota</option>
                                            <option value="MS">Mississippi</option>
                                            <option value="MO">Missouri</option>
                                            <option value="OK">Oklahoma</option>
                                            <option value="SD">South Dakota</option>
                                            <option value="TX">Texas</option>
                                            <option value="TN">Tennessee</option>
                                            <option value="WI">Wisconsin</option>
                                        </optgroup>
                                        <optgroup label="Eastern Time Zone">
                                            <option value="CT">Connecticut</option>
                                            <option value="DE">Delaware</option>
                                            <option value="FL">Florida</option>
                                            <option value="GA">Georgia</option>
                                            <option value="IN">Indiana</option>
                                            <option value="ME">Maine</option>
                                            <option value="MD">Maryland</option>
                                            <option value="MA">Massachusetts</option>
                                            <option value="MI">Michigan</option>
                                            <option value="NH">New Hampshire</option>
                                            <option value="NJ">New Jersey</option>
                                            <option value="NY">New York</option>
                                            <option value="NC">North Carolina</option>
                                            <option value="OH">Ohio</option>
                                            <option value="PA">Pennsylvania</option>
                                            <option value="RI">Rhode Island</option>
                                            <option value="SC">South Carolina</option>
                                            <option value="VT">Vermont</option>
                                            <option value="VA">Virginia</option>
                                            <option value="WV">West Virginia</option>
                                        </optgroup>
                                    </select>

                                    <h6 class="m-t-30 text-muted">Multiple Select</h6>
                                    <p class="text-muted m-b-15 font-13">
                                        Select2 can take a regular select box like this...
                                    </p>

                                    <select class="select2 form-control" multiple="multiple"
                                            data-placeholder="Choose ...">
                                        <optgroup label="Alaskan/Hawaiian Time Zone">
                                            <option value="AK">Alaska</option>
                                            <option value="HI">Hawaii</option>
                                        </optgroup>
                                        <optgroup label="Pacific Time Zone">
                                            <option value="CA">California</option>
                                            <option value="NV">Nevada</option>
                                            <option value="OR">Oregon</option>
                                            <option value="WA">Washington</option>
                                        </optgroup>
                                        <optgroup label="Mountain Time Zone">
                                            <option value="AZ">Arizona</option>
                                            <option value="CO">Colorado</option>
                                            <option value="ID">Idaho</option>
                                            <option value="MT">Montana</option>
                                            <option value="NE">Nebraska</option>
                                            <option value="NM">New Mexico</option>
                                            <option value="ND">North Dakota</option>
                                            <option value="UT">Utah</option>
                                            <option value="WY">Wyoming</option>
                                        </optgroup>
                                        <optgroup label="Central Time Zone">
                                            <option value="AL">Alabama</option>
                                            <option value="AR">Arkansas</option>
                                            <option value="IL">Illinois</option>
                                            <option value="IA">Iowa</option>
                                            <option value="KS">Kansas</option>
                                            <option value="KY">Kentucky</option>
                                            <option value="LA">Louisiana</option>
                                            <option value="MN">Minnesota</option>
                                            <option value="MS">Mississippi</option>
                                            <option value="MO">Missouri</option>
                                            <option value="OK">Oklahoma</option>
                                            <option value="SD">South Dakota</option>
                                            <option value="TX">Texas</option>
                                            <option value="TN">Tennessee</option>
                                            <option value="WI">Wisconsin</option>
                                        </optgroup>
                                        <optgroup label="Eastern Time Zone">
                                            <option value="CT">Connecticut</option>
                                            <option value="DE">Delaware</option>
                                            <option value="FL">Florida</option>
                                            <option value="GA">Georgia</option>
                                            <option value="IN">Indiana</option>
                                            <option value="ME">Maine</option>
                                            <option value="MD">Maryland</option>
                                            <option value="MA">Massachusetts</option>
                                            <option value="MI">Michigan</option>
                                            <option value="NH">New Hampshire</option>
                                            <option value="NJ">New Jersey</option>
                                            <option value="NY">New York</option>
                                            <option value="NC">North Carolina</option>
                                            <option value="OH">Ohio</option>
                                            <option value="PA">Pennsylvania</option>
                                            <option value="RI">Rhode Island</option>
                                            <option value="SC">South Carolina</option>
                                            <option value="VT">Vermont</option>
                                            <option value="VA">Virginia</option>
                                            <option value="WV">West Virginia</option>
                                        </optgroup>
                                    </select>

                                    <h6 class="m-t-30 text-muted">Disabled results</h6>
                                    <p class="text-muted m-b-15 font-13">
                                        Select2 will correctly handle disabled results, both with data coming from a standard select (when the disabled attribute is set) and from remote sources, where the object has disabled: true set.
                                    </p>

                                    <select class="select2 form-control">
                                        <option value="one">First</option>
                                        <option value="two" disabled="disabled">Second (disabled)</option>
                                        <option value="three">Third</option>
                                    </select>

                                </div>

                            </div>


                            <div class="col-md-6">

                                <div class="p-20 m-b-20">
                                    <h4 class="header-title m-t-0 m-b-20">Bootstrap FileStyle</h4>

                                    <form>
                                        <div class="form-group">
                                            <label class="control-label">Default file input</label>
                                            <input type="file" class="filestyle" data-buttonname="btn-default">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">File style without input</label>
                                            <input type="file" class="filestyle" data-input="false">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Small file style</label>
                                            <input type="file" class="filestyle" data-size="sm">
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Disable file style</label>
                                            <input type="file" class="filestyle" data-disabled="true">
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">File style with custom text</label>
                                            <input type="file" class="filestyle" data-buttontext="Select file" data-buttonname="btn-default">
                                        </div>
                                        <div class="form-group m-b-0">
                                            <label class="control-label">File style with button style</label>
                                            <input type="file" class="filestyle" data-buttonname="btn-primary">
                                        </div>

                                    </form>

                                </div>

                            </div> <!-- end col -->

                        </div>
                        <!-- end row -->


                        <div class="row">

                            <div class="col-lg-6">
                                <div class="p-20 m-b-20">

                                    <h4 class="header-title m-t-0">Form Validation - Basic Form</h4>
                                    <p class="text-muted font-13 m-b-10">
                                        Parsley is a javascript form validation library. It helps you provide your users with feedback on their form submission before sending it to your server.
                                    </p>

                                    <div class="p-20 m-b-20">
                                        <form action="#" class="form-validation">
                                            <div class="form-group">
                                                <label for="userName">User Name<span class="text-danger">*</span></label>
                                                <input type="text" name="nick" parsley-trigger="change" required
                                                       placeholder="Enter user name" class="form-control" id="userName">
                                            </div>
                                            <div class="form-group">
                                                <label for="emailAddress">Email address<span class="text-danger">*</span></label>
                                                <input type="email" name="email" parsley-trigger="change" required
                                                       placeholder="Enter email" class="form-control" id="emailAddress">
                                            </div>
                                            <div class="form-group">
                                                <label for="pass1">Password<span class="text-danger">*</span></label>
                                                <input id="pass1" type="password" placeholder="Password" required
                                                       class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="passWord2">Confirm Password <span class="text-danger">*</span></label>
                                                <input data-parsley-equalto="#pass1" type="password" required
                                                       placeholder="Password" class="form-control" id="passWord2">
                                            </div>
                                            <div class="form-group">
                                                <div class="checkbox">
                                                    <input id="remember-1" type="checkbox">
                                                    <label for="remember-1"> Remember me </label>
                                                </div>
                                            </div>

                                            <div class="form-group text-right m-b-0">
                                                <button class="btn btn-primary waves-effect waves-light" type="submit">
                                                    Submit
                                                </button>
                                                <button type="reset" class="btn btn-default waves-effect m-l-5">
                                                    Cancel
                                                </button>
                                            </div>

                                        </form>
                                    </div>

                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="p-20 m-b-20">
                                    <h4 class="header-title m-t-0">Form Validation -  Horizontal Form</h4>
                                    <p class="text-muted font-13 m-b-10">
                                        Parsley is a javascript form validation library. It helps you provide your users with feedback on their form submission before sending it to your server.
                                    </p>

                                    <div class="p-20 m-b-20">
                                        <form role="form" class="form-validation">
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-4 form-control-label">Email<span class="text-danger">*</span></label>
                                                <div class="col-sm-7">
                                                    <input type="email" required parsley-type="email" class="form-control"
                                                           id="inputEmail3" placeholder="Email">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="hori-pass1" class="col-sm-4 form-control-label">Password<span class="text-danger">*</span></label>
                                                <div class="col-sm-7">
                                                    <input id="hori-pass1" type="password" placeholder="Password" required
                                                           class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="hori-pass2" class="col-sm-4 form-control-label">Confirm Password
                                                    <span class="text-danger">*</span></label>
                                                <div class="col-sm-7">
                                                    <input data-parsley-equalto="#hori-pass1" type="password" required
                                                           placeholder="Password" class="form-control" id="hori-pass2">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="webSite" class="col-sm-4 form-control-label">Web Site<span class="text-danger">*</span></label>
                                                <div class="col-sm-7">
                                                    <input type="url" required parsley-type="url" class="form-control"
                                                           id="webSite" placeholder="URL">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-8 col-sm-offset-4">
                                                    <div class="checkbox">
                                                        <input id="remember-2" type="checkbox">
                                                        <label for="remember-2"> Remember me </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-8 col-sm-offset-4">
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light">
                                                        Register
                                                    </button>
                                                    <button type="reset"
                                                            class="btn btn-default waves-effect m-l-5">
                                                        Cancel
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end row -->



                        <div class="row">
                            <div class="col-md-6">
                                <div class="p-20 m-b-20">
                                    <h4 class="header-title m-t-0">Timepicker</h4>
                                    <p class="text-muted font-13 m-b-25">
                                        Easily select a time for a text input using your mouse or keyboards arrow keys.
                                    </p>

                                    <div class="">
                                        <div class="form-group">
                                            <label>Default Time Picker</label>
                                            <div class="input-group">
                                                <input id="timepicker" type="text" class="form-control">
                                                <span class="input-group-addon"><i class="mdi mdi-clock"></i></span>
                                            </div><!-- input-group -->
                                        </div>

                                        <div class="form-group">
                                            <label>24 Hour Mode Time Picker</label>
                                            <div class="input-group">
                                                <input id="timepicker2" type="text" class="form-control">
                                                <span class="input-group-addon"><i class="mdi mdi-clock"></i></span>
                                            </div><!-- input-group -->
                                        </div>

                                        <div class="form-group m-b-0">
                                            <label>Specify a step for the minute field</label>
                                            <div class="input-group">
                                                <input id="timepicker3" type="text" class="form-control">
                                                <span class="input-group-addon"><i class="mdi mdi-clock"></i></span>
                                            </div><!-- input-group -->
                                        </div>

                                    </div>
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="p-20 m-b-20">
                                    <h4 class="header-title m-t-0">Colorpicker</h4>
                                    <p class="text-muted font-13 m-b-25">
                                        Add color picker to field or to any other element.
                                    </p>

                                    <div class="">
                                        <form action="#">
                                            <div class="form-group">
                                                <label>Default</label>
                                                <input type="text" class="colorpicker-default form-control" value="#8fff00">
                                            </div>
                                            <div class="form-group">
                                                <label>RGBA</label>
                                                <input type="text" class="colorpicker-rgba form-control" value="rgb(0,194,255,0.78)" data-color-format="rgba">
                                            </div>
                                            <div class="form-group m-b-0">
                                                <label>As Component</label>
                                                <div data-color-format="rgb" data-color="rgb(255, 146, 180)" class="colorpicker-default input-group">
                                                    <input type="text" readonly="readonly" value="" class="form-control">
                                                    <span class="input-group-btn add-on">
                                                        <button class="btn btn-white" type="button">
                                                            <i style="background-color: rgb(124, 66, 84);margin-top: 2px;"></i>
                                                        </button>
                                                    </span>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="p-20 m-b-20">
                                    <h4 class="header-title m-t-0">Date Picker</h4>
                                    <p class="text-muted font-13 m-b-25">
                                        The datepicker is tied to a standard form input field. Click on the input to open
                                        an interactive calendar in a small overlay. Click elsewhere on the page or hit the Esc
                                        key to close. If a date is chosen, feedback is shown as the input's value.
                                    </p>

                                    <div class="row">
                                        <div class="col-lg-8">

                                            <div class="">
                                                <form action="#">
                                                    <div class="form-group">
                                                        <label>Default Functionality</label>
                                                        <div>
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" placeholder="mm/dd/yyyy" id="datepicker">
                                                                <span class="input-group-addon bg-custom b-0"><i class="mdi mdi-calendar text-white"></i></span>
                                                            </div><!-- input-group -->
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Auto Close</label>
                                                        <div>
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" placeholder="mm/dd/yyyy" id="datepicker-autoclose">
                                                                <span class="input-group-addon bg-custom b-0"><i class="mdi mdi-calendar text-white"></i></span>
                                                            </div><!-- input-group -->
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Multiple Date</label>
                                                        <div>
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" placeholder="mm/dd/yyyy" id="datepicker-multiple-date">
                                                                <span class="input-group-addon bg-custom b-0"><i class="mdi mdi-calendar text-white"></i></span>
                                                            </div><!-- input-group -->
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Date Range</label>
                                                        <div>
                                                            <div class="input-daterange input-group" id="date-range">
                                                                <input type="text" class="form-control" name="start" />
                                                                <span class="input-group-addon b-0">to</span>
                                                                <input type="text" class="form-control" name="end" />
                                                            </div>
                                                        </div>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">

                                            <div class="p-20 m-b-20 text-center">

                                                <label>Display Inline</label>
                                                <div class="input-group" style="margin: 10px auto">
                                                    <div id="datepicker-inline"></div>
                                                </div><!-- input-group -->

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <!-- end row -->


                        <div class="row">

                            <div class="col-md-6">
                                <div class="p-20 m-b-20">
                                    <h4 class="header-title m-t-0">Date Range Picker</h4>
                                    <p class="text-muted font-13 m-b-25">
                                        A JavaScript component for choosing date ranges.
                                        Designed to work with the Bootstrap CSS framework.
                                    </p>

                                    <div class="">
                                        <form>
                                            <div class="form-group">
                                                <label>With all options</label>
                                                <div id="reportrange" class="pull-right form-control">
                                                    <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                                                    <span></span>
                                                </div>
                                            </div>
                                            <div class="form-group m-t-50">
                                                <label>Date Range Pick</label>
                                                <div>
                                                    <input class="form-control input-daterange-datepicker" type="text" name="daterange" value="01/01/2015 - 01/31/2015"/>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Date Range With Time</label>
                                                <div>
                                                    <input type="text" class="form-control input-daterange-timepicker" name="daterange" value="01/01/2015 1:30 PM - 01/01/2015 2:00 PM"/>
                                                </div>
                                            </div>
                                            <div class="form-group m-b-0">
                                                <label>Limit Selectable Dates</label>
                                                <div>
                                                    <input class="form-control input-limit-datepicker" type="text" name="daterange" value="06/01/2015 - 06/07/2015"/>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="p-20 m-b-20">
                                    <h4 class="header-title m-t-0">Clock Picker</h4>
                                    <p class="text-muted font-13 m-b-25">
                                        A clock-style timepicker for Bootstrap (or jQuery).Your awesome text goes here.
                                    </p>

                                    <label>Default Clock Picker</label>
                                    <div class="input-group clockpicker m-b-20">
                                        <input type="text" class="form-control" value="09:30">
                                        <span class="input-group-addon"> <span class="mdi mdi-clock"></span> </span>
                                    </div>

                                    <label>Auto close</label>
                                    <div class="input-group clockpicker m-b-20" data-placement="top" data-align="top" data-autoclose="true">
                                        <input type="text" class="form-control" value="13:14">
                                        <span class="input-group-addon"> <span class="mdi mdi-clock"></span> </span>
                                    </div>

                                    <label>Now time</label>
                                    <div class="input-group m-b-20">
                                        <input class="form-control" id="single-input" value="" placeholder="Now">
                                        <span class="input-group-btn">
                                            <button type="button" id="check-minutes" class="btn waves-effect waves-light btn-primary">Check the minutes</button>
                                        </span>
                                    </div>

                                    <label>Place at left, align the arrow to top </label>
                                    <div class="input-group clockpicker" data-placement="top" data-align="top">
                                        <input type="text" class="form-control" value="13:14">
                                        <span class="input-group-addon"> <span class="mdi mdi-clock"></span> </span>
                                    </div>
                                </div> <!-- demo-box -->

                            </div> <!-- end col -->

                        </div>
                        <!-- end row -->


                        <div class="row">
							<div class="col-sm-12">
								<div class="p-20 m-b-20">
									<h4 class="m-b-30 m-t-0 header-title">Summernote Editor</h4>
									<div class="summernote">
										<h4>Hello Summer note</h4>
                                        <ul>
                                            <li>
                                                Select a text to reveal the toolbar.
                                            </li>
                                            <li>
                                                Edit rich document on-the-fly, so elastic!
                                            </li>
                                        </ul>
									</div>
								</div>
							</div>
						</div>
                        <!-- end row -->


                    </div>
                    <!-- end container -->

                    <div class="footer">
                        <div class="pull-right hidden-xs">
                            Project Completed <strong class="text-custom">39%</strong>.
                        </div>
                        <div>
                            <strong>Simple Admin</strong> - Copyright &copy; 2017
                        </div>
                    </div> <!-- end footer -->

                </div>
                <!-- End #page-right-content -->

            </div>
            <!-- end .page-contentbar -->
        </div>
        <!-- End #page-wrapper -->



        <!-- js placed at the end of the document so the pages load faster -->
        <script src="assets/js/jquery-2.1.4.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/metisMenu.min.js"></script>
        <script src="assets/js/jquery.slimscroll.min.js"></script>

        <script src="assets/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.min.js"></script>
        <script src="assets/plugins/select2/js/select2.min.js" type="text/javascript"></script>
        <script src="assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js" type="text/javascript"></script>
        <script src="assets/plugins/switchery/switchery.min.js"></script>
        <script type="text/javascript" src="assets/plugins/parsleyjs/parsley.min.js"></script>

        <script src="assets/plugins/moment/moment.js"></script>
     	<script src="assets/plugins/timepicker/bootstrap-timepicker.js"></script>
     	<script src="assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
     	<script src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
     	<script src="assets/plugins/clockpicker/js/bootstrap-clockpicker.min.js"></script>
     	<script src="assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
        <script src="assets/plugins/summernote/summernote.min.js"></script>

        <!-- form advanced init js -->
        <script src="assets/pages/jquery.form-advanced.init.js"></script>

        <!-- App Js -->
        <script src="assets/js/jquery.app.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                $('.form-validation').parsley();
                $('.summernote').summernote({
                    height: 350,                 // set editor height
                    minHeight: null,             // set minimum height of editor
                    maxHeight: null,             // set maximum height of editor
                    focus: false                 // set focus to editable area after initializing summernote
                });
            });
        </script>

    </body>
</html>