application.config(function($routeProvider){
	$routeProvider.when('/' , { 
		templateUrl : 'partials/login.html',
		controller : 'angular_controller',
	}).when('/dashboard', {
		templateUrl : 'partials/dashboard.html',
		controller : 'angular_controller',
	}).when('/reports', {
		templateUrl : 'partials/reports.html',
		controller : 'angular_controller',
	}).when('/login', {
		templateUrl : 'partials/login.html',
		controller : 'angular_controller',
	});

});

application.run(function($rootScope, $location, checkLogin, User){
	$rootScope.$on("$routeChangeStart", function(event, next, current){
		checkLogin.check(function(response){
			if(response){
				var nextUrl = next.$$route.originalPath;
				if (nextUrl == '/login' || nextUrl == '/') {
					$location.path('/dashboard');
				}
				$rootScope.isLoggedIn = true;
			}else{
				$location.path('/login');
				$rootScope.isLoggedIn = false;
			}
		});
	});
});