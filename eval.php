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
                            <h4>Faculty Evaluators</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <!-- <li class="breadcrumb-item active"><a href="javascript:void(0);">Department</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0);">All Department</a></li> -->
                        </ol>
                    </div>
                </div>
				
				<div class="row">
					<div class="col-lg-12">
						<div class="row tab-content">
							<div id="list-view" class="tab-pane fade active show col-lg-12">
								<div class="card">
									<div class="card-body">
										

											
                                               <br>
                                                
                                                 <div class="row align-items-center"><center><img src="logo.png" width="10%"></center><h6 class="text-center"><strong>CARLOS HILADO MEMORIAL STATE UNIVERSITY</strong></h6></div>
										    <p class="text-center" style="margin-top: -5px">Binalbagan Campus</p>
											<h2 class="text-center">Total of Faculty Evaluators Report</h2>
											<br>


											<table id="datatable" class="display table-sm table table-striped" style="min-width: 845px">
												<thead>
													<tr>
														<th>Instructor</th>
														<th>Evaluator</th>
														<th>Type</th>
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
													
													$query1 = "SELECT e.class_id,e.facultyid,e.evaluator_type,comment,f.facultyname as 'f1',fe.facultyname as 'f2',sy.sy,semester,e.facidno,evaluationdatetime FROM `evaluation` e LEFT JOIN faculty f ON f.facultyid = e.facultyid LEFT JOIN faculty fe ON fe.facidno = e.facidno LEFT JOIN criteria c ON c.criteriaid = e.criteriaid LEFT JOIN class cl ON cl.class_id = e.class_id LEFT JOIN course crs ON crs.coursename = cl.coursename LEFT JOIN schoolyear sy ON sy.syid = e.sy WHERE evaluator_type != '' group by e.facultyid,e.class_id,e.facidno";
                    								$result1 = mysqli_query($db, $query1) or die (mysqli_error($db));
                  
                       								 while ($row1 = mysqli_fetch_assoc($result1)) {
                       								 $comsum = "select (sum(rate)/5) as 'sum' from evaluation e LEFT JOIN faculty f ON f.facidno = e.facidno WHERE criteriaid = 1 AND e.facidno = '".$row1['facidno']."' AND e.facultyid = '{$row1['facultyid']}' AND e.class_id = '{$row1['class_id']}'";
                       								 $result2 = mysqli_query($db, $comsum) or die (mysqli_error($db));
                       								 $row2 = mysqli_fetch_assoc($result2);
                       								 $total = $row2['sum'];
                       								 
                       								 $knsum = "select (sum(rate)/5) as 'sum' from evaluation e LEFT JOIN faculty f ON f.facidno = e.facidno WHERE criteriaid = 2 AND e.facidno = '".$row1['facidno']."' AND e.facultyid = '{$row1['facultyid']}' AND e.class_id = '{$row1['class_id']}'";
                       								 $result3 = mysqli_query($db, $knsum) or die (mysqli_error($db));
                       								 $row3 = mysqli_fetch_assoc($result3);
                       								 	$total1 = $row3['sum'];
                       								
                       								 $tsum = "select (sum(rate)/5) as 'sum' from evaluation e LEFT JOIN faculty f ON f.facidno = e.facidno WHERE criteriaid = 3 AND e.facidno = '".$row1['facidno']."' AND e.facultyid = '{$row1['facultyid']}' AND e.class_id = '{$row1['class_id']}'";
                       								 $result4 = mysqli_query($db, $tsum) or die (mysqli_error($db));
                       								 $row4 = mysqli_fetch_assoc($result4);
                       								 	$total2 = $row4['sum'];
                       								
                       								 $msum = "select (sum(rate)/5) as 'sum' from evaluation e LEFT JOIN faculty f ON f.facidno = e.facidno WHERE criteriaid = 4 AND e.facidno = '".$row1['facidno']."' AND e.facultyid = '{$row1['facultyid']}' AND e.class_id = '{$row1['class_id']}'";
                       								 $result5 = mysqli_query($db, $msum) or die (mysqli_error($db));
                       								 $row5 = mysqli_fetch_assoc($result5);
                       								 	$total3 = $row5['sum'];

                       								 //-----------------------------------------------------------------------------------------------------------------------
                       								 $totsum = "select (sum(rate)/5) as 'sum' from evaluation e LEFT JOIN faculty f ON f.facidno = e.facidno WHERE e.facidno = '".$row1['facidno']."' AND e.facultyid = '{$row1['facultyid']}' AND e.class_id = '{$row1['class_id']}'";
                       								 $totresult = mysqli_query($db, $totsum) or die (mysqli_error($db));
                       								 $rowtot = mysqli_fetch_assoc($totresult);
                       								 	$totalperq = $rowtot['sum'];
                       								 	$grandtot = $rowtot['sum']/20;



                       								 $overall = $total+$total1+$total2+$total3;
                       								 $average = ($total+$total1+$total2+$total3)/4
                       								 
													?>
													<tr>
													<td><?php echo $row1['f1']; ?></td>
													<td><?php echo ($row1['f2']=='') ? $row1['f1'] : $row1['f2']; ?></td>
													<td><?php echo ($row1['f2']=='') ? 'Self' : $row1['evaluator_type']; ?></td>
													<td><?php echo ($row1['f2']=='') ? number_format($total,1) : number_format($total,1); ?></td>
													<td><?php echo ($row1['f2']=='') ? number_format($total1,1) : number_format($total1,1); ?></td>
													<td><?php echo ($row1['f2']=='') ? number_format($total2,1) : number_format($total2,1); ?></td>
													<td><?php echo ($row1['f2']=='') ? number_format($total3,1) : number_format($total3,1); ?></td>
													<td><strong><?php echo ($row1['f2']=='') ? number_format($overall,1) : number_format($overall,1); ?></strong></td>
													<td><strong><?php echo ($row1['f2']=='') ? number_format($average,1) : number_format($average,1); ?></strong></td>
													<td><strong><?php echo $row1['comment']; ?></strong></td>
													<td><?php echo $row1['evaluationdatetime']; ?></td>
													</tr>
													<?php
												}
													?>
												</tbody>
											</table>
										<?php
									//}

									?>
									<div class="row">
									<div class="col-lg-12 text-right">
										<button onclick="javascript:window.print();" class="btn btn-light no-print" type="button"> <i class="fa fa-print"></i> Print </button>
									</div>
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