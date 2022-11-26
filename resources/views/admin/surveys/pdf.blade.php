<!DOCTYPE html>
<html>
  	<head>
	    <meta charset="utf-8">
	    <title>Laravel PDF</title>
	    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  	</head>
  	<body>
  		@if(!empty($survey))
  		{{ dd($survey) }}
  			<div class="container">
		    	<div class="card mt-4">
		    		<div class="card-header">
		    			<h2 class="mb-0">Survey & Lifting Application Details for {{ ucwords($survey->client_name) }}</h2>
		    		</div>
		    		<div class="card-body">
		    			<?php $plot_numbers = $survey->plot_numbers; ?>
		    			@if(empty($plot_numbers))
		    				<div class="alert alert-danger mb-0">No PLot Numbers</div>
		    			@else
			    			<div class="row">
			    				<?php $plot_numbers = str_contains($plot_numbers, '-') ? explode('-', $plot_numbers) : 1; ?>
			    				@if(is_string($plot_numbers))
			    					<div class="col-12 col-lg-4 mb-4">
			    						<div class="px-3 py-2 bg-dark text-white">
			    							{{ $plot_numbers }}
			    						</div>
			    					</div>
			    				@else
			    					@foreach($plot_numbers as $number)
			    						<div class="col-12 col-md-6 col-lg-4 mb-4">
				    						<div class="px-3 py-2 bg-dark text-white">
				    							{{ $number }}
				    						</div>
				    					</div>
			    					@endforeach
			    				@endif
			    			</div>
		    			@endif
		    		</div>
		    	</div>
  			</div>
	    @endif
  	</body>
</html>