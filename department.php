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
									<div class="card-header">
										<h4 class="card-title">All Department</h4>
										<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Addnew">+ Add new</button>
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table id="example3" class="display" style="min-width: 845px">
												<thead>
													<tr>
														<th>ID</th>
														<th>Department Name</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
													<?php
													$query = "SELECT * FROM department ";
                    								$result = mysqli_query($db, $query) or die (mysqli_error($db));
                  
                       								 while ($row = mysqli_fetch_assoc($result)) {
													?>
													<tr>
													<td><?php echo $row['depid']; ?></td>	
													<td><?php echo $row['department']; ?></td>	
													<td><a type="button" class="btn btn-sm btn-warning" href="#" data-toggle="modal" data-target="#Update<?php echo $row['depid']; ?>"><i class="ti ti-pencil"></i> Edit</a>
														<a class="btn btn-sm btn-info" href="view.php?depid=<?php echo $row['depid']; ?>"><i class="ti ti-eye"></i> View</a>
														<div class="modal fade" id="Update<?php echo $row['depid']; ?>">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Update Department</h5>
                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                    </button>
                                                </div>
                                                <form method="POST" action="#">
                                                <div class="modal-body">
                                                	<div class="row">
										<div class="col-sm-12">
											<div class="form-group">
												<label class="form-label">Department Name</label>
												<input type="hidden" name="depid" value="<?php echo $row['depid']; ?>">
												<input type="text" name="department" placeholder="Enter Department" value="<?php echo $row['department']; ?>" class="form-control">
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
                                                    <h5 class="modal-title">Add New Department</h5>
                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                    </button>
                                                </div>
                                                <form method="POST" action="#">
                                                <div class="modal-body">
                                                	<div class="row">
										<div class="col-sm-12">
											<div class="form-group">
												<label class="form-label">Department Name</label>
												<input type="text" name="department" placeholder="Enter Department Name" class="form-control">
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
   

   $department = $_POST['department'];

  $query = "INSERT INTO `department` (`department`)
                VALUES ('".$department."')";
                mysqli_query($db,$query)or die (mysqli_error($db));

 // $queryacc = "INSERT INTO `useraccount` (`idno`,`name`,`username`,`password`,`usertype`)
 //                VALUES ('".$idno."','".$facultyname."','".$username."','".$password."','Faculty')";
 //                mysqli_query($db,$queryacc)or die (mysqli_error($db));

                             ?>
                <script type="text/javascript">
      alert("New Department was Added Successfully!.");
      window.location = "department.php";
    </script>
    <?php
}elseif(isset($_POST['update'])){


              $depid = $_POST['depid'];
              $department = $_POST['department'];

  $query = "UPDATE `department` SET `department`='".$department."' WHERE `depid`='".$depid."'";
                mysqli_query($db,$query)or die (mysqli_error($db));

                ?>
                <script type="text/javascript">
      alert("Department was Updated Successfully!.");
      window.location = "department.php";
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