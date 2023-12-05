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
                            <h4>All Asigned Course(s)</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0);">Asigned Course(s)</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0);">All Asigned Course(s)</a></li>
                        </ol>
                    </div>
                </div>
                <div class="btn-group mb-2">
                <a href="faculty.php" class="btn btn-warning btn-md"> Back</a>
                </div>
				
				<div class="row">
					<div class="col-lg-12">
						<div class="row tab-content">
							<div id="list-view" class="tab-pane fade active show col-lg-12">
								<div class="card">
									<div class="card-header">
										<h4 class="card-title">All Asigned Course(s) </h4>
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table id="example3" class="display" style="min-width: 845px">
												<thead>
													<tr>
														<th>Faculty ID</th>
														<th>Name</th>
														<th>Program</th>
                                                        <th>Year Level</th>
                                                        <th>Section</th>
													</tr>
												</thead>
												<tbody>
													<?php
													$query = "SELECT c.facultyid,facultyname,coursename,yearlevel,section FROM class c LEFT JOIN faculty f ON f.facultyid = c.facultyid WHERE c.facultyid = '{$_GET['facultyid']}'";
                    								$result = mysqli_query($db, $query) or die (mysqli_error($db));
                  
                       								 while ($row = mysqli_fetch_assoc($result)) {
													?>
													<tr>
													<td><?php echo $row['facultyid']; ?></td>	
													<td><?php echo $row['facultyname']; ?></td>	
													<td><?php echo $row['coursename']; ?></td>
                                                    <td><?php echo $row['yearlevel']; ?></td>
                                                    <td><?php echo $row['section']; ?></td>									
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
    <?php
include "theme/sidebar.php";
include "theme/footer.php";
    ?>