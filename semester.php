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
                            <h4>All Semester</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0);">Semester</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0);">All Semester</a></li>
                        </ol>
                    </div>
                </div>
				
				<div class="row">
					<div class="col-lg-12">
						<div class="row tab-content">
							<div id="list-view" class="tab-pane fade active show col-lg-12">
								<div class="card">
									<div class="card-header">
										<h4 class="card-title">All Semester</h4>
										<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Addnew">+ Add new</button>
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table id="example3" class="display" style="min-width: 845px">
												<thead>
													<tr>
														<th>ID</th>
														<th>School Year</th>
														<th>Semester Name</th>
														<th>Status</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
													<?php
													$query = "SELECT * FROM schoolyear ";
                    								$result = mysqli_query($db, $query) or die (mysqli_error($db));
                  
                       								 while ($row = mysqli_fetch_assoc($result)) {
													?>
													<tr>
													<td><?php echo $row['syid']; ?></td>
													<td><?php echo $row['sy']; ?></td>	
													<td><?php echo $row['semester']; ?></td>
													<?php
													if($row['isDefault']==1){
													?>
													<td><span class="badge badge-success">Active</span></td>
													<?php
												}else{
													?>
													<td><span class="badge badge-danger">In-Active</span></td>
													<?php
												}
													?>	
													<td><a type="button" class="btn btn-sm btn-warning" href="#" data-toggle="modal" data-target="#Update<?php echo $row['syid']; ?>"><i class="ti ti-pencil"></i> Edit</a>
														<div class="modal fade" id="Update<?php echo $row['syid']; ?>">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Update Semester</h5>
                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                    </button>
                                                </div>
                                                <form method="POST" action="#">
                                                <div class="modal-body">
                                                	<div class="row">
										<div class="col-sm-12">
											<div class="form-group">
												<label class="form-label">Academic Year</label>
												<input type="hidden" name="syid" value="<?php echo $row['syid']; ?>">
												<input type="text" name="sy" placeholder="Enter Academic Year" value="<?php echo $row['sy']; ?>" class="form-control">
											</div>
										</div>
                                                </div>
                                                <div class="row">
										<div class="col-sm-12">
											<div class="form-group">
												<label class="form-label">Semester</label>
												<input type="text" name="semester" placeholder="Enter Semester" value="<?php echo $row['semester']; ?>" class="form-control">
											</div>
										</div>
                                                </div>
                                                <div class="row">
										<div class="col-sm-12">
											<div class="form-group">
												<label class="form-label">Is Default</label>
												<select name="isDefault" class="form-control">
												<option value="0">No</option>
												<option value="1">Yes</option>
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
                                                    <h5 class="modal-title">Add New Academic Year</h5>
                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                    </button>
                                                </div>
                                                <form method="POST" action="#">
                                                <div class="modal-body">
                                                	<div class="row">
										<div class="col-sm-12">
											<div class="form-group">
												<label class="form-label">Academic Year</label>
												<input type="text" name="sy" placeholder="Enter Academic Year" class="form-control">
											</div>
										</div>
                                                </div>
                                                <div class="row">
										<div class="col-sm-12">
											<div class="form-group">
												<label class="form-label">Semester</label>
												<input type="text" name="semester" placeholder="Enter Semester" class="form-control">
											</div>
										</div>
                                                </div>
                                                <div class="row">
										<div class="col-sm-12">
											<div class="form-group">
												<label class="form-label">Is Default</label>
												<select name="isDefault" class="form-control">
												<option value="0">No</option>
												<option value="1">Yes</option>
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
   

   $sy = $_POST['sy'];
   $semester = $_POST['semester'];
   $isDefault = $_POST['isDefault'];

  $query = "INSERT INTO `schoolyear` (`sy`,`semester`,`isDefault`)
                VALUES ('".$sy."','".$semester."','".$isDefault."')";
                mysqli_query($db,$query)or die (mysqli_error($db));

 // $queryacc = "INSERT INTO `useraccount` (`idno`,`name`,`username`,`password`,`usertype`)
 //                VALUES ('".$idno."','".$facultyname."','".$username."','".$password."','Faculty')";
 //                mysqli_query($db,$queryacc)or die (mysqli_error($db));

                             ?>
                <script type="text/javascript">
      alert("New Academic Year was Added Successfully!.");
      window.location = "semester.php";
    </script>
    <?php
}elseif(isset($_POST['update'])){


              $syid = $_POST['syid'];
              $sy = $_POST['sy'];
              $semester = $_POST['semester'];
              $isDefault = $_POST['isDefault'];

  $query = "UPDATE `schoolyear` SET `sy`='".$sy."',`semester`='".$semester."',`isDefault`='".$isDefault."' WHERE `syid`='".$syid."'";
                mysqli_query($db,$query)or die (mysqli_error($db));

                ?>
                <script type="text/javascript">
      alert("Academic Year was Updated Successfully!.");
      window.location = "semester.php";
    </script>
    <?php
}
include "theme/sidebar.php";
include "theme/footer.php";
    ?>