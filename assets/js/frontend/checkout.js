
var checkout_url = base_url + 'checkout/';



function hide_card_details()
{
   var pay_type = $("input[name=pay_type]:checked").val();

   if(pay_type=="paypal")
   {
    $(".err_cc_name").text('');
    $(".err_cc_number").text('');
    $(".err_cc_ccd").text('');
    $(".err_exp_date").text('');
    $("input[name='cc_name']").prop("readonly",true);
    $("input[name='cc_number']").prop("readonly",true);
    $("input[name='cc_ccd']").prop("readonly",true);
    $("#exp_month").prop("disabled","disabled");
    $("#exp_year").prop("disabled","disabled");
    $("input[name='cc_name']").val('');
    $("input[name='cc_number']").val('');
    $("input[name='cc_ccd']").val('');
    $('#card_type').prop('selectedIndex',0);
    $('#exp_month').prop('selectedIndex',0);
    $('#exp_year').prop('selectedIndex',0);
   }

   else
   {
    $("input[name='cc_name']").removeAttr("readonly");
    $("input[name='cc_number']").removeAttr("readonly");
    $("input[name='cc_ccd']").removeAttr("readonly");
    $("#exp_month").removeAttr("disabled");
    $("#exp_year").removeAttr("disabled");
   }
}

$(document).on("click",".edit_billing_addr",function(){
  $("input[name='ship_to_addr']").prop("checked",false);

    var url = base_url+'checkout/set_billing_address';

     $.ajax({
        url : url,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            if(data.status=="success")
            {
                $("#billing_form").show();
                $("#billing_form").html(data.content);
                $("#billing_list").hide();
                $("#billing_address").html('');

            }
            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error in Edit Billing Address');
        }
     });
});



$(document).on("click",".edit_shipping_addr",function(){


    var url = base_url+'checkout/set_shipping_address';

     $.ajax({
        url : url,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            if(data.status=="success")
            {
                $("#shipping_form").show();
                $("#shipping_form").html(data.content);
                $("#shipping_list").hide();
                $("#shipping_address").html('');

            }
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error in Edit Shipping Address');
        }
     });
});

$(document).on("change","input[name='ship_to_addr']",function(){

  var val = $(this).val();

  if(val==0)
  {
    var name = $("input[name='name']").val(),
         company_name = $("input[name='company_name']").val(),
         email = $("input[name='email']").val(),
         phone = $("input[name='phone']").val(),
         address = $("input[name='address']").val(),
         city = $("input[name='city']").val(),
         state = $("input[name='state']").val(),
         country = $(".country option:selected").val(),
         zip_code = $("input[name='zip_code']").val();

      if(name!=undefined)
      {   

         if(name!='' && company_name!='' && email!='' && phone!='' && address!='' && city!='' && state!='' && country!='' && zip_code!='')
         {
            $("input[name='sa_name']").val(name);
            $("input[name='sa_company_name']").val(company_name);
            $("input[name='sa_email']").val(email);
            $("input[name='sa_phone']").val(phone);
            $("input[name='sa_address']").val(address);
            $("input[name='sa_city']").val(city);
            $("input[name='sa_state']").val(state);
            $(".sa_country").val(country);
            $("input[name='sa_zip_code']").val(zip_code);
         }
         else
         {
           alert("Please fill all the fields in billing form");
           $("input[name='ship_to_addr']").prop("checked",false);
           return false;
         }
       }
       else
       {
        name = $("#billing_list").find("span.name").text();
        company_name = $("#billing_list").find("span.company").text();
        email = $("#billing_list").find("span.email").text();
        phone = $("#billing_list").find("span.phone").text();
        address = $("#billing_list").find("span.address").text();
        city = $("#billing_list").find("span.city").text();
        country = $("#billing_list").find("span.country").text();
        state = $("#billing_list").find("span.state").text();
        zip_code = $("#billing_list").find("span.zip_code").text();

           $("input[name='sa_name']").val(name);
            $("input[name='sa_company_name']").val(company_name);
            $("input[name='sa_email']").val(email);
            $("input[name='sa_phone']").val(phone);
            $("input[name='sa_address']").val(address);
            $("input[name='sa_city']").val(city);
            $("input[name='sa_state']").val(state);
            $(".sa_country").val(country);
            $("input[name='sa_zip_code']").val(zip_code);

       }
     }
     else
     {
          $("input[name='sa_name']").val('');
          $("input[name='sa_company_name']").val('');
          $("input[name='sa_email']").val('');
          $("input[name='sa_phone']").val('');
          $("input[name='sa_address']").val('');
          $("input[name='sa_city']").val('');
          $("input[name='sa_state']").val('');
          $(".sa_country").val('');
          $("input[name='sa_zip_code']").val('');
     }  
});


