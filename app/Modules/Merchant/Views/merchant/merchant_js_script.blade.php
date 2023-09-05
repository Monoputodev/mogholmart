<script>
  $(document).ready(function() {
    function init_summernote() {

        if ($('.textarea').length > 0) {
            $('.textarea').summernote({
                minHeight: 100,
                onCreateLink: function (url) {
                    if (url.indexOf('http://') !== 0 && url.indexOf('#') !== 0) {
                        url = url;
                    }
                    return url;
                },
            });
        }

    }

    init_summernote();

});
 
  //merchant seo=====================================================
  $(document).delegate('#seoform','submit',function () {

     var data = $(this).serializeArray();
     var product_id = $('#product_id').val();

     $.ajax({
        headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
        url: '{{ url("merchant-seo-update") }}'+'/'+product_id,
        type: 'patch',
        data: data,
        dataType: "json",
            success:function(data){
            
                if(data.result=="success")
                {
                  
                  var priority = 'success';
                  var title    = data.result;
                  var message  = data.message;

                  $.toaster({ priority : priority, title : title, message : message });

                }
                else
                {
                    var priority = 'danger';
                    var title    = data.result;
                    var message  = data.message;

                    $.toaster({ priority : priority, title : title, message : message });
                }
            }
        });
     return false;
   });   


  //merchant product===============================
$(function() {
        // highlight
        var elements = $("input[type!='submit'], textarea, select");
        elements.focus(function() {
          $(this).parents('li').addClass('highlight');
        });
        elements.blur(function() {
          $(this).parents('li').removeClass('highlight');
        });

        $("#productform").validate({
          rules:{



            attribute_set_id:{
              required:true,
              number:true
            },

            type:{
              required:true
            },

            status:{
              required:true
            }

          },
          messages:{

            attribute_set_id:'Please choose attribute set',
            type: 'Plese choose type',

            status: 'Plese choose status'
          }
        });
    });

//basic info=====================================
  function convert_to_slug(){
        var str = document.getElementById("title").value;
        str = str.replace(/[^a-zA-Z0-12\s]/g,"");
        str = str.toLowerCase();
        str = str.replace(/\s/g,'-');
        document.getElementById("slug").value = str;

    }

    $(function() {
        // highlight
        var elements = $("input[type!='submit'], textarea, select");
        elements.focus(function() {
            $(this).parents('li').addClass('highlight');
        });
        elements.blur(function() {
            $(this).parents('li').removeClass('highlight');
        });

        $("#productform").validate({
          rules:{
            
            title:{
              required:true
            },
            slug:{
              required:true
            },
            
            item_no:{
              required:true
            },
            sell_price:{
              required:true
            },
            list_price:{
              required:true
            },
            status:{
              required:true
            }
            
          },
          messages:{
            title:'Please enter title',
            slug: 'Plese enter slug',
            
            list_price:'Please enter list price',
            sale_price: 'Plese enter sale price',
            status: 'Plese choose status'
          }
        });
    });


    function select2_brand(target,data,selected) {

        $(target).select2({
            placeholder: 'Select brand',
            width: "100%",
            closeOnSelect: false,
            data: data,
            multiple: true,
            formatSelection: function(item) {
                return item.text
            },
            formatResult: function(item) {
                return item.name
            },
            
        });

        $(target).val(selected).trigger("change");
    }

    $(document).delegate('#manufacturer_id','change',function () {

            var manufacturer_id = $(this).val();
            var product_id = $('#product_id').val();

            $.ajax({
                url: '{{ url('merchant-product-brand') }}',
                type: 'POST',
                data: { _token: '{!! csrf_token() !!}', manufacturer_id:manufacturer_id,product_id:product_id},
                dataType: "json",
                success: function (data) {

                    if(data.result == 'success'){

                        $('#brand_select').html(data.data);
                        brand_data = data.brand_data;

                        select2_brand("#brand_select",brand_data,data.selected);

                    }else{
                        alert(data.message);
                    }
                }
            });

            return false;
        });
    
        $( document ).ready(function() {
            $('#manufacturer_id').trigger('change');
        });

    $(document).delegate('#product_form_basic_info','submit',function () {
      
       var data = $(this).serializeArray();
       var product_id = $('#product_id').val();

        $.ajax({
            headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
            url: '{{ url("merchant-besic-info-add") }}'+'/'+product_id,
            method: 'patch',
            data: data,
            dataType: "json",
            success:function(data){
            
                if(data.result=="success")
                {
                  
                  var priority = 'success';
                  var title    = data.result;
                  var message  = data.message;

                  $.toaster({ priority : priority, title : title, message : message });

                }
                else
                {
                    var priority = 'danger';
                    var title    = data.result;
                    var message  = data.message;

                    $.toaster({ priority : priority, title : title, message : message });
                }
            }
        });

      return false;
    });    

    $(document).delegate('#product_description','submit',function () {

     var data = $(this).serializeArray();
     var product_id = $('#product_id').val();


     $.ajax({
      headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
      url: '{{ url("merchant-description-update") }}'+'/'+product_id,
      type: 'patch',
      data: data,
      dataType: "json",
            success:function(data){
            
                if(data.result=="success")
                {
                  
                  var priority = 'success';
                  var title    = data.result;
                  var message  = data.message;

                  $.toaster({ priority : priority, title : title, message : message });

                }
                else
                {
                    var priority = 'danger';
                    var title    = data.result;
                    var message  = data.message;

                    $.toaster({ priority : priority, title : title, message : message });
                }
            }
        });
     return false;
   });   

