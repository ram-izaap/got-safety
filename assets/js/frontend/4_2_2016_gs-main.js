

$(document).ready(function(){
    
     //$(".home-right").height($(".content-area").height());


// When document is ready...





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


	
	

});





