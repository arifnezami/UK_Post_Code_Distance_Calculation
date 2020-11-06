<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    
    
     function distance($lat1, $lon1, $lat2, $lon2, $unit) {

        $theta = $lon1 - $lon2;
          $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
          $dist = acos($dist);
          $dist = rad2deg($dist);
          $miles = $dist * 60 * 1.1515;
          $unit = strtoupper($unit);
        
          if ($unit == "K") {
            return ($miles * 1.609344);
          } else if ($unit == "N") {
              return ($miles * 0.8684);
            } else {
                return $miles;
              }
        }
    
    //echo $_POST['zip1'];
    
    if(isset($_POST['submit'])){
    
   // echo 'here';
    //echo $_POST['zip1'];
    
    $zip1 = strip_tags($_POST['zip1']);
    $zip1 = htmlspecialchars($zip1, ENT_QUOTES);
    
    
    
    $url="http://api.postcodes.io/postcodes/".$zip1;
    
    
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);       

    $data1 = curl_exec($ch);
    
    $data1_array = json_decode($data1);
   
    $zip1_lat = $data1_array->{'result'}->{'latitude'};
    $zip1_long = $data1_array->{'result'}->{'longitude'};
  
    curl_close($ch);
    
    
    //return $data;
    
    
    $zip2 = strip_tags($_POST['zip2']);
    $zip2 = htmlspecialchars($zip2, ENT_QUOTES);
    
    $url="http://api.postcodes.io/postcodes/".$zip2;
    
    
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);       

    $data2 = curl_exec($ch);
    
    $data2_array = json_decode($data2);
   
    $zip2_lat = $data2_array->{'result'}->{'latitude'};
    $zip2_long = $data2_array->{'result'}->{'longitude'};
  
    curl_close($ch);
    
  
    
    $unit = 'K'; // unit in kilometer
    
    // function to calculate distance between two sets of lat long
    
    $distance =   distance($zip1_lat, $zip1_long, $zip2_lat, $zip2_long, $unit);
  
    
    
   }
    
    ?>
    
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Preneur Lab Codes">
    <meta name="author" content="Arif Nezami">

    <title> Zip Distance | Preneurlab</title>
    
    <!-- Bootstrap core CSS-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Fontawesome-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <!-- Custom styles for this page-->
    <style>
      	body { background: white;}
      	label { margin-bottom: .3rem;font-weight: 600;}
      	.form-control {
		    display: block;
		    width: 100%;
		    height: calc(1.5em + .75rem + 2px);
		    padding: .375rem .75rem;
		    font-size: 1rem;
		    font-weight: 400;
		    line-height: 1.5;
		    color: #495057;
		    background-color: #fff0;
		    background-clip: padding-box;
		    border: 1px solid #ced4da;
		    border-radius: .25rem;
		    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
		}
    </style>

</head>

<body>
    <div class="container-fluid">
      	<div class="row mt-3">
	        <div class="col-md-8 mx-auto">
	        	<div class="card">
				  	<h5 class="card-header text-center alert-success">UK Zip Code Distance Calculation</h5>
				  	<div class="card-body">
				  	    <?php if($distance != NULL) { echo "The distance between ".$zip1." and ".$zip2." is " .$distance." Kilometers";  }?>
				  		<form method="post" action="index.php">
				  			<div class="form-row">
							    <div class="form-group col-md-6">
							      	<label for="inputname">Zip Code 1 <span class="text-danger">*</span></label>
							      	<input type="text" class="form-control" id="zip1" name="zip1" placeholder="Zip 1" required>
							    </div>
							    <div class="form-group col-md-6">
							      	<label for="inputphone">Zip Code 2 <span class="text-danger">*</span></label>
							      	<input name="zip2" type="text" class="form-control" id="zip2" placeholder="Zip 2" required>
							    </div>
						  	</div>
						  	<!--<div class="form-row">-->
							  <!--  <div class="form-group col-md-6">-->
							  <!--    	<label for="inputEmail4">Email <span class="text-danger">*</span></label>-->
							  <!--    	<input type="email" class="form-control" id="inputEmail4" placeholder="Email" required>-->
							  <!--  </div>-->
							  <!--  <div class="form-group col-md-6">-->
							  <!--    	<label for="inputPassword4">Password <span class="text-danger">*</span></label>-->
							  <!--    	<input type="password" class="form-control" id="inputPassword4" placeholder="Password" required>-->
							  <!--  </div>-->
						  	<!--</div>-->
						  	<!--<div class="form-group">-->
						   <!-- 	<label for="inputAddress">Address</label>-->
						   <!-- 	<input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">-->
						  	<!--</div>-->
						  	<!--<div class="form-group">-->
							  <!--  <label for="inputAddress2">Address 2</label>-->
							  <!--  <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">-->
						  	<!--</div>-->
						  	<!--<div class="form-row">-->
							  <!--  <div class="form-group col-md-6">-->
							  <!--    <label for="inputCity">City</label>-->
							  <!--    <input type="text" class="form-control" id="inputCity">-->
							  <!--  </div>-->
							  <!--  <div class="form-group col-md-4">-->
							  <!--    <label for="inputState">State</label>-->
							  <!--    <select id="inputState" class="form-control">-->
							  <!--      <option selected>Choose...</option>-->
							  <!--      <option>...</option>-->
							  <!--    </select>-->
							  <!--  </div>-->
							  <!--  <div class="form-group col-md-2">-->
							  <!--    <label for="inputZip">Zip</label>-->
							  <!--    <input type="text" class="form-control" id="inputZip">-->
							  <!--  </div>-->
						  	<!--</div>-->
						  	<!--<div class="form-group">-->
							  <!--  <div class="form-check">-->
							  <!--    <input class="form-check-input" type="checkbox" id="gridCheck">-->
							  <!--    <label class="form-check-label" for="gridCheck">-->
							  <!--      Privacy & Terms-->
							  <!--    </label>-->
							  <!--  </div>-->
						  	<!--</div>-->
						  	<input type="submit" name="submit" id="submit" class="btn btn-success float-right pl-5 pr-5"></input>
						</form>
				  	</div>
				</div>
	        </div>
      </div>
    </div>
    

<!-- Footer -->
<footer class="page-footer font-small white">

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">© 2020 Built by:
    <a href="https://arifnezami.com/"> Arif Nezami | Preneur Lab Limited</a>
  </div>
  <!-- Copyright -->

</footer>
<!-- Footer -->

    <!-- Bootstrap core JavaScript-->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
