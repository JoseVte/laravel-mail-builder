@extends ('layout.email')

@section ('title')
    Forgot password
@endsection

@section ('content')
    Click here to reset your password: <a href="@{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> @{{ $link }} </a>
@endsection
