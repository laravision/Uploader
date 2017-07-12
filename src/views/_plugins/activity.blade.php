<h3>Activity</h3>
<hr>
<div class="list-group">
	@foreach(Visiteur::activity() as $log)
	  <div class="list-group-item">
	    <h4 class="list-group-item-heading"> 
	    {{$log->ip}}
	     ( {{$log->ip('countryName')}} ) 
	    </h4>
	    <span class="pull-right">{{ $log->created_at->diffForHumans() }}</span>
	    <p class="list-group-item-text">
	    	<ul>
	    		<li>See : <a href="{{$log->url()->url}}">{{$log->url()->route->name}}</a></li>
	    		<li>Browser : {{$log->browser()->getName()}}</li>
	    		<li>OS : {{$log->browser()->getPlatformVersion()}} [{{ ($log->browser()->is64bitPlatform())?'64bit':'32bit' }}]</li>
	    		<li>User : 
	    			@if($log->user()->login)
	    				<a href="">{{$log->auth()->name}}</a>
	    			@else
	    				<b>Anonyme</b>
	    			@endif
	    			 &nbsp;
	    			{{ $log->user()->pc->name }} [ {{ $log->user()->pc->session }} ]
	    		</li>
	    	</ul>
	    </p>
	  </div> 
	@endforeach
</div> 
