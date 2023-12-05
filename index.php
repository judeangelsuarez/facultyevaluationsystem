<?php
include "theme/header.php";
include "theme/connection.php";
include "theme/topnav.php";
include "theme/sidebar.php";

$acadyear=mysqli_query($db,"select * from `schoolyear` where isDefault = 1");
$row=mysqli_fetch_array($acadyear);
?>
<div class="content-body">
            <!-- row -->
<div class="container-fluid">
<div class="row">
					<div class="col-xl-3 col-xxl-3 col-sm-6">
						<div class="widget-stat card bg-primary">
							<div class="card-body">
								<div class="media">
									<span class="mr-3">
										<i class="la la-users"></i>
									</span>
									 <?php
                                        $filters = "SELECT * FROM student";
                                        $filterstud = mysqli_query($db, $filters) or die (mysqli_error($db));
										$studnumrows = mysqli_num_rows($filterstud);
                                        ?>
									<div class="media-body text-white">
										<p class="mb-1">Total Students</p>
										<h3 class="text-white"><?php echo $studnumrows; ?></h3>
										<div class="progress mb-2 bg-white">
                                            <div class="progress-bar progress-animated bg-light" style="width: 80%"></div>
                                        </div>
									</div>
								</div>
							</div>
						</div>
                    </div>
					<div class="col-xl-3 col-xxl-3 col-sm-6">
						<div class="widget-stat card bg-warning">
							<div class="card-body">
								<div class="media">
									<span class="mr-3">
										<i class="la la-user"></i>
									</span>
									<?php
                                        $filterf = "SELECT * FROM faculty";
                                        $filterfac = mysqli_query($db, $filterf) or die (mysqli_error($db));
										$facnumrows = mysqli_num_rows($filterfac);
                                        ?>
									<div class="media-body text-white">
										<p class="mb-1">Total Faculties</p>
										<h3 class="text-white"><?php echo $facnumrows; ?></h3>
										<div class="progress mb-2 bg-white">
                                            <div class="progress-bar progress-animated bg-light" style="width: 50%"></div>
                                        </div>
									</div>
								</div>
							</div>
						</div>
                    </div>
					<div class="col-xl-3 col-xxl-3 col-sm-6">
						<div class="widget-stat card bg-secondary">
							<div class="card-body">
								<div class="media">
									<span class="mr-3">
										<i class="la la-graduation-cap"></i>
									</span>
									<?php
                                        $filterc = "SELECT * FROM course";
                                        $filtercourse = mysqli_query($db, $filterc) or die (mysqli_error($db));
										$coursenumrows = mysqli_num_rows($filtercourse);
                                        ?>
									<div class="media-body text-white">
										<p class="mb-1">Total Course</p>
										<h3 class="text-white"><?php echo $coursenumrows; ?></h3>
										<div class="progress mb-2 bg-white">
                                            <div class="progress-bar progress-animated bg-light" style="width: 76%"></div>
                                        </div>
									</div>
								</div>
							</div>
						</div>
                    </div>
					<div class="col-xl-3 col-xxl-3 col-sm-6">
						<div class="widget-stat card bg-danger">
							<div class="card-body">
								<div class="media">
									<span class="mr-3">
										<i class="la la-pencil"></i>
									</span>
									<?php
                                        $filtere = "SELECT * FROM evaluation GROUP BY studentid";
                                        $filterstud = mysqli_query($db, $filtere) or die (mysqli_error($db));
										$evalnumrows = mysqli_num_rows($filterstud);
                                        ?>
									<div class="media-body text-white">
										<p class="mb-1">Total Evaluations</p>
										<h3 class="text-white"><?php echo $evalnumrows; ?></h3>
										<div class="progress mb-2 bg-white">
                                            <div class="progress-bar progress-animated bg-light" style="width: 30%"></div>
                                        </div>
									</div>
								</div>
							</div>
						</div>
                    </div>
                </div><br>

                <div class="card">
                	<div class="card-header">
                		<h1 class="card-title"><span class="la la-bar-chart"></span> List of Faculty Evaluation Reports For The Current Academic Yr and Semester</h1>
                	</div>
                        <div class="card-body">
                           <?php
                           $sqll= "SELECT f.eval_type,facultyname,e.facultyid,class_id,sy FROM `evaluation` e LEFT JOIN faculty f ON f.facultyid = e.facultyid where sy = '{$row['syid']}' GROUP BY e.facultyid";
                              $ress = mysqli_query($db, $sqll) or die (mysqli_error($db));
                              while($rowss = mysqli_fetch_assoc($ress)){
                                
                              ?> 
                            <div class="row">
                    <div class="col-xl-4 col-xxl-4 col-sm-6">
                        <div class="widget-stat card">
                            <div class="card-body">
                                
                                   <center><h1><span class="la la-user"></span> <?php echo $rowss['facultyname'] ?></h1>
                                    <span>Designation: <strong><u><?php echo $rowss['eval_type']; ?></u></strong></span></center>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-xxl-2 col-sm-6">
                        <div class="widget-stat card bg-primary">
                            <div class="card-body">
                                <div class="media">
                                    <span class="mr-3">
                                    <?php
                                                    $total = 0;
                                                    $total1 = 0;
                                                    $total2 = 0;
                                                    $total3 = 0;
                                                    $overall = 0;
                                                    
                                                    
                                                     $comsum = "select (sum(rate)/5) as 'sum' from evaluation WHERE criteriaid = 1 AND facultyid = '{$rowss['facultyid']}' AND class_id = '{$rowss['class_id']}' AND sy = '{$rowss['sy']}' AND evaluator_type = '' group by class_id,facultyid,studentid";
                                                     $result2 = mysqli_query($db, $comsum) or die (mysqli_error($db));
                                                     $row2 = mysqli_fetch_assoc($result2);
                                                     $total = isset($row2['sum']) ? $row2['sum'] : 0.0;
                                                     
                                                     $knsum = "select (sum(rate)/5) as 'sum' from evaluation WHERE  criteriaid = 2 AND facultyid = '{$rowss['facultyid']}' AND class_id = '{$rowss['class_id']}' AND sy = '{$rowss['sy']}' AND evaluator_type = '' group by class_id,facultyid,studentid";
                                                     $result3 = mysqli_query($db, $knsum) or die (mysqli_error($db));
                                                     $row3 = mysqli_fetch_assoc($result3);
                                                        $total1 = isset($row3['sum']) ? $row3['sum'] : 0.0;
                                                    
                                                     $tsum = "select (sum(rate)/5) as 'sum' from evaluation WHERE criteriaid = 3 AND facultyid = '{$rowss['facultyid']}' AND class_id = '{$rowss['class_id']}' AND sy = '{$rowss['sy']}' AND evaluator_type = '' group by class_id,facultyid,studentid";
                                                     $result4 = mysqli_query($db, $tsum) or die (mysqli_error($db));
                                                     $row4 = mysqli_fetch_assoc($result4);
                                                    $total2 = isset($row4['sum']) ? $row4['sum'] : 0.0;
                                                    
                                                     $msum = "select (sum(rate)/5) as 'sum' from evaluation WHERE  criteriaid = 4 AND facultyid = '{$rowss['facultyid']}' AND class_id = '{$rowss['class_id']}' AND sy = '{$rowss['sy']}' AND evaluator_type = '' group by class_id,facultyid,studentid";
                                                     $result5 = mysqli_query($db, $msum) or die (mysqli_error($db));
                                                     $row5 = mysqli_fetch_assoc($result5);
                                                        $total3 = isset($row5['sum']) ? $row5['sum'] : 0.0;

                                                     //-----------------------------------------------------------------------------------------------------------------------
                                                     $totsum = "select (sum(rate)/5) as 'sum' from evaluation WHERE facultyid = '{$rowss['facultyid']}' AND class_id = '{$rowss['class_id']}' AND sy = '{$rowss['sy']}' AND evaluator_type = '' group by class_id,facultyid,studentid";
                                                     $totresult = mysqli_query($db, $totsum) or die (mysqli_error($db));
                                                     $rowtot = mysqli_fetch_assoc($totresult);
                                                        $totalperq = isset($rowtot['sum']) ? $rowtot['sum'] : 0.0;
                                                        $grandtot = isset($rowtot['sum']) ? $rowtot['sum']/20 : 0.0;



                                                     $overall = $total+$total1+$total2+$total3;
                                                     $average = ($total+$total1+$total2+$total3)/4;
                                                     echo $average;
                                    ?>
                                        
                                    </span>
                                     <?php
                                        $filters = "SELECT count(studentid) FROM evaluation WHERE facultyid = '{$rowss['facultyid']}' AND class_id = '{$rowss['class_id']}' AND sy = '{$rowss['sy']}' AND evaluator_type = '' group by class_id,facultyid,studentid";
                                        $filterstud = mysqli_query($db, $filters) or die (mysqli_error($db));
                                        $studnumrows = mysqli_num_rows($filterstud);
                                        ?>
                                    <div class="media-body text-white">
                                        <p class="mb-1">Total Students</p>
                                        <h3 class="text-white"><?php echo $studnumrows; ?></h3>
                                        <div class="progress mb-2 bg-white">
                                            <div class="progress-bar progress-animated bg-light" style="width: 80%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-xxl-2 col-sm-6">
                        <div class="widget-stat card bg-warning">
                            <div class="card-body">
                                <div class="media">
                                    <span class="mr-3">
                                        
                                        <?php
                                                    $total = 0;
                                                    $total1 = 0;
                                                    $total2 = 0;
                                                    $total3 = 0;
                                                    $overall = 0;
                                                    
                                                    
                                                     $comsum = "select (sum(rate)/5) as 'sum' from evaluation WHERE criteriaid = 1 AND facultyid = '{$rowss['facultyid']}' AND class_id = '{$rowss['class_id']}' AND sy = '{$rowss['sy']}' AND evaluator_type = 'faculty' group by class_id,facultyid,studentid";
                                                     $result2 = mysqli_query($db, $comsum) or die (mysqli_error($db));
                                                     $row2 = mysqli_fetch_assoc($result2);
                                                     $total = isset($row2['sum']) ? $row2['sum'] : 0.0;
                                                     
                                                     $knsum = "select (sum(rate)/5) as 'sum' from evaluation WHERE  criteriaid = 2 AND facultyid = '{$rowss['facultyid']}' AND class_id = '{$rowss['class_id']}' AND sy = '{$rowss['sy']}' AND evaluator_type = 'faculty' group by class_id,facultyid,studentid";
                                                     $result3 = mysqli_query($db, $knsum) or die (mysqli_error($db));
                                                     $row3 = mysqli_fetch_assoc($result3);
                                                        $total1 = isset($row3['sum']) ? $row3['sum'] : 0.0;
                                                    
                                                     $tsum = "select (sum(rate)/5) as 'sum' from evaluation WHERE criteriaid = 3 AND facultyid = '{$rowss['facultyid']}' AND class_id = '{$rowss['class_id']}' AND sy = '{$rowss['sy']}' AND evaluator_type = 'faculty' group by class_id,facultyid,studentid";
                                                     $result4 = mysqli_query($db, $tsum) or die (mysqli_error($db));
                                                     $row4 = mysqli_fetch_assoc($result4);
                                                    $total2 = isset($row4['sum']) ? $row4['sum'] : 0.0;
                                                    
                                                     $msum = "select (sum(rate)/5) as 'sum' from evaluation WHERE  criteriaid = 4 AND facultyid = '{$rowss['facultyid']}' AND class_id = '{$rowss['class_id']}' AND sy = '{$rowss['sy']}' AND evaluator_type = 'faculty' group by class_id,facultyid,studentid";
                                                     $result5 = mysqli_query($db, $msum) or die (mysqli_error($db));
                                                     $row5 = mysqli_fetch_assoc($result5);
                                                        $total3 = isset($row5['sum']) ? $row5['sum'] : 0.0;

                                                     //-----------------------------------------------------------------------------------------------------------------------
                                                     $totsum = "select (sum(rate)/5) as 'sum' from evaluation WHERE facultyid = '{$rowss['facultyid']}' AND class_id = '{$rowss['class_id']}' AND sy = '{$rowss['sy']}' AND evaluator_type = 'faculty' group by class_id,facultyid,studentid";
                                                     $totresult = mysqli_query($db, $totsum) or die (mysqli_error($db));
                                                     $rowtot = mysqli_fetch_assoc($totresult);
                                                        $totalperq = isset($rowtot['sum']) ? $rowtot['sum'] : 0.0;
                                                        $grandtot = isset($rowtot['sum']) ? $rowtot['sum']/20 : 0.0;



                                                     $overall = $total+$total1+$total2+$total3;
                                                     $average1 = ($total+$total1+$total2+$total3)/4;
                                                     echo $average1;
                                    ?>
                                    </span>
                                    <?php
                                        $filterf = "SELECT count(studentid) FROM evaluation WHERE facultyid = '{$rowss['facultyid']}' AND class_id = '{$rowss['class_id']}' AND sy = '{$rowss['sy']}' AND evaluator_type = 'faculty' group by facultyid,facidno";
                                        $filterfac = mysqli_query($db, $filterf) or die (mysqli_error($db));
                                        $facnumrows = mysqli_num_rows($filterfac);
                                        ?>
                                    <div class="media-body text-white">
                                        <p class="mb-1">Total Peer</p>
                                        <h3 class="text-white"><?php echo $facnumrows; ?></h3>
                                        <div class="progress mb-2 bg-white">
                                            <div class="progress-bar progress-animated bg-light" style="width: 50%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-xxl-2 col-sm-6">
                        <div class="widget-stat card bg-secondary">
                            <div class="card-body">
                                <div class="media">
                                    <span class="mr-3">
                                        <?php
                                                    $total = 0;
                                                    $total1 = 0;
                                                    $total2 = 0;
                                                    $total3 = 0;
                                                    $overall = 0;
                                                    
                                                    
                                                     $comsum = "select (sum(rate)/5) as 'sum' from evaluation WHERE criteriaid = 1 AND facultyid = '{$rowss['facultyid']}' AND class_id = '{$rowss['class_id']}' AND sy = '{$rowss['sy']}' AND evaluator_type = 'chairperson' group by class_id,facultyid,studentid";
                                                     $result2 = mysqli_query($db, $comsum) or die (mysqli_error($db));
                                                     $row2 = mysqli_fetch_assoc($result2);
                                                     $total = isset($row2['sum']) ? $row2['sum'] : 0.0;
                                                     
                                                     $knsum = "select (sum(rate)/5) as 'sum' from evaluation WHERE  criteriaid = 2 AND facultyid = '{$rowss['facultyid']}' AND class_id = '{$rowss['class_id']}' AND sy = '{$rowss['sy']}' AND evaluator_type = 'chairperson' group by class_id,facultyid,studentid";
                                                     $result3 = mysqli_query($db, $knsum) or die (mysqli_error($db));
                                                     $row3 = mysqli_fetch_assoc($result3);
                                                        $total1 = isset($row3['sum']) ? $row3['sum'] : 0.0;
                                                    
                                                     $tsum = "select (sum(rate)/5) as 'sum' from evaluation WHERE criteriaid = 3 AND facultyid = '{$rowss['facultyid']}' AND class_id = '{$rowss['class_id']}' AND sy = '{$rowss['sy']}' AND evaluator_type = 'chairperson' group by class_id,facultyid,studentid";
                                                     $result4 = mysqli_query($db, $tsum) or die (mysqli_error($db));
                                                     $row4 = mysqli_fetch_assoc($result4);
                                                    $total2 = isset($row4['sum']) ? $row4['sum'] : 0.0;
                                                    
                                                     $msum = "select (sum(rate)/5) as 'sum' from evaluation WHERE  criteriaid = 4 AND facultyid = '{$rowss['facultyid']}' AND class_id = '{$rowss['class_id']}' AND sy = '{$rowss['sy']}' AND evaluator_type = 'chairperson' group by class_id,facultyid,studentid";
                                                     $result5 = mysqli_query($db, $msum) or die (mysqli_error($db));
                                                     $row5 = mysqli_fetch_assoc($result5);
                                                        $total3 = isset($row5['sum']) ? $row5['sum'] : 0.0;

                                                     //-----------------------------------------------------------------------------------------------------------------------
                                                     $totsum = "select (sum(rate)/5) as 'sum' from evaluation WHERE facultyid = '{$rowss['facultyid']}' AND class_id = '{$rowss['class_id']}' AND sy = '{$rowss['sy']}' AND evaluator_type = 'chairperson' group by class_id,facultyid,studentid";
                                                     $totresult = mysqli_query($db, $totsum) or die (mysqli_error($db));
                                                     $rowtot = mysqli_fetch_assoc($totresult);
                                                        $totalperq = isset($rowtot['sum']) ? $rowtot['sum'] : 0.0;
                                                        $grandtot = isset($rowtot['sum']) ? $rowtot['sum']/20 : 0.0;



                                                     $overall = $total+$total1+$total2+$total3;
                                                     $average2 = ($total+$total1+$total2+$total3)/4;
                                                     echo $average2;
                                    ?>
                                    </span>
                                    <?php
                                        $filterc = "SELECT count(studentid) FROM evaluation WHERE facultyid = '{$rowss['facultyid']}' AND class_id = '{$rowss['class_id']}' AND sy = '{$rowss['sy']}' AND evaluator_type = 'chairperson' group by facultyid,facidno";
                                        $filtercourse = mysqli_query($db, $filterc) or die (mysqli_error($db));
                                        $coursenumrows = mysqli_num_rows($filtercourse);
                                        ?>
                                    <div class="media-body text-white">
                                        <p class="mb-1">Total Chair</p>
                                        <h3 class="text-white"><?php echo $coursenumrows; ?></h3>
                                        <div class="progress mb-2 bg-white">
                                            <div class="progress-bar progress-animated bg-light" style="width: 76%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-xxl-2 col-sm-6">
                        <div class="widget-stat card bg-success">
                            <div class="card-body">
                                <div class="media">
                                    <span class="mr-3">
                                        <?php
                                                    $total = 0;
                                                    $total1 = 0;
                                                    $total2 = 0;
                                                    $total3 = 0;
                                                    $overall = 0;
                                                    
                                                    
                                                     $comsum = "select (sum(rate)/5) as 'sum' from evaluation WHERE criteriaid = 1 AND facultyid = '{$rowss['facultyid']}' AND class_id = '{$rowss['class_id']}' AND sy = '{$rowss['sy']}' AND evaluator_type IN ('dean','supervisor') group by class_id,facultyid,studentid";
                                                     $result2 = mysqli_query($db, $comsum) or die (mysqli_error($db));
                                                     $row2 = mysqli_fetch_assoc($result2);
                                                     $total = isset($row2['sum']) ? $row2['sum'] : 0.0;
                                                     
                                                     $knsum = "select (sum(rate)/5) as 'sum' from evaluation WHERE  criteriaid = 2 AND facultyid = '{$rowss['facultyid']}' AND class_id = '{$rowss['class_id']}' AND sy = '{$rowss['sy']}' AND evaluator_type IN ('dean','supervisor') group by class_id,facultyid,studentid";
                                                     $result3 = mysqli_query($db, $knsum) or die (mysqli_error($db));
                                                     $row3 = mysqli_fetch_assoc($result3);
                                                        $total1 = isset($row3['sum']) ? $row3['sum'] : 0.0;
                                                    
                                                     $tsum = "select (sum(rate)/5) as 'sum' from evaluation WHERE criteriaid = 3 AND facultyid = '{$rowss['facultyid']}' AND class_id = '{$rowss['class_id']}' AND sy = '{$rowss['sy']}' AND evaluator_type IN ('dean','supervisor') group by class_id,facultyid,studentid";
                                                     $result4 = mysqli_query($db, $tsum) or die (mysqli_error($db));
                                                     $row4 = mysqli_fetch_assoc($result4);
                                                    $total2 = isset($row4['sum']) ? $row4['sum'] : 0.0;
                                                    
                                                     $msum = "select (sum(rate)/5) as 'sum' from evaluation WHERE  criteriaid = 4 AND facultyid = '{$rowss['facultyid']}' AND class_id = '{$rowss['class_id']}' AND sy = '{$rowss['sy']}' AND evaluator_type IN ('dean','supervisor') group by class_id,facultyid,studentid";
                                                     $result5 = mysqli_query($db, $msum) or die (mysqli_error($db));
                                                     $row5 = mysqli_fetch_assoc($result5);
                                                        $total3 = isset($row5['sum']) ? $row5['sum'] : 0.0;

                                                     //-----------------------------------------------------------------------------------------------------------------------
                                                     $totsum = "select (sum(rate)/5) as 'sum' from evaluation WHERE facultyid = '{$rowss['facultyid']}' AND class_id = '{$rowss['class_id']}' AND sy = '{$rowss['sy']}' AND evaluator_type IN ('dean','supervisor') group by class_id,facultyid,studentid";
                                                     $totresult = mysqli_query($db, $totsum) or die (mysqli_error($db));
                                                     $rowtot = mysqli_fetch_assoc($totresult);
                                                        $totalperq = isset($rowtot['sum']) ? $rowtot['sum'] : 0.0;
                                                        $grandtot = isset($rowtot['sum']) ? $rowtot['sum']/20 : 0.0;



                                                     $overall = $total+$total1+$total2+$total3;
                                                     $average3 = ($total+$total1+$total2+$total3)/4;
                                                     echo $average3;
                                    ?>
                                    </span>
                                    <?php
                                        $filterc = "SELECT count(studentid) FROM evaluation WHERE facultyid = '{$rowss['facultyid']}' AND class_id = '{$rowss['class_id']}' AND sy = '{$rowss['sy']}' AND evaluator_type IN ('dean','supervisor') group by facultyid,facidno";
                                        $filtercourse = mysqli_query($db, $filterc) or die (mysqli_error($db));
                                        $coursenumrows = mysqli_num_rows($filtercourse);
                                        ?>
                                    <div class="media-body text-white">
                                        <p class="mb-1">Total Dean</p>
                                        <h3 class="text-white"><?php echo $coursenumrows; ?></h3>
                                        <div class="progress mb-2 bg-white">
                                            <div class="progress-bar progress-animated bg-light" style="width: 76%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <?php
}
                ?>
                        </div>
                        
                    </div>
            </div>
        </div>
<?php
include "theme/footer.php";
?>