<?php
//print_r($_POST);
if ((empty($_POST['userid'])) && (empty($_POST['uname'])) && (empty($_POST['mobile'])) && (empty($_POST['pass'])) && (empty($_POST['repass'])) && (empty($_POST['dob']))) {
	echo "***********Please Fil The Fields*********";
}
elseif (empty($_POST['userid'])) {
	echo "*********Please Enter Userid*********";
}
elseif (empty($_POST['uname'])) {
	echo "**********Please Enter UserName**************";
}
elseif (empty($_POST['mobile'])) {
	echo "**************Please Enter Mobile Number***********";
}
elseif (empty($_POST['pass'])) {
	echo "************Please Enter New Password***********";
}
elseif (empty($_POST['repass'])) {
	echo "************Please Enter ReTypePassword*************";
}
elseif (empty($_POST['dob'])) {
	echo "******************Please Enter Date Of Birth*****************";
}
else{
	$userid=$_POST['userid'];
	$uname=$_POST['uname'];
	$mobile=$_POST['mobile'];
	$pass=$_POST['pass'];
	$repass=$_POST['repass'];
	$dob=$_POST['dob'];
	if (strcmp($pass, $repass)==0) {
		echo "********Password matching*********";
		$pass=$_POST['pass'];
		echo "<br>";
		include('db_config.php');
		if ($con->connect_error) {
			die('connection failed'.$con->connect_error);
		}
		else{
			//echo "*****connection successfully*******";
			$sql="SELECT * FROM `admin` WHERE `mobile`='".$mobile."' AND `dob`='".$dob."' ";
			$res=mysqli_query($con,$sql);
			$row=mysqli_fetch_array($res);
			$count=mysqli_num_rows($res);
			if ($count==1) {
				echo "*****First Step Verification Ok******";
				echo "<br>";
				echo $pass;
				$query="UPDATE `admin` SET `password`='$_POST[pass]', `username`='$_POST[uname]' WHERE `userid`='$_POST[userid]' ";
				//mysqli_query($con,$sql)
				if (mysqli_query($con,$sql)) {
					echo "********Password and username changed Updated successfully***********";
				}
				else{
					echo "error incorrect userid and username";
				}
			}
			else{
				echo "error mobile number and date of birth";
			}
		}
	}
	else{
		echo "******Password not matched************";
	}
}

?>