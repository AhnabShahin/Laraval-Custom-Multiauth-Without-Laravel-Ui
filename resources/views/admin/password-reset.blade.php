
<!DOCTYPE html>
<html>
<head>
<title>Admin Password Reset</title>
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
		<h1>Admin Password Reset</h1>
		<div class="main-agileinfo">
			<div class="agileits-top">
				<form action="{{ route('admin.reset',$slug)}}" method="post">

				
				
                @isset($wrongpassword)
				{{ $wrongpassword }}
				@endisset
				
					@csrf

					<input class="text" type="password" name="password" placeholder="New Password" required="">
					<span>@error('password'){{$message}}@enderror</span>
                    
					<input class="text" type="password" name="confirmPassword" placeholder="Confirm New Password" required="">
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