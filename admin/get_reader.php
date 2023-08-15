<?php 
require_once("includes/config.php");
if(!empty($_POST["readerid"])) {
  $readerid= strtoupper($_POST["readerid"]);
 
    $sql ="SELECT FullName,Status,EmailId,MobileNumber FROM tblreaders WHERE readerid=:readerid";
$query= $dbh -> prepare($sql);
$query-> bindParam(':readerid', $readerid, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query -> rowCount() > 0)
{
foreach ($results as $result) {
if($result->Status==0)
{
echo "<span style='color:red'> Độc giả đã bị khóa </span>"."<br />";
echo "<b>Reader Name-</b>" .$result->FullName;
 echo "<script>$('#submit').prop('disabled',true);</script>";
} else {
?>


<?php  
echo htmlentities($result->FullName)."<br />";
echo htmlentities($result->EmailId)."<br />";
echo htmlentities($result->MobileNumber);
 echo "<script>$('#submit').prop('disabled',false);</script>";
}
}
}
 else{
  
  echo "<span style='color:red'> Sai định dạng. Hãy nhập lại id. .</span>";
 echo "<script>$('#submit').prop('disabled',true);</script>";
}
}



?>
