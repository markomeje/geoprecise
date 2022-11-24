<!DOCTYPE html>
<html>
  	<head>
	    <meta charset="utf-8">
	    <title>Laravel PDF</title>
	    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  	</head>
  	<body>
    	<h2 class="mb-3">Survey Application Details</h2>
    	<table class="table table-bordered">
	    	<thead>
	      	<tr>
		        <th>Name</th>
		        <th>E-mail</th>
		        <th>Phone</th>
		        <th>DOB</th>
	      	</tr>
	      </thead>
	      <tbody>
	        @if(!empty($survey))
		        <tr>
		            <td>{{ $survey->cleint_name }}</td>
		            <td>{{ $survey->plot_numbers }}</td>
		        </tr>
	        @endif
	      </tbody>
	    </table>
  	</body>
</html>