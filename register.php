<?php
include 'theme/connection.php';
?>

<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Faculty Evaluation - Login </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <link href="vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>

<body class="h-100" style="background-image: url('back.jpg');opacity: 1.8;">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <center><img src="logo.png" width="50%"></center>
                    <div class="authincation-content" style="background-color:rgba(255, 255, 255, 0.5);">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                            <div class="auth-form">
                                    <h4 class="text-center mb-4">Sign up your account</h4>
                                    <form action="#" method="POST">
                                        <div class="form-group">
                                            <label><strong>IDNO</strong></label>
                                            <input type="text" name="idno" class="form-control" placeholder="ID Number">
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Full Name</strong></label>
                                            <input type="text" name="studentname" class="form-control" placeholder="Full Name">
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Course</strong></label>
                                            <?php
                               $ysql = "SELECT * FROM `course`";
                               $yresult = mysqli_query($db, $ysql) or die (mysqli_error($db));
                               ?>
                                <select class="form-control" name="coursename">
                              <?php
                              while($rowy = mysqli_fetch_assoc($yresult)){
                                ?>
                                <option value="<?php echo $rowy['coursename']; ?>"><?php echo $rowy['coursename'] ;?></option>
                                <?php
                              }
                              ?>
                            </select>
                        </div>
                                        <div class="row">
                                        <div class="col-sm-6">
                        <div class="form-group">
                                            <label><strong>Year Level</strong></label>
                                            <select name="yearlevel" class="form-control">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            </select>
                                        </div>
                    </div>
                    <div class="col-sm-6">
                            <div class="form-group">
                                            <label><strong>Section</strong></label>
                                            <select name="section" class="form-control">
                                            <option value="A">A</option>
                                            <option value="B">B</option>
                                            <option value="C">C</option>
                                            <option value="D">D</option>
                                            <option value="E">E</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                        <div class="form-group">
                                            <label><strong>Username</strong></label>
                                            <input type="text" name="username" class="form-control" placeholder="Username">
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Password</strong></label>
                                            <input type="password" name="password" class="form-control" placeholder="Password">
                                        </div>
                                        <div class="text-center mt-4">
                                            <button type="submit" name="Submit" class="btn btn-success btn-block">Sign me up</button>
                                        </div>
                                    </form>
                                    <div class="new-account mt-3">
                                        <p>Already have an account? <a class="text-primary" href="login.php">Sign in</a></p>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div><br>
                </div>
            </div>
        </div>
    </div>
   <?php
if(isset($_POST['Submit'])){
$studentname = $_POST['studentname'];
 $coursename = $_POST['coursename'];
 $idno = $_POST['idno'];
 $yearlevel = $_POST['yearlevel'];
 $section = $_POST['section'];
 $username = $_POST['username'];
 $password = $_POST['password'];

  $query = "INSERT INTO `student` (`idno`,`studentname`,`coursename`,`yearlevel`,`section`)
                VALUES ('".$idno."','".$studentname."','".$coursename."','".$yearlevel."','".$section."')";
                mysqli_query($db,$query)or die (mysqli_error($db));

 $queryacc = "INSERT INTO `useraccount` (`idno`,`name`,`username`,`password`,`usertype`)
                VALUES ('".$idno."','".$studentname."','".$username."','".$password."','Student')";
                mysqli_query($db,$queryacc)or die (mysqli_error($db));

                             ?>
                <script type="text/javascript">
      alert("You Have Registered Successfully!.");
      window.location = "login.php";
    </script>
    <?php
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
    
    <!-- Svganimation scripts -->
    <script src="vendor/svganimation/vivus.min.js"></script>
    <script src="vendor/svganimation/svg.animation.js"></script>
    <script src="js/styleSwitcher.js"></script>

</body>

</html>