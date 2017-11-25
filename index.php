<!DOCTYPE html>
<html lang="en" ng-app="angular_app">
<head>
	<title>Anular_app</title>
	    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- Bootstrap CSS -->
   
	
	<link rel="stylesheet" type="text/css" href="styles/styles.css">

</head>
<body ng-controller="angular_controller">
	<header class="jumbotron" >
		<div ng-show="isLoggedIn" >
	<div >
	
	
		<a  href="#/dashboard">Home</a>
	
	
		<a class="offset-1" href="#/reports">Report</a>
	

	
		<a class="offset-8" href="" ng-click="logout()">
		<i type="submit" class="btn btn-primary">Log out</i>
		</a>
	</div>
	</div>
</header>

<!-- This is the container in which partial views are displayed -->
<div ng-view>
	
</div>

<div class="modal" id="modal">
	<div class="modal-content">
		<div class="modal-header">
			<span class="close">
				x
			</span>
		</div>
		<div class="modal-body">
		<div class="alert">
			Invalid email or password.
		</div>
	</div>
	</div>
</div>


	


<script src="bower_components/jquery/dist/jquery.min.js"></script>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
<script src="bower_components/angular-route/angular-route.js"></script>
<script type="text/javascript" src="scripts/app.js"></script>
<script type="text/javascript" src="scripts/config.js"></script>
<script type="text/javascript" src="scripts/services.js"></script>


  <!-- jQuery first, then Tether, then Bootstrap JS. -->
       

<script type="text/javascript">
		var modal = document.getElementById('modal');
		var span = document.getElementsByClassName('close')[0];
		span.onclick = function(){
			$('.modal').fadeOut(1000);
		}

</script>

</body>
</html>