//inventory==================================================
    $(document).delegate('#inventory_form','submit',function () {
       var data=$(this).serializeArray();
       var product_id=$('#product_id').val();

       $.ajax({
         headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
         url: '{{ url("merchant-inventory-update") }}'+'/'+product_id,
         type: 'patch',
         data: data,
         dataType: "json",
         success:function(data){
              if(data.result=="success"){
                      
                  var priority = 'success';
                  var title    = data.result;
                  var message  = data.message;
                  
                  //window.location='my-product';

                  $.toaster({ priority : priority, title : title, message : message });

                  

                }else{
                        var priority = 'danger';
                        var title    = data.result;
                        var message  = data.message;

                        $.toaster({ priority : priority, title : title, message : message });
                    }
                }
       });
        return false;
    });

    $(function() {
        // highlight
        var elements = $("input[type!='submit'], textarea, select");
        elements.focus(function() {
            $(this).parents('li').addClass('highlight');
        });
        elements.blur(function() {
            $(this).parents('li').removeClass('highlight');
        });

        $("#inventory_form").validate({
                  rules:{

                    warehouse:{
                      required:true
                  },
                  item_number:{
                      required:true,
                  },
                  quantity:{
                      required:true,
                      number:true
                  },

              },
              messages:{
                warehouse:'Please select a warehouse',
                item_number:'Please enter item number',
                quantity:'Please enter product quantity',

            }
        });
    });


//update category==========================================
$(document).delegate('#product_category_form','submit',function () {

     var data = $(this).serializeArray();
     var product_id = $('#product_id').val();


     $.ajax({
      headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
      url: '{{ url("merchant-category-update") }}'+'/'+product_id,
      type: 'patch',
      data: data,
      dataType: "json",
            success:function(data){
            
                if(data.result=="success")
                {
                  
                  var priority = 'success';
                  var title    = data.result;
                  var message  = data.message;

                  $.toaster({ priority : priority, title : title, message : message });

                }
                else
                {
                    var priority = 'danger';
                    var title    = data.result;
                    var message  = data.message;

                    $.toaster({ priority : priority, title : title, message : message });
                }
            }
        });
     return false;
   });   

//product attribute form
$(document).delegate('.product_attribute_form','submit',function () {
   var data=$(this).serializeArray();
   var product_id=$('#product_id').val();

   $.ajax({
     headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
     url: '{{ url("merchant-attribute-update") }}'+'/'+product_id,
     type: 'patch',
     data: data,
     dataType: "json",
     success:function(data){
          if(data.result=="success"){
                  
              var priority = 'success';
              var title    = data.result;
              var message  = data.message;

              $.toaster({ priority : priority, title : title, message : message });

            }else{
                    var priority = 'danger';
                    var title    = data.result;
                    var message  = data.message;

                    $.toaster({ priority : priority, title : title, message : message });
                }
            }
   });
    return false;
});

//print page

$(document).delegate('.print_the_pages','click',function(){
  PrintDiv();
  return false;
});        

function PrintDiv() {       
  var restorepage = $('body').html();
  var printcontent = $('#print_verification_letter').clone();
  $('body').empty().html(printcontent);
  window.print();
  $('body').html(restorepage)
}

$('.left-filter ul').readmore({
  speed: 75,
  collapsedHeight:260,
  lessLink: '<a href="#">View less</a>',
  moreLink: '<a href="#">View more</a>'
});

 //===================================== for increment image button @@
 $(document).ready(function() {

    $(".btn-success").click(function(){ 
      var html = $(".clone").html();
      $(".increment").before(html);
    });

    $("body").on("click",".btn-danger",function(){ 
      $(this).parents(".control-group").remove();
    });

});


//===================================== for increment show and delete button @@
function showchild(id) {
  $('#child-'+id).css('opacity','1');

}function hidechild(id) {
  $('#child-'+id).css('opacity','0');
}



function DeleteImage(id) {

  $.confirm({
    title:'Confirm!',
    content:'<b style="color:red">Are Your Confirm To Delete ?</b>',
    theme: 'modern',
    closeIcon: true,
    animation: 'scale',
    type: 'red',
    buttons:{
      ok:function() {
        $.ajax({
          url: "{{URL::to('merchant-image-delete')}}/"+id,
          type: 'GET',
          data: {},
          success:function(data) {
            if(data=="true"){
              $.alert({
                title: 'Success !',
                content: '<b style="color:green">Image Deleted Successfully</b>',
                autoClose: 'ok|2000',
              });
              $('#parent-'+id).fadeOut();
            }else if(data=="false"){
              $.alert({
                title: 'Whoops !',
                content: '<b style="color:green">Something Went Wrong!!</b>',
                autoClose: 'ok|2000',
              });
            }
          }
        });

      },
      close:function() {

      }
    },
  });

}


function sho_image(id) {
        var heightvalue = 800;
        $.dialog({
            title: 'Product Image Show',
            content: 'url:{{URL::to('merchant-product-image-show')}}/'+id,
            animation: 'scale',
            columnClass: 'medium',
            closeAnimation: 'scale',
            backgroundDismiss: true,
            height: heightvalue,
        });

}

</script>