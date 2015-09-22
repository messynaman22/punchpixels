<!DOCTYPE html>
<html>
<head >
	<title>Excel Sheet</title>
	<style type="text/css">
	.head {
		    font-size: 16px;
    		   font-weight: bold;
    		   background-color: #e3e3e3;

	}
	.twidth{
		width: 300px !important;
	}
	</style>
</head >
<body>
<table style=" word-wrap: break-word;table-layout:fixed">
	<thead >
		<tr>
			      <th class="head twidth">Username</th>
			      <th  class="head twidth">Message</th>			          
		</tr>
	</thead >
	<tbody>
		@foreach($userData as $data)
		<tr>		
		<td class="twidth">{!! $data["username"]["name"] !!}</td>
		<td class="twidth">{!! $data["username"]["email"] !!}</td>	
		</tr>
		@endforeach
	</tbody>
</table>
</body>
</html>