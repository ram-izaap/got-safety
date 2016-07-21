/* 
*Select Attribute to load the Attribute Value in Product Add Page 
*/

$('.sel_label_size').on("change",function() {

    var type = $('option:selected', this).attr('variationid'),
    url = base_url+'product/get_price/'+type;

      $("#attr_price").html('');
      if(type!='')
      {
          $.ajax({
                url : url,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    if(data.status=='success')
                       $("#attr_price").html(data.content);
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
          });
      }
      
  });


$(window).load(function(){
    var $divs = $("div.product-loop");

  $('#sort').on('change', function () {
    $val = $(this).val();

    if($val=="low-to-high")
    {
      var lowprice = $divs.sort(function (a, b) {
          return $(a).find("h2").text() > $(b).find("h2").text();
      });
      $("#product-container").html(lowprice);
    }
    else if($val=="high-to-low") {
      var highprice = $divs.sort(function (a, b) {
          return $(a).find("h2").text() < $(b).find("h2").text();
      });
      $("#product-container").html(highprice);
    }
    else if($val=="new-item") {
      var newitem = $divs.sort(function (a, b) {
          return new Date( $(a).find("h3").text() ) < new Date( $(b).find("h3").text() );
      });
      $("#product-container").html(newitem);
    }
    else if($val=="default-order")
    {
      var defaultorder = $divs.sort(function (a, b) {
          return $(a).find("h4").text() > $(b).find("h4").text();
      });
      $("#product-container").html(defaultorder);
    }
   });
});


function newTabFunction() { 
    var w = window.open();
    var html = $("#newTab").html();

    $(w.document.body).html(html);
}


$(function() { 
    $("a#link").click(newTabFunction);
});


function newTabFunction2() { 
    var w = window.open();
    var html = $("#newTab2").html();

    $(w.document.body).html(html);
}


$(function() { 
    $("a#link2").click(newTabFunction2);
});

function newTabFunction3() { 
    var w = window.open();
    var html = $("#newTab3").html();

    $(w.document.body).html(html);
}


$(function() { 
    $("a#link3").click(newTabFunction3);
});

function newTabFunction4() { 
    var w = window.open();
    var html = $("#newTab4").html();

    $(w.document.body).html(html);
}


$(function() { 
    $("a#link4").click(newTabFunction4);
});
	
	
 



