$('#attr_price').on('click', '.add_to_cart', function(event) {

    event.preventDefault();
    var pid = $("input[name='p_id']").val(),
        attr_val_id = $(".sel_label_size option:selected").val(),
        qty = $("input[name='quantity']").val(),
        url = base_url + 'cart/add/' + pid + '/' + attr_val_id + '/' + qty;

        alert(qty);
        return false;

    $.ajax({
        url: url,
        type: "GET",
        dataType: "JSON",

        success: function(data) {
            if (data.status == 'success') {
                $("#add_to_cart").html(data.content);
                $(".cart_item").find(".subtotal").html("$" + data.subtotal);
                $(".cart_item").find(".items").html("" + data.total_items + " items <i class='fa fa-shopping-cart'></i>");
                $("#add_cart_modal").modal("show");
            }
        },

        error: function(jqXHR, textStatus, errorThrown) {
            alert("Error get data from ajax");
        }
    });
});

$(document).ready(function() {
    var url = base_url + 'cart/get_cart_dtl';
    $.ajax({
        url: url,
        type: "GET",
        dataType: "JSON",

        success: function(data) {
            if (data.status == 'success') {
                $("#add_to_cart").html(data.content);
                $(".cart_item").find(".subtotal").html("$" + data.subtotal);
                $(".cart_item").find(".items").html("" + data.total_items + " items <i class='fa fa-shopping-cart'></i>");
            }
        },

        error: function(jqXHR, textStatus, errorThrown) {
            alert("Error get data from ajax");
        }
    });
});


$(document).on('click','.btn-delete',function(){
   var rowid = $(this).attr("rowid"), 
       from = $(this).attr("from"),
       remove = $(this).attr("remove"),
       url = base_url + 'cart/remove_cart/'+rowid+'/'+remove;


    if(rowid!='')
    {
        $.ajax({
            url: url,
            type: "GET",
            dataType: "JSON",

            success: function(data) {
                if (data.status == 'success') {
                  if(from=="cart_list")
                    location.reload();

                  $("#add_to_cart").html(data.content);
                  $(".cart_item").find(".subtotal").html("$" + data.subtotal);
                  $(".cart_item").find(".items").html("" + data.total_items + " items <i class='fa fa-shopping-cart'></i>");
                }
            },

            error: function(jqXHR, textStatus, errorThrown) {
                alert("Error in Deletion");
            }
        });
    }
});






