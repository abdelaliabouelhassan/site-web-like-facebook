<?php 

////////kandir variables bach nhat fihom dok 9ima lighayjiwni mli aydir register user
$fname = ""; //First name
$lname = ""; //Last name
$em = ""; //email
$em2 = ""; //email 2
$password = ""; //password
$password2 = ""; //password 2
$date = ""; //Sign up date 
$error_array = array(); /////bach tbayn liya error lakan f chiblasa mn hado first name ola pass ola email etx..
/////////////////


if(isset($_POST['register_button'])){

	/////////nhayd tags dyal html ou lmisahat spaces bach ikon mahmi 3andi site

	//bnsba First name
	$fname = strip_tags($_POST['reg_fname']); ////kanhyd tags mn first name bach nzid mn lhimaua
	$fname = str_replace(' ', '', $fname); //////kanhyd spaces lmisahat mn first name
	$fname = ucfirst(strtolower($fname)); //////kanrj3 awl harf lakan kbir iwali sghir 
	$_SESSION['reg_fname'] = $fname; /////kankhabi firsn name f season bach tmchi l database

	//bnsba Last name
	$lname = strip_tags($_POST['reg_lname']); ////kanhyd tags mn first name bach nzid mn lhimaua
	$lname = str_replace(' ', '', $lname); //////kanhyd spaces lmisahat mn first name
	$lname = ucfirst(strtolower($lname)); //////kanrj3 awl harf lakan kbir iwali sghir
	$_SESSION['reg_lname'] = $lname; /////kankhabi firsn name f season bach tmchi l database

	//bnsba email
	$em = strip_tags($_POST['reg_email']); //Remove html tags
	$em = str_replace(' ', '', $em); //remove spaces
	$em = ucfirst(strtolower($em)); //Uppercase first letter
	$_SESSION['reg_email'] = $em; //Stores email into session variable

	//bnsba email 2
	$em2 = strip_tags($_POST['reg_email2']); //Remove html tags
	$em2 = str_replace(' ', '', $em2); //remove spaces
	$em2 = ucfirst(strtolower($em2)); //Uppercase first letter
	$_SESSION['reg_email2'] = $em2; //Stores email2 into session variable

	//bnsba Password
	$password = strip_tags($_POST['reg_password']); ////kanhyd tags mn password bach nzid mn lhimaua
	$password2 = strip_tags($_POST['reg_password2']); ////kanhyd tags mn password bach nzid mn lhimaua

    ////tarikh date
	$date = date("Y-m-d"); ////bach ndir tarikh years ou months ou days

	if($em == $em2) {
		//// ta2kod mn email wach format dyalo shiha 
		if(filter_var($em, FILTER_VALIDATE_EMAIL)) {

			$em = filter_var($em, FILTER_VALIDATE_EMAIL);

			 //////t2akod wach email fayt msta3ml
			$e_check = mysqli_query($con, "SELECT email FROM users WHERE email='$em'");

			////nhasbo a3dad sofof lighayrj3o ya3ni 
			$num_rows = mysqli_num_rows($e_check);

			if($num_rows > 0) {
				array_push($error_array, "Email already in use<br>");
				//kankhbi error msg f array
			}

		}
		else {
			array_push($error_array, "Invalid email format<br>");////kankhbi error msg f array 
		}


	}
	else {
		array_push($error_array, "Emails don't match<br>");////kankhbi error msg f array 
	}


	if(strlen($fname) > 25 || strlen($fname) < 2) {
		array_push($error_array, "Your first name must be between 2 and 25 characters<br>");////kankhbi error msg f array 
	}

	if(strlen($lname) > 25 || strlen($lname) < 2) {
		array_push($error_array,  "Your last name must be between 2 and 25 characters<br>");////kankhbi error msg f array 
	}

	if($password != $password2) {
		array_push($error_array,  "Your passwords do not match<br>");
		//kankhbi error msg f array 
	}
	else {
		if(preg_match('/[^A-Za-z0-9]/', $password)) {
			array_push($error_array, "Your password can only contain english characters or numbers<br>");///kankhbi error msg f array
		}
	}

	if(strlen($password > 30 || strlen($password) < 5)) {
		array_push($error_array, "Your password must be betwen 5 and 30 characters<br>");////kankhbi error msg f array 
	}


	if(empty($error_array)) {
		$password = md5($password); /////kandir tachfir l password 9bal mansifto l database

      /////db als9 firstname m3a lastname b _ bach iyakhdha user ou nsaghr lharf lawl

		$username = strtolower($fname . "_" . $lname);
		$check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");


		$i = 0; 
		/////////////lakan user name kayn ayb9a izid lih 1 
		while(mysqli_num_rows($check_username_query) != 0) {
			$i++; //Add 1 to i
			$username = $username . "_" . $i;
			$check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
		}

		//////an3ti random pic profile l users
		$rand = rand(1, 6); ////kan3ti ra9m 3achwa2y mn 1 tal 6

		if($rand == 1)
			$profile_pic = "assets/images/profile_pics/defaults/head_carrot.png";
		else if($rand == 2)
			$profile_pic = "assets/images/profile_pics/defaults/head_emerald.png";
		else if($rand == 3)
			$profile_pic = "assets/images/profile_pics/defaults/head_pete_river.png";
		else if($rand == 4)
			$profile_pic = "assets/images/profile_pics/defaults/head_red.png";
		else if($rand == 5)
			$profile_pic = "assets/images/profile_pics/defaults/head_sun_flower.png";
		else if($rand == 6)
			$profile_pic = "assets/images/profile_pics/defaults/head_wisteria.png";
             
          //////////db ansift data dyal register l mysqli
		$query = mysqli_query($con, "INSERT INTO users VALUES ('', '$fname', '$lname', '$username', '$em', '$password', '$date', '$profile_pic', '0', '0', 'no', ',' , '0','0','0','0')");

		array_push($error_array, "<span style='color: #14C800;'>You're all set! Goahead and login!</span><br>");

		//Clear session variables 
		$_SESSION['reg_fname'] = "";
		$_SESSION['reg_lname'] = "";
		$_SESSION['reg_email'] = "";
		$_SESSION['reg_email2'] = "";
	}

}

 ?>