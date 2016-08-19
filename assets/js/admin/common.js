function before_ajax(elm, content)
{
	if(!$(elm).length)
		return false;

	content=content?content:'Processing...';
	
	if($(elm).attr("disabled")=="disabled")
    {
		return false;
    }
	else
	{
		$(elm).attr("disabled","disabled");
		
		if(content)
		{
			var w1 = $(elm).width();
			
			if($(elm).is("a"))
			{
			 elm_old_text = $(elm).html();
             
			 if($(elm).hasClass("add_loader_class")){
			     $(elm).addClass($(elm).attr("data-add_loader_class"));
			 }
             else
             {
				$(elm).text(content);
             }
			
			}
			else if($(elm).is("button"))
			{
				elm_old_text = $(elm).text();
				$(elm).text(content);
			}
			else if($(elm).attr("type") == 'checkbox' && $(elm).parent().hasClass('add-on') && $(elm).parent().next().hasClass('add-on'))
			{
				elm_old_text = $(elm).parent().next().html();
				$(elm).parent().next().html(content);
			}
			
			var w2 = $(elm).width();
			
			if(w2<w1)
				$(elm).width(w1);
			
		}
			
		return true;
	}
	
}

/*The functions "after_ajax" should be called after ajax-process end.
 * It enables the button or anchor elemnts and resets thier original text.
 */ 

function after_ajax(elm,data)
{
    
	if($(elm).length)
	{
		if($(elm).is("a,span"))
		{
		    if($(elm).hasClass("add_loader_class")){
			     $(elm).removeClass($(elm).attr("data-add_loader_class"));
	        }
        
            $(elm).removeAttr("disabled");
            $(elm).html(elm_old_text);
			
		}
		else if($(elm).is("button"))
		{
			$(elm).removeAttr("disabled");
			$(elm).text(elm_old_text);
		}
		else if($(elm).attr("type") == 'checkbox' && $(elm).parent().hasClass('add-on') && $(elm).parent().next().hasClass('add-on'))
		{
			$(elm).removeAttr("disabled");
			$(elm).parent().next().html(elm_old_text);
		}
	}
	
    if(data.access_status && data.access_status == 'denied')
    {
    	if(data.access_message && data.access_message != '')
    		alert(data.access_message);
    	else
    		alert("Access denied.");
        
        return false;
        
    }
    else if(data.session_status && data.session_status == 'destroyed')
    {
        alert("Oops!! Your session has expierd.");
        location.href = base_url+'login.php/login';
        return false;
        
    }
    
	return true;	
	
}


function DeleteCheckedRow(e,cls,url,divid='')
{ 
    var rec_count = $(document).find('.'+cls+':checked').length, ids = '';
    
  if(rec_count <= 0 ) {
    alert("Please check atleast 1 record to delete!"); return false;
  }
   
  var conf = confirm("Are you sure want to delete "+ rec_count + " Record(s)?");
  
  if(! conf ) return false;
  
     $(document).find("."+cls+":checked").each(function(){ 
        ids += (ids)?','+$(this).val():$(this).val();
  });
  
   url = base_url+'index.php/'+url;
   
  // alert(url);
   before_ajax(e);
   
     
   $.ajax({
          type: "POST",
          url: url,
          data: {id:ids},
          success: function(res){  
            alert(rec_count+' record(s) deleted successfully');
           if(divid == 'navigation') {
                $("#tabs ul li").eq(2).find('a').trigger('click');
            }
            else if(divid == 'social-links')
            {
                $("#tabs ul li").eq(1).find('a').trigger('click');
            }
            else if(divid == 'team-links')
            { 
                $("#tabs ul li").eq(1).find('a').trigger('click');
            }
            else if(divid == 'review-links')
            { 
                $("#tabs ul li").eq(1).find('a').trigger('click');
            }
            else
            { 
                //$("#content-wrapper").trigger('load');
                window.location.reload();
            }
           after_ajax(e);
          },
          error: function(e) {
            	//called when there is an error
            	console.log(e.message);
                after_ajax(e);
              }
        });
}

function get_export()
{
	search_value = $('#exmaplePrependButton').val();
	search_field = $('#search_field').val();
	
	url = base_url+'signoff/bulk_export_set/';
	
	$.ajax({
          type: "POST",
          url: url,
          data: {search_field:search_field,search_value:search_value},
          success: function(res){  
			  
            alert(res);
          },
         
        }); 
        
        
        
             
	
}

/* Save Attribute */

function add_attr_name()
{
    $('#attr_form').modal('show');
    $('.modal-title').text('Add Attribute');
    $(".err").hide();
    $('input[name="attr_name"]').val('');
}

