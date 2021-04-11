<p>Hey! {{ $data['name']}}</p>
<p>Your Registration mail is {{ $data['email']}}</p>
<p>here is your account verification mail {{ 'http://127.0.0.1:8000/admin/account/verification/'.$data['verification_slug']}}</p>