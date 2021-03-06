<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard</title>

    <!-- Bootstrap Core CSS -->
    {{HTML::style('packages/bootstrap/css/bootstrap.min.css')}}

    <!-- Custom CSS -->
    {{HTML::style('packages/sbadmin2/css/sb-admin-2.css')}}

    <!-- MetisMenu CSS -->
    {{HTML::style('packages/metismenu/metismenu.min.css')}}

    <!-- Custom Fonts -->
    {{HTML::style('packages/font-awesome/css/font-awesome.min.css')}}

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style type="text/css">
    div.global-message
    {
        position: absolute;
        top:10px;
        width: 60%;
        margin-left: 20%;
        z-index: 9999;
        display: none;
    }
    </style>

</head>

<body>
    <!-- Alert, Success, Error, Info Messages -->
    @if(!is_null(Session::get('msg')))
        <div class="alert alert-{{Session::get('msg-type')}} global-message" data-timeout={{Session::get('msg-timeout')}}>
            {{Session::get('msg')}}
        </div>
    @endif
    <!-- .End Messages -->
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Dashboard</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
            <li>
                {{Auth::user()->username}}
            </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="{{url('users/logout')}}"><i class="fa fa-sign-out"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="{{route('admin')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="{{route('users.list')}}"><i class="fa fa-users"></i> Manage Users</a>
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-ticket"></i> Roles & Permissions<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{route('roles.list')}}">Roles</a>
                                </li>
                                <li>
                                    <a href="{{route('permissions.list')}}">Permissions</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    @section('content_header')
                        @if(Session::get('success'))
                            <div class="alert alert-success">
                                {{Session::get('success')}}
                            </div>
                        @endif
                        @if(Session::get('errors'))
                            @foreach(Session::get('errors')->all() as $error)
                                <div class="alert alert-danger">
                                    {{$error}}
                                </div>
                            @endforeach
                        @endif
                    @show
                    @yield('content')
                </div>
            </div>

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    {{HTML::script('packages/jquery/jquery.min.js')}}

    <!-- Bootstrap Core JavaScript -->
    {{HTML::script('packages/bootstrap/js/bootstrap.min.js')}}

    <!-- Metis Menu Plugin JavaScript -->
    {{HTML::script('packages/metismenu/metismenu.min.js')}}
    <!-- Custom Theme JavaScript -->
    {{HTML::script('packages/sbadmin2/js/sb-admin-2.js')}}

    <script type="text/javascript">
    $(function()
    {
        // Global Message Box
        $('.global-message').fadeIn('fast')
        .click(function()
        {
            $(this).fadeOut();
        })

        function hideMessage()
        {
            $('.global-message[data-timeout="1"]').fadeOut('fast');
        }
        setTimeout(hideMessage, 3000);
    })
    </script>

</body>

</html>
