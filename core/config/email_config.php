<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
		
/*
		  $config['email']['protocol'] = 'smtp';
		  $config['email']['smtp_host'] = 'ssl://smtp.gmail.com';
		  $config['email']['smtp_port'] = 465;
		  $config['email']['smtp_user'] = 'healiohealth123@gmail.com';
		  $config['email']['smtp_pass'] = 'healio123';
		  $config['email']['mailtype'] = 'html';

*/	
  $config['email']['protocol'] = 'sendmail';
  $config['email']['mailtype'] = 'html'; 
 


	//channel wise email details
	
	/*
	healiohealth => 1
	paintech	 => 2
	zinganything => 3
	doctorstore  => 4
	sears  		 => 5
	amazon  	 => 7
	amazon-FBA 	 => 8
	Ext-vendors  => 9
	*/

	/*$config['email']['channel_details'][1] = array(
											'email_id' 	=> 'support@healiohealth.com',
											'from_name' => 'Healio Health',
											'site_name' => 'HealioHealth.com',
											'info_email_id' 	=> 'info@healiohealth.com',
											'fax' => '800-867-5309',
											'phone' => '800-493-3450',
											'logo' => 'https://hhcdn.s3.amazonaws.com/images/logo.jpg'
											);

	$config['email']['channel_details'][3] = array(
											'email_id' 	=> 'support@zinganything.com',
											'from_name' => 'Zing Anything',
											'site_name' => 'zinganything.com',
											'info_email_id' => 'info@zinganything.com',
											'fax' => '800-867-5309',
											'phone' => '800-573-0052',
											'logo' => 'https://zinganything.s3.amazonaws.com/img/zingLogo.jpg'
											);
	$config['email']['channel_details'][4] = array(
											'email_id' 	=> 'support@doctorstore.com',
											'from_name' => 'DoctorStore',
											'site_name' => 'DoctorStore.com',
											'info_email_id' => 'info@doctorstore.com',
											'fax' => '800-867-5309',
											'phone' => '330-867-5309',
											'logo' => 'https://hhcdn.s3.amazonaws.com/images/logo.jpg'
											);

	$config['email']['channel_details'][5] = array(
											'email_id' 	=> 'support@healiohealth.com',
											'from_name' => 'Healio Health',
											'site_name' => 'HealioHealth.com',
											'info_email_id' 	=> 'info@healiohealth.com',
											'fax' => '800-867-5309',
											'phone' => '800-493-3450',
											'logo' => 'https://hhcdn.s3.amazonaws.com/images/logo.jpg'
											);

	$config['email']['channel_details'][7] = array(
											'email_id' 	=> 'support@helioliving.com',
											'from_name' => 'Helio Living',
											'site_name' => 'helioliving.com',
											'info_email_id' 	=> 'info@healiohealth.com',
											'fax' => '800-867-5309',
											'phone' => '800-493-3450',
											'logo' => 'https://hhcdn.s3.amazonaws.com/images/logo.jpg'
											);

	$config['email']['channel_details'][8] = array(
											'email_id' 	=> 'support@helioliving.com',
											'from_name' => 'Helio Living',
											'site_name' => 'helioliving.com',
											'info_email_id' 	=> 'info@healiohealth.com',
											'fax' => '800-867-5309',
											'phone' => '800-493-3450',
											'logo' => 'https://hhcdn.s3.amazonaws.com/images/logo.jpg'
											);
	$config['email']['channel_details'][9] = array(
											'email_id' 	=> 'support@healiohealth.com',
											'from_name' => 'Healio Health',
											'site_name' => 'HealioHealth.com',
											'info_email_id' 	=> 'info@healiohealth.com',
											'fax' => '800-867-5309',
											'phone' => '800-493-3450',
											'logo' => 'https://hhcdn.s3.amazonaws.com/images/logo.jpg'
											);

	if ( ($file=safe_include("config/email_config.local.php", false)) ) {
    require $file;
}
*/

/* End of file email_config.php */
/* Location: ./system/application/config/email_config.php */
