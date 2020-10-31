<!DOCTYPE html>
<html>
<head>

	<!-- CHANGE THE TITLE HERE -->
  <title>WATR TECHNOLOGIES LAB REPORT</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- BOOTSTRAP V4.0 ALL CDN LINKS START -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <!-- BOOTSTRAP V4.0 ALL CDN LINKS END -->

  <style type="text/css">

  	/*TABLE BORDER COLOR START*/
  	table.table-bordered{
    border:1px solid black;
  }
table.table-bordered > thead > tr > th{
    border:1px solid black;
}
table.table-bordered > tbody > tr > td{
    border:1px solid black;
}
/*TABLE BORDER COLOR END*/

  </style>

 <!-- PAGE PRINT TEST -->
 <script>
function printPage() {
  window.print();
}

</script>


</head>
<body>
	<div class="container">

 @php

 $partner=$data['partner'];

 $reports=$data['reports'];

 @endphp
	 <center><h3 style="color:#6086E6">WATR TECHNOLOGIES LAB REPORT</h3></center>

	 <div class="row">
	  <div class="col-sm-4">
     
      <img src="{{asset('images/logo.png')}}" alt="Company Logo" style="width: 200px">

    </div>
	  <div class="col-sm-8">
	  	 <div class="row">
		  <div class="col-sm-3 col-xs-6">
		  	<strong><p>Order Number:</p></strong>
		  	<strong><p>Lab Number:</p></strong>
		  	<strong><p>Name:</p></strong>
		  	<strong><p>Address:</p></strong>
		  	<strong><p>City, State, Zip:</p></strong>
		  </div>
		  <div class="col-sm-3 col-xs-6">
		  	<p>1234567890</p>
		  	<p>L{{$partner->id}}</p>
		  	<p>{{$partner->labname}}</p>
		  	<p>Hooghly</p>
		  	<p>Hooghly</p>
		  </div>
		  <div class="col-sm-3 col-xs-6">
		  	<strong><p>Source/Location:</p></strong>
		  	<strong><p>Date Collected:</p></strong>
		  </div>
		  <div class="col-sm-3 col-xs-6">
		  	<p>{{$partner->location}}</p>
		  	<p>12/07/2020</p>
		  </div>
		 </div>
	  </div>
	 <br>
@php 
  $prevName='';
  $start=1;
@endphp

 @foreach($reports as $report)

  @php 

    $currName=$report->test_name;

  @endphp

@if($prevName!=$currName)

@if($start==0)
      </tbody>
    </table>
  </div><br>
@endif

   <h4 style="color: green">{{$currName}}</h4>

    <div class="table-responsive">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Parameter</th>
          <th>MCL (NTU)</th>
          <th>MDL (NTU)</th>
          <th>Result (NTU)</th>
        </tr>
      </thead>
      <tbody>

@endif


        <tr>
          <td>{{$report->parameter}}</td>
          <td><center>{{$report->mcl}}</center></td>
          <td><center>{{$report->mdl}}</center></td>
          <td><center>{{$report->result}}</center></td>
        </tr>

@php 
  $prevName=$report->test_name;
  $start=0
@endphp

@endforeach

      </tbody>
    </table>
  </div><br>

</div>
<br>
</body>
</html>