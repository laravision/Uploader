@extends('Laravision-visiteur::layout')

@section('content')
	
	<div class="col-md-12">
		<h1>Hello in laravision visiteur dashboard</h1><hr>
	</div>
	<div class="col-xs-4">
		<div class="alert alert-dismissible alert-warning" > 
		  <h2> <b  class="ion ion-ios-eye pull-left" style="font-size: 2em;padding: 0px 10% 0 10%;"></b> &nbsp; {{count($data)}}</h2>
		  <h4>Count of visiteurs</h4>
		</div>
	</div> 
	<div class="col-xs-4">
		<div class="alert alert-dismissible alert-success" > 
		  <h2> <b  class="ion ion-ios-eye pull-left" style="font-size: 2em;padding: 0px 10% 0 10%;"></b> &nbsp; 5047</h2>
		  <h4>Count of visiteurs</h4>
		</div>
	</div> 
	<div class="col-xs-4">
		<div class="alert alert-dismissible alert-info" > 
		  <h2> <b  class="ion ion-ios-eye pull-left" style="font-size: 2em;padding: 0px 10% 0 10%;"></b> &nbsp; 5047</h2>
		  <h4>Count of visiteurs</h4>
		</div>
	</div> 

	<div class="col-md-7">
		{{dump($data)}}
	</div>
	<div class="col-md-5">
		@include('Laravision-visiteur::_plugins.activity')
	</div>

@stop