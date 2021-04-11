
<!DOCTYPE html>
<html>
<head>
<title>User Login</title>
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
		<h1>User Login</h1>
		<div class="main-agileinfo">
			<div class="agileits-top">
				<form action="{{ route('user.check')}}" method="Post">
				@if(Session::get('IncorrctPassword'))
				{{Session::get('IncorrctPassword')}}
				@endif
				@if(Session::get('success'))
				{{Session::get('success')}}
				@endif
				@if(Session::get('EmailNotRecognize'))
				{{Session::get('EmailNotRecognize')}}
				@endif
				@if(Session::get('MustLogin'))
				{{Session::get('MustLogin')}}
				@endif
				@if(session('invalidlink'))
				{{session('invalidlink')}}
				@endif
				@if(Session::get('invalidlink'))
				{{Session::get('invalidlink')}}
				@endif
				
				
				
					@csrf
					<input class="text email" type="email" name="email" placeholder="Email" required="">
					<span>@error('email'){{$message}}@enderror</span>
					<input class="text" type="password" name="password" placeholder="Password" required="">
					<span>@error('password'){{$message}}@enderror</span>

					<div class="wthree-text">
						<label class="anim">
							<input type="checkbox" class="checkbox" >
							<span>Remember Password</span>
						</label>
						<div class="clear"> </div>
					</div>
					<input type="submit" value="User-Login">
				</form>
				<p>Don't have an Account? <a href="{{ route('user.registration')}}"> Registration Now!</a></p>
				<p>Fogot Password ?<a href="{{ route('user.reset_request_get')}}"> Reset Now!</a></p>
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