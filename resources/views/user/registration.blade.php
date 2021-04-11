
<!DOCTYPE html>
<html>

<head>
	<title>User Registration</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script type="application/x-javascript">
		addEventListener("load", function() {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
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
		<h1>User Registration</h1>
		<div class="main-agileinfo">
			<div class="agileits-top">

				@if(Session::get('fails'))
				{{Session::get('fails')}}
				@endif
				@isset($wrongpassword)
				{{ $wrongpassword }}
				@endisset
				<form action="{{ route('user.save')}}" method="post">
					@csrf
					<input class="text" type="text" name="name" placeholder="Name" required="" value="{{old('name')}}">
					<span>@error('name'){{$message}}@enderror</span>
					<input class="text" type="email" name="email" placeholder="Email" required="" value="{{old('email')}}">
					<span>@error('email'){{$message}}@enderror</span>
					<input class="text" type="password" name="password" placeholder="Password" required="">
					<span>@error('password'){{$message}}@enderror</span>
					<input class="text" type="password" name="confirmPassword" placeholder="Confirm Password" required="">
					<span>@error('confirmPassword'){{$message}}@enderror</span>

					<div class="wthree-text">
						<label class="anim">
							<input type="checkbox" name="TermsAndConditions" class="checkbox" required="">
							<span>I Agree To The Terms & Conditions</span>
						</label>
						<div class="clear"> </div>
					</div>
					<span>@error('TermsAndConditions'){{$message}}@enderror</span>
					<input type="submit" value="User-Login">
				</form>
				<p>have an Account? <a href="{{ route('user.login')}}"> Login Now!</a></p>
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