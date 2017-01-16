<?php

class UserController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function login()
	{
		// $data = [];

		if ($this->isPostRequest()) {
        $validator = $this->getLoginValidator();

 if ($validator->passes()) {
 	$credentials = $this->getLoginCredentials();

 // echo "Validation passed!";
 	if (Auth::attempt($credentials)) {
 		return Redirect::route("user/profile");
 	}

 	return Redirect::back()->withErrors([
 		"password" => ["Credentials invalid."]
 		]);
 } 
 else {
 	return Redirect::back()->withInput()->withErrors($validator);

 	// $data["error"] = "<h3 style=color:red;> Username and/or password invalid. </h3>";
 }
 }
		return View::make("user/login");
	}


public function profile(){

	return View::make("user/profile");
}


protected function isPostRequest()
 {
 return Input::server("REQUEST_METHOD") == "POST";
 }


protected function getLoginValidator()
 {
 return Validator::make(Input::all(), [
 "username" => "required",
 "password" => "required"
 ]);
 }

protected function getLoginCredentials() {
	return [
	"username" => Input::get("username"),
	"password" => Input::get("password")

	];
}

public function request(){
	if ($this->isPostRequest()) {
		$response = $this->getPasswordRemindResponse();

	if ($this->isInvalidUser($response)) {
		return Redirect::back()->withInput()->with("error", Lang::get($response));
	}

	return Redirect::back()->with("status", Lang::get($response));
	}

	return View::make("user/request");
}

protected function getPasswordRemindResponse(){
	return Password::remind(Input::only("email"));
}

protected function isInvalidUser($response){
	return $response === Password::INVALID_USER;
}

public function reset($token){
	if ($this->isPostRequest()){
		$credentials = Input::only(
			"email",
			"password",
			"password_confirmation"
			) + compact("token");

	$response = $this->resetPassword($credentials);

	if ($response === Password::PASSWORD_RESET) {
		return Redirect::route("user/profile");
	}

	return Redirect::back()->withInput()->with("error", Lang::get($response));
	}

	return View::make("user/reset", compact("token"));
}

protected function resetPassword($credentials){
	return Password::reset($credentials, function($user, $pass) {
		$user->password = Hash::make($pass);
		$user->save();
	});
}

public function logout(){
	Auth::logout();
	return Redirect::route("user/login");
}

}

