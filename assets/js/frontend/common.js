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

 $('.video_modal .close').click(function(){      
        $('iframe').attr('src', $('iframe').attr('src'));
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

$(document).on("click","ul.lesson_list li a",function(event){

  event.preventDefault();
  var lesson_id= $(this).attr("lesson_id"),
        attachment_id=$(this).attr("attachment_id"),
        language_id=$(this).attr("language_id"),
        url = base_url+'lesson/get_lesson_data';

  $.ajax({
      url: url, 
      type: 'POST',
      dataType:'json',
      data: {
        'lesson_id': lesson_id, 'attachment_id': attachment_id,'language_id':language_id
      }
      ,
      success: function(data)
      {
        if(data.status=="success")
        {
          $("#lesson_content").html('');
          $('#lesson_content').html(data.content);
        }
      },

      error: function(jqXHR, textStatus, errorThrown) 
      {
            alert("Error get data from ajax");
      }
    });
 });

  $("select.lang").on("change",function() {


    language_id = $(".lang option:selected").val();
    title = $("input[name='search_title']").val(),
    url = base_url+'lesson/ajax_lesson_display';


    $.ajax({
      url: url, 
      type: 'POST',
      dataType:'json',
      data: {
        'language_id': language_id,'title':title
      }
      ,
      success: function(response)
      {
        $('#content-load1').html(response.html_view);
      },
      error: function(jqXHR, textStatus, errorThrown) 
      {
            alert("Error get data from ajax");
      }
    });
  });

  $(document).on("change","select.lang1",function() {


    language_id = $(".lang1 option:selected").val();
        url = base_url+'lesson/ajax_attachment_display';


     $.ajax({
       url: url, 
       type: 'POST',
       dataType:'json',
       data: {'language_id': language_id},
       
       success: function(response)
       { 
         $('#content-load').html(response.html_view);
       },
       error: function(jqXHR, textStatus, errorThrown) 
       {
         alert("Error get data from ajax");
       }
     });
  });

   $("input[name='search_title']").on("keyup",function() {

    language_id = $(".lang option:selected").val();
    title = $("input[name='search_title']").val(),
    url = base_url+'lesson/ajax_lesson_display';

    $.ajax({
      url: url, 
      type: 'POST',
      dataType:'json',
      data: {
        'language_id': language_id,'title':title
      }
      ,
      success: function(response)
      {
        $('#content-load1').html(response.html_view);
      },
      error: function(jqXHR, textStatus, errorThrown) 
      {
            alert("Error get data from ajax");
      }
    });
  });


$(document).on("click",".lesson_suggestion1",function(event){

  event.preventDefault();

  var name = $("input[name='name']").val(),
      company = $("input[name='company']").val(),
      email = $("input[name='email']").val(),
      phone_no = $("input[name='phone_no']").val(),
      lesson_suggestion = $("#lesson_suggestion").val(),
      contact_time = $("#contact_time option:selected").val(),
      url = base_url+'lesson/lesson_suggestion';
      data = 'name='+ name +'&company='+ company +'&email=' + email +'&phone_no=' + phone_no+'&lesson_suggestion=' + lesson_suggestion+'&contact_time=' + contact_time; 
      
      $.ajax({
          url : url,
          type: "POST",
          data: data,
          dataType: "JSON",
          success: function(data)
          {

            if(data.status=="failure")
            {
              $("#div-lesson-forms").html(data.content);
            }
            else if(data.status=="success")
            {
              $("#div-lesson-forms").html(data.content);
              $("input[name='name']").val('');
              $("input[name='company']").val('');
              $("input[name='email']").val('');
              $("input[name='phone_no']").val('');
              $("#lesson_suggestion").val('');
              $('#contact_time').prop('selectedIndex',0);

              $(".lesson_succ").css("display","block");
            }
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
              alert('Error adding / update data');
          }
      });
});


/*

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
	
	
 */



