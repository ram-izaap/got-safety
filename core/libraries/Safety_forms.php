<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Safety_forms
{

	public function __construct($options = array())
	{
		$this->_CI = & get_instance();
	}
	
	public function create_pdf($form_data)
	{

	   if ($form_data['form_type']=="Accident Investigation")
	   {


		$prepared_by = $_POST['prepared_by'];
		$title = $_POST['title'];
		$address_unclean = $_POST['address'];
		$address = preg_replace('/[^A-Za-z0-9\-]/', ' ', $address_unclean);
		$employee_customer = $_POST['employee_customer'];
		$position = $_POST['position'];
		$incident_date = $_POST['incident_date'];
		$time = $_POST['time'];
		$cold_flu = $_POST['cold_flu'];
		$date_reported = $_POST['date_reported'];
		$time_reported = $_POST['time_reported'];
		$sex = $_POST['sex'];
		$age = $_POST['age'];
		$years_on_job = $_POST['years_on_job'];
		$supervisors_name = $_POST['supervisors_name'];
		$self_inflicted = $_POST['self_inflicted'];
		$witness_names = $_POST['witness_names'];
		$area_1 = $_POST['area_1'];
		$area_2 = $_POST['area_2'];
		$area_3 = $_POST['area_3'];
		$area_4 = $_POST['area_4'];
		$area_5 = $_POST['area_5'];
		$area_6 = $_POST['area_6'];
		$area_7 = $_POST['area_7'];

		//Check if Checkbox is checked
		if(isset($_POST['fatality'])) {
			$fatality = "X";
		} else {
			$fatality = "";
		}
		if(isset($_POST['no_injury'])) {
			$no_injury = "X";
		} else {
			$no_injury = "";
		}
		if(isset($_POST['onsite_first_aid'])) {
			$onsite_first_aid = "X";
		} else {
			$onsite_first_aid = "";
		}
		if(isset($_POST['medical_treatment'])) {
			$medical_treatment = "X";
		} else {
			$medical_treatment = "";
		}
		if(isset($_POST['hospitalization'])) {
			$hospitalization = "X";
		} else {
			$hospitalization = "";
		}
		if(isset($_POST['lost_time'])) {
			$lost_time = "X";
		} else {
			$lost_time = "";
		}
		if(isset($_POST['property_damage'])) {
			$property_damage = "X";
		} else {
			$property_damage = "";
		}
		if(isset($_POST['vehicle_accident'])) {
			$vehicle_accident = "X";
		} else {
			$vehicle_accident = "";
		}
		if(isset($_POST['regular_job'])) {
			$regular_job = "X";
		} else {
			$regular_job = "";
		}
		if(isset($_POST['modified_duty'])) {
			$modified_duty = "X";
		} else {
			$modified_duty = "";
		}
		if(isset($_POST['security_police'])) {
			$security_police = "X";
		} else {
			$security_police = "";
		}
		if(isset($_POST['returned_other'])) {
			$returned_other = "X";
		} else {
			$returned_other = "";
		}

		$html= '<!doctype html>
		<html>
		<head>
		<meta charset="utf-8">
		<title>Accident Investigation Form</title>
		<style type="text/css">

		* {
			margin-right: auto;
			padding: 0px;
			position: static;
			margin-bottom: 0px;
			margin-left: auto;
			margin-top: 0px;
		}
		#body {
			width: 100%;
		}

		</style>
		</head>

		<body>
		<table width="90%" border="0">
		  <tbody>
		    <tr>
		      <td align="center" style="border:none;font-weight:bold;font-size:25px; margin-bottom:20px;bold;text-align: center;text-transform: uppercase;"><strong>SUPERVISORS ACCIDENT / INCIDENT INVESTIGATION REPORT</strong></td>
		    </tr>
		  </tbody>
		</table>
		<p>&nbsp;</p>
		<table width="90%" height="50" border="1">
		  <tbody>
		    <tr>
		      <td width="50%"><strong>Prepared By:</strong> ' . $prepared_by . '</td>
		      <td width="50%"><strong>Title:</strong> ' . $title . '</td>
		    </tr>
		  </tbody>
		</table>
		<br>
		<table width="90%" height="50" border="1">
		  <tbody>
		    <tr>
		      <td><strong>Location / Address:</strong> ' . $address . '</td>
		    </tr>
		  </tbody>
		</table>
		<br>
		<table width="90%" height="50" border="1">
		  <tbody>
		    <tr>
		      <td width="50%"><strong>Employee / Customer:</strong> ' . $employee_customer . '</td>
		      <td width="50%"><strong>Position:</strong> ' . $position . '</td>
		    </tr>
		  </tbody>
		</table>
		<br>
		<table width="90%" height="50" border="1">
		  <tbody>
		    <tr>
		      <td width="25%"><strong>Incident Date:</strong> ' . $incident_date . '</td>
		      <td width="25%"><strong>Time:</strong> ' . $time . '</td>
		      <td width="50%"><strong>Has the Employee had the Cold / Flu?</strong> ' . $cold_flu . '</td>
		    </tr>
		  </tbody>
		</table>
		<br>
		<table width="90%" height="50" border="1">
		  <tbody>
		    <tr>
		      <td width="25%"><strong>Date Reported:</strong> ' . $date_reported . '</td>
		      <td width="25%"><strong>Time Reported:</strong> ' . $time_reported . '</td>
		      <td width="11%"><strong>Sex:</strong> ' . $sex . '</td>
		      <td width="10%"><strong>Age:</strong> ' . $age . '</td>
		      <td width="29%"><strong>Years on the Job:</strong> ' . $years_on_job . '</td>
		    </tr>
		  </tbody>
		</table>
		<br>
		<table width="90%" height="50" border="1">
		  <tbody>
		    <tr>
		      <td width="50%"><strong>Supervisors Name:</strong> ' . $supervisors_name . '</td>
		      <td width="50%"><strong>Was it Self Inflicted?</strong> ' . $self_inflicted . '</td>
		    </tr>
		  </tbody>
		</table>
		<br>
		<table width="90%" height="50" border="1">
		  <tbody>
		    <tr>
		      <td><strong>Witness Names:</strong> ' . $witness_names . '</td>
		    </tr>
		  </tbody>
		</table>
		<br>
		<table width="90%" height="250" border="1">
		  <tbody>
		    <tr>
		      <td colspan="3" align="center" bgcolor="#ddd" style="color: #ed1c24;"><strong>Check All That Apply</strong></td>
		    </tr>
		    <tr>
		      <td width="33%"><strong>Fatality:</strong> ' . $fatality . '</td>
		      <td width="34%"><strong>Hospitalization:</strong> ' . $hospitalization . '</td>
		      <td width="33%"><strong>Return to Regular Job:</strong> ' . $regular_job . '</td>
		    </tr>
		    <tr>
		      <td><strong>No Injury - Incident Only:</strong> ' . $no_injury . '</td>
		      <td><strong>Lost Time Injury:</strong> ' . $lost_time . '</td>
		      <td><strong>Returned to Transitional / Modified Duty:</strong> ' . $modified_duty . '</td>
		    </tr>
		    <tr>
		      <td><strong>On-site First Aid Only:</strong> ' . $onsite_first_aid . '</td>
		      <td><strong>Property Damage:</strong> ' . $property_damage . '</td>
		      <td><strong>Returned to Security / Police:</strong> ' . $security_police . '</td>
		    </tr>
		    <tr>
		      <td><strong>Medical Treatment Only:</strong> ' . $medical_treatment . '</td>
		      <td><strong>Vehicle Accident:</strong> ' . $vehicle_accident . '</td>
		      <td><strong>Return to Other:</strong> ' . $returned_other . '</td>
		    </tr>
		  </tbody>
		</table>
		<br>
		<table width="90%" height="1141" border="1">
		  <tbody>
		    <tr>
		      <td align="center" bgcolor="#ddd" style="color: #ed1c24;"><strong>Please Complete All Sections Thoroughly</strong></td>
		    </tr>
		    <tr>
		      <td valign="top"><strong>1. Where did the accident / incident occur? Please be specific:</strong> ' . $area_1 . '</td>
		    </tr>
		    <tr>
		      <td valign="top"><strong>2. What happened? Describe what and how the incident occurred:</strong> ' . $area_2 . '</td>
		    </tr>
		    <tr>
		      <td valign="top"><strong>3. Describe the injury(ies) and specific part(s) of the body affected:</strong> ' . $area_3 . '</td>
		    </tr>
		    <tr>
		      <td valign="top"><strong>4. Why did it happen? Develop the cause of the incident. Focus on contributing factors: People, materials, equipment, policies:</strong> ' . $area_4 . '</td>
		    </tr>
		    <tr>
		      <td valign="top"><strong>5. How could it have been prevented?</strong> ' . $area_5 . '</td>
		    </tr>
		    <tr>
		      <td valign="top"><strong>6. Corrective Action:</strong> ' . $area_6 . '</td>
		    </tr>
		    <tr>
		      <td valign="top"><strong>7. Witness Statements (State Name and Comments):</strong> ' . $area_7 . '</td>
		    </tr>
		  </tbody>
		</table>
		</body>
		</html>';
	 }

	 else if ($form_data['form_type']=="Safety Violation")
     {

     	// Form Variables
		$to_field = $_POST['to_field'];
		$date = $_POST['date'];
		$time = $_POST['time'];
		$job_site_unclean = $_POST['job_site'];
		$job_site = preg_replace('/[^A-Za-z0-9\-]/', ' ', $job_site_unclean);
		$supervisor_foreman = $_POST['supervisor_foreman'];
		$other = $_POST['other'];
		$comments = $_POST['comments'];
		$corrective_action = $_POST['corrective_action'];
		$prepared_by = $_POST['prepared_by'];

		// Variables to check if checkboxes are checked
		if(isset($_POST['safety_glasses'])) {
			$safety_glasses = "X";
		} else {
			$safety_glasses = "";
		}
		if(isset($_POST['hard_hat'])) {
			$hard_hat = "X";
		} else {
			$hard_hat = "";
		}
		if(isset($_POST['safety_vest'])) {
			$safety_vest = "X";
		} else {
			$safety_vest = "";
		}
		if(isset($_POST['gloves'])) {
			$gloves = "X";
		} else {
			$gloves = "";
		}
		if(isset($_POST['boots'])) {
			$boots = "X";
		} else {
			$boots = "";
		}
		if(isset($_POST['horse_play'])) {
			$horse_play = "X";
		} else {
			$horse_play = "";
		}
		if(isset($_POST['driving'])) {
			$driving = "X";
		} else {
			$driving = "";
		}
		if(isset($_POST['housekeeping'])) {
			$housekeeping = "X";
		} else {
			$housekeeping = "";
		}
		if(isset($_POST['unsafe_act'])) {
			$unsafe_act = "X";
		} else {
			$unsafe_act = "";
		}

		$html= '<!doctype html>
		<html>
		<head>
		<meta charset="utf-8">
		<title>Safety Violation</title>
		<style type="text/css">

		* {
			margin-right: auto;
			padding: 0px;
			position: static;
			margin-bottom: 0px;
			margin-left: auto;
			margin-top: 0px;
		}
		#body {
			width: 100%;
		}

		</style>
		</head>

		<body>
		<table width="100%" border="0">
		  <tbody>
		    <tr>
		      <td height="19" align="center" style="border:none;font-weight:bold;font-size:25px; margin-bottom:20px;bold;text-align: center;text-transform: uppercase;"><strong>SAFETY VIOLATION</strong></td>
		    </tr>
		  </tbody>
		</table>
		<p>&nbsp;</p>
		<table width="100%" height="71" border="1" cellpadding="5" cellspacing="5">
		  <tbody>
		    <tr>
		      <td colspan="2"><strong>To:</strong> ' . $to_field . '</td>
		    </tr>
		    <tr>
		      <td width="50%"><strong>Date:</strong> ' . $date . '</td>
		      <td width="50%"><strong>Time:</strong> ' . $time . '</td>
		    </tr>
		    <tr>
		      <td><strong>Job Site:</strong> ' . $job_site . '</td>
		      <td><strong>Supervisor / Foreman:</strong> ' . $supervisor_foreman . '</td>
		    </tr>
		  </tbody>
		</table>
		<p>&nbsp;</p>
		<table width="100%" height="1141" border="1" cellpadding="5" cellspacing="5">
		  <tbody>
		  	<tr>
		    <td height="22" colspan="3" align="center" style="color: #ed1c24;" bgcolor="#ddd"><h3>Violation</h3></td>
		    </tr>
		    <tr>
		      <td><strong>Safety Gloves: </strong>' . $safety_glasses . '</td>
		      <td><strong>Gloves: </strong>' . $gloves . '</td>
		      <td><strong>Driving: </strong>' . $driving . '</td>
		    </tr>
		    <tr>
		      <td><strong>Hard Hat: </strong>' . $hard_hat . '</td>
		      <td><strong>Boots: </strong>' . $boots . '</td>
		      <td><strong>Housekeeping: </strong>' . $housekeeping . '</td>
		    </tr>
		    <tr>
		      <td><strong>Safety Vest: </strong>' . $safety_vest . '</td>
		      <td><strong>Horse Play: </strong>' . $horse_play . '</td>
		      <td><strong>Unsafe Act: </strong>' . $unsafe_act . '</td>
		    </tr>
		    <tr>
		      <td colspan="3"><strong>Other: </strong>' . $other . '</td>
		    </tr>
		    <tr>
		      <td colspan="3"><p><strong>Comments: </strong></p><p>' . $comments . '</p></td>
		    </tr>
		    <tr>
		      <td colspan="3"><p><strong>Corrective Action: </strong></p><p>' . $corrective_action . '</p></td>
		    </tr>
		    <tr>
		      <td colspan="3"><p><strong>Prepared By: </strong></p><p>' . $prepared_by . '</p></td>
		    </tr>
		  </tbody>
		</table>
		<p>&nbsp;</p>
		<table width="100%" height="1141" border="1" cellpadding="5" cellspacing="5">
		  <tbody>
		    
		  </tbody>
		</table>
		<p>&nbsp;</p>
		</body>
		</html>';

     }

     else if ($form_data['form_type']=="Daily Sign in Sheet")
     {
     	//Form Variables
		$project_name_unclean = $_POST['project_name'];
		$project_name = preg_replace('/[^A-Za-z0-9\-]/', ' ', $project_name_unclean);
		$supervisor_foreman = $_POST['supervisor_foreman'];
		// Date Variables
		$date = date('m-d-Y');

		// Sign In Table Variables
		$name_1 = $_POST['name_1'];
		$phone_number_1 = $_POST['phone_number_1'];
		$time_in_1 = $_POST['time_in_1'];
		$time_out_1 = $_POST['time_out_1'];

		$name_2 = $_POST['name_2'];
		$phone_number_2 = $_POST['phone_number_2'];
		$time_in_2 = $_POST['time_in_2'];
		$time_out_2 = $_POST['time_out_2'];

		$name_3 = $_POST['name_3'];
		$phone_number_3 = $_POST['phone_number_3'];
		$time_in_3 = $_POST['time_in_3'];
		$time_out_3 = $_POST['time_out_3'];

		$name_4 = $_POST['name_4'];
		$phone_number_4 = $_POST['phone_number_4'];
		$time_in_4 = $_POST['time_in_4'];
		$time_out_4 = $_POST['time_out_4'];

		$name_5 = $_POST['name_5'];
		$phone_number_5 = $_POST['phone_number_5'];
		$time_in_5 = $_POST['time_in_5'];
		$time_out_5 = $_POST['time_out_5'];

		$name_6 = $_POST['name_6'];
		$phone_number_6 = $_POST['phone_number_6'];
		$time_in_6 = $_POST['time_in_6'];
		$time_out_6 = $_POST['time_out_6'];

		$name_7 = $_POST['name_7'];
		$phone_number_7 = $_POST['phone_number_7'];
		$time_in_7 = $_POST['time_in_7'];
		$time_out_7 = $_POST['time_out_7'];

		$name_8 = $_POST['name_8'];
		$phone_number_8 = $_POST['phone_number_8'];
		$time_in_8 = $_POST['time_in_8'];
		$time_out_8 = $_POST['time_out_8'];

		$name_9 = $_POST['name_9'];
		$phone_number_9 = $_POST['phone_number_9'];
		$time_in_9 = $_POST['time_in_9'];
		$time_out_9 = $_POST['time_out_9'];

		$name_10 = $_POST['name_10'];
		$phone_number_10 = $_POST['phone_number_10'];
		$time_in_10 = $_POST['time_in_10'];
		$time_out_10 = $_POST['time_out_10'];

		//Date If Statements
		if ($name_2 != "") 
		{
			$date_2 = date('m-d-Y');
		}
		else
		{
			$date_2='';
		}

		if ($name_3 != "") 
		{
			$date_3 = date('m-d-Y');
		}
		else
		{
			$date_3='';
		}

		if ($name_4 != "") {
			$date_4 = date('m-d-Y');
		}
		else
		{
			$date_4='';
		}

		if ($name_5 != "") {
			$date_5 = date('m-d-Y');
		}
		else
		{
			$date_5='';
		}

		if ($name_6 != "") {
			$date_6 = date('m-d-Y');
		}
		else
		{
			$date_6='';
		}

		if ($name_7 != "") {
			$date_7 = date('m-d-Y');
		}
		else
		{
			$date_7='';
		}

		if ($name_8 != "") {
			$date_8 = date('m-d-Y');
		}
		else
		{
			$date_8='';
		}

		if ($name_9 != "") {
			$date_9 = date('m-d-Y');
		}
		else
		{
			$date_9='';
		}

		if ($name_10 != "") {
			$date_10 = date('m-d-Y');
		}
		else
		{
			$date_10='';
		}

		$html= '<!doctype html>
		<html>
		<head>
		<meta charset="utf-8">
		<title>Daily Sign In Sheet</title>
		</head>

		<body>
		<table width="100%" border="0">
		  <tbody>
		    <tr>
		      <td align="center"><h1>Star Hardware, Inc. Daily Sign In Sheet</h1></td>
		    </tr>
		  </tbody>
		</table>
		<p>&nbsp;</p>
		<table width="100%" border="0">
		  <tbody>
		    <tr>
		      <td width="50%"><strong>Project Name: </strong>' . $project_name . '</td>
		      <td width="50%"><strong>Supervisor / Foreman: </strong>' . $supervisor_foreman . '</td>
		    </tr>
		  </tbody>
		</table>
		<p>&nbsp;</p>
		<table width="100%" border="1" cellpadding="5" cellspacing="5">
		  <tbody>
		  <tr>
		      <td width="43%"><strong>Name</strong></td>
		      <td width="15%"><strong>Date</strong></td>
		      <td width="22%"><strong>Phone Number</strong></td>
		      <td width="10%"><strong>Time In</strong></td>
		      <td width="10%"><strong>Time Out</strong></td>
		    </tr>
		    <tr>
		      <td>' . $name_1 . '</td>
		      <td>' . $date . '</td>
		      <td>' . $phone_number_1 . '</td>
		      <td>' . $time_in_1 . '</td>
		      <td>' . $time_out_1 . '</td>
		    </tr>
			<tr>
		      <td>' . $name_2 . '</td>
		      <td>' . $date_2 . '</td>
		      <td>' . $phone_number_2 . '</td>
		      <td>' . $time_in_2 . '</td>
		      <td>' . $time_out_2 . '</td>
		    </tr>
			<tr>
		      <td>' . $name_3 . '</td>
		      <td>' . $date_3 . '</td>
		      <td>' . $phone_number_3 . '</td>
		      <td>' . $time_in_3 . '</td>
		      <td>' . $time_out_3 . '</td>
		    </tr>
			<tr>
		      <td>' . $name_4 . '</td>
		      <td>' . $date_4 . '</td>
		      <td>' . $phone_number_4 . '</td>
		      <td>' . $time_in_4 . '</td>
		      <td>' . $time_out_4 . '</td>
		    </tr>
			<tr>
		      <td>' . $name_5 . '</td>
		      <td>' . $date_5 . '</td>
		      <td>' . $phone_number_5 . '</td>
		      <td>' . $time_in_5 . '</td>
		      <td>' . $time_out_5 . '</td>
		    </tr>
			<tr>
		      <td>' . $name_6 . '</td>
		      <td>' . $date_6 . '</td>
		      <td>' . $phone_number_6 . '</td>
		      <td>' . $time_in_6 . '</td>
		      <td>' . $time_out_6 . '</td>
		    </tr>
			<tr>
		      <td>' . $name_7 . '</td>
		      <td>' . $date_7 . '</td>
		      <td>' . $phone_number_7 . '</td>
		      <td>' . $time_in_7 . '</td>
		      <td>' . $time_out_7 . '</td>
		    </tr>
			<tr>
		      <td>' . $name_8 . '</td>
		      <td>' . $date_8 . '</td>
		      <td>' . $phone_number_8 . '</td>
		      <td>' . $time_in_8 . '</td>
		      <td>' . $time_out_8 . '</td>
		    </tr>
			<tr>
		      <td>' . $name_9 . '</td>
		      <td>' . $date_9 . '</td>
		      <td>' . $phone_number_9 . '</td>
		      <td>' . $time_in_9 . '</td>
		      <td>' . $time_out_9 . '</td>
		    </tr>
			<tr>
		      <td>' . $name_10 . '</td>
		      <td>' . $date_10 . '</td>
		      <td>' . $phone_number_10 . '</td>
		      <td>' . $time_in_10 . '</td>
		      <td>' . $time_out_10 . '</td>
		    </tr>
		  </tbody>
		</table>
		</body>
		</html>';
     }

     else if ($form_data['form_type']=="Safety Inspection Check List")
     {

     	  //Form Variables
			$foreman_name = $_POST['foreman_name'];
			$job_site_unclean = $_POST['job_site'];
			$job_site = preg_replace('/[^A-Za-z0-9\-]/', ' ', $job_site_unclean);
			$date = date('m-d-Y');
			$supervisor = $_POST['supervisor'];

			// Text Area Variables
			$other = $_POST['other'];
			$details = $_POST['details'];
			$corrective_action = $_POST['corrective_action'];

			// Variables for Radio Button Questions and Answers
			$question_1 = isset($_POST['question_1'])?$_POST['question_1']:'';

			$question_2 = isset($_POST['question_2'])?$_POST['question_2']:'';
			$question_3 = isset($_POST['question_3'])?$_POST['question_3']:'';
			$question_4 = isset($_POST['question_4'])?$_POST['question_4']:'';
			$question_5 = isset($_POST['question_5'])?$_POST['question_5']:'';
			$question_6 = isset($_POST['question_6'])?$_POST['question_6']:'';
			$question_7 = isset($_POST['question_7'])?$_POST['question_7']:'';
			$question_8 = isset($_POST['question_8'])?$_POST['question_8']:'';
			$question_9 = isset($_POST['question_9'])?$_POST['question_9']:'';
			$question_10 = isset($_POST['question_10'])?$_POST['question_10']:'';
			$question_11 = isset($_POST['question_11'])?$_POST['question_11']:'';
			$question_12 = isset($_POST['question_12'])?$_POST['question_12']:'';
			$question_13 = isset($_POST['question_13'])?$_POST['question_13']:'';
			$question_14 = isset($_POST['question_14'])?$_POST['question_14']:'';
			$question_15 = isset($_POST['question_15'])?$_POST['question_15']:'';
			$question_16 = isset($_POST['question_16'])?$_POST['question_16']:'';
			$question_17 = isset($_POST['question_17'])?$_POST['question_17']:'';
			$question_18 = isset($_POST['question_18'])?$_POST['question_18']:'';
			$question_19 = isset($_POST['question_19'])?$_POST['question_19']:'';
			$question_20 = isset($_POST['question_20'])?$_POST['question_20']:'';
			$question_21 = isset($_POST['question_21'])?$_POST['question_21']:'';
			$question_22 = isset($_POST['question_22'])?$_POST['question_22']:'';
			$question_23 = isset($_POST['question_23'])?$_POST['question_23']:'';
			$question_24 = isset($_POST['question_24'])?$_POST['question_24']:'';
			$question_25 = isset($_POST['question_25'])?$_POST['question_25']:'';


			if ($question_1 == "yes") 
			{
				$answer_1_yes = "X";
				$answer_1_no = "";
			} 
			else 
			{ 
				$answer_1_no = "X";
				$answer_1_yes = "";
			}

			if ($question_2 == "yes") 
			{
				$answer_2_yes = "X";
				$answer_2_no = "";
			} 
			else 
			{ 
				$answer_2_no = "X";
				$answer_2_yes = "";
			}

			if ($question_3 == "yes") 
			{
				$answer_3_yes = "X";
				$answer_3_no = "";
			} 
			else 
			{ 
				$answer_3_yes = "";
				$answer_3_no = "X";
			}

			if ($question_4 == "yes") 
			{
				$answer_4_yes = "X";
				$answer_4_no = "";
			} 
			else 
			{ 
			   $answer_4_no = "X";
			   $answer_4_yes = "";
			}

			if ($question_5 == "yes") 
			{
				$answer_5_yes = "X";
				$answer_5_no = "";
			} 
			else 
			{ 
				$answer_5_no = "X";
				$answer_5_yes = "";
			}

			if ($question_6 == "yes") 
			{
				$answer_6_yes = "X";
				$answer_6_no = "";
			} 
			else 
			{ 
				$answer_6_no = "X";
				$answer_6_yes = "";
			}

			if ($question_7 == "yes") 
			{
				$answer_7_yes = "X";
				$answer_7_no = "";
			} 
			else 
			{ 
				$answer_7_no = "X";
				$answer_7_yes = "";
			}

			if ($question_8 == "yes") 
			{
				$answer_8_yes = "X";
				$answer_8_no = "";
			} 
			else 
			{ 
				$answer_8_no = "X";
				$answer_8_yes = "";
			}

			if ($question_9 == "yes") 
			{
				$answer_9_yes = "X";
				$answer_9_no = "";
			} 
			else 
			{ 
				$answer_9_no = "X";
				$answer_9_yes = "";
			}

			if ($question_10 == "yes") 
			{
				$answer_10_yes = "X";
				$answer_10_no = "";
			} 
			else 
			{ 
				$answer_10_no = "X";
				$answer_10_yes = "";
			}

			if ($question_11 == "yes") 
			{
				$answer_11_yes = "X";
				$answer_11_no = "";
			} 
			else 
			{ 
				$answer_11_no = "X";
				$answer_11_yes = "";
			}

			if ($question_12 == "yes") 
			{
				$answer_12_yes = "X";
				$answer_12_no = "";
			} 
			else 
			{ 
				$answer_12_no = "X";
				$answer_12_yes = "";
			}

			if ($question_13 == "yes") 
			{
				$answer_13_yes = "X";
				$answer_13_no = "";
			} 
			else 
			{ 
				$answer_13_no = "X";
				$answer_13_yes = "";
			}

			if ($question_14 == "yes") 
			{
				$answer_14_yes = "X";
				$answer_14_no = "";
			} 
			else 
			{ 
				$answer_14_no = "X";
				$answer_14_yes = "";
			}

			if ($question_15 == "yes") 
			{
				$answer_15_yes = "X";
				$answer_15_no = "";
			} 
			else 
			{ 
				$answer_15_no = "X";
				$answer_15_yes = "";
			}

			if ($question_16 == "yes") 
			{
				$answer_16_yes = "X";
				$answer_16_no = "";
			} 
			else 
			{ 
				$answer_16_no = "X";
				$answer_16_yes = "";
			}

			if ($question_17 == "yes") 
			{
				$answer_17_yes = "X";
				$answer_17_no = "";
			} 
			else 
			{ 
				$answer_17_no = "X";
				$answer_17_yes = "";
			}

			if ($question_18 == "yes") 
			{
				$answer_18_yes = "X";
				$answer_18_no = "";
			} 
			else 
			{ 
				$answer_18_no = "X";
				$answer_18_yes = "";
			}

			if ($question_19 == "yes") 
			{
				$answer_19_yes = "X";
				$answer_19_no = "";
			} 
			else 
			{ 
				$answer_19_yes = "";
				$answer_19_no = "X";
			}

			if ($question_20 == "yes") 
			{
				$answer_20_yes = "X";
				$answer_20_no = "";
			} 
			else 
			{ 
				$answer_20_no = "X";
				$answer_20_yes = "";
			}

			if ($question_21 == "yes") 
			{
				$answer_21_yes = "X";
				$answer_21_no = "";
			} 
			else 
			{ 
				$answer_21_no = "X";
				$answer_21_yes = "";
			}

			if ($question_22 == "yes") 
			{
				$answer_22_yes = "X";
				$answer_22_no = "";
			} 
			else 
			{
			   $answer_22_no = "X";
			   $answer_22_yes = "";
			}

			if ($question_23 == "yes") 
			{
				$answer_23_yes = "X";
				$answer_23_no = "";
			} 
			else 
			{ 
				$answer_23_no = "X";
				$answer_23_yes = "";
			}

			if ($question_24 == "yes") 
			{
				$answer_24_yes = "X";
				$answer_24_no = "";
			} 
			else 
			{ 
				$answer_24_no = "X";
				$answer_24_yes = "";
			}

			if ($question_25 == "yes") 
			{
				$answer_25_yes = "X";
				$answer_25_no = "";
			} 
			else 
			{ 
				$answer_25_no = "X";
				$answer_25_yes = "";
			}

			$html= '<!doctype html>
			<html>
			<head>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-size=1.0">
			<title>Safety Inspection Check List</title>
			<style type="text/css">

			* {
				margin-right: auto;
				padding: 0px;
				position: static;
				margin-bottom: 0px;
				margin-left: auto;
				margin-top: 0px;
			}
			#body {
				width: 100%;
			}
			.field { padding: 10px; border: 2px outset rgb(36, 153, 0); border-image: none; font-size: 16px; border-color:#249c00; width: 95%;  } 
			.field:focus { outline:none; }

			</style>
			</head>

			<body>
			<div id="body">
			<form action="process_accident_form.php" method="POST">
			<table width="100%" border="0">
			  <tbody>
			    <tr>
			      <td align="center" style="border:none;font-weight:bold;font-size:25px; margin-bottom:20px;bold;text-align: center;text-transform: uppercase;"><strong>SAFETY INSPECTION CHECK LIST</strong></td>
			    </tr>
			  </tbody>
			</table>
            <p>&nbsp;</p>
			<table width="90%" border="1" cellpadding="5" cellspacing="5">
			  <tbody>
			   
				<tr>
			      <td width="50%"><strong>Foreman Name:</strong> ' . $foreman_name . '</td>
			      <td width="50%"><strong>Job Site:</strong> ' . $job_site . '</td>
			    </tr>
			    <tr>
			      <td><strong>Date:</strong> ' . $date . '</td>
			      <td><strong>Supervisor:</strong> ' . $supervisor . '</td>
			    </tr>
			  </tbody>
			</table>
			<p>&nbsp;</p>
			<table width="90%" height="1141" border="1" cellpadding="5" cellspacing="5">
			  <tbody>
			    <tr>
			      <td width="80%" align="center" bgcolor="#ddd" style="color: #ed1c24;"><strong>ITEM</strong></td>
			      <td width="10%" align="center" bgcolor="#ddd" style="color: #ed1c24;"><strong>YES</strong></td>
			      <td width="10%" align="center" bgcolor="#ddd" style="color: #ed1c24;"><strong>NO</strong></td>
			    </tr>
			    <tr>
			      <td><strong>1. Did foreman have a &quot;huddle-up&quot;?</strong></td>
			      <td align="center">' . $answer_1_yes . '</td>
			      <td align="center">' . $answer_1_no . '</td>
			    </tr>
			    <tr>
			      <td><strong>2. Did crew perform stretching exercises before their shift?</strong></td>
			      <td align="center">' . $answer_2_yes . '</td>
			      <td align="center">' . $answer_2_no . '</td>
			    </tr>
			    <tr>
			      <td><strong>3. Did foreman provide shade at  (80 degrees)? </strong></td>
			      <td align="center">' . $answer_3_yes . '</td>
			      <td align="center">' . $answer_3_no . '</td>
			    </tr>
			    <tr>
			      <td><strong>4. Did foreman provide water (2 gallons per person/day)?</strong></td>
			      <td align="center">' . $answer_4_yes . '</td>
			      <td align="center">' . $answer_4_no . '</td>
			    </tr>
			    <tr>
			      <td><strong>5. Did foreman provide for the replenishing of water?</strong></td>
			      <td align="center">' . $answer_5_yes . '</td>
			      <td align="center">' . $answer_5_no . '</td>
			    </tr>
			    <tr>
			      <td><strong>6. Did foreman assign a flag person?</strong></td>
			      <td align="center">' . $answer_6_yes . '</td>
			      <td align="center">' . $answer_6_no . '</td>
			    </tr>
			    <tr>
			      <td><strong>7. Did foreman identify, communicate, and correct hazards?</strong></td>
			      <td align="center">' . $answer_7_yes . '</td>
			      <td align="center">' . $answer_7_no . '</td>
			    </tr>
			    <tr>
			      <td><strong>8. Does foreman have the IIPP?</strong></td>
			      <td align="center">' . $answer_8_yes . '</td>
			      <td align="center">' . $answer_8_no . '</td>
			    </tr>
			    <tr>
			      <td><strong>9. Does foreman have a map to the nearest medical clinic?</strong></td>
			      <td align="center">' . $answer_9_yes . '</td>
			      <td align="center">' . $answer_9_no . '</td>
			    </tr>
			    <tr>
			      <td><strong>10. Does foreman have directions to the job site?</strong></td>
			      <td align="center">' . $answer_10_yes . '</td>
			      <td align="center">' . $answer_10_no . '</td>
			    </tr>
			    <tr>
			      <td><strong>11. Does foreman have his first aid kit?</strong></td>
			      <td align="center">' . $answer_11_yes . '</td>
			      <td align="center">' . $answer_11_no . '</td>
			    </tr>
			    <tr>
			      <td><strong>12. Does foreman have his fire extinguisher?</strong></td>
			      <td align="center">' . $answer_12_yes . '</td>
			      <td align="center">' . $answer_12_no . '</td>
			    </tr>
			    <tr>
			      <td><strong>13. Does foreman have MSDS/SDS book on job site?</strong></td>
			      <td align="center">' . $answer_13_yes . '</td>
			      <td align="center">' . $answer_13_no . '</td>
			    </tr>
			    <tr>
			      <td><strong>14. Does foreman know the weather?</strong></td>
			      <td align="center">' . $answer_14_yes . '</td>
			      <td align="center">' . $answer_14_no . '</td>
			    </tr>
			    <tr>
			      <td><strong>15. Did foreman conduct the latest Safety Tailgate Meeting?</strong></td>
			      <td align="center">' . $answer_15_yes . '</td>
			      <td align="center">' . $answer_15_no . '</td>
			    </tr>
			    <tr>
			      <td><strong>16. Did foreman provide for timely rest and meal periods?</strong></td>
			      <td align="center">' . $answer_16_yes . '</td>
			      <td align="center">' . $answer_16_no . '</td>
			    </tr>
			    <tr>
			      <td><strong>17. Did new employees receive training?</strong></td>
			      <td align="center">' . $answer_17_yes . '</td>
			      <td align="center">' . $answer_17_no . '</td>
			    </tr>
			    <tr>
			      <td><strong>18. Power cords are in good working Condition?</strong></td>
			      <td align="center">' . $answer_18_yes . '</td>
			      <td align="center">' . $answer_18_no . '</td>
			    </tr>
			    <tr>
			      <td><strong>19. Power tools are in good working Condition?</strong></td>
			      <td align="center">' . $answer_19_yes . '</td>
			      <td align="center">' . $answer_19_no . '</td>
			    </tr>
			    <tr>
			      <td><strong>20. Nails are being removed or bent over? </strong></td>
			      <td align="center">' . $answer_20_yes . '</td>
			      <td align="center">' . $answer_20_no . '</td>
			    </tr>
			    <tr>
			      <td><strong>21. Hard Hats and safety Vest are on at all times?</strong></td>
			      <td align="center">' . $answer_21_yes . '</td>
			      <td align="center">' . $answer_21_no . '</td>
			    </tr>
			    <tr>
			      <td><strong>22. Safety Glass are on when needed?</strong></td>
			      <td align="center">' . $answer_22_yes . '</td>
			      <td align="center">' . $answer_22_no . '</td>
			    </tr>
			    <tr>
			      <td><strong>23. Gloves when needed? </strong></td>
			      <td align="center">' . $answer_23_yes . '</td>
			      <td align="center">' . $answer_23_no . '</td>
			    </tr>
			    <tr>
			      <td><strong>24. Equipment is in safe working order (no leaks, back up alarm is working and 3&rdquo;  seat belt is working)</strong></td>
			      <td align="center">' . $answer_24_yes . '</td>
			      <td align="center">' . $answer_24_no . '</td>
			    </tr>
			    <tr>
			      <td><strong>25. Operator is wearing seat belt?</strong></td>
			      <td align="center">' . $answer_25_yes . '</td>
			      <td align="center">' . $answer_25_no . '</td>
			    </tr>
				<tr>
			      <td colspan="3"><p><strong>Other:</strong></p>
			        <p>' . $other . '</p></td>
			    </tr>
			    <tr>
			      <td colspan="3"><p><strong>Details:</strong></p>
			        <p>' . $details . '</p></td>
			    </tr>
			    <tr>
			      <td colspan="3"><p><strong>Corrective Action:</strong></p>
			        <p>' . $corrective_action . '</p></td>
			    </tr>
			  </tbody>
			</table>

			</form>
			</div>
			</body>
			</html>';

     }

		return $html;
		
	}
}