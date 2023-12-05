<?php
include "theme/connection.php";
if(isset($_POST['sec'])){
	$filter = "SELECT facultyname,studentname,s.coursename,s.yearlevel,s.section,sy.sy,semester,e.studentid FROM `evaluation` e LEFT JOIN faculty f ON f.facultyid = e.facultyid LEFT JOIN criteria c ON c.criteriaid = e.criteriaid LEFT JOIN student s ON s.idno = e.studentid LEFT JOIN class cl ON cl.class_id = e.class_id LEFT JOIN course crs ON crs.coursename = cl.coursename LEFT JOIN schoolyear sy ON sy.syid = e.sy WHERE s.coursename = '".$_POST['crs']."' AND s.yearlevel = '".$_POST['yl']."' AND s.section = '".$_POST['sec']."' GROUP BY e.studentid";
$filter_result = mysqli_query($db, $filter) or die (mysqli_error($db));
$resrow = mysqli_fetch_assoc($filter_result);
$numrows = mysqli_num_rows($filter_result);

?>
										    <div class="row align-items-center"><center><img src="logo.png" width="10%"></center><h6 class="text-center"><strong>CARLOS HILADO MEMORIAL STATE UNIVERSITY</strong></h6></div>
										    <p class="text-center" style="margin-top: -5px">Binalbagan Campus</p>
											<h2 class="text-center">Total of Faculty Evaluation Report</h2>
											<table width="50%">
												<tr>
												<td width="10%">Course/Yr & Section:</td>
												<td width="30%"><strong><?php echo isset($resrow['coursename']) ? $resrow['coursename'].' '.$resrow['yearlevel'].' - '.$resrow['section'] : 'NA'; ?></strong></td>
												</tr>
												<tr>
												<td width="10%">School year & Semester:</td>
												<td width="30%"><strong><?php echo isset($resrow['sy']) ? $resrow['sy'].' - '.$resrow['semester'] : 'NA'; ?></strong></td>
												</tr>
												<tr>
												<td width="10%">Total Evaluation:</td>
												<td width="30%"><strong><?php echo isset($numrows) ? $numrows: '0'; ?></strong></td>
												</tr>
											</table><br>


											<table id="datatable" class="display table-sm table table-striped" style="min-width: 845px">
												<thead>
													<tr>
														<th>Instructor</th>
														<th>Student</th>
														<th>Commitment</th>
														<th>Knowledge of Subject</th>
														<th>Teaching for Dependent Learning</th>
														<th>Management of Learning</th>
														<th>Over All Total</th>
														<th>Over All Average</th>
														<th>Comments/Suggestions</th>
														<th>Date and Time</th>
													</tr>
												</thead>
												<tbody>
													<?php
													$total = 0;
													$total1 = 0;
													$total2 = 0;
													$total3 = 0;
													$overall = 0;
													
													$query1 = "SELECT comment,facultyname,studentname,s.coursename,s.yearlevel,s.section,sy.sy,semester,e.studentid,evaluationdatetime FROM `evaluation` e LEFT JOIN faculty f ON f.facultyid = e.facultyid LEFT JOIN criteria c ON c.criteriaid = e.criteriaid LEFT JOIN student s ON s.idno = e.studentid LEFT JOIN class cl ON cl.class_id = e.class_id LEFT JOIN course crs ON crs.coursename = cl.coursename LEFT JOIN schoolyear sy ON sy.syid = e.sy WHERE s.coursename = '".$_POST['crs']."' AND s.yearlevel = '".$_POST['yl']."' AND s.section = '".$_POST['sec']."' GROUP BY e.studentid,e.facultyid,e.class_id";
                    								$result1 = mysqli_query($db, $query1) or die (mysqli_error($db));
                  
                       								 while ($row1 = mysqli_fetch_assoc($result1)) {
                       								 $comsum = "select (sum(rate)/5) as 'sum' from evaluation e LEFT JOIN student s ON s.idno = e.studentid WHERE criteriaid = 1 AND s.coursename = '".$_POST['crs']."' AND s.yearlevel = '".$_POST['yl']."' AND s.section = '".$_POST['sec']."' AND e.studentid = '".$row1['studentid']."'";
                       								 $result2 = mysqli_query($db, $comsum) or die (mysqli_error($db));
                       								 $row2 = mysqli_fetch_assoc($result2);
                       								 $total = $row2['sum'];
                       								 
                       								 $knsum = "select (sum(rate)/5) as 'sum' from evaluation e LEFT JOIN student s ON s.idno = e.studentid WHERE criteriaid = 2 AND s.coursename = '".$_POST['crs']."' AND s.yearlevel = '".$_POST['yl']."' AND s.section = '".$_POST['sec']."' AND e.studentid = '".$row1['studentid']."'";
                       								 $result3 = mysqli_query($db, $knsum) or die (mysqli_error($db));
                       								 $row3 = mysqli_fetch_assoc($result3);
                       								 	$total1 = $row3['sum'];
                       								
                       								 $tsum = "select (sum(rate)/5) as 'sum' from evaluation e LEFT JOIN student s ON s.idno = e.studentid WHERE criteriaid = 3 AND s.coursename = '".$_POST['crs']."' AND s.yearlevel = '".$_POST['yl']."' AND s.section = '".$_POST['sec']."' AND e.studentid = '".$row1['studentid']."'";
                       								 $result4 = mysqli_query($db, $tsum) or die (mysqli_error($db));
                       								 $row4 = mysqli_fetch_assoc($result4);
                       								 	$total2 = $row4['sum'];
                       								
                       								 $msum = "select (sum(rate)/5) as 'sum' from evaluation e LEFT JOIN student s ON s.idno = e.studentid WHERE criteriaid = 4 AND s.coursename = '".$_POST['crs']."' AND s.yearlevel = '".$_POST['yl']."' AND s.section = '".$_POST['sec']."' AND e.studentid = '".$row1['studentid']."'";
                       								 $result5 = mysqli_query($db, $msum) or die (mysqli_error($db));
                       								 $row5 = mysqli_fetch_assoc($result5);
                       								 	$total3 = $row5['sum'];

                       								 //-----------------------------------------------------------------------------------------------------------------------
                       								 $totsum = "select (sum(rate)/5) as 'sum' from evaluation e LEFT JOIN student s ON s.idno = e.studentid WHERE s.coursename = '".$_POST['crs']."' AND s.yearlevel = '".$_POST['yl']."' AND s.section = '".$_POST['sec']."' AND e.studentid = '".$row1['studentid']."'";
                       								 $totresult = mysqli_query($db, $totsum) or die (mysqli_error($db));
                       								 $rowtot = mysqli_fetch_assoc($totresult);
                       								 	$totalperq = $rowtot['sum'];
                       								 	$grandtot = $rowtot['sum']/20;



                       								 $overall = $total+$total1+$total2+$total3;
                       								 $average = ($total+$total1+$total2+$total3)/4
                       								 
													?>
													<tr>
													<td><?php echo $row1['facultyname']; ?></td>
													<td><?php echo $row1['studentname']; ?></td>
													<td><?php echo number_format($total,1); ?></td>
													<td><?php echo number_format($total1,1); ?></td>
													<td><?php echo number_format($total2,1); ?></td>
													<td><?php echo number_format($total3,1); ?></td>
													<td><strong><?php echo number_format($overall,1); ?></strong></td>
													<td><strong><?php echo number_format($average,1); ?></strong></td>
													<td><strong><?php echo $row1['comment']; ?></strong></td>
													<td><?php echo $row1['evaluationdatetime']; ?></td>
													</tr>
													<?php
												}
													?>
												</tbody>
											</table>
										<?php
									}

									?>
									<div class="row">
									<div class="col-lg-12 text-right">
										<button onclick="javascript:window.print();" class="btn btn-light no-print" type="button"> <i class="fa fa-print"></i> Print </button>
									</div>
								</div>
									