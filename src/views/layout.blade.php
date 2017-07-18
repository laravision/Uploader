<!DOCTYPE html>
<html>
<head>
	<title>@yield('title')</title>
	<link rel="stylesheet" type="text/css" href="https://bootswatch.com/cosmo/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<style type="text/css">
		.care{
			text-align: center;
		    border: 2px dashed #eaeaea;
		    min-height: 100px;
		    padding: 10px;
		    text-decoration: none!important;
		    color: #757575;
		    float: left;
		}
		.care:hover{
			background-color: #f5f5f5;
			color: #757575;
		}
		.care i.ion{
			font-size: 5em;
			width: 100%;
		}
		.care span{
			 
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="row">
			@yield('content')
		</div>
	</div>
</body>
</html>