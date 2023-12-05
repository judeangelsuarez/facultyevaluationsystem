<style type="text/css">
  @media print {
  .no-print, .main-sidebar,
  .main-header,
  .content-header {
    display: none !important;
  }
</style>
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
									<div class="card-body">
										

											
                                                	<div class="row">
                                                		
                                                		
										<div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="form-label">Academic Yr and Semester</label>
                                                 <?php
                              $csql1 = "SELECT * FROM `schoolyear`";
                              $cresult1 = mysqli_query($db, $csql1) or die (mysqli_error($db));
                              ?>
                            <select class="form-control syid" name="course" id="syid">
                              <?php
                              while($rowc1 = mysqli_fetch_assoc($cresult1)){
                                ?>
                                <option value="<?php echo $rowc1['syid']; ?>"><?php echo $rowc1['sy'].'/'.$rowc1['semester'] ;?></option>
                                <?php
                              }
                              ?>
                          </select>
                                            </div>
                                        </div>
										
                                                </div><br>
                                                
                                                <div id="table-container"></div>
                                                
										</div>
									</div>
                                </div>
                            </div>
						</div>
					</div>
                    <div class="card">
                        <div class="card-body">
                           <?php
                           $sqll= "SELECT facultyname,e.facultyid,class_id,sy FROM `evaluation` e LEFT JOIN faculty f ON f.facultyid = e.facultyid where sy = 1 GROUP BY e.facultyid";
                              $ress = mysqli_query($db, $sqll) or die (mysqli_error($db));
                              while($rowss = mysqli_fetch_assoc($ress)){
                                
                              ?> 
                            <div class="row">
                    <div class="col-xl-4 col-xxl-4 col-sm-6">
                        <div class="widget-stat card">
                            <div class="card-body">
                                
                                   <center><h1><span class="la la-user"></span> <?php echo $rowss['facultyname'] ?></h1></center>
                                
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
include "theme/sidebar.php";
include "theme/footer.php";
    ?>
    <script type="text/javascript">

    $('.syid').on('change', function() {
      var syid = $(this).val();
      
      $.ajax({    
        type: "POST",
        url: "action1.php",
        data:{syid:syid},           
        dataType: "html",                  
        success: function(data){                    
            $("#table-container").html(data); 
           
        }
    });
});
</script>