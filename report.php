<?php
include "theme/connection.php";
include "theme/header.php";
include "theme/topnav.php";
include "theme/sidebar.php";

$acadyear=mysqli_query($db,"select * from `schoolyear` where isDefault = 1");
$row=mysqli_fetch_array($acadyear);
?>
<div class="content-body">
            <!-- row -->
<div class="container-fluid">
<div class="row">
	<?php
                      
$query = "SELECT count(e.facultyid) as 'total',facultyname,studentname,s.coursename,s.yearlevel,s.section,sy.sy,semester,e.studentid FROM `evaluation` e LEFT JOIN faculty f ON f.facultyid = e.facultyid LEFT JOIN criteria c ON c.criteriaid = e.criteriaid LEFT JOIN student s ON s.idno = e.studentid LEFT JOIN class cl ON cl.class_id = e.class_id LEFT JOIN course crs ON crs.coursename = cl.coursename LEFT JOIN schoolyear sy ON sy.syid = e.sy WHERE e.sy = '{$row['syid']}' GROUP BY s.coursename";
                     
$filter_result = mysqli_query($db, $query) or die (mysqli_error($db));
$numrows = mysqli_num_rows($filter_result);

  // foreach ($cur as $result) {
  // $course[]=$result->name;
  // $qty[]=$result->qty;
  // }
  $dataPointsGRADE = array();    
  while ($resultG = mysqli_fetch_assoc($filter_result)) {
    if($resultG['coursename']==''){
      $ev = 'Peer/Chair/Dean';
    }else{
      $ev = $resultG['coursename'];
    }
       
         $elementsGRADE = array("label"=>$ev, "y" => $resultG['total']/20);
        array_push($dataPointsGRADE, $elementsGRADE);
    //number_format(abs(($student->MID + $student->FIN)/2),0)
       } 

    ?>
					<div id="chartContainer1" style="height: 360px; width: 100%;"></div>
                </div>
            </div>
        </div>
<?php
include "theme/footer.php";
?>
<script type="text/javascript">
  window.onload = function() {
    var chart = new CanvasJS.Chart("chartContainer1", {
      exportEnabled: true,
      animationEnabled: true,
      title: {
        text: "Statistics of Total Faculty Evaluation Results"
      },
      subtitles: [{
        text: ""
      }],
      data: [{
        type: "pie",
        indexLabel: "{label}",
        indexLabelFontColor: "#000",
        indexLabelFontSize: 12,
        indexLabelFontWeight: "bold",
        dataPoints: <?php echo json_encode($dataPointsGRADE, JSON_NUMERIC_CHECK); ?>
      }]
    });
    chart.render();
  }
</script>

