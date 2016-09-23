<!DOCTYPE html>

<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.1.1
Version: 2.0.2
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8"/>
        <title>@yield('page_title')</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
        <meta content="" name="description"/>
        <meta content="" name="author"/>
        {{ csrf_field() }}
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <!--<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>-->
        <link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/plugins/uniform/css/uniform.default.css') }}" rel="stylesheet">
        
        <!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="{{ asset('assets/plugins/select2/select2.css') }}" rel="stylesheet">
<link href="{{ asset('assets/plugins/select2/select2-metronic.css') }}" rel="stylesheet">
<link href="{{ asset('assets/plugins/data-tables/DT_bootstrap.css') }}" rel="stylesheet">
<link href="{{ asset('assets/plugins/bootstrap-datepicker/css/datepicker.css') }}" rel="stylesheet">
<!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME STYLES -->
        <link href="{{ asset('assets/css/style-metronic.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/style-responsive.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/plugins.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/themes/blue.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
        <!-- END THEME STYLES -->
        <link rel="shortcut icon" href="{{ asset('assets/img') }}/favicon.ico"/>
    </head>
    <!-- END HEAD -->
    <!-- BEGIN BODY -->
    <body class="page-header-fixed page-sidebar-fixed" oncontextmenu="return false">
        <!-- BEGIN HEADER -->
        <div class="header navbar navbar-fixed-top">
            <!-- BEGIN TOP NAVIGATION BAR -->
            <div class="header-inner">
                <!-- BEGIN LOGO -->
                <a class="navbar-brand" href="">
                    <!--<img src="assets/img/logo.png" alt="Wingu Client 1.0" class="img-responsive"/>-->
                    <img src="{{ asset('assets/img/Wingu.jpg') }}"/>
                </a>
                <!-- END LOGO -->
                <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                <a href="javascript:;" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <!--<img src="assets/img/menu-toggler.png" alt=""/>-->
                    <img src="{{ asset('assets/img/menu-toggler.png') }}"/>
                </a>
                <!-- END RESPONSIVE MENU TOGGLER -->
                <!-- BEGIN TOP NAVIGATION MENU -->
                <ul class="nav navbar-nav pull-right">
                    <!-- BEGIN NOTIFICATION DROPDOWN -->
                    <li class="dropdown" id="header_notification_bar">
                        
                        
                    <!-- END TODO DROPDOWN -->
                    <!-- BEGIN USER LOGIN DROPDOWN -->
                    <li class="dropdown user">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <!--<img alt="" src="assets/img/avatar1_small.jpg"/>-->
                            <img src="{{ asset('assets/img/avatar_sm.png') }}"/>
                            <span class="username">
                                {{ auth()->user()->username }}
                                
                               <!-- Bob Nilson-->
                            </span>
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="">
                                    <i class="fa fa-user"></i> My Profile
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <i class="fa fa-calendar"></i> My Calendar
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <i class="fa fa-envelope"></i> My Inbox
                                    <span class="badge badge-danger">
                                        3
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-tasks"></i> My Tasks
                                    <span class="badge badge-success">
                                        7
                                    </span>
                                </a>
                            </li>
                            <li class="divider">
                            </li>
                            <li>
                                <a href="javascript:;" id="trigger_fullscreen">
                                    <i class="fa fa-arrows"></i> Full Screen
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <i class="fa fa-lock"></i> Lock Screen
                                </a>
                            </li>
                            <li>
                                <a href="{{ URL::to('logout') }}">
                                    <i class="fa fa-key"></i> Log Out
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- END USER LOGIN DROPDOWN -->
                </ul>
                <!-- END TOP NAVIGATION MENU -->
            </div>
            <!-- END TOP NAVIGATION BAR -->
        </div>
        <!-- END HEADER -->
        <div class="clearfix">
        </div>
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN SIDEBAR -->
            <div class="page-sidebar-wrapper">
                <div class="page-sidebar navbar-collapse collapse navbar-fixed-top ">
                    <!-- add "navbar-no-scroll" class to disable the scrolling of the sidebar menu -->
                    <!-- BEGIN SIDEBAR MENU -->
                    <ul class="page-sidebar-menu" data-auto-scroll="true" data-slide-speed="200">
                        <li class="sidebar-toggler-wrapper">
                            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                            <div class="sidebar-toggler hidden-phone">
                            </div>
                            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                        </li>

                        <li class="start active ">
                            <a href="{{ URL::to('accounts') }}">
                                <i class="fa fa-home"></i>
                                <span class="title">
                                    Dashboard
                                </span>
                                <span class="selected">
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:;">
                                <i class="fa fa-cogs"></i>
                                <span class="title">
                                    System Setup
                                </span>
                                <span class="arrow ">
                                </span>
                            </a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="{{ URL::to('core/setup/classes') }}">
                                        <i class="fa fa-eject"></i>
                                        Register Classes
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ URL::to('core/setup/subjects') }}">
                                        <i class="fa fa-book"></i>
                                        Register Subjects
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ URL::to('core/setup/streams') }}">
                                        <i class="fa fa-sitemap"></i>
                                        Register Streams
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ URL::to('core/setup/exams') }}">
                                        <i class="fa fa-tasks"></i>
                                        Register Exam Types
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ URL::to('core/setup/dorms') }}">
                                        <i class="fa fa-toggle-up"></i>
                                        Register Dormitories
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ URL::to('core/setup/banks') }}">
                                        <i class="fa fa-toggle-up"></i>
                                        Register Bank
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:;">
                                <i class="fa fa-users"></i>
                                <span class="title">
                                    System Users
                                </span>
                                <span class="arrow ">
                                </span>
                            </a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="{{ URL::to('core/accounts/users') }}">
                                        <i class="fa fa-user"></i>
                                        View Users
                                    </a>
                                </li>
                            </ul>
                        </li>
                        
                        <li>
                            <a href="javascript:;">
                                <i class="fa fa-envelope-o"></i>
                                <span class="title">
                                    SMS Module
                                </span>
                                <span class="arrow ">
                                </span>
                            </a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="{{ URL::to('sms/sendmessage') }}" oncontextmenu="return false">
                                        <i class="fa fa-bullhorn"></i>
                                        Send Single Message
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ URL::to('sms/sendresult') }}">
                                        <i class="fa fa-shopping-cart"></i>
                                        Send Student's Results
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ URL::to('sms/bulkresults') }}">
                                        <i class="fa fa-shopping-cart"></i>
                                        Send Class Results
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ URL::to('sms/class/custom') }}">
                                        <i class="fa fa-shopping-cart"></i>
                                        Custom Class SMS
                                    </a>
                                </li>
                                
                            </ul>
                        </li>

                    </ul>
                    <!-- END SIDEBAR MENU -->
                </div>
            </div>
            <!-- END SIDEBAR -->
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
                    <div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h4 class="modal-title">Modal title</h4>
                                </div>
                                <div class="modal-body">
                                    Widget settings form goes here
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn blue">Save changes</button>
                                    <button type="button" class="btn default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->
                    <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
                    <!-- BEGIN STYLE CUSTOMIZER -->
                    <div class="theme-panel hidden-xs hidden-sm">
                        <div class="toggler">
                        </div>
                        <div class="toggler-close">
                        </div>
                        <div class="theme-options">
                            
                            <div class="theme-option">
                                <span>
                                    Layout
                                </span>
                                <select class="layout-option form-control input-small">
                                    <option value="fluid" selected="selected">Fluid</option>
                                    <option value="boxed">Boxed</option>
                                </select>
                            </div>
                            <div class="theme-option">
                                <span>
                                    Header
                                </span>
                                <select class="header-option form-control input-small">
                                    <option value="fixed" selected="selected">Fixed</option>
                                    <option value="default">Default</option>
                                </select>
                            </div>
                            <div class="theme-option">
                                <span>
                                    Sidebar
                                </span>
                                <select class="sidebar-option form-control input-small">
                                    <option value="fixed" selected="selected">Fixed</option>
                                    <option value="default">Default</option>
                                </select>
                            </div>
                            <div class="theme-option">
                                <span>
                                    Sidebar Position
                                </span>
                                <select class="sidebar-pos-option form-control input-small">
                                    <option value="left" selected="selected">Left</option>
                                    <option value="right">Right</option>
                                </select>
                            </div>
                            <div class="theme-option">
                                <span>
                                    Footer
                                </span>
                                <select class="footer-option form-control input-small">
                                    <option value="fixed">Fixed</option>
                                    <option value="default" selected="selected">Default</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- END STYLE CUSTOMIZER -->
                    <!-- BEGIN PAGE HEADER-->
                    
                    <!-- END PAGE HEADER-->
 
                    
