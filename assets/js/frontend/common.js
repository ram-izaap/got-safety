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
                    console.log(data.content);
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



 



