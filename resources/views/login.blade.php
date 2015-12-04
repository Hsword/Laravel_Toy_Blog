@extends("layouts.app")

@section("content")
@if(count($errors) > 0 || isset($loginError))
	<div>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
		@if(isset($loginError))
            <li>{{ $loginError }}</li>
		@endif
	</div>
@endif
<form action="/login" method="POST">
{{ csrf_field() }}
    <table>
        <th>Login</th>
            <tr>
                <td>Username</td>
                <td><input type="text" name="username" value="@if(!isset($username)){{ old('username') }}@else{{ $username }}@endif"/></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="password" name="password"/></td>
            </tr>
            <tr>
                <td><div>Forget Password? Click <a href="/resetpass">here</a> to reset</div></td>
            </tr>
            <tr>
                <td><div>Not signed up? <a href="/register">Register</a></div></td>
            </tr>
            <tr>
                <td><input type="submit" value="Login"></td>
            </tr>
    </table>
</form>
@endsection
