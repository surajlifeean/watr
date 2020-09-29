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

	<!-- INVOICE HEADER START -->
<!-- 	 <div class="row" style="margin-top: 5%">
	  <div class="col-sm-4"></div>
	  <div class="col-sm-4">
	  	CHANGE THE COMPANY LOGO
	  	<img src="my_name_logo_small.png" alt="Company Logo">
	  </div>
	  <div class="col-sm-4"></div>
	 </div>
 -->
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
		  	<p>L04</p>
		  	<p>Sribas Nemu</p>
		  	<p>Hooghly</p>
		  	<p>Hooghly</p>
		  </div>
		  <div class="col-sm-3 col-xs-6">
		  	<strong><p>Source/Location:</p></strong>
		  	<strong><p>Date Collected:</p></strong>
		  </div>
		  <div class="col-sm-3 col-xs-6">
		  	<p>Hooghly</p>
		  	<p>12/07/2020</p>
		  </div>
		 </div>
	  </div>
	 <br>
	<!-- INVOICE HEADER END -->


	 <!-- Feature 30-Part 1 Sediment TABLE START -->
	 <h4 style="color: green">Feature 30-Part 1 Sediment</h4>

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
        <tr>
          <td>Turbidity</td>
          <td><center></center></td>
          <td><center>0.1</center></td>
          <td><center></center></td>
        </tr>
      </tbody>
    </table>
  </div><br>
  <!-- Feature 30-Part 1 Sediment TABLE END -->

<!-- Feature 30-Part 2 Microorganisms TABLE START -->
  <h4 style="color: green">Feature 30-Part 2 Microorganisms</h4>

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
        <tr>
          <td>Total Coliforms(including E-Code)</td>
          <td><center><1/100ml</center></td>
          <td><center>na</center></td>
          <td><center></center></td>
        </tr>
      </tbody>
    </table>
  </div><br>
  <!-- Feature 30-Part 2 Microorganisms TABLE END -->

<!-- Contaminants TABLE START -->
  <h4 style="color: green">Contaminants</h4>

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
        <tr>
          <td>Lead</td>
          <td><center>0.01</center></td>
          <td><center>0.002</center></td>
          <td><center>nd</center></td>
        </tr>
        <tr>
          <td>Arsenic</td>
          <td><center>0.01</center></td>
          <td><center>0.002</center></td>
          <td><center>nd</center></td>
        </tr>
        <tr>
          <td>Antimony</td>
          <td><center>0.01</center></td>
          <td><center>0.002</center></td>
          <td><center>nd</center></td>
        </tr>
        <tr>
          <td>Lead</td>
          <td><center>0.01</center></td>
          <td><center>0.002</center></td>
          <td><center>nd</center></td>
        </tr>
        <tr>
          <td>Lead</td>
          <td><center>0.01</center></td>
          <td><center>0.002</center></td>
          <td><center>nd</center></td>
        </tr>
        <tr>
          <td>Lead</td>
          <td><center>0.01</center></td>
          <td><center>0.002</center></td>
          <td><center>nd</center></td>
        </tr>
      </tbody>
    </table>
  </div><br>
  <!-- Contaminants TABLE END -->

<!-- Feature 32 Organic Contaminants TABLE START -->
  <h4 style="color: green">Feature 32 Organic Contaminants</h4>

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
        <tr>
          <td>Total Coliforms(including E-Code)</td>
          <td><center><1/100ml</center></td>
          <td><center>na</center></td>
          <td><center>nd</center></td>
        </tr>
        <tr>
          <td>Total Coliforms(including E-Code)</td>
          <td><center><1/100ml</center></td>
          <td><center>na</center></td>
          <td><center>nd</center></td>
        </tr>
        <tr>
          <td>Total Coliforms(including E-Code)</td>
          <td><center><1/100ml</center></td>
          <td><center>na</center></td>
          <td><center>nd</center></td>
        </tr>
        <tr>
          <td>Total Coliforms(including E-Code)</td>
          <td><center><1/100ml</center></td>
          <td><center>na</center></td>
          <td><center>nd</center></td>
        </tr>
        <tr>
          <td>Total Coliforms(including E-Code)</td>
          <td><center><1/100ml</center></td>
          <td><center>na</center></td>
          <td><center>nd</center></td>
        </tr>
        <tr>
          <td>Total Coliforms(including E-Code)</td>
          <td><center><1/100ml</center></td>
          <td><center>na</center></td>
          <td><center>nd</center></td>
        </tr>
        <tr>
          <td>Total Coliforms(including E-Code)</td>
          <td><center><1/100ml</center></td>
          <td><center>na</center></td>
         <td><center>nd</center></td>
        </tr>
        <tr>
          <td>Total Coliforms(including E-Code)</td>
          <td><center><1/100ml</center></td>
          <td><center>na</center></td>
          <td><center>nd</center></td>
        </tr>
      </tbody>
    </table>
  </div><br>
  <!-- Feature 32 Organic Contaminants TABLE END -->

<!-- Feature 33- Part 1 Herbicides and Pesticides TABLE START -->
  <h4 style="color: green">Feature 33- Part 1 Herbicides and Pesticides</h4>

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
        <tr>
          <td>Lead</td>
          <td><center>0.01</center></td>
          <td><center>0.002</center></td>
          <td><center>nd</center></td>
        </tr>
        <tr>
          <td>Arsenic</td>
          <td><center>0.01</center></td>
          <td><center>0.002</center></td>
          <td><center>nd</center></td>
        </tr>
        <tr>
          <td>Antimony</td>
          <td><center>0.01</center></td>
          <td><center>0.002</center></td>
          <td><center>nd</center></td>
        </tr>
        <tr>
          <td>Lead</td>
          <td><center>0.01</center></td>
          <td><center>0.002</center></td>
          <td><center>nd</center></td>
        </tr>
      </tbody>
    </table>
  </div><br>
  <!-- Feature 33- Part 1 Herbicides and Pesticides TABLE END -->


<!-- Feature 33 Part 2-Fertilizers TABLE START -->
  <h4 style="color: green">Feature 33 Part 2-Fertilizers</h4>

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
        <tr>
          <td>Lead</td>
          <td><center>0.01</center></td>
          <td><center>0.002</center></td>
          <td><center>nd</center></td>
        </tr>
      </tbody>
    </table>
  </div><br>
<!-- Feature 33 Part 2-Fertilizers TABLE END -->

<!-- PRINT BUTTON START -->
	<button type="button" class="btn btn-info btn-block" onclick="printPage()">PRINT</button>
<!-- PRINT BUTTON END -->
</div>
<br>
</body>
</html>