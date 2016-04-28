
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
