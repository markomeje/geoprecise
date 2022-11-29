<!DOCTYPE html>
<html>
  	<head>
	    <meta charset="utf-8">
	    <title>Geoprecise Services Limited</title>
	    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  	</head>
  	<body>
  		@if(!empty($survey) && !empty($survey->form))
  			<div class="container mb-4 pb-5">
		    	<div class="mt-4">
		    		<div class="border p-4 mb-4">
		    			<h2 class="mb-0">{{ ucwords($survey->client_name) }} {{ ucwords($survey->form->name) }} Details</h2>
		    		</div>
		    		<div class="">
		    			<?php $plot_numbers = $survey->plot_numbers; ?>
		    			@if(empty($plot_numbers))
		    				<div class="alert alert-danger">No Plot Numbers</div>
		    			@else
		    				<div class="card mb-4">
		    					<div class="card-header bg-transparent p-4">Plot Numbers in {{ ucwords($survey->layout->name) }}</div>
		    					<div class="card-body pt-4 px-4">
		    						<div class="row">
					    				<?php $plot_numbers = str_contains($plot_numbers, '-') ? explode('-', $plot_numbers) : 1; ?>
					    				@if(is_string($plot_numbers))
					    					<div class="col-12 col-md-6 mb-4">
					    						<div class="p-4 bg-dark text-white">
					    							{{ $plot_numbers }}
					    						</div>
					    					</div>
					    				@else
					    					@foreach($plot_numbers as $number)
					    						<div class="col-12 col-md-6 mb-4">
						    						<div class="p-4 bg-dark text-white">
						    							{{ $number }}
						    						</div>
						    					</div>
					    					@endforeach
					    				@endif
					    			</div>
		    					</div>
		    				</div>	
		    			@endif
		    			<div class="">
		                	@if(empty($survey->documents))
		                		<div class="alert alert-danger">No Documents for this Application</div>
		                	@else
		                		<div class="border px-4 pt-4 mb-4">
		                			<div class="border p-4 mb-4">Submitted Land Documents</div>
					                <div class="row">
				                		@foreach($survey->documents as $document)
				                			<div class="col-6 mb-4">
				                				<div class="bg-dark text-white p-4">
				                					{{ ucwords($document->type) }}
				                				</div>
				                			</div>
				                		@endforeach
					                </div>
		                		</div>
		                	@endif
		                </div>
		    			<div class="survey-form mb-4">
		                    <div class="card border mb-4">
		                      <div class="card-header bg-transparent p-4 border-bottom">Client or Allottee Details</div>
		                      <div class="card-body p-4">
		                        <div class="row">
		                          <div class="mb-3">
		                            <label class="mb-2 text-muted">Client or Allottee Name</label>
		                            <div class="p-3 border text-dark">
		                            	{{ $survey->client_name }}
		                            </div>
		                          </div>
		                          <div class="mb-3">
		                            <label class="mb-2 text-muted">Client or Allottee Phone</label>
		                            <div class="p-3 border text-dark">
		                            	{{ $survey->client_phone }}
		                            </div>
		                          </div>
		                        </div>
		                        <div class="mb-3">
		                          <label class="mb-2 text-muted">Client or Allottee Address</label>
		                          <div class="p-3 border text-dark">
		                          	{{ $survey->client_address }}
		                          </div>
		                        </div>
		                      </div>
		                    </div>
		                    <div class="card border mb-4">
		                      <div class="card-header bg-transparent p-4 border-bottom">Land Seller or Donor Details</div>
		                      <div class="card-body p-4">
		                        <div class="row">
		                          <div class="mb-3">
		                            <label class="mb-2 text-muted">Land Seller or Donor Name</label>
		                            <div class="p-3 border text-dark">
		                            	{{ $survey->seller_name }}
		                            </div>
		                          </div>
		                          <div class="mb-3">
			                        <label class="mb-2 text-muted">Land Seller or Donor Phone number</label>
		                          	<div class="p-3 border text-dark">
		                            	{{ $survey->seller_phone }}
		                            </div>
			                      </div>
		                        </div>
		                        <div class="mb-3">
		                          <label class="mb-2 text-muted">Land Seller or Donor Address</label>
		                          <div class="p-3 border text-dark">
		                            	{{ $survey->seller_address }}
		                            </div>
		                        </div>
		                      </div>
		                    </div>
		                </div>
		                <div class="p-4 border">
		                	<div class="bg-dark p-4 text-white">Survey Approved by {{ $survey->approver ? $survey->approver->staff->fullname : '' }} on {{ date("F j, Y, g:i a", strtotime($survey->approved_at)) }}</div>
		                </div>
		                	
		    		</div>
		    	</div>
  			</div>
	    @endif
  	</body>
</html>