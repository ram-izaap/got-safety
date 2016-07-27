<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<title>gotsafety.com</title>
</head>
<body bgcolor="#F4F4F4">

<style type="text/css">
body{background-image:url('<?php echo site_url(); ?>assets/images/frontend/emailtemplate/bg.gif');background-repeat:repeat-y no-repeat;background-position:top center;margin:0;padding:0;}
.bodytbl{margin:0;padding:0;-webkit-text-size-adjust:none;}
table{font-family:Helvetica, Arial, sans-serif;font-size:12px;color:#787878;}
div{line-height:18px;color:#787878;}
img{display:block;}
div.img{border:8px solid #FAFAFA;}
.header{width:100%;}
.tbox{border-top:1px solid #EBEBEB;width:50%;}
.bbox{border-bottom:1px solid #EBEBEB;width:50%;}
.box{background-color:#FAFAFA}
.h1 div{font-weight:bold;color:#416f94;font-size:48px;line-height:45px;letter-spacing:-0.04em;text-shadow:#787878 0px 1px 1px;-moz-text-shadow:#787878 0px 1px 1px;-webkit-text-shadow:#787878 0px 1px 1px;}
.h2 div{font-size:24px;letter-spacing:-0.04em;line-height:24px;}
.h div{font-weight:bold;color:#416f94;font-size:18px;line-height:18px;letter-spacing:-0.02em;margin-bottom:18px;display:block;}
.bull{font-size:20px;color:#416f94;}
.intro,.copy{font-size:9px;color:#787878;}
.bold{color:#383838;font-size:14px;font-weight:bold;}
td, tr{padding:0;}
a{color:#416f94;text-decoration:none;}
.box a{color:#416F94;text-decoration:none;}
.btn{display:block;color:#416f94;font-size:14px;margin-top:8px;margin-bottom:7px;}
.btn img{display:inline;}
.sep{margin:10px 4px;}
.pl{padding-left:20px;} 
.small,small{font-size:10px;line-height:14px;}
ul{margin-top:20px;margin-bottom:20px;} 
li{list-style:disc;margin-top:4px;margin-bottom:4px;} 
div.preheader{line-height:1px;font-size:1px;height:1px;color:#F4F4F4;display:none!important;}
</style>

<table class="bodytbl" width="100%" cellspacing="0" cellpadding="0" background="http://hhcdn.s3.amazonaws.com/email/img/bg.gif">
	<tr>
		<td align="center">

			<table width="630" cellspacing="0" cellpadding="0">
				<tr>
					<td width="600" align="center" valign="bottom">
						<div class="preheader"></div>
						<div class="intro"><div></div><a name="top"></a></div>
					</td>
				</tr>
				<tr><td width="630"><img src="<?php echo site_url(); ?>assets/images/frontend/emailtemplate/top.gif" style="display:block;" alt="" title="" width="630" height="10" border="0"></td></tr>
			</table>

			<table width="100%" cellspacing="0" cellpadding="0">
				<tr>
					<td align="center">
						<table width="600" cellspacing="0" cellpadding="0">
							<tr>
								<td height="36" class="box" bgcolor="#FCFCFC" align="left">
									<!-- Top Label start -->
									<table width="600" cellspacing="0" cellpadding="0">
										<tr>
											<td width="10" align="left"><img src="<?php echo site_url(); ?>assets/images/frontend/emailtemplate/sep_l.gif" style="display:block;" width="10" height="36" alt="" border="0"></td>
											
											<td align="right" class="bold">
												<div>1-8001-4931-34501<br><a href="mailto:info@gotsafety.com">info@gotsafety.com</a></div>
											</td>
											<td width="10" align="right"><img src="<?php echo site_url(); ?>assets/images/frontend/emailtemplate/sep_r.gif" style="display:block;" width="10" height="36" alt="" border="0"></td>
										</tr>
									</table>
									<!-- Top Label end -->
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td height="44" align="center">
						<table width="100" align="center" cellspacing="0" cellpadding="0" class="header" bgcolor="#FCFCFC">
							<tr>
								<td class="tbox">&nbsp;</td>
								<td align="center" height="25" width="600" valign="top"><img src="<?php echo site_url(); ?>assets/images/frontend/emailtemplate/bottom.gif" style="display:block;" alt="" title="" width="600" height="25" border="0"></td>
								<td class="tbox">&nbsp;</td>
							</tr>
							<tr>
								<td align="center" colspan="3">
									<!-- Header start -->
									<table width="600" cellspacing="0" cellpadding="0">
										<tr>
											<td width="5">&nbsp;</td>
											<td align="left" valign="top">
												<div><h2>Lesson Suggestion</h2>
												    <div style="">
												    <table cellspacing="10" width="100%">
												      <tr>
												        <th>Name</th>
												        <th>Company</th>
												        <th>Email</th>
												        <th>Phone No</th>
												        <th>Contact Time</th>
												        <th>Lesson Suggestion</th>
												        <th>Lesson Title</th>
												      </tr>
												      <tr><td colspan=7><hr/></td></tr>
												        <tr>
												          <td><?php echo $lesson_data['name'];?></td>
												          <td><?php echo $lesson_data['company'];?></td>
												          <td><?php echo $lesson_data['email'];?></td>
												          <td><?php echo $lesson_data['phone_no'];?></td>
												          <td><?php echo $lesson_data['contact_time'];?></td>
												          <td><?php echo $lesson_data['lesson_suggestion'];?></td>
												          <td><?php echo (isset($lesson_data['lesson_name']) && $lesson_data['lesson_name']!='')?$lesson_data['lesson_name']:'';?></td>
												        </tr>
												        <tr><td colspan=7><hr/></td></tr>     
												     </table>
												    </div>
											</td>
										</tr>
									</table>
									<!-- Header end -->
								</td>
							</tr>


						</table>
					</td>
				</tr>

			</table>


<!-- ~ header block ends here -->
<!-- 1/1 Column start  -->



<!-- 1/1 Column end   -->






<!-- Footer start -->


<table width="600" cellspacing="0" cellpadding="0">
	<tr><td align="center" height="20" valign="bottom"><img src="<?php echo site_url(); ?>assets/images/frontend/emailtemplate/sep_top.gif" style="display:block;" alt="" title="" width="600" height="10" border="0"></td></tr>
	<tr>
		<td class="box" valign="top" bgcolor="#FCFCFC">
			<table width="600" cellspacing="0" cellpadding="0">
				<tr>
					<td width="10" align="left" rowspan="3"><img src="<?php echo site_url(); ?>assets/images/frontend/emailtemplate/sep_l_f.gif" style="display:block;" width="10" height="240" alt="" border="0"></td>
					<td width="40" height="40" align="left" valign="middle">

					</td>
					<td align="left" colspan="3" class="bold">
						<div>Contact Us</div>
					</td>
					<td width="10" align="right" rowspan="3"><img src="<?php echo site_url(); ?>assets/images/frontend/emailtemplate/sep_r_f.gif" style="display:block;" width="10" height="240" alt="" border="0"></td>
				</tr>
				<tr>
					<td width="40" colspan="2">&nbsp;</td>
					<td align="left" height="100" valign="top" colspan="2">
						<div>
							Got Safety.<br>Address1<br>Address2<br>Country<br> <a href="mailto:info@gotsafety.com" target="_blank">info@gotsafety.com</a><br>
							<a href="http://www.gotsafety.com" target="_blank">http://www.gotsafety.com</a><br>Toll Free: 80012-49312-345012<br>Fax: 330121-56412-011812<br>
						</div>
						<br>
					</td>
				</tr>
				<?php if(isset($mail_type) && $mail_type == 'customer'):?>
				<tr>
					<td width="40" colspan="2">&nbsp;</td>
					<td colspan="2" valign="bottom" align="left">
						<div class="small">
							You have received this email because you have subscribed to <a href="http://www.gotsafety.com" target="_blank">Got Safety</a>.
							<br>
							If you no longer wish to receive emails from <a href="http://www.gotsafety.com" target="_blank">Got Safety</a> please <a href="#" target="_blank">unsubscribe</a>
						</div>
						<div class="small">
							
					</td>
				</tr>
				<?php endif;?>
			</table>
		</td>
	</tr>
	<tr><td align="center" height="20" valign="top"><img src="<?php echo site_url(); ?>assets/images/frontend/emailtemplate/sep_bottom.gif" style="display:block;" alt="" title="" width="600" height="25" border="0"></td></tr>
	<tr><td class="copy" align="center" height="40" valign="top"><div>&copy;Got Safety., All rights reserved</div></td></tr>
</table>
<!-- Footer end -->


</td>
</tr>
</table>
</body>
</html>

