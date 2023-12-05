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
                            <h4>All Subject</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0);">Subject</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0);">All Subject</a></li>
                        </ol>
                    </div>
                </div>
				
				<div class="row">
					<div class="col-lg-12">
						<div class="row tab-content">
							<div id="list-view" class="tab-pane fade active show col-lg-12">
								<div class="card">
									<div class="card-header">
										<h4 class="card-title">All Subject</h4>
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
														<th>ID</th>
														<th>Subject Name</th>
                                                        <th>Description</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
													<?php
													$query = "SELECT * FROM subject ";
                    								$result = mysqli_query($db, $query) or die (mysqli_error($db));
                  
                       								 while ($row = mysqli_fetch_assoc($result)) {
													?>
													<tr>
													<td><?php echo $row['subjectid']; ?></td>	
													<td><?php echo $row['subjectname']; ?></td>
                                                    <td><?php echo $row['subjectdesc']; ?></td>	
													<td><a type="button" class="btn btn-sm btn-warning" href="#" data-toggle="modal" data-target="#Update<?php echo $row['subjectid']; ?>"><i class="ti ti-pencil"></i> Edit</a>
														<div class="modal fade" id="Update<?php echo $row['subjectid']; ?>">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Update Subject</h5>
                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                    </button>
                                                </div>
                                                <form method="POST" action="#">
                                                <div class="modal-body">
                                                	<div class="row">
										<div class="col-sm-12">
											<div class="form-group">
												<label class="form-label">Subject Name</label>
												<input type="hidden" name="subjectid" value="<?php echo $row['subjectid']; ?>">
												<input type="text" name="subjectname" placeholder="Enter Subject" value="<?php echo $row['subjectname']; ?>" class="form-control">
											</div>
										</div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label">Description</label>
                                                <input type="text" name="subjectdesc" placeholder="Enter Description" value="<?php echo $row['subjectdesc']; ?>" class="form-control">
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
                                                    <h5 class="modal-title">Add New Subject</h5>
                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                    </button>
                                                </div>
                                                <form method="POST" action="#">
                                                <div class="modal-body">
                                                	<div class="row">
										<div class="col-sm-12">
											<div class="form-group">
												<label class="form-label">Subject Name</label>
												<input type="text" name="subjectname" placeholder="Enter Subject Name" class="form-control">
											</div>
										</div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label">Description</label>
                                                <input type="text" name="subjectdesc" placeholder="Enter Subject Description" class="form-control">
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
                                                    <h5 class="modal-title">Add New Subject</h5>
                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                    </button>
                                                </div>
                                                <form method="POST" action="uploadsubjcsv.php" enctype="multipart/form-data">
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
   

   $subjectname = $_POST['subjectname'];
   $subjectdesc = $_POST['subjectdesc'];

  $query = "INSERT INTO `subject` (`subjectname`,`subjectdesc`)
                VALUES ('".$subjectname."','".$subjectdesc."')";
                mysqli_query($db,$query)or die (mysqli_error($db));

 // $queryacc = "INSERT INTO `useraccount` (`idno`,`name`,`username`,`password`,`usertype`)
 //                VALUES ('".$idno."','".$facultyname."','".$username."','".$password."','Faculty')";
 //                mysqli_query($db,$queryacc)or die (mysqli_error($db));

                             ?>
                <script type="text/javascript">
      alert("New Subject was Added Successfully!.");
      window.location = "subject.php";
    </script>
    <?php
}elseif(isset($_POST['update'])){


              $subjectid = $_POST['subjectid'];
              $subjectname = $_POST['subjectname'];
              $subjectdesc = $_POST['subjectdesc'];

  $query = "UPDATE `subject` SET `subjectname`='".$subjectname."',subjectdesc='".$subjectdesc."' WHERE `subjectid`='".$subjectid."'";
                mysqli_query($db,$query)or die (mysqli_error($db));

                ?>
                <script type="text/javascript">
      alert("Subject was Updated Successfully!.");
      window.location = "subject.php";
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