$('#save_attr_name').on("click",function(event) {
   
   $("#attribute_index").attr("onsubmit", "javascript:return false");

   var url=base_url+'attribute/add_edit_attr/',
    attr_name = $("input[name='attr_name']").val(),
    is_active = $("input[name=is_active]:checked").val(),
    is_Active = (is_active!=undefined)?1:0,
    edit_id = $("input[name='edit_id']").val();


    if(attr_name=='')
    {
        $(".err").show();
        event.preventDefault();
        return false;
    }

    else
    {
        if(edit_id!='')
           save_method = 'update';
        else
           save_method='add';	


        var data = 'attr_name='+ attr_name +'&is_active=' + is_active+'&edit_id=' + edit_id+'&save_method=' + save_method; 

        $.ajax({
            url : url,
            type: "POST",
            data: data,
            dataType: "JSON",

            beforesend: function()
            {
              $('#attr_form').modal('show');
            },

            success: function(data)
            {
                if(data.status=='success')
                {
                    $('#attr_form').modal('hide');
                    window.location.href= base_url+'attribute';
                }
                else if(data.status=='This attribute already exists. Please enter a new attribute')
                {
                  $('#attr_form').modal('show');
                  $(".err").show()
                  $(".err").text("This attribute already exists.");
                }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
            	alert('Error adding / update data');
                window.location.href= base_url+'attribute';
            }
        });
    }
});


