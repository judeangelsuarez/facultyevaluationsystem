<style type="text/css">
  @media print {
  .no-print, .main-sidebar,
  .main-header,
  .content-header {
    display: none !important;
  }
</style>
<?php
include "theme/header.php";
include "theme/connection.php";
include "theme/topnav.php";
?>
<div class="content-body">
            <!-- row -->
            <div class="container-fluid">
				    
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>All Department</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0);">Department</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0);">All Department</a></li>
                        </ol>
                    </div>
                </div>
				
				<div class="row">
					<div class="col-lg-12">
						<div class="row tab-content">
							<div id="list-view" class="tab-pane fade active show col-lg-12">
								<div class="card">
									<div class="card-body">
										

											
                                                	<div class="row">
                                                		
                                                		<div class="col-sm-4">
											<div class="form-group">
												<label class="form-label">Course</label>
												 <?php
                              $csql = "SELECT * FROM `course` WHERE department = ".$_GET['depid']."";
                              $cresult = mysqli_query($db, $csql) or die (mysqli_error($db));
                              ?>
                            <select class="form-control crs" name="course" id="crs">
                              <?php
                              while($rowc = mysqli_fetch_assoc($cresult)){
                                ?>
                                <option value="<?php echo $rowc['coursename']; ?>"><?php echo $rowc['coursename'] ;?></option>
                                <?php
                              }
                              ?>
                          </select>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-group">
												<label class="form-label">Year Level</label>
												<select class="form-control yl" name="yearlevel" id="yl">
                        	<option value="1">First Year</option>
                        	<option value="2">Second Year</option>
                        	<option value="3">Third Year</option>
                        	<option value="4">Fourth Year</option>
                        	<option value="5">Fifth Year</option>
                        </select>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-group">
												<label class="form-label">Section</label>
												<select class="form-control sec" name="section">
												<option disabled selected>--Select Item--</option>
                        	<option value="1">1</option>
                        	<option value="2">2</option>
                        	<option value="3">3</option>
                        	<option value="4">4</option>
                        	<option value="5">5</option>
                        </select>
											</div>
										</div>
                                                </div><br>
                                                
                                                <div id="table-container"></div>
                                                
										</div>
									</div>
                                </div>
                            </div>
						</div>
					</div>
				</div>
				
            </div>
    <?php
include "theme/sidebar.php";
include "theme/footer.php";
    ?>
    <script type="text/javascript">

    $('.sec').on('change', function() {
      var sec = $(this).val();
      var crs = $('#crs').val();
      var yl = $('#yl').val();
      //alert(yl);
      $.ajax({    
        type: "POST",
        url: "action.php",
        data:{sec:sec,crs:crs,yl:yl},           
        dataType: "html",                  
        success: function(data){                    
            $("#table-container").html(data); 
           
        }
    });
});
</script>