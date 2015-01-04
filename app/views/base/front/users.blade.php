<!-- This is the base for sign up form, login form, forgot password and reset password -->
<!-- You can make your own base layout for those form and extends each form layout to your custom base layout -->

<!DOCTYPE html>
<html>
<head>
    @section('head')
	<title>My Site</title>
    @show
	<!-- Bootstrap Core CSS -->
    {{HTML::style('packages/bootstrap/css/bootstrap.min.css')}}

    <!-- Custom Fonts -->
    {{HTML::style('packages/font-awesome/css/font-awesome.min.css')}}

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
    body{
        background: #eee;
    }
    </style>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-lg-3"></div>
        <div class="col-lg-6" style="margin:0 auto;position:relative">
            <div style="border:1px #ddd solid;margin-top:20px;padding:10px;background:#fff;">
               @yield('user_form') 
            </div>
        </div>
        <div class="col-lg-3"></div>
    </div>
</div>





    <!-- jQuery -->
    {{HTML::script('packages/jquery/jquery.min.js')}}

    <!-- Bootstrap Core JavaScript -->
    {{HTML::script('packages/bootstrap/js/bootstrap.min.js')}}

</body>
</html>