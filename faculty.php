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
                            <h4>All Faculties</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0);">Faculties</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0);">All Faculties</a></li>
                        </ol>
                    </div>
                </div>
				
				<div class="row">
					<div class="col-lg-12">
						<div class="row tab-content">
							<div id="list-view" class="tab-pane fade active show col-lg-12">
								<div class="card">
									<div class="card-header">
										<h4 class="card-title">All Faculties  </h4>
										<div class="btn-group">
										<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Addnew">+ Add new</button>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AddCSV">+ Upload CSV</button>
                                    </div>
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table id="example3" class="display" style="min-width: 845px">
												<thead>
													<tr>
														<th>Faculty ID</th>
														<th>Name</th>
														<th>Email</th>
                                                        <th>Designation</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
													<?php
													$query = "SELECT * FROM faculty";
                    								$result = mysqli_query($db, $query) or die (mysqli_error($db));
                  
                       								 while ($row = mysqli_fetch_assoc($result)) {
													?>
													<tr>
													<td><?php echo $row['facidno']; ?></td>	
													<td><?php echo $row['facultyname']; ?></td>	
													<td><?php echo $row['email']; ?></td>
                                                    <td><?php echo $row['eval_type']; ?></td>
													<td><a type="button" class="btn btn-sm btn-warning" href="#" data-toggle="modal" data-target="#Update<?php echo $row['facultyid']; ?>"><i class="ti ti-pencil"></i> Edit</a>
													<div class="modal fade" id="Update<?php echo $row['facultyid']; ?>">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Update Faculty</h5>
                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                    </button>
                                                </div>
                                                <form method="POST" action="#">
                                                <div class="modal-body">
                                                	<div class="row">
										<div class="col-sm-12">
											<div class="form-group">
												<label class="form-label">Employee ID #</label>
												<input type="hidden" name="fid" value="<?php echo $row['facultyid']; ?>">
												<input type="text" name="idno" placeholder="Employee ID Number" value="<?php echo $row['facidno']; ?>" class="form-control">
											</div>
										</div>
										<div class="col-sm-12">
											<div class="form-group">
												<label class="form-label">Full Name</label>
												<input type="text" placeholder="Full Name" name="facultyname" value="<?php echo $row['facultyname']; ?>" class="form-control">
											</div>
										</div>
										<div class="col-sm-12">
											<div class="form-group">
												<label class="form-label">Email</label>
												<input type="text" name="email" placeholder="Email" value="<?php echo $row['email']; ?>" class="form-control">
											</div>
										</div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label">Evaluator Type</label>
                                                <select class="form-control" name="eval_type">
                                                    <option value="Faculty">Faculty</option>
                                                    <option value="Supervisor">Supervisor</option>
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
													
												<a type="button" class="btn btn-sm btn-success" href="#" data-toggle="modal" data-target="#Assign<?php echo $row['facultyid']; ?>"><i class="la la-plus-square-o"></i> Assign Course</a>
                                                <a type="button" class="btn btn-sm btn-primary" href="assigned.php?facultyid=<?php echo $row['facultyid'] ?>"><i class="la la-eye"></i> Assigned Course(s)</a>

												<div class="modal fade" id="Assign<?php echo $row['facultyid']; ?>">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Assign Course</h5>
                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                    </button>
                                                </div>
                                                <form method="POST" action="#">
                                                <div class="modal-body">
                                                	<div class="row">
                                                		<div class="col-sm-12">
											<div class="form-group">
												<label class="form-label">Schoolyear & Semester</label>
												 <?php
                              $sysql = "SELECT * FROM `schoolyear` WHERE isDefault=1";
                              $syresult = mysqli_query($db, $sysql) or die (mysqli_error($db));
                              $rowsy = mysqli_fetch_assoc($syresult);
                              ?>
                              <input type="text" readonly class="form-control" name="" value="<?php echo $rowsy['sy'].' - '.$rowsy['semester']; ?>">
                              <input type="hidden" name="sy" value="<?php echo $rowsy['syid']; ?>">
											</div>
										</div>
                                                		<div class="col-sm-12">
											<div class="form-group">
												<label class="form-label">Course</label>
												 <?php
                              $csql = "SELECT * FROM `course`";
                              $cresult = mysqli_query($db, $csql) or die (mysqli_error($db));
                              ?>
                            <select class="form-control" name="course">
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
										<div class="col-sm-12">
											<div class="form-group">
												<label class="form-label">Subject</label>
												<input type="hidden" name="fac" value="<?php echo $row['facultyid']; ?>">
												<?php
                              $subsql = "SELECT * FROM `subject`";
                              $subresult = mysqli_query($db, $subsql) or die (mysqli_error($db));
                              ?>
                            <select class="form-control select2" name="subject" id="single-select">
                              <?php
                              while($rowsub = mysqli_fetch_assoc($subresult)){
                                ?>
                                <option value="<?php echo $rowsub['subjectid']; ?>"><?php echo $rowsub['subjectname'] ;?></option>
                                <?php
                              }
                              ?>
                          </select>
											</div>
										</div>
										<div class="col-sm-12">
											<div class="form-group">
												<label class="form-label">Year Level</label>
												<select class="form-control" name="yearlevel">
                        	<option value="1">First Year</option>
                        	<option value="2">Secoond Year</option>
                        	<option value="3">Third Year</option>
                        	<option value="4">Fourth Year</option>
                        	<option value="5">Fifth Year</option>
                        </select>
											</div>
										</div>
										<div class="col-sm-12">
											<div class="form-group">
												<label class="form-label">Section</label>
												<select class="form-control" name="section">
                        	<option value="1">1</option>
                        	<option value="2">2</option>
                        	<option value="3">3</option>
                        	<option value="4">4</option>
                        	<option value="5">5</option>
                        </select>
											</div>
										</div>
                                                </div>
                                            </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" name="Assign" class="btn btn-primary">Save changes</button>
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
                                                    <h5 class="modal-title">Add New Faculty</h5>
                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                    </button>
                                                </div>
                                                <form method="POST" action="#">
                                                <div class="modal-body">
                                                	<div class="row">
										<div class="col-sm-12">
											<div class="form-group">
												<label class="form-label">Employee ID #</label>
												<input type="text" name="idno" placeholder="Employee ID Number" class="form-control">
											</div>
										</div>
										<div class="col-sm-12">
											<div class="form-group">
												<label class="form-label">Full Name</label>
												<input type="text" placeholder="Full Name" name="facultyname" class="form-control">
											</div>
										</div>
										<div class="col-sm-12">
											<div class="form-group">
												<label class="form-label">Email</label>
												<input type="text" name="email" placeholder="Email" class="form-control">
											</div>
										</div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label">Evaluator Type</label>
                                                <select class="form-control" name="eval_type">
                                                    <option value="Faculty">Faculty</option>
                                                    <option value="Supervisor">Supervisor</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label">Username</label>
                                                <input type="text" placeholder="Username" name="username" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label">Password</label>
                                                <input type="password" name="password" placeholder="Password" class="form-control">
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

                                    <div class="modal fade" id="AddCSV">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Add New Faculty</h5>
                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                    </button>
                                                </div>
                                                <form method="POST" action="uploadfaccsv.php" enctype="multipart/form-data">
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
 if(isset($_POST['submit'])){
   

   $facultyname = $_POST['facultyname'];
 $idno = $_POST['idno'];
 $email = $_POST['email'];
 $username = $_POST['username'];
 $password = $_POST['password'];
 $eval_type = $_POST['eval_type'];

  $query = "INSERT INTO `faculty` (`facidno`,`facultyname`,`email`,`eval_type`)
                VALUES ('".$idno."','".$facultyname."','".$email."','".$eval_type."')";
                mysqli_query($db,$query)or die (mysqli_error($db));

 $queryacc = "INSERT INTO `useraccount` (`idno`,`name`,`username`,`password`,`usertype`)
                VALUES ('".$idno."','".$facultyname."','".$username."','".$password."','Faculty')";
                mysqli_query($db,$queryacc)or die (mysqli_error($db));

                             ?>
                <script type="text/javascript">
      alert("New Faculty was Added Successfully!.");
      window.location = "faculty.php";
    </script>
    <?php
}elseif(isset($_POST['update'])){


              $idno = $_POST['idno'];
              $facultyname = $_POST['facultyname'];
              $email = $_POST['email'];
              $eval_type = $_POST['eval_type'];
              $id = $_POST['fid'];

  $query = "UPDATE `faculty` SET `facidno`='".$idno."',`facultyname`='".$facultyname."',`email`='".$email."',`eval_type`='".$eval_type."' WHERE `facultyid`='".$id."'";
                mysqli_query($db,$query)or die (mysqli_error($db));

                ?>
                <script type="text/javascript">
      alert("New Faculty was Updated Successfully!.");
      window.location = "faculty.php";
    </script>
    <?php
}elseif(isset($_POST['Assign'])){
   

  //$ccode = $_POST['ccode'];
 $fac = $_POST['fac'];
 $course = $_POST['course'];
 $subject = $_POST['subject'];
 $section = $_POST['section'];
 $yearlevel = $_POST['yearlevel'];
 $sy = $_POST['sy'];

  $query = "INSERT INTO `class` (`facultyid`,`coursename`,`subjectid`,`yearlevel`,`section`,`syid`)
                VALUES ('".$fac."','".$course."','".$subject."','".$yearlevel."','".$section."','".$sy."')";
                mysqli_query($db,$query)or die (mysqli_error($db));
                ?>
                <script type="text/javascript">
      alert("New Class was Added Successfully!.");
      window.location = "faculty.php";
    </script>
    <?php
}
include "theme/sidebar.php";
include "theme/footer.php";
    ?>