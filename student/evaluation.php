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
				    <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Evaluation Form</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0);">Evaluation</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0);">Evaluate Teacher</a></li>
                        </ol>
                    </div>
                </div>
                <div class="row">
				    
	                <div class="col-12 col-md-12">
		                <div class="card shadow-sm p-4">
						    <div class="card-body">
			    <h1 class="card-header">Select Faculty</h1>
							    <form class="settings-form" method="POST" action="#">
									<div class="mb-3">
										 <div class="col-md-12">
									    <label for="setting-input-2" class="form-label">Faculty</label>
									    <fieldset class="form-group">
                                                    
                                                     <?php
                              $ysql = "SELECT *,c.facultyid as 'fac' FROM `class` c LEFT JOIN `faculty` f ON f.facultyid = c.facultyid LEFT JOIN subject s ON s.subjectid = c.subjectid LEFT JOIN `schoolyear` sy ON sy.syid = c.syid WHERE c.coursename = '".$_SESSION['coursename']."' AND c.yearlevel = ".$_SESSION['yearlevel']." AND c.section='".$_SESSION['section']."' AND c.facultyid NOT IN (SELECT facultyid from evaluation WHERE studentid = '".$_SESSION['studid']."')";
                              $yresult = mysqli_query($db, $ysql) or die (mysqli_error($db));
                              ?>
                            <select class="form-control select2 facc" name="class_id">
                            	<option disabled selected>--Select Faculty--</option>
                              <?php
                              while($rowy = mysqli_fetch_assoc($yresult)){
                                ?>
                                <option value="<?php echo $rowy['class_id']; ?>"><?php echo $rowy['facultyname'].' - '.$rowy['subjectname'] ;?></option>
                                <?php
                              }
                              ?>
                          </select>
                                                </fieldset>
									</div>
								</div>
									<button type="submit" disabled id="SelBtn" name="teacher" class="btn btn-primary">Select</button>
							    </form>
						    </div><!--//app-card-body-->
						    
						</div><!--//app-card-->
	                </div>
	                <?php
	                if(isset($_POST['teacher'])){
	                	                     
                              $teach = "SELECT *,c.facultyid as 'fac' FROM `class` c LEFT JOIN `faculty` f ON f.facultyid = c.facultyid LEFT JOIN subject s ON s.subjectid = c.subjectid LEFT JOIN `schoolyear` sy ON sy.syid = c.syid WHERE c.class_id = '".$_POST['class_id']."'";
                              $teachresult = mysqli_query($db, $teach) or die (mysqli_error($db));
                              $rowteach = mysqli_fetch_assoc($teachresult);
	                ?>
	                <div class="col-12 col-md-12">
		                <div class="app-card app-card-settings shadow-sm p-4">
						    <div class="app-card-body">
							    <form class="settings-form" action="controller.php" method="POST">
							    	<input type="hidden" name="class_id" value="<?php echo $rowteach['class_id']; ?>">
							    	<input type="hidden" name="facultyid" value="<?php echo $rowteach['facultyid']; ?>">
							    	<input type="hidden" name="sy" value="<?php echo $rowteach['syid']; ?>">
							    	<input type="hidden" name="studentid" value="<?php echo $_SESSION['studid']; ?>">
							    	<p class="text-center"><strong>FACULTY TEACHING PERFORMANCE EVALUATION INSTRUMENT</strong></p><br>
					<div class="row text-center">
						<div class="col-md-6">
					<p>Name of Faculty: <i style="text-decoration-line: underline;"><?php echo $rowteach['facultyname']; ?></i></p>
				</div>
						
				<div class="col-md-6">
					<p>Term/Semester: <u><i><?php echo $row['semester']; ?></i></u></p>
				</div>
				</div><br>
				<div class="row text-center">
					<div class="col-md-6">
					<p>Course Taught: <u><i><?php echo $rowteach['coursename'].' ('.$rowteach['subjectname'].')'; ?></i></u></p>
				</div>	
				<div class="col-md-6">
					<p>Academic Yr: <u><i><?php echo $row['sy']; ?></i></u></p>
				</div>
				</div><br>
				<p class="text-center">Evaluators:</p><br>
				<div class="row text-center">
					<div class="col-md-4"></div>
					<div class="col-md-2">
						<label>Self</label>
						<input type="radio" name="radio1" id="radio1">
					</div>
					<div class="col-md-2">
						<label>Peer</label>
						<input type="radio" name="radio1" id="radio1">
					</div>
					<div class="col-md-4"></div>
				</div>
				<div class="row text-center">
					<div class="col-md-4"></div>
					<div class="col-md-2">
						<label>Student</label>
						<input type="radio" checked name="radio1" id="radio1">
					</div>
					<div class="col-md-2">
						<label>Dean</label>
						<input type="radio" name="radio1" id="radio1">
					</div>
					<div class="col-md-4"></div>
				</div><br>
					<center>
				<div class="col-md-8">
				<p>Instruction: Please evaluate the faculty using the scale below. Check the radio button.</p>
			</div>
			</center>
									<div class="mb-3">
										<center>
										<div class="col-md-8">
										<fieldset class="border border-info p-2 w-100">
					   <legend  class="w-auto">Rating Legend</legend>
					   <p class="text-left">5 = Outstanding, 4 = Very Satisfactory, 3 = Satisfactory, 2 = Fair, 1 = Foor</p>
					</fieldset></div><br>
					<?php
$criteria = "SELECT * FROM `criteria`";
                              $cresult = mysqli_query($db, $criteria) or die (mysqli_error($db));
                              while($rowc = mysqli_fetch_assoc($cresult)){
					?>
					<div class="col-md-8">
					<fieldset class="border border-info p-2 w-100">
									    <label for="setting-input-2" class="form-label bg-info"><?php echo $rowc['criteria']; ?></label>
									    
									    <table class="table app-table-hover mb-0 text-left">
										<thead>
											<tr>
												<th class="cell">Questions</th>
												<th class="cell">1</th>
												<th class="cell">2</th>
												<th class="cell">3</th>
												<th class="cell">4</th>
												<th class="cell">5</th>
											</tr>
										</thead>
										<tbody>
<?php
$question = "SELECT * FROM `question` where criteriaid = '".$rowc['criteriaid']."'";
                              $qresult = mysqli_query($db, $question) or die (mysqli_error($db));
                              while($rowq = mysqli_fetch_assoc($qresult)){
?>
											<tr>
												<td class="cell"><?php echo $rowq['question']; ?></td>
												<?php for($c=1;$c<=5;$c++): ?>
								<td class="text-center">
									<input type="hidden" name="questionid[]" value="<?php echo $rowq['questionid']; ?>">
									<input type="hidden" name="criteriaid[]" value="<?php echo $rowq['criteriaid']; ?>">
										
				                        <input type="radio" name="rate[<?php echo $rowq['questionid']; ?>]" id="qradio<?php echo $rowq['questionid'].'_'.$c ?>" value="<?php echo $c ?>">
				                        <label for="qradio<?php echo $rowq['questionid'].'_'.$c ?>">
				                        </label>
								</td>
								<?php endfor; ?>
											</tr>
											<?php
}
											?>
											<!-- <tr>
												<td class="cell">Question 2</td>
												<td>
                                            		<input type="radio" name="answer1" id="answer1" value="yes" required>
                                        		</td>
												<td>
                                            		<input type="radio" name="answer1" id="answer1" value="yes" required>
                                        		</td>
												<td>
                                            		<input type="radio" name="answer1" id="answer1" value="yes" required>
                                        		</td>
												<td>
                                            		<input type="radio" name="answer1" id="answer1" value="yes" required>
                                        		</td>
												<td>
                                            		<input type="radio" name="answer1" id="answer1" value="yes" required>
                                        		</td>
											</tr> -->
										</tbody>
									</table>
								</fieldset></div><br>
									
										<?php
}
									    ?>
									  
								    </center>
								    	
								    	<center>
								    		<strong><label class="text-left">Comments/Suggestions:</label></strong>
								   <div class="col-md-8">
								   

								   	<textarea cols="50" rows="5" style="height: 100px;" class="form-control" name="comment">
								   	</textarea>
								   </div><br>
								   <button type="submit" name="save_eval" class="btn btn-info"><i class="la la-save"></i> Submit Evaluation</button>
								 </center>
								  
								   </div>
							    </form>
						    </div><!--//app-card-body-->
						    
						</div><!--//app-card-->
	                </div>
	                <?php
}
	                ?>
			    
	    
    </div>
				</div>
            </div>

<?php
include "footer.php";
?>
<script type="text/javascript">
$(document).on('change', '.facc', function(){
document.getElementById("SelBtn").disabled = false;
});
</script>