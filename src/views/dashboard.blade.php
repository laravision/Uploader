@extends('Laravision-uploader::layout')

@section('content')
	
	<div class="row">
		<div class="col-md-12">
			<h1 class="text-muted">Uploader laravision package for laravel 5 framework</h1>
		</div>
		<a href="{{route('uploader.picture')}}" class="col-md-3 care">
			<i class="ion ion-image"></i>
			<span>Upload Picture</span>
		</a>
	</div>

@stop