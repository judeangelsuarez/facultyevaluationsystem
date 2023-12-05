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
                            <h4>All Program</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0);">Program</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0);">All Program</a></li>
                        </ol>
                    </div>
                </div>
				
				<div class="row">
					<div class="col-lg-12">
						<div class="row tab-content">
							<div id="list-view" class="tab-pane fade active show col-lg-12">
								<div class="card">
									<div class="card-header">
										<h4 class="card-title">All Program</h4>
										<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Addnew">+ Add new</button>
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table id="example3" class="display" style="min-width: 845px">
												<thead>
													<tr>
														<th>ID</th>
														<th>Program Name</th>
                                                        <th>Description</th>
                                                        <th>Department</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
													<?php
													$query = "SELECT *,d.department as 'dep' FROM course c LEFT JOIN department d ON d.depid = c.department";
                    								$result = mysqli_query($db, $query) or die (mysqli_error($db));
                  
                       								 while ($row = mysqli_fetch_assoc($result)) {
													?>
													<tr>
													<td><?php echo $row['courseid']; ?></td>	
													<td><?php echo $row['coursename']; ?></td>	
                                                    <td><?php echo $row['coursedesc']; ?></td> 
                                                    <td><?php echo $row['dep']; ?></td> 
													<td><a type="button" class="btn btn-sm btn-warning" href="#" data-toggle="modal" data-target="#Update<?php echo $row['courseid']; ?>"><i class="ti ti-pencil"></i> Edit</a>
														
														<div class="modal fade" id="Update<?php echo $row['courseid']; ?>">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Update Program</h5>
                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                    </button>
                                                </div>
                                                <form method="POST" action="#">
                                                <div class="modal-body">
                                                	<div class="row">
										<div class="col-sm-12">
											<div class="form-group">
												<label class="form-label">Program Name</label>
												<input type="hidden" name="courseid" value="<?php echo $row['courseid']; ?>">
												<input type="text" name="coursename" placeholder="Enter Program" value="<?php echo $row['coursename']; ?>" class="form-control">
											</div>
										</div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label">Description</label>
                                                <input type="text" name="coursedesc" placeholder="Enter Description" value="<?php echo $row['coursedesc']; ?>" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label">Department</label>
                                                 <?php
                              $csql = "SELECT * FROM `department`";
                              $cresult = mysqli_query($db, $csql) or die (mysqli_error($db));
                              ?>
                            <select class="form-control" name="department">
                              <?php
                              while($rowc = mysqli_fetch_assoc($cresult)){
                                ?>
                                <option value="<?php echo $rowc['depid']; ?>"><?php echo $rowc['department'] ;?></option>
                                <?php
                              }
                              ?>
                          </select>
                                            </div>
                                        </div>
                                                </div>
                                            </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" name="update" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </form>
                                            </div>
                                        </div>
                                    </div>
													</td>										
													</tr>
													<?php
												}
													?>
												</tbody>
											</table>
										</div>
									</div>
                                </div>
                            </div>
						</div>
					</div>
				</div>
				
            </div>
        </div>
        <div class="modal fade" id="Addnew">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Add New Program</h5>
                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                    </button>
                                                </div>
                                                <form method="POST" action="#">
                                                <div class="modal-body">
                                                	<div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label">Program Name</label>
                                                <input type="text" name="coursename" placeholder="Enter Program" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label">Description</label>
                                                <input type="text" name="coursedesc" placeholder="Enter Description" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label">Department</label>
                                                 <?php
                              $csql = "SELECT * FROM `department`";
                              $cresult = mysqli_query($db, $csql) or die (mysqli_error($db));
                              ?>
                            <select class="form-control" name="department">
                              <?php
                              while($rowc = mysqli_fetch_assoc($cresult)){
                                ?>
                                <option value="<?php echo $rowc['depid']; ?>"><?php echo $rowc['department'] ;?></option>
                                <?php
                              }
                              ?>
                          </select>
                                            </div>
                                        </div>
                                                </div>
                                            </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" name="submit" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </form>
                                            </div>
                                        </div>
                                    </div>
        <?php
 if(isset($_POST['submit'])){
   

   $coursename = $_POST['coursename'];
   $coursedesc = $_POST['coursedesc'];
   $department = $_POST['department'];

  $query = "INSERT INTO `course` (`coursename`,`coursedesc`,`department`)
                VALUES ('".$coursename."','".$coursedesc."','".$department."')";
                mysqli_query($db,$query)or die (mysqli_error($db));

 // $queryacc = "INSERT INTO `useraccount` (`idno`,`name`,`username`,`password`,`usertype`)
 //                VALUES ('".$idno."','".$facultyname."','".$username."','".$password."','Faculty')";
 //                mysqli_query($db,$queryacc)or die (mysqli_error($db));

                             ?>
                <script type="text/javascript">
      alert("New Course was Added Successfully!.");
      window.location = "course.php";
    </script>
    <?php
}elseif(isset($_POST['update'])){


              $courseid = $_POST['courseid'];
              $coursename = $_POST['coursename'];
                $coursedesc = $_POST['coursedesc'];
              $department = $_POST['department'];

  $query = "UPDATE `course` SET `coursename`='".$coursename."',coursedesc='".$coursedesc."',department='".$department."' WHERE `courseid`='".$courseid."'";
                mysqli_query($db,$query)or die (mysqli_error($db));

                ?>
                <script type="text/javascript">
      alert("Course was Updated Successfully!.");
      window.location = "course.php";
    </script>
    <?php
}

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
            $("#example3").html(data); 
           
        }
    });
});
</script>