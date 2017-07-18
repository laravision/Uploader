@extends('Laravision-uploader::layout')
@section('content')
	
	<div class="row">
		<div class="col-md-12 text-center">
			<h1 class="text-muted">Uploader laravision package for laravel 5 framework</h1>
			<h2>Upload Picture (image)</h2>
		</div>
		<div class="col-md-8 col-md-offset-2"><hr><br>
			<form action="{{ route('uploader.picture') }}" method="post" enctype="multipart/form-data">
				{{csrf_field()}}
				<div class="form-group">
			      <label for="inputfile" class="col-lg-2 control-label">Picture</label>
			      <div class="col-lg-10">
			        <input type="file" class="form-control" id="inputfile" name="picture">
			      </div>
			    </div>
			    <div class="form-group">
			      <div class="col-md-3 col-md-offset-9"> <br>
			        <button type="submit" class="btn btn-primary btn-block">Upload</button>
			      </div>
			    </div>
			</form>
		</div>
	</div>

@stop