function billing_address_validation()
{

   var name = $("input[name='name']").val(),
       company_name = $("input[name='company_name']").val(),
       email = $("input[name='email']").val(),
       phone = $("input[name='phone']").val(),
       address = $("input[name='address']").val(),
       city = $("input[name='city']").val(),
       state = $("input[name='state']").val(),
       country = $(".country option:selected").val(),
       zip_code = $("input[name='zip_code']").val(),
       valid_email = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/,
       url = base_url +'checkout/save_billing_address';
   
   if(name!=undefined)
   {  


       if(name.length) 
        {
            $(".err_name").text('');
        } 
        else 
        {
            $(".err_name").text("Please Enter Your Name");
        }

        if(email=='' || !valid_email.test(email))
        {
           $(".err_email").text('Please Enter Valid Email Address');
        }
        else
        {
            $(".err_email").text('');
        }
        if(phone.length && phone.length >=10 && !isNaN(phone))
        {
            $(".err_phone").text('');
        }
        else
        {
            $(".err_phone").text('Please Enter Valid Phone No');
        }
        if(address.length)
        {
            $(".err_add").text('');
        }
        else
        {
            $(".err_add").text('Please Enter Your Address');
        }
        if(city.length)
        {
            $(".err_city").text('');
        }
        else
        {
            $(".err_city").text('Please Enter Your City');
        }
        if(state.length)
        {
            $(".err_state").text('');
        }
        else
        {
            $(".err_state").text('Please Enter Your State');
        }
        if(country.length)
        {
            $(".err_country").text('');
        }
        else
        {
            $(".err_country").text('Please Enter Your Country');
        }
        if(zip_code.length && !isNaN(zip_code))
        {
            $(".err_zip").text('');
        }
        else
        {
            $(".err_zip").text("Please Enter Valid Zip Code")
        }

        if(name=='' || email=='' || !valid_email.test(email) || phone=='' || phone.length <10 || isNaN(phone) || address=='' || city=='' || state=='' || country=='' || zip_code=='' || isNaN(zip_code))
        {
          $('html, body').animate({ scrollTop: $('#billing_information').offset().top }, 'slow');
          return false;
        }

        else if(name!='' && email!='' && phone!='' && address!='' && city!='' && state!='' && country!='' && zip_code!='')
        {
            var data = 'name='+ name +'&company_name='+ company_name +'&email=' + email +'&phone=' + phone+'&address=' + address+'&city=' + city+'&state=' + state+'&country=' + country+'&zip_code=' + zip_code; 

            $.ajax({
                url : url,
                type: "POST",
                data: data,
                dataType: "JSON",
                success: function(data)
                {
                    
                    if(data.status=="success")
                    {
                        $("#billing_address").hide();
                        $("#billing_form").html('');
                        $("#billing_list").show();
                        $("#billing_list").html(data.content);
                        $("input[name='success1']").val("billing_success");
                    }
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error adding / update data');
                }
            });

        }

        
    }


}


