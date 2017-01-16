@extends("layout")
@section("content")

 {{ Form::open() }}

 	<!-- @if(isset($error))
 	{{ $error }} <br />
 	@endif -->

 	{{ $errors->first("password") }} <br />

  {{ Form::label("username", "Username") }}
  {{ Form::text("username", Input::old("username")) }}

  {{ Form::label("password", "Password") }}
  {{ Form::password("password") }}

  {{ Form::submit("login")}}

 {{ Form::close() }}

 @stop