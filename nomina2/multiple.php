<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<body>
<input type="hidden" name="btnSubmit" id="btnSubmit" value="">
<?php
include("includes/miclase.php");
$link=conectarse("nomina");
$query_disp='SELECT * FROM nomina.integrantes where cedula like "13%"'; //echo $query_disp.”<br>”;
$result_disp = mysql_query($query_disp, $link);
$k=0;
while($query_data_exam = mysql_fetch_array($result_disp))
{
$id2[$k]=$query_data_exam['cedula'];
?>
<TR height=”25″>
<TD align=”right”><b>cedula</b></TD>
<TD width=”1%” align=”right”></TD>
<TD><input type="textbox" name="txtExamName<?php echo $k;?>"

id="txtExamName<?php echo $k;?>" size="35" value="<? echo

$query_data_exam['nombres'];?>"></TD>
<TD width=”3%” align=”right”><b>nombre</b></TD>
<TD width=”3%” align=”right”></TD>
<TD><input type="textbox" name="txtMarks<?php echo $k;?>"

id="txtMarks<?php echo $k;?>" size="35" value=""></TD>
</TR>
<?
$k++;
}
?>
<TR>


<input type="hidden" name="hidTotal" id="hidTotal" value="<? echo $k; ?>">
</TR>
</body>
</html>
<?php /* include(”connection.php”)

$semesterID=$_REQUEST['salSemesterID'];
$swcoID=$_REQUEST['salCourseID'];
$total = $_REQUEST['hidTotal'];
if(($_REQUEST['btnSubmit']) == “Add”)
{
$swcoID = $_REQUEST['salCourseID'];
$upuser_id = $_REQUEST['salStudentID'];

for($i=0; $i<$total; $i++){
$exam_name = $_POST['txtExamName'.$i];
$marks = $_POST['txtStartDate'.$i];
$modi_by=”Khalid”;
$query = “INSERT INTO casa_assessment ( assessment_id, swco_id, upuser_id,

exam_name, marks, modified_by, mod_date) VALUES(”, “.$swcoID.”, “.$upuser_id.”,’”.$exam_name.”‘,

“.$marks .”, ‘”.$modi_by.”‘, NOW())”;
//echo $query . “<br>”;
$result = mysql_query($query, $conn) or die(mysql_error());
?>
<script language=”javascript”>
<!–
document.frmAddAssessment.btnSubmit.value=”clear”;
–>
</script>
<?
}//end for
}
?>*/?>