<!---------------------------------------PAGE CONTENT IS TO BE RENDERED HERE----------------------------------------->
@yield('page_content')


<!----------------------------------------AND THE FOOTER GOES HERE-------------------------------------------------->
</div>
            </div>
            <!-- END CONTENT -->
        </div>
        <!-- END CONTAINER -->
        <!-- BEGIN FOOTER -->
        <div class="footer">
            <div class="footer-inner">
                {{ date('Y') }} &COPY; Wingu Client 1.0
            </div>
            <div class="footer-tools">
                <span class="go-top">
                    <i class="fa fa-angle-up"></i>
                </span>
            </div>
        </div>
        <!-- END FOOTER -->
        <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
        <!-- BEGIN CORE PLUGINS -->
        <!--[if lt IE 9]>
        <script src="assets/plugins/respond.min.js"></script>
        <script src="assets/plugins/excanvas.min.js"></script> 
        <![endif]-->
        -->
        <script src="{{ asset('assets/plugins/jquery-1.10.2.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/jquery-migrate-1.2.1.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/jquery.blockui.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/jquery.cokie.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/uniform/jquery.uniform.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
        <!-- END CORE PLUGINS -->
        
        <script src="{{ asset('assets/scripts/core/app.js') }}"></script>
        <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/data-tables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/data-tables/DT_bootstrap.js') }}"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        
        <!--<script src="assets/scripts/custom/table-advanced.js"></script>-->
        <script src="{{ asset('assets/scripts/custom/table-advanced.js') }}"></script>
        <script src="{{ asset('assets/scripts/custom/components-pickers.js') }}"></script>
        <script>
            jQuery(document).ready(function() {
                // initiate layout and plugins
                App.init();
                TableAdvanced.init();
                ComponentsPickers.init();
                //ComponentsDropdowns.init();
            });
        </script>
        
        <script>
        $('#class').change(function(){
                var class_id = $('#class').val();
                $.ajax(
                {
                        type:"GET",
                        url: "classes/selected",
                        data: {'class_id': class_id, '_token': $('input[name=_token]').val()},
                        cache: false,
                        success: function(data) {
                                $('#admno').empty();
                                $.each(data, function(){
                                    $('#admno').append("<option value='"+this.admno+"'>" + this.surname + ", " + this.fname + " " + this.lname + "</option>");
                                });
                        }
                });
        });
        </script>
        <script>
            $(document).ready(function(){
                $('#examscheck').click(function(){
                var term = $('#term').val();
                var exam = $('#exam').val();
                var token = $('#examform > input[name="_token"]').val();
                var adm = 721;
                $.ajax(
                        {
                            type: "GET",
                            url: "{{ url('students/profile/examhistory') }}",
                            data: {'term': term, 'exam': exam, 'admnum': adm, '_token': $('input[name=_token]').val()},                             
                            cache: false,
                            success: function(data){
                                $('#examresults').empty(); 
                                alert(data);
                            }
                        }
                        );
            });
            });
            
            
        </script>
        <script>
            $(document).ready(function(){
               $('#addclass').click(function(){
                var classname = $('#classname').val();
                $.ajax(
                        {
                            type: "POST",
                            url: "{{ url('core/setup/classes') }}",
                            data: {'classname': classname, '_token': $('input[name=_token]').val()},
                            cache: false,
                            success: function(data){
                                $('#response').empty();
                                $('#response').append("<tr><th>Class ID</th><th>Class Name</th><th>Action</th></tr>");
                                $.each(data, function(){
                                        $('#response').append("<tr><td>"+this.id+"</td><td>" + this.name + "</td><td><a href='classes/delete/" + this.id+"'' onclick='return showalert()'><span  class='label label-danger label-sm'>Delete</span></a></td></tr>");
                                    });
                                }
                        });
                    }); 
            
        });
            
        </script>
        <script>
            $(document).ready(function(){
               $('#addsubject').click(function(){
                var subjectcode = $('#subjectcode').val();
                var subjectname = $('#subjectname').val();
                $.ajax(
                        {
                            type: "POST",
                            url: "{{ url('core/setup/subjects') }}",
                            data: {'subjectcode': subjectcode, 'subjectname': subjectname, '_token': $('input[name=_token]').val()},
                            cache: false,
                            success: function(data){
                                $('#response').empty();
                                $('#response').append("<tr><th>Subject Code</th><th>Subject Name</th><th>Action</th></tr>");
                                $.each(data, function(){
                                        $('#response').append("<tr><td>"+this.code+"</td><td>" + this.name + "</td><td><a href='subjects/delete/" + this.id+"'><span  class='label label-danger label-sm'>Delete</span></a></td></tr>");
                                    });
                                }
                        });
                    }); 
            
        });
            
        </script>
        <script>
            $(document).ready(function(){
               $('#addstream').click(function(){
                var streamname = $('#streamname').val();
                $.ajax(
                        {
                            type: "POST",
                            url: "streams",
                            data: {'streamname': streamname, '_token': $('input[name=_token]').val()},
                            cache: false,
                            success: function(data){
                                $('#streamname').attr('value', '');
                                $('#streamstable').empty();
                                $('#streamstable').append("<tr><th>Stream ID</th><th>Stream Name</th><th>Action</th></tr>");
                                $.each(data, function(){
                                        $('#streamstable').append("<tr><td>"+this.id+"</td><td>" + this.name + "</td><td><a href='delete/" + this.id+"'><span  class='label label-danger label-sm'>Delete</span></a></td></tr>");
                                    });
                                }
                        });
                    }); 
            
        });
            
        </script>
        <script>
            $(document).ready(function(){
               $('#addexam').click(function(){
                var examname = $('#examname').val();
                var outof = $('#outof').val();
                $.ajax(
                        {
                            type: "POST",
                            url: "{{ url('core/setup/exams') }}",
                            data: {'examname': examname, 'outof': outof, '_token': $('input[name=_token]').val()},
                            cache: false,
                            success: function(data){
                                $('#examname').attr('value', '');
                                $('#outof').attr('value', '');
                                $('#response').empty();
                                $('#response').append("<tr><th>Exam Id</th><th>Exam Name</th><th>Out of</th><th>Action</th></tr>");
                                $.each(data, function(){
                                        $('#response').append("<tr><td>"+this.id+"</td><td>" + this.name + "</td><td>" + this.outof + "</td><td><a href='exams/delete/" + this.id+"'><span  class='label label-danger label-sm'>Delete</span></a></td></tr>");
                                    });
                                }
                        });
                    }); 
            
        });
            
        </script>
        <script>
            $(document).ready(function(){
               $('#adddorm').click(function(){
                var dormname = $('#dormitory').val();
                var capacity = $('#capacity').val();
                var sex = $('#sex').val();
                $.ajax(
                        {
                            type: "POST",
                            url: "{{ url('core/setup/dorms') }}",
                            data: {'dormname': dormname, 'capacity': capacity, 'sex': sex, '_token': $('input[name=_token]').val()},
                            cache: false,
                            success: function(data){
                                $('#dormitory').attr('value', '');
                                $('#sex').attr('value', '');
                                $('#capacity').attr('value', '');
                                $('#response').empty();
                                $('#response').append("<tr><th>Dorm Name</th><th>Sex</th><th>Capacity</th><th>Action</th></tr>");
                                $.each(data, function(){
                                        $('#response').append("<tr><td>"+this.name+"</td><td>" + this.sex + "</td><td>" + this.capacity + "</td><td><a href='dorm/delete/" + this.id+"'><span  class='label label-danger label-sm'>Delete</span></a></td></tr>");
                                    });
                                }
                        });
                    }); 
            
        });
            
        </script>
        <script>
            $(document).ready(function(){
                $('#fromclass').change(function (){
                    var classs = $('#fromclass').val();
                    $.ajax(
                            {
                                type: "GET",
                                url: "{{ url('students/class/students') }}",
                                data: {'classs': classs, '_token': $('input[name=_token]').val()},
                                cache: false,
                                success: function(data){
                                    $('#classstudents').append("<tr><th>Student Name</th><th>Student Adm</th><th>Action</th></tr>");
                                    $.each(data, function(){
                                            $('#classstudents').append("<tr><td>"+this.surname + "," + this.fname + " " + this.lname + "</td><td>" + this.admno + "</td><td><a href='students/class/next/" + this.id+"'><span  class='label label-danger label-sm'>Next Class</span></a></td></tr>");
                                        });
                                }
                            });

                });    
        
            });
        </script>
        <script>
        $(document).ready(function(){
            $('#pushtoclass').click(function (){
                var former = $('#fromclass').val();
                $.ajax({
                    type: "POST",
                    url: "{{ url('students/class/nextclass') }}",
                    data: {'former': former, '_token': $('input[name=_token]').val()},
                    cache: false,
                    success: function (data){
                        alert(data);
                    }
                });
            });
        });    
        </script>
        <script>
            $(document).ready(function(){
                $('#gender').change(function(){
                    var thegender = $('#gender').val();
                    //var thegender = $('select[name = sex]:selected').val();
                    
                    $.ajax({
                        type: "GET",
                        url: "{{ url('core/search/dorm/gender') }}",
                        data: {'thegender': thegender, '_token': $('input[name=_token]').val()},
                        cache: false,
                        success: function(data){
                            $('#dormitoryname').empty();
                            $('#dormitoryname').append("<option></option>");
                            $.each(data, function(){
                                $('#dormitoryname').append("<option value='" + this.id + "'>" + this.name + "</option>");
                            });
                        }
                    });
                });
            });
        </script>    
        <script>
            $(document).ready(function(){
               $('#addnewuser').click(function(){
                var newuser = $('#newuser').val();
                var email = $('#email').val();
                var userrole = $('#userrole').val();
                var userstatus = $('#userstatus').val();
                $.ajax(
                        {
                            type: "POST",
                            url: "{{ url('core/accounts/users') }}",
                            data: {'newuser': newuser, 'email': email, 'userrole': userrole, 'userstatus': userstatus, '_token': $('input[name=_token]').val()},
                            cache: false,
                            success: function(data){
                                $('#userstable').empty();
                                $('#newuser').attr('value', '');
                                $('#email').attr('value', '');
                                $('#userrole').attr('value', '');
                                $('#userstatus').attr('value', '');
                                $('#userstable').append("<tr><th>User ID</th><th>User Name</th><th>Email</th><th>Status</th><th>Action</th></tr>");
                                $.each(data, function(){
                                    if(this.status === 'Active'){
                                        $('#userstable').append("<tr><td>"+this.id+"</td><td>" + this.username + "</td><td>" + this.email + "</td><td>" + this.status + "</td><td><span class='btn btn-warning btn-xs'>Suspend</span><a href='"+"{{ url('accounts/users/delete/" + this.id+"')}}' onclick='return showalert()'><span  class='btn btn-danger btn-xs'>Delete</span></a></td></tr>");
                                    } else{
                                        $('#userstable').append("<tr><td>"+this.id+"</td><td>" + this.username + "</td><td>" + this.email + "</td><td>" + this.status + "</td><td><span class='btn btn-success btn-xs'>Activate</span><a href='"+"{{ url('accounts/users/delete/" + this.id+"')}}' onclick='return showalert()'><span  class='btn btn-danger btn-xs'>Delete</span></a></td></tr>");
                                    }                                        
                                    });
                                }
                        });
                    }); 
            
            });
            
        </script>
        
        <script>
            $(document).ready(function(){
               $('#addbank').click(function(){
                var bankname = $('#bankname').val();
                var accno = $('#accno').val();
                var branch = $('#branch').val();
                $.ajax(
                        {
                            type: "POST",
                            url: "{{ url('core/setup/banks') }}",
                            data: {'bankname': bankname, 'accno': accno, 'branch': branch, '_token': $('input[name=_token]').val()},
                            cache: false,
                            success: function(data){
                                $('#response').empty();
                                $('#bankname').attr('value', '');
                                $('#accno').attr('value', '');
                                $('#branch').attr('value', '');
                                $('#response').append("<tr><th>Bank ID</th><th>Bank Name</th><th>Account No</th><th>Branch</th><th>Action</th></tr>");
                                $.each(data, function(){
                                        $('#response').append("<tr><td>"+this.id+"</td><td>" + this.name + "</td><td>" + this.accno + "</td><td>" + this.branch + "</td><td><a href='"+"{{ url('core/setup/banks/delete/" + this.id+"')}}' onclick='return showalert()'><span  class='label label-danger label-sm'>Delete</span></a></td></tr>");
                                    });
                                }
                        });
                    }); 
            
        });
            
        </script>
        
        <script>
        $(document).ready(function(){
            $('#response').find('tr').click(function(){
                var userid = $(this).find('td:first').text();
                $.ajax(
                        {
                            type: "POST",
                            url: "{{ url('core/accounts/users/togglestatus') }}",
                            data: {'userid': userid, '_token': $('input[name=_token]').val()},
                            cache: false,
                            success: function(){
                                window.location = "{{ url('core/accounts/users') }}";
                                alert('Done.');
                            }
                        }
                        );
            });
        });
        </script>
        <!-- END JAVASCRIPTS -->
    </body>
    <!-- END BODY -->
</html>