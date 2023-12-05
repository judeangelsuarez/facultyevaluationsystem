<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Online Faculty Evaluation - Login </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="clogo.png">
    <link href="css/style.css" rel="stylesheet">

</head>

<body class="h-100" style="background-image: url('back.jpg');opacity: 1.8;">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <center><img src="logo.png" width="50%"></center><br>
                    <div class="authincation-content" style="background-color:rgba(255, 255, 255, 0.5);">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <h4 class="text-center mb-4">Sign in your account</h4>
                                    <p id="BAL"></p>
                                    <form action="#" method="POST">
                                        
                                        <div class="form-group">
                                            <label><strong>Username/Email</strong></label>
                                            <input type="text" class="form-control" placeholder="Enter Username/Email" name="USERNAME">
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Password</strong></label>
                                            <input type="password" class="form-control" name="PASSWORD" placeholder="Enter Password">
                                        </div>
                                        <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                            <div class="form-group">
                                               <div class="custom-control custom-checkbox ml-1">
													<input type="checkbox" class="custom-control-input" id="basic_checkbox_1">
													<label class="custom-control-label" for="basic_checkbox_1">Remember my preference</label>
												</div>
                                            </div>
                                            <!-- <div class="form-group">
                                                <a href="page-forgot-password.html">Forgot Password?</a>
                                            </div> -->
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" name="submit" class="btn btn-block text-white" style="background-color:#288C28">Sign me in</button>
                                        </div>
                                    </form>
                                    <div class="new-account mt-3">
                                        <p>Don't have an account? <a class="text-primary" href="register.php">Sign up</a></p>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    include 'theme/connection.php';
if (isset($_POST['submit'])) {
   $user = $_POST['USERNAME'];
   $pass = $_POST['PASSWORD'];

   $query=mysqli_query($db,"select * from `useraccount` where username='".$user."' AND password = '".$pass."'");
  $num_rows=mysqli_num_rows($query);
  $row=mysqli_fetch_array($query);
  
  if ($num_rows>0){
    
    
    if($row['usertype']=='Administrator'){
    $_SESSION["name"]=$row['name'];
?>
    <script>
alert('You Have Successfully Login as Administrator');
window.location="index.php";
 </script>
    <?php
    }elseif($row['usertype']=='Student'){
  $studquery=mysqli_query($db,"select * from `student` where idno = '".$row['idno']."'");
  $row1=mysqli_fetch_array($studquery);
    //$_SESSION["studid"]=$row1['idno'];
  if($row1['status']==1){
    $_SESSION["sname"]=$row1['studentname'];
    $_SESSION["studid"]=$row1['idno'];
    $_SESSION["coursename"]=$row1['coursename'];
    $_SESSION["yearlevel"]=$row1['yearlevel'];
    $_SESSION["section"]=$row1['section'];
}else{
    ?>
    <script>
alert('Your status is pending! Please wait for the approval!');
window.location="login.php";
 </script>
    <?php
    //$_SESSION["sname"]=$row1['name'];
}
?>
    <script>
alert('You Have Successfully Login as Student');
window.location="student";
 </script>
 <?php
    }elseif($row['usertype']=='Faculty'){
    $facquery=mysqli_query($db,"select * from `faculty` where facidno = '".$row['idno']."'");
  $row2=mysqli_fetch_array($facquery);
    //$_SESSION["studid"]=$row1['idno'];
    $_SESSION["fname"]=$row2['facultyname'];
    $_SESSION["facidno"]=$row2['facidno'];
    $_SESSION["depid"]=$row2['depid'];
    $_SESSION["eval_type"]=$row2['eval_type'];
    ?>
    <script>
alert('You Have Successfully Login as faculty');
window.location="evaluators";
 </script>
 <?php
    }
  }
  else{
  ?>
    <script>
document.getElementById("BAL").innerHTML ='<p class="alert alert-danger text-center" id="alert"><i class="la la-exclamation-triangle"></i> Incorrect Username or Password!</p>';
 </script>
    <?php

  }
   // code...
}
?>

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="vendor/global/global.min.js"></script>
	<script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/dlabnav-init.js"></script>

</body>

</html>