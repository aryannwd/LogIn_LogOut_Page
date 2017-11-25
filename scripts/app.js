var application = angular.module('angular_app', ['ngRoute']);

application.controller('angular_controller', function($scope, $location, $timeout, Http, User){

$scope.form = {
	email : '',
	password: '',
	keepmein : false,
}

$scope.login = function(){
	//body of the login .
	//$location.path('/dashboard');
	//$scope.showAlert();

	var email = $scope.form.email;
	var password = $scope.form.password;
	var keepmein = $scope.form.keepmein;

	var data = {
		'what_to_do' : 'authenticate_user',
		'email' : email,
		'password' : password,
		'remember_me' : keepmein
	}

	var request = Http.post(data);
	Http.send(request, function(response){
		if (response.data.id != '') {
				User.isLoggedIn = true;
				User.user_id = response.data.id;
				User.username = response.data.username;
				$location.path('/dashboard');
			}else{
				User.isLoggedIn = false;
				User.user_id = '';
				User.username = '' ;
				$scope.showAlert();
			}
		
	});
}

$scope.logout = function(){
	//body of the logout here
	//$location.path('/login');
	var data = {
		'what_to_do' : 'log_me_out',

	}
	var request = Http.post(data);
	Http.send(request, function(){
		$location.path('/login');
	});
}



$scope.showAlert = function(){
	$('.modal').fadeIn(1000);
	$timeout(function(){
		$('.modal').fadeOut(1000);
	}, 5000);
}

$scope.isAuthenticated = function(){
	var data = {
		'what_to_do' : 'isAuthenticated',
	}
	var request = Http.post(data);
	Http.send(request, function(response){
		if (response.data) {
			$location.path('/dashboard');
		}else{
			$location.path('/login');
		}
	});
}

angular.element(document).ready(function(){
	$scope.isAuthenticated();
});
});