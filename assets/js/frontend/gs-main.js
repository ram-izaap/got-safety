

$(document).ready(function(){
    
     //$(".home-right").height($(".content-area").height());


// When document is ready...


	if (window.matchMedia("(min-width: 992px)").matches) {
		$(".content-bar").height($(".inner-full").height());
  		$(".right-bar").height($(".inner-full").height());

	 }


	if (window.matchMedia("(min-width: 769px)").matches) {
			// Product List page
  		$(".left-bar").height($(".inner-full").height());
  		
	}


     if (window.matchMedia("(min-width: 768px)").matches) {

  		// .content-area Parent element
  		// .home-right child element
  		$(".home-right").height($(".content-area").height());
  		

	};


function init() {
	var imgDefer = document.getElementsByTagName('img');
	for (var i=0; i<imgDefer.length; i++) {
		if(imgDefer[i].getAttribute('data-src')) {
			imgDefer[i].setAttribute('src',imgDefer[i].getAttribute('data-src'));
		} 
	}

}

window.onload = init;





$(function(){
    $(".dropdown").hover(            
            function() {
                $('.dropdown-menu', this).stop( true, true ).fadeIn("fast");
                $(this).toggleClass('open');
                $('b', this).toggleClass("caret caret-up");                
            },
            function() {
                $('.dropdown-menu', this).stop( true, true ).fadeOut("fast");
                $(this).toggleClass('open');
                $('b', this).toggleClass("caret caret-up");                
            });
    });
	
	$("input[name='pay_method']").click(function(){
    val = $(this).val();
    if(val==1)
    {
      $(".auth_div").hide();
      $(".paypal_div").show();
    }
    else
    {
      $(".auth_div").show();
      $(".paypal_div").hide();
    }
  });



  $("input[name='plan']").click(function(){
      val = $(this).val();
      value = val.split("-");
      $("input[name='plan_name']").val(value[0]);
      $("input[name='plan_cost']").val(value[1]);
  });


    val = $("input[name='pay_method']:checked").val();
    if(val==1)
    {
      $(".auth_div").hide();
      $(".paypal_div").show();
    }
    else
    {
      $(".auth_div").show();
      $(".paypal_div").hide();
    }

});





