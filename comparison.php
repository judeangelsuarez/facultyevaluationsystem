<?php
include "theme/connection.php";
include "theme/header.php";
include "theme/topnav.php";
include "theme/sidebar.php";
?>
<div class="content-body">
            <!-- row -->
<div class="container-fluid">
<div class="row">
	<?php

$query = "SELECT count(e.facultyid) as total,facultyname,studentname,s.coursename,s.yearlevel,s.section,sy.sy,semester,e.studentid,e.evaluator_type FROM `evaluation` e LEFT JOIN faculty f ON f.facultyid = e.facultyid LEFT JOIN criteria c ON c.criteriaid = e.criteriaid LEFT JOIN student s ON s.idno = e.studentid LEFT JOIN class cl ON cl.class_id = e.class_id LEFT JOIN course crs ON crs.coursename = cl.coursename LEFT JOIN schoolyear sy ON sy.syid = e.sy WHERE sy.semester = 'First Semester' GROUP BY s.coursename";
                     
$filter_result = mysqli_query($db, $query) or die (mysqli_error($db));
$numrows = mysqli_num_rows($filter_result);

  // foreach ($cur as $result) {
  // $course[]=$result->name;
  // $qty[]=$result->qty;
  // }
  $dataPointsGRADE = array();    
  while ($resultG = mysqli_fetch_assoc($filter_result)) {
    if($resultG['coursename'] == ''){
      $ev = 'Peer/Chair/Dean';
    }else{
      $ev = $resultG['coursename'];
    }
       
         $elementsGRADE = array("label"=>$ev, "y" => $resultG['total']/20);
        array_push($dataPointsGRADE, $elementsGRADE);
    //number_format(abs(($student->MID + $student->FIN)/2),0)
       } 


       $query2 = "SELECT count(e.facultyid) as total,facultyname,studentname,s.coursename,s.yearlevel,s.section,sy.sy,semester,e.studentid,e.evaluator_type FROM `evaluation` e LEFT JOIN faculty f ON f.facultyid = e.facultyid LEFT JOIN criteria c ON c.criteriaid = e.criteriaid LEFT JOIN student s ON s.idno = e.studentid LEFT JOIN class cl ON cl.class_id = e.class_id LEFT JOIN course crs ON crs.coursename = cl.coursename LEFT JOIN schoolyear sy ON sy.syid = e.sy WHERE sy.semester = 'Second Semester' GROUP BY  s.coursename";
                     
$filter_result2 = mysqli_query($db, $query2) or die (mysqli_error($db));
$numrows2 = mysqli_num_rows($filter_result2);

  // foreach ($cur as $result) {
  // $course[]=$result->name;
  // $qty[]=$result->qty;
  // }
  $dataPointsGRADE2 = array();    
  while ($resultG2 = mysqli_fetch_assoc($filter_result2)) {
    if($resultG2['coursename'] ==''){
      $ev2 = 'Peer/Chair/Dean';
    }else{
      $ev2 = $resultG2['coursename'];
    }
       
         $elementsGRADE2 = array("label"=>$ev2, "y" => $resultG2['total']/20);
        array_push($dataPointsGRADE2, $elementsGRADE2);
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
  title:{
    text: "Comparison Rate for 1st Sem and 2nd Sem"
  },
  subtitles: [{
    text: "Click Legend to Hide or Unhide Data Series"
  }], 
  axisX: {
    title: "Semester"
  },
  axisY: {
    titleFontColor: "#4F81BC",
    lineColor: "#4F81BC",
    labelFontColor: "#4F81BC",
    tickColor: "#4F81BC",
    includeZero: true
  },
  axisY2: {
    titleFontColor: "#C0504E",
    lineColor: "#C0504E",
    labelFontColor: "#C0504E",
    tickColor: "#C0504E",
    includeZero: true
  },
  toolTip: {
    shared: true
  },
  legend: {
    cursor: "pointer",
    itemclick: toggleDataSeries
  },
  data: [{
    type: "column",
    indexLabel: "{y}",
    name: 'First Semester',
    showInLegend: true,      
    dataPoints: <?php echo json_encode($dataPointsGRADE); ?>
  },{
    type: "column", 
    indexLabel: "{y}",
    name: "Second Semester",
    showInLegend: true,
    dataPoints:<?php echo json_encode($dataPointsGRADE2); ?>
  }]
});
chart.render();

function toggleDataSeries(e) {
  if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
    e.dataSeries.visible = false;
  } else {
    e.dataSeries.visible = true;
  }
  e.chart.render();
}
}
</script>