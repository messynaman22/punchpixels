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
			      <th class="head twidth">SNo. (click one of below cell to select)</th>
			      <th  class="head twidth">Time submitted</th>
			      <th  class="head twidth">First Name</th>
			      <th  class="head twidth">Last Name</th>
			      <th  class="head twidth">Middle Name</th>
			      <th  class="head twidth">E-mail</th>
			      <th  class="head twidth">Best phone to contact</th>
			      <th  class="head twidth">Street Address</th>
			      <th  class="head twidth">Zip</th>
			      <th  class="head twidth">City</th>
			      <th  class="head twidth">State</th>      
			      <th  class="head twidth">Enter Your Desired First Payment Fee Start Date Here</th>
			      <th  class="head twidth">Package type</th>
			      <th  class="head twidth">Name As Shown on Card</th>
			      <th  class="head twidth">Card Number</th>
			      <th  class="head twidth">Expiration Date MM</th>
			      <th  class="head twidth">YY</th>
			      <th  class="head twidth">CVV</th>
			      <th  class="head twidth">Bank Name</th>
			      <th class="head twidth">Account type</th>
			      <th  class="head twidth">ABA/ Routing Number</th>
			      <th  class="head twidth">Account Number</th>
			      <th class="head twidth">Name on Account</th>
			      <th  class="head twidth">Date of Birth</th>
			      <th  class="head twidth">Social Security Number</th>
			      <th class="head twidth">Driving license Number</th>
			      <th class="head twidth">Driving license State</th>
			          
		</tr>
	</thead >
	<tbody>
		@foreach($userData as $data)
		<tr>		
		<td class="twidth">{!! $data["user"]["sno"] !!}</td>
		<td class="twidth">{!! $data["user"]["date"] !!}</td>
		<td class="twidth">{!! $data["profile"]["fname"] !!}</td>
		<td class="twidth">{!! $data["profile"]["lname"] !!}</td>
		<td class="twidth">{!! $data["profile"]["mname"] !!}</td>
		<td class="twidth">{!! $data["user"]["email"] !!}</td>
		<td class="twidth">{!! $data["profile"]["mno"] !!}</td>
		<td class="twidth">{!! $data["profile"]["paddress"] !!}</td>
		<td class="twidth">{!! $data["profile"]["zip"] !!}</td>		
		<td class="twidth">{!! $data["profile"]["city"] !!}</td>
		<td class="twidth">{!! $data["profile"]["state"] !!}</td>
		<td class="twidth">{!! $data["order"]["package_start"] !!}</td>
		<td class="twidth">{!! $data["order"]["package"] !!}</td>		
		<td class="twidth">{!! $data["order"]["contact_information"] !!}</td>
		<td class="twidth">{!! $data["order"]["card_number"] !!}</td>		
		<td class="twidth">{!! $data["order"]["month"] !!}</td>
		<td class="twidth">{!! $data["order"]["year"] !!}</td>
		<td class="twidth">{!! $data["order"]["cvv"] !!}</td>
		<td class="twidth">{!! $data["order"]["bank_name"] !!}</td>
		<td class="twidth">{!! $data["order"]["account_type"] !!}</td>
		<td class="twidth">{!! $data["order"]["routing_number"] !!}</td>
		<td class="twidth">{!! $data["order"]["account_number"] !!}</td>		
		<td class="twidth">{!! $data["order"]["full_name"] !!}</td>
		<td class="twidth">{!! $data["last"]['birthdate'] !!}</td>
		<td class="twidth">{!! $data["last"]["social_security_number"] !!}</td>
		<td class="twidth">{!! $data["last"]["driving_license_number"] !!}</td>
		<td class="twidth">{!! $data["last"]["driving_license_state"] !!}</td>
		</tr>
		@endforeach
	</tbody>
</table>
</body>
</html>