function edit_attr_name(id)
{
    save_method='list';
    var data = 'save_method=' + save_method;

    $(".err").hide();

    $.ajax({
        url : base_url+'attribute/add_edit_attr/'+id, 
        type: "POST",
        dataType: "JSON",
        data:data,

        success: function(data)
        {
        	
            $('input[name="attr_name"]').val(data.attr_name);
            $('input[name="edit_id"]').val(data.id);
            if(data.is_active==1)
              $("input[name=is_active]").prop("checked",true);

            $('.modal-title').text('Edit Attribute');
            $('#attr_form').modal('show');
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

/* Save Attribute Values */

$(".add_attr_val").on("click",function()
{

    var id = $(this).attr("id1"),
        attr_id = $(this).attr("attr_id"),
        attr_val = $(this).attr("attr_val"),
        is_active = $(this).attr("is_active"),
        url = base_url+'attribute/get_attribute/';
      
        var data = 'attr_id=' + attr_id;

       $(".err").hide();
       $(".err1").hide();

       $(".modal-title").text("Edit Attribute Value");    

    $('.attr_names').html('');
     $.ajax({
        url : url,
        type: "POST",
        dataType: "JSON",
        data:data,
        success: function(data)
        {
            $('.attr_names').append("<option value=''>Select Attribute</option>");
            
            $.each(data, function(index,item) {
                if(item.id==attr_id)
                    var selected1="selected";
                else
                    var selected1='';
                $('.attr_names').append("<option value='"+item.id+"' "+selected1+">"+item.attr_name+"</option>");
            });
            
            if(is_active=='Active')
              $("input[name=is_active]").prop("checked",true);

            $("input[name='edit_id']").val(id);
            $("input[name='attr_val']").val(attr_val);
            $('#attr_form').modal('show');
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');

        }
    });
});

$('#save_attr_value').on("click",function(event) {

   $("#attribute_attribute_value").attr("onsubmit", "javascript:return false");

    var url = base_url+'attribute/add_edit_attr_val/',
        attr_name = $(".attr_names option:selected").val(),
        attr_val = $("input[name='attr_val']").val(),
        is_active = $("input[name=is_active]:checked").val(),
        is_Active = (is_active!=undefined)?1:0,
        edit_id = $("input[name='edit_id']").val();
        

    if(attr_name=='' && attr_val=='') 
    {
        $(".err").show();
        $(".err1").show();
        event.preventDefault();
        return false;
    }
    else if(attr_name=='')
    {
       $(".err").show();
       $(".err1").hide();
        event.preventDefault();
        return false;
    }
    else if(attr_val=='')
    {
       $(".err").hide();
       $(".err1").show();
        event.preventDefault();
        return false;
    }

    else
    {
        if(edit_id!='')
           save_method = 'update';
        else
           save_method='add';   

        var data = 'attr_name='+ attr_name +'&attr_val=' + attr_val +'&is_active=' + is_active+'&edit_id=' + edit_id+'&save_method=' + save_method; 

        $.ajax({
            url : url,
            type: "POST",
            data: data,
            dataType: "JSON",

            beforesend: function()
            {
              $('#attr_form').modal('show');
            },

            success: function(data)
            {
                if(data.status=='success')
                {
                    $('#attr_form').modal('hide');
                    window.location.href= base_url+'attribute/attribute_value';
                }
                else if(data.status='This attribute value already exists. Please enter a new attribute value')
                {
                  $('#attr_form').modal('show');
                  $(".err1").show();
                  $(".err1").text("This attribute value already exists.");
                }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
                window.location.href= base_url+'attribute/attribute_value';
            }
        });
    }
});

/* Select Attribute to load the Attribute Value in Product Add Page */

$('.sel_attr_type').on("change",function() {
  var type = $(this).val(),
      edit_id = $("input[name='edit_id']").val(),
      url = base_url+'product/get_attributes/'+type+'/'+edit_id;
      
      $("#attr_list").hide();

      if(type!='')
      {
          $.ajax({
                url : url,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    console.log(data.content);
                    if(data.status=='success')
                    {
                        $("#attr_list").show();
                       $("#attr_list").html(data.content);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
          });
      }
  });

  
function mediatype(val)
{
	$(".media-opt,.non-media-opt").hide();
	if(val==1)
	{
		$(".non-media-opt").show();
		$(".media-opt").hide();
	}
	else if(val==2 || val==3)
	{
		$(".non-media-opt").show();
		$(".media-opt").show();
	}
}
val= $("select[name='type']").val();
$(".media-opt,.non-media-opt").hide();
	if(val==1)
	{
		$(".non-media-opt").show();
		$(".media-opt").hide();
	}
	else if(val==2 || val==3)
	{
		$(".non-media-opt").show();
		$(".media-opt").show();
	}

function cancel_sub(attr)
{
  href = attr.getAttribute("data-href");
  con = confirm("Are you sure want to do this?");
  
  if(con){
    window.location.href=href;
  }  
  else
  {
    location.reload();
  }  
}

function show_payment()
{
  $(".payment-info").show();
}

$("input[name='plan_name']").click(function(){
  val = $(this).attr("data-price");
  type = $(this).attr("data-type");
  $(".plan-amt").html("$"+val);
  $(".ip_amt").val(val);
  $(".ip_type").val(type);
});

$(document).on("click",".employee_view",function(){
  var client_id = $(this).attr("client_id"),
      url = base_url+'employee',
      data = 'client_id='+ client_id; 

      $.ajax({
          url : url,
          type: "POST",
          data: data,
          dataType: "JSON",

          success: function(data)
          {
            window.location.href= base_url+'employee';

          },
          error: function (jqXHR, textStatus, errorThrown)
          {
              alert('Error get data from ajax');
          }
      });


});
 $("select[name='discount_type']").change(function(){
    val = $(this).val();
    if(val=="1")
      $(".dis_label").html("Amount");
    else
      $(".dis_label").html("Percentage");
  });
 $("select[name='offer_type']").change(function(){
    val = $(this).val();
    if(val=="1")
    {
      $(".amount_over").removeClass("hide");
      $(".spec_prod").addClass("hide");
    }
    else if(val=="3")
    {
      $(".spec_prod").removeClass("hide");
      $(".amount_over").addClass("hide");
    }
    else
    {
      $(".amount_over").addClass("hide");
      $(".spec_prod").addClass("hide");
    }
  });

  $("select[name='order_type']").change(function(){
    val = $(this).val();
    if(val=="1")
    {
      $(".shop-only").removeClass("hide");
      $(".spec_plan").addClass("hide");
    }
    else
    {
      $(".shop-only").addClass("hide");
      $(".spec_plan").removeClass("hide");
    }
  });


  d_type = $("select[name='order_type']").val();
  if(d_type=="1")
  {
    $(".shop-only").removeClass("hide");
    $(".spec_plan").addClass("hide");
  }
  else if(d_type=="2")
  {
    $(".shop-only").addClass("hide");
    $(".spec_plan").removeClass("hide");
  }
 


 offer = $("select[name='offer_type']").val();
  if(offer=="1")
  {
    $(".amount_over").removeClass("hide");
    $(".spec_prod").addClass("hide");
  }
  else if(offer=="3")
  {
    $(".spec_prod").removeClass("hide");
    $(".amount_over").addClass("hide");
  }
  else
  {
    $(".amount_over").addClass("hide");
    $(".spec_prod").addClass("hide");
  }

  discount = $("select[name='discount_type']").val();
  if(discount=="1")
   $(".dis_label").html("Amount");
  else
    $(".dis_label").html("Percentage");

  $(".delete-coupon").click(function(){
    id = $(this).attr("data-id");
    $("a.remove-coupon").attr("href","http://localhost/got-safety/admin/promo/delete/"+id);
  });

  