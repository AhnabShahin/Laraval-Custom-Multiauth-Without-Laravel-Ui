
<!DOCTYPE html>
<html>
<head>
<title>Admin Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Custom Theme files -->
<link href="{{ asset('css/login-registration/style.css')}}" rel="stylesheet" type="text/css" media="all" />
<!-- //Custom Theme files -->
<!-- web font -->
<link href="//fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,700,700i" rel="stylesheet">
<!-- //web font -->
</head>
<body>
	<!-- main -->
	<div class="main-w3layouts wrapper">
		<h1>Forgot Password For Admin Login</h1>
		<div class="main-agileinfo">
			<div class="agileits-top">

				<form action="{{ route('admin.reset_request_post')}}" method="post">

				<p>Enter your email address</p>
				@if(Session::get('EmailNotRecognize'))
				{{Session::get('EmailNotRecognize')}}
				@endif
                @if(Session::get('link-send'))
				{{Session::get('link-send')}}
				@endif
                
				
					@csrf
					<input class="text email" type="email" name="email" placeholder="Email" required="">
					<span>@error('email'){{$message}}@enderror</span>

					<input type="submit" value="Send Reset Link">
				</form>

			</div>
		</div>

		<ul class="colorlib-bubbles">
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
		</ul>
	</div>
	<!-- //main -->
</body>
</html>