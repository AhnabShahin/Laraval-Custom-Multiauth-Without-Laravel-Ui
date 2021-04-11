
<p>Your Registration mail is {{ $data['email']}}</p>
<p>here is your account password reset link  {{ 'http://127.0.0.1:8000/user/password/reset/form/'.$data['password_reset_slug']}}</p>