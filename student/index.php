<?php
include "header.php";
include "topnav.php";
include "sidebar.php";
include "connection.php";
$acadyear=mysqli_query($db,"select * from `schoolyear` where isDefault = 1");
$row=mysqli_fetch_array($acadyear);
?>
<div class="content-body">
            <!-- row -->
            <div class="container-fluid">
				    
                <div class="row">
					<div class="col-12">
    <div class="card">
      <div class="card-body">
        <br>
        <div class="col-md-5">
          <div class="callout callout-info">
            <h5><b>Academic Year: <?php echo $row['sy'].' - '.$row['semester']; ?></b></h5>
            <!-- <h6><b>Evaluation Status: </b></h6> -->
          </div>
        </div>
      </div>
    </div>
</div>
				</div>
            </div>
        </div>
<?php
include "footer.php";
?>