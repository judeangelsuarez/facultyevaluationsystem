<?php
include "connection.php";

if(isset($_POST['save_eval'])){
	$facidno = $_POST['facidno'];
	$class_id = $_POST['class_id'];
	$facultyid = $_POST['facultyid'];
	$sy = $_POST['sy'];
	$comment = $_POST['comment'];
	$evaluator_type = $_POST['evaluator_type'];
	foreach ($_POST['rate'] as $question_id => $rating) {
		
		$criteria = "SELECT criteriaid FROM `question` where questionid = '".$question_id."'";
        $cresult = mysqli_query($db, $criteria) or die (mysqli_error($db));
        $rowc = mysqli_fetch_assoc($cresult);	

	$query = "INSERT INTO `evaluation` (`facultyid`, `criteriaid`, `questionid`, `sy`, `class_id`, `facidno`, `rate`, `comment`,`evaluator_type`) VALUES ('".$facultyid."','".$rowc['criteriaid']."','".$question_id."','".$sy."','".$class_id."','".$facidno."','".$rating."','".$comment."','".$evaluator_type."')";
    $istrue = mysqli_query($db,$query)or die (mysqli_error($db));

    
    
}
    if ($istrue==true) {
    	?>
    	<script type="text/javascript">
      alert("You Have Successfully Evaluated!.");
      window.location = "index.php";
    </script>
    	<?php
	}
}
?>