function shipping_address_validation()
{
   var name = $("input[name='sa_name']").val(),
       company_name = $("input[name='sa_company_name']").val(),
       email = $("input[name='sa_email']").val(),
       phone = $("input[name='sa_phone']").val(),
       address = $("input[name='sa_address']").val(),
       city = $("input[name='sa_city']").val(),
       state = $("input[name='sa_state']").val(),
       country = $(".sa_country option:selected").val(),
       zip_code = $("input[name='sa_zip_code']").val(),
       valid_email = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/,
       url = base_url +'checkout/save_shipping_address';
       
       

   if(name!=undefined)
   {
       if(name.length) 
        {
            $(".err_sa_name").text('');
        } 
        else 
        {
            $(".err_sa_name").text("Please Enter Your Name");
        }

        if(email=='' || !valid_email.test(email))
        {
           $(".err_sa_email").text('Please Enter Valid Email Address');
        }
        else
        {
            $(".err_sa_email").text('');
        }
        if(phone.length && phone.length >=10 && !isNaN(phone))
        {
            $(".err_sa_phone").text('');
        }
        else
        {
            $(".err_sa_phone").text('Please Enter Valid Phone No');
        }
        if(address.length)
        {
            $(".err_sa_add").text('');
        }
        else
        {
            $(".err_sa_add").text('Please Enter Your Address');
        }
        if(city.length)
        {
            $(".err_sa_city").text('');
        }
        else
        {
            $(".err_sa_city").text('Please Enter Your City');
        }
        if(state.length)
        {
            $(".err_sa_state").text('');
        }
        else
        {
            $(".err_sa_state").text('Please Enter Your State');
        }
        if(country.length)
        {
            $(".err_sa_country").text('');
        }
        else
        {
            $(".err_sa_country").text('Please Enter Your Country');
        }
        if(zip_code.length && !isNaN(zip_code))
        {
            $(".err_sa_zip").text('');
        }
        else
        {
            $(".err_sa_zip").text('Please Enter Valid Zip Code');
        }

        if(name=='' || email=='' || !valid_email.test(email) || phone=='' || phone.length <10 || isNaN(phone) || address=='' || city=='' || state=='' || country=='' || zip_code=='' || isNaN(zip_code))
        {
          $('html, body').animate({ scrollTop: $('#shipping_information').offset().top }, 'slow');
          return false;
        }

        else if(name!='' && email!='' && phone!='' && address!='' && city!='' && state!='' && country!='' && zip_code!='')
        {
            var data = 'name='+ name +'&company_name='+ company_name +'&email=' + email +'&phone=' + phone+'&address=' + address+'&city=' + city+'&state=' + state+'&country=' + country+'&zip_code=' + zip_code; 

            $.ajax({
                url : url,
                type: "POST",
                data: data,
                dataType: "JSON",
                success: function(data)
                {
                    
                    if(data.status=="success")
                    {
                        $("#shipping_information").hide();
                        $("#shipping_form").html('');
                        $("#shipping_list").show();
                        $("#shipping_list").html(data.content);
                        $("input[name='success']").val("shipping_success");
                    }
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error adding / update data');
                }
            });
        }
    }
}

function card_validation()
{
  var pay_type = $("input[name=pay_type]:checked").val(),
      cc_name = $("input[name='cc_name']").val(),
      cc_number = $("input[name='cc_number']").val(),
      cc_ccd = $("input[name='cc_ccd']").val(),
      exp_month = $(".exp_month option:selected").val(),
      exp_year = $(".exp_year option:selected").val(),
      currentYear = new Date().getFullYear(),
      currentMonth = new Date().getMonth() + 1,
      month = parseInt(exp_month, 10),
      year = parseInt(exp_year, 10);
      
   
   if(pay_type!="paypal")
   {
     if(cc_name.length)
      {
        $(".err_cc_name").text('');
      } 
      else
      {
        $(".err_cc_name").text('Please Enter Your Name on Card');
      } 

      if(cc_number.length)
      {
        $('#cc_number').validateCreditCard(function(result) {

          if(!result.valid)
          {
            $('.err_cc_number').text("Please Enter Valid Credit Card Number");
          }
          else
          {
            $('.err_cc_number').text("");

          }
       });
      } 
      else
      {
        $(".err_cc_number").text('Please Enter Your Credit Card Number');
      }
      if(exp_month.length && exp_year.length)
      {
          if ((year > currentYear) || ((year === currentYear) && (month >= currentMonth))) 
          {
              $(".err_exp_date").text("");
          } 
          else 
          {
              $(".err_exp_date").text("Date is Expired");
          }
      }
      else
      {
          $(".err_exp_date").text('Please Select Expiry Date');
          
      }
      if(cc_ccd.length && cc_ccd.length <=4 && !isNaN(cc_ccd))
      {
        $(".err_cc_ccd").text('');
      } 
      else
      {
        $(".err_cc_ccd").text('Please Enter Valid CCV Number');
      }   
      
   }
  
  if(pay_type=="authorize" && cc_name!='' && cc_number!='' && exp_month!='' && exp_year!='' && (year > currentYear) || ((year === currentYear) && (month >= currentMonth)) && cc_ccd!='' && cc_ccd.length <=4 && !isNaN(cc_ccd))
   {

     $('#cc_number').validateCreditCard(function(result) {

          if(!result.valid)
          {
            $('.err_cc_number').text("Please Enter Valid Credit Card Number");
          }
          else
          {
            $('.err_cc_number').text("");
            $("input[name='card_success']").val("card_success");
          }
      });
      
   }
    
}


$("#check_before_order").on("click",function(event){

    event.preventDefault();
  
  $("input[name='ship_to_addr']").prop("checked",false);

    billing_address_validation();
    shipping_address_validation();
    card_validation();

    var pay_type = $("input[name=pay_type]:checked").val(),
        billing_succ = $("input[name='success1']").val(),
        shipping_succ = $("input[name='success']").val(),
        card_succ = $("input[name='card_success']").val();

        

    if(pay_type =="paypal" && billing_succ=="billing_success" && shipping_succ=="shipping_success")
    {
      location.href = base_url + 'paypal_exp';
    }
    else if(pay_type=="authorize" && billing_succ=="billing_success" && shipping_succ=="shipping_success" && card_succ=="card_success")
    {

        submit_order();
    }
});

function submit_order()
{


  var url = checkout_url+'submit_order';
  var rurl1 = checkout_url+'success';
  var rurl2 = base_url + 'paypal/process';

  var data = $("#paymethod").serialize();
  
  
  $.ajax({
    url : url,
    type: "POST",
    data: data,
    dataType: "JSON",
    
    beforeSend: function() {
       $("#preloader").css("display",'block');
    },

    success: function(data)
    {
       //$("#preloader").css("display",'none');

        if(data.status=="success" && data.message == 'success')
        {
           location.href = rurl1;
        }

    },
    error: function (jqXHR, textStatus, errorThrown)
    {
        $("#preloader").css("display",'none');
        alert('Error adding / update data');
    }
 });
}


$(window).load(function(){

  if ($(".checkout-area").length) 
   {
     var name = sessionStorage.getItem('name');
     var company_name = sessionStorage.getItem('company_name');
     var email = sessionStorage.getItem('email');
     var phone = sessionStorage.getItem('phone');
     var address = sessionStorage.getItem('address');
     var city = sessionStorage.getItem('city');
     var state = sessionStorage.getItem('state');
     var country = sessionStorage.getItem('country');
     var zip_code = sessionStorage.getItem('zip_code');

     var sa_name = sessionStorage.getItem('sa_name');
     var sa_company_name = sessionStorage.getItem('sa_company_name');
     var sa_email = sessionStorage.getItem('sa_email');
     var sa_phone = sessionStorage.getItem('sa_phone');
     var sa_address = sessionStorage.getItem('sa_address');
     var sa_city = sessionStorage.getItem('sa_city');
     var sa_state = sessionStorage.getItem('sa_state');
     var sa_country = sessionStorage.getItem('sa_country');
     var sa_zip_code = sessionStorage.getItem('sa_zip_code');

     if (name!="undefined") $('input[name="name"]').val(name);
     if (company_name!="undefined") $('input[name="company_name"]').val(company_name);
     if (email!="undefined") $('input[name="email"]').val(email);
     if (phone!="undefined") $('input[name="phone"]').val(phone);
     if (address!="undefined") $('input[name="address"]').val(address);
     if (city!="undefined") $('input[name="city"]').val(city);
     if (state!="undefined") $('input[name="state"]').val(state);
     if (country!="undefined") $("#country option[value='"+country+"']").prop('selected', true);;
     if (zip_code!="undefined") $('input[name="zip_code"]').val(zip_code);

     if (sa_name!="undefined") $('input[name="sa_name"]').val(sa_name);
     if (sa_company_name!="undefined") $('input[name="sa_company_name"]').val(sa_company_name);
     if (sa_email!="undefined") $('input[name="sa_email"]').val(sa_email);
     if (sa_phone!="undefined") $('input[name="sa_phone"]').val(sa_phone);
     if (sa_address!="undefined") $('input[name="sa_address"]').val(sa_address);
     if (sa_city!="undefined") $('input[name="sa_city"]').val(sa_city);
     if (sa_state!="undefined") $('input[name="sa_state"]').val(sa_state);
     if (sa_country!="undefined") $(".sa_country option[value='"+sa_country+"']").prop('selected', true);;
     if (sa_zip_code!="undefined") $('input[name="sa_zip_code"]').val(sa_zip_code);

   }
});

$(window).unload(function(){

   if ($(".checkout-area").length) 
   {
     var name = $("input[name='name']").val(),
       company_name = $("input[name='company_name']").val(),
       email = $("input[name='email']").val(),
       phone = $("input[name='phone']").val(),
       address = $("input[name='address']").val(),
       city = $("input[name='city']").val(),
       state = $("input[name='state']").val(),
       country = $(".country option:selected").val(),
       zip_code = $("input[name='zip_code']").val(),
       sa_name = $("input[name='sa_name']").val(),
       sa_company_name = $("input[name='sa_company_name']").val(),
       sa_email = $("input[name='sa_email']").val(),
       sa_phone = $("input[name='sa_phone']").val(),
       sa_address = $("input[name='sa_address']").val(),
       sa_city = $("input[name='sa_city']").val(),
       sa_state = $("input[name='sa_state']").val(),
       sa_country = $(".sa_country option:selected").val(),
       sa_zip_code = $("input[name='sa_zip_code']").val();


       sessionStorage.setItem("name", name);
       sessionStorage.setItem("company_name", company_name);
       sessionStorage.setItem("email", email);
       sessionStorage.setItem("phone", phone);
       sessionStorage.setItem("address", address);
       sessionStorage.setItem("city", city);
       sessionStorage.setItem("state", state);
       sessionStorage.setItem("country", country);
       sessionStorage.setItem("zip_code", zip_code);

       sessionStorage.setItem("sa_name", sa_name);
       sessionStorage.setItem("sa_company_name", sa_company_name);
       sessionStorage.setItem("sa_email", sa_email);
       sessionStorage.setItem("sa_phone", sa_phone);
       sessionStorage.setItem("sa_address", sa_address);
       sessionStorage.setItem("sa_city", sa_city);
       sessionStorage.setItem("sa_state", sa_state);
       sessionStorage.setItem("sa_country", sa_country);
       sessionStorage.setItem("sa_zip_code", sa_zip_code);
  }
});
