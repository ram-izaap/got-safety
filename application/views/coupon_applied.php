<span class='coupon_succ'>
	 <span style="width:85px;"><?=$coupon['code'];?></span> - $<?=number_format($coupon['ans'],2);?>&nbsp;
		<a href='javascript:void(0);' class='del_coupon green'>x</a>
</span>
<script type="text/javascript">
	$(".del_coupon").click(function(){
  id = $(this).attr("data-id");
  url = base_url+"login/del_coupon";
  $.ajax({
  	type:"POST",
  	url:url,
  	data:{id:id},
  	success:function(data)
  	{
  		$(".coupon_error,.coupon_success").html("");
  	}
  });
});
</script>