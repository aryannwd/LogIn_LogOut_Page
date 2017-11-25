application.factory('Http', function($http){
	var base_url = "../angular_app/server_pages/server.php";

	return {
		post : function(form_data){
			var request = $http({
				method : 'post',
				url : base_url,
				data : form_data
			});

			return request;
		},

		send : function(request, callback){
			request.then(function(response){
				callback(response);
			}).error(function(msg){
				alert(msg.data);
			});
		}
	}
});

application.factory('User', function(){
	var obj = {
		isLoggedIn : false,
		user_id : '',
		username : '',

	}
	return obj
});

application.factory('checkLogin', function(Http, User){
	return {
		check : function(callback){
			var data = {
				'what_to_do' : 'check_if_logged_in',
			}
			var request = Http.post(data);
			Http.send(request, function(response){
				if (response.data.id != '') {
					User.isLoggedIn = true;
					User.user_id = response.data.id;
					User.username = response.data.username;
				}else{
					User.isLoggedIn = false;
					User.user_id = '';
					User.username = '' ;
				}
				callback(User.isLoggedIn);
			})
		}
	}
});