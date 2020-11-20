<?php include 'connection.php';

	$customer_id= $_GET["cid"];

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>YTbanking</title>
  <meta content="" name="descriptison">
  <meta content="" name="keywords">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Montserrat:300,400,500,600,700" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="assets/vendor/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
</head>

<body style="background: #f5f8fd;">

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top header-transparent">
    <div class="container d-flex align-items-center">

      <h1 class="logo mr-auto"><a href="index.php">YTBanking</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo mr-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav class="main-nav d-none d-lg-block">
        <ul>
          <li class="active"><a href="index.php">Home</a></li>
          <li><a href="customer.php">View All Customers</a></li>
          <li><a href="history.php">View Transaction History</a></li>
        </ul>
      </nav><!-- .main-nav-->

    </div>
  </header><!-- End Header -->

 <!-- ======= Table Section ======= -->

 <section class="clearfix">
  <div class="container d-flex h-100">
	<div style="margin-top: 150px;"><h5>Customer Information</h5></div>
      <table  id="showTable" class="table" style="margin-top: 200px;">
      <thead class="black white-text">
      </thead>
      <tbody>
      <?php
        $sql = "SELECT id, name, email, balance FROM customers WHERE id=$customer_id";
        $result = mysqli_query($conn, $sql);
        while( $row = mysqli_fetch_assoc($result)){
        //var_dump($row);
        $customer_id = $row['id'];
				$customer_name = $row['name'];
				$customer_email =$row['email'];
				$customer_balance=$row['balance'];
		}
		$sqlforsenders = "SELECT id, name, email, balance FROM customers WHERE id !=$customer_id";
		$resultforsenders = mysqli_query($conn, $sqlforsenders);
		
		$mySelect = '<select id="senders"><option value="default">Select Sender</option>';
        while( $rowforSenders = mysqli_fetch_assoc($resultforsenders)){
			//echo $rowforSenders['id'];
			//$mySelect .="<option value='1'>Test</option>";
			$mySelect .="<option value='".$rowforSenders['id']."'>".$rowforSenders['name']."</option>";
		}
		$mySelect .= ' </select>';
	  ?>
    <tr>
		<td ><h4>customer_Id</h4></td><td id="customer_id"><?php echo $customer_id;?></td>
	  </tr>
	  <tr>
		<td ><h4>customer_name</h4></td><td id="customer_name"><?php echo $customer_name;?></td>
	  </tr>
	  <tr>
		<td><h4>customer_email</h4></td><td id="customer_email"><?php echo $customer_email;?></td>
	  </tr>
	  <tr>
		<td><h4>customer_balance</h4></td><td id="customer_balance"><?php echo $customer_balance;?></td>
	  </tr>
	  <tr>
		<td><h4>Send To:</h4></td><td>Select user : <?php echo $mySelect;?></td>
	  </tr>
	  <tr>
		<td><h5>Enter Valid Amount to send for selected user:</h5></td><td><input type="number" name="amount" class="form-control" id="amountTosend" placeholder="Enter Amount" data-rule="minlen:4" data-msg="Please enter valid chars"></td>
	  </tr>
	  <tr>
		<td><button type="button" class="btn btn-primary" onclick= "send()" style="width:30%;">Send</i></button></td><td></td>
	  </tr>
      </tbody>
    </table>
  </div>
</section>

<script>
    function send()
      {
        var senderId = document.getElementById("customer_id").textContent;
        //alert(senderId);
        var senderName =document.getElementById("customer_name").textContent;
        var e = document.getElementById("senders");
        var recieverName =e.options[e.selectedIndex].text;
        var recieverId = document.getElementById("senders").value;
        // alert(recieverId);
        var senderAmount = document.getElementById("customer_balance").textContent;
        // alert(senderAmount);
        var amountTosend = document.getElementById("amountTosend").value;
        // alert(amountTosend);
        if(recieverName == 'Select Sender' || amountTosend ==''){
          alert('Please select valid sender or amount');
        }else if(amountTosend > senderAmount){
          alert('Insufficeient balance to send');
        }else if(amountTosend <= 0){
          alert('Please enter valid amount to send');
        }
        else{
           location.href = "success.php?senderName="+senderName+"&senderId="+senderId+"&recieverId="+recieverId+"&recieverName="+recieverName+"&amountTosend="+amountTosend;
        }


      } 
</script>
  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/counterup/counterup.min.js"></script>
  <script src="assets/vendor/venobox/venobox.min.js"></script>
  <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>