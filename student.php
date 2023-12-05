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
                            <h4>All Students</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0);">Students</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0);">All Students</a></li>
                        </ol>
                    </div>
                </div>
				
				<div class="row">
					<div class="col-lg-12">
						<div class="row tab-content">
							<div id="list-view" class="tab-pane fade active show col-lg-12">
								<div class="card">
									<div class="card-header">
										<h4 class="card-title">All Students  </h4>
										<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AddCSV">+ Upload CSV</button>
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table id="example3" class="display" style="min-width: 845px">
												<thead>
													<tr>
														<th>ID #</th>
                      									<th>Student Name</th>
                      									<th>Course</th>
                      									<th>Year Level</th>
                      									<th>Status</th>
                      									<!-- <th>Action</th> -->
													</tr>
												</thead>
												<tbody>
													<?php
													$query = "SELECT * FROM student ";
                    								$result = mysqli_query($db, $query) or die (mysqli_error($db));
                  
                       								 while ($row = mysqli_fetch_assoc($result)) {
													?>
													<tr>
													<td><?php echo $row['idno']; ?></td>	
													<td><?php echo $row['studentname']; ?></td>	
													<td><?php echo $row['coursename']; ?></td>
													<td><?php echo $row['yearlevel']; ?></td>
													<?php
													if($row['status']==1){
													?>
													<td><span class="badge badge-success">Approved</span></td>
													<?php
												}else{
													?>
													<td><span class="badge badge-warning">Pending</span> <a href="student.php?idno=<?php echo $row['idno']; ?>" class="btn btn-primary">Approve</a></td>
													<?php
												}
													?>									
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
        <div class="modal fade" id="AddCSV">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Add New Faculty</h5>
                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                    </button>
                                                </div>
                                                <form method="POST" action="uploadstudcsv.php" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                     <label for="csvFile">Choose CSV File:</label>
                                                     <input type="file" name="csvFile" id="csvFile" accept=".csv" required>
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
if(isset($_GET['idno'])){
$update = "UPDATE student SET status = 1 WHERE idno = '".$_GET['idno']."'";
$istrue = mysqli_query($db, $update) or die (mysqli_error($db));
if($istrue==true){
?>
<script type="text/javascript">
alert('Student was approved successfully!');
window.location = 'student.php';
</script>
<?php
}

}

include "theme/sidebar.php";
include "theme/footer.php";
    ?>