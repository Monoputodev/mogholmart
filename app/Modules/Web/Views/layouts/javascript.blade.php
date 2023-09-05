<script>
    //Subcription submit
    $(document).delegate('#subscription', 'click', function() {
        var email = $('#txtemail').val();
        var mainpath = window.location.host;

        if (email != '') {

            $.ajax({
                url: "{{ route('web.subscription') }}",
                type: 'post',
                data: {
                    _token: '{!! csrf_token() !!}',
                    email: email
                },
                dataType: "json",
                success: function(data) {
                    if (data.result == "success") {
                        iziToast.success({
                            title: 'OK',
                            message: 'Thank You For Your Subcription!',
                            position: 'topCenter',
                        });

                        $('#txtemail').val('');
                    } else if (data.result == "invalid_email") {
                        iziToast.error({
                            title: 'Whoops',
                            message: 'Please Enter Valid Email!!',
                            position: 'topCenter',
                        });
                    } else if (data.result == "false") {
                        iziToast.error({
                            title: 'Whoops',
                            message: 'Your email already subscribed!!',
                            position: 'topCenter',
                        });
                    }
                } //end success
            }); //end ajax
        } else {
            //alert('Please enter your email first');
            iziToast.error({
                title: 'Whoops',
                message: 'Please enter your email first!!',
                position: 'topCenter',
            });
        } // end button function
    });

    //City wise Area Call in Customer Dashboard.
    //Customer Billing and Shipping Address.

    $(document).delegate('.city-ajax', 'change', function() {

        var city_name = $(this).val();

        $.ajax({
            url: '{{ url('call/city/area') }}',
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                city_name: city_name
            },
            dataType: "json",
            success: function(data) {

                if (data.result == 'success') {
                    $('.modal-area-ajax').html(data.data);
                } else {
                    alert(data.message);
                }
            }
        });

        return false;
    });

    //for checkout page billing address.

    $(document).delegate('.billing_city_call', 'change', function() {

        var city_name = $(this).val();

        $.ajax({
            url: '{{ url('billing/address/city') }}',
            type: 'POST',
            data: {
                _token: '{!! csrf_token() !!}',
                city_name: city_name
            },
            dataType: "json",
            success: function(data) {

                if (data.result == 'success') {
                    $('.modal-area-ajax').html(data.data);
                } else {
                    alert(data.message);
                }
            }
        });

        return false;
    });

    //product quick view
    $(document).delegate('.product_quick_view', 'click', function() {

        var item = $(this);
        var url = $(this).attr('data-href');
        var product_id = $(this).attr('product-id');

        $.ajax({
            url: url,
            method: "GET",
            data: {
                product_id: product_id
            },
            dataType: "json",
            success: function(response) {
                if (response.result == 'success') {

                    jQuery('.quick_view_modal .modal-body .no-gutters').html(response.cart_body);
                    jQuery('.quick_view_modal').modal('show');
                }
            }
        });
        return false;
    });


    //AddToCart script call
    //Add product in cart.
    //Add in session.
    //Add in right side popup cart.
    //Update product in header
    //Update in popup cart
    $(document).delegate(".add_cart_ajax", 'click', function() {

        var product_id = jQuery(this).attr('product_id');
        var product_quantity = jQuery(this).attr('product_quantity');
        var product_merchant_id = jQuery(this).attr('product_merchant_id');
        var product_image = jQuery(this).attr('product_image');
        var product_weight = jQuery(this).attr('product_weight');
        var product_category_id = jQuery(this).attr('product_category_id');

        var url = '{{ route('web.cart.add') }}';

        jQuery.ajax({
            url: url,
            method: "POST",
            data: {
                _token: '{!! csrf_token() !!}',
                product_id: product_id,
                product_quantity: product_quantity,
                product_merchant_id: product_merchant_id,
                product_image: product_image,
                product_weight: product_weight,
                product_category_id: product_category_id
            },
            dataType: "json",
            success: function(response) {
                if (response.result == 'success') {

                    jQuery('#total_items').html(response.total_item);
                    jQuery('.total_cart_1').html(response.total_item);

                    jQuery('#total_items_cart').html(response.total_item);
                    jQuery('#total_price').html(response.cart_total);

                    jQuery('#cart_summary_ajax').html(response.cart_body);

                    jQuery('#total_items2').html(response.total_item);

                    jQuery('#total_price_3').html(response.cart_total);
                    jQuery('#cart_summary_ajax2').html(response.cart_body);
                    jQuery('#cart_summary_ajax3').html(response.cart_body2);

                    iziToast.success({
                        title: 'OK',
                        message: 'Successfully added to shopping cart!',
                        position: 'topCenter',
                    });

                } else {
                    jQuery('#total_items').html(0);
                    jQuery('#total_items_cart').html(0);
                    jQuery('#total_price').html(0);
                    jQuery('#cart_summary_ajax').html('');

                    jQuery('#total_items2').html(0);
                    jQuery('#total_cart_1').html(0);
                    jQuery('#total_price_3').html('');
                    jQuery('#cart_summary_ajax2').html('');
                    jQuery('#cart_summary_ajax3').html('');

                }

            }
        });

        return false;
    });

    var category_id = [];
    var shown = [];
    var categoryCount = {{ App\Modules\Category\Models\Category::orderBy('short_order', 'desc')->first()->short_order}};

    for (let i = 0; i < categoryCount; i++) {
        $(document).on('click', '#btn-more' + i, function() {
            category_id[i] = $('#category_id' + i).val();
            if (shown[i] == null) {
                shown[i] = 6;
            }else{
                shown[i] = shown[i] + 6;
            }


            console.log(category_id[i]);
            $("#btn-more").html("Loading....");
            $.ajax({
                url: '{{ url('product-load-more') }}',
                method: "POST",
                data: {
                    category_id: category_id[i],
                    shown: shown[i],
                    _token: "{{ csrf_token() }}"
                },
                dataType: "text",
                success: function(data) {

                    if(data == 0){
                        $("#btn-more"+i).html("No Data Found");
                        console.log(data);
                    }else{
                        console.log(data);
                        $('#show_new_data' + i).append(data);
                    }


                }
            });
        });
    }
    //Remove product from cart.
    //Delete from session.
    //Remove from right side popup cart.
    //Update product in header
    //Update in popup cart
    $(document).delegate(".close-item", 'click', function(e) {

        var product_id = jQuery(this).attr('product_id');

        var url = '{{ route('web.cart.remove.item.ajax') }}';

        jQuery.ajax({
            url: url,
            method: "POST",
            data: {
                _token: '{!! csrf_token() !!}',
                product_id: product_id
            },
            dataType: "json",
            beforeSend: function(xhr) {

            }
        }).done(function(response) {

            jQuery.noConflict();

            if (response.result == 'success') {

                jQuery('#total_price').html(response.cart_total);

                jQuery('#total_price_3').html(response.cart_total);

                jQuery('#total_items').html(response.total_item);
                jQuery('#cart_summary_ajax').html(response.cart_body);
                jQuery('.total_cart_1').html(response.total_item);
                jQuery('#total_items2').html(response.total_item);
                jQuery('#cart_summary_ajax2').html(response.cart_body);
                jQuery('#cart_summary_ajax3').html(response.cart_body2);

                iziToast.success({
                    title: 'OK',
                    message: 'Successfully deleted from shopping cart!',
                    position: 'topCenter',
                });


            }

            if (response.result == 'error') {
                jQuery('#total_price').html(0.00);
                jQuery('#total_price_3').html(0.00);

                jQuery('#total_items').html(0);
                jQuery('#cart_summary_ajax').html('');

                jQuery('#total_items2').html(0);
                jQuery('#cart_summary_ajax2').html('');
                jQuery('#cart_summary_ajax3').html('');
                jQuery('#total_cart_1').html(0);

                iziToast.error({
                    title: 'Whoops',
                    message: 'Something want wrong!',
                    position: 'topCenter',
                });
            }

        }).fail(function(jqXHR, textStatus) {
            alert("11Request failed: " + jqXHR.responseText);
        });
    });

    //For my cart
    $(document).delegate(".delete_cart", 'click', function(e) {

        var product_id = jQuery(this).attr('product_id');

        var url = '{{ route('web.cart.remove.item.ajax') }}';

        jQuery.ajax({
            url: url,
            method: "POST",
            data: {
                _token: '{!! csrf_token() !!}',
                product_id: product_id
            },
            dataType: "json",
            beforeSend: function(xhr) {

            }
        }).done(function(response) {

            jQuery.noConflict();

            if (response.result == 'success') {
                jQuery('#total_price').html(response.cart_total);
                jQuery('#total_price_2').html(response.cart_total);
                jQuery('#total_items').html(response.total_item);

                jQuery('#cart_summary_ajax').html(response.cart_body);

                jQuery('#total_items2').html(response.total_item);

                jQuery('#cart_summary_ajax2').html(response.cart_body);
                jQuery('.total_cart_1').html(response.total_item);
                jQuery('#cart_summary_ajax3').html(response.cart_body2);
                iziToast.success({
                    title: 'OK',
                    message: 'Successfully deleted from shopping cart!',
                    position: 'topCenter',
                });
                location.reload();

            }

            if (response.result == 'error') {
                jQuery('#total_price').html(0.00);
                jQuery('#total_items').html(0);

                jQuery('#cart_summary_ajax').html('');

                jQuery('#total_items2').html(0);
                jQuery('#total_price_3').html('');

                jQuery('#cart_summary_ajax2').html('');
                jQuery('#cart_summary_ajax3').html('');
                jQuery('#total_cart_1').html(0);

                iziToast.error({
                    title: 'Whoops',
                    message: 'Something want wrong!',
                    position: 'topCenter',
                });

            }

        }).fail(function(jqXHR, textStatus) {
            alert("11Request failed: " + jqXHR.responseText);
        });
    });
    //For My Cart Product Update
    $(document).delegate(".update_cart", 'click', function(e) {

        var product_id = jQuery(this).attr('product_id');
        var quantity = jQuery('.product_quantity_field' + product_id).val();

        ///alert(quantity+'/'+product_id);

        var data = [];
        data.push({
            'product_id': product_id,
            'product_quantity': quantity
        })


        var url = '{{ route('web.cart.update.ajax') }}';

        jQuery.ajax({
            url: url,
            method: "POST",
            data: {
                _token: '{!! csrf_token() !!}',
                data: data
            },
            dataType: "json",
            beforeSend: function(xhr) {

            }
        }).done(function(response) {

            if (response.result == 'success') {
                jQuery('.alert-cartupdate').show();
                jQuery('#total_price').html(response.cart_total);
                jQuery('#total_price_3').html(response.cart_total);
                jQuery('.total_cart_1').html(response.total_item);

                jQuery('#total_items').html(response.total_item);
                jQuery('#cart_summary_ajax').html(response.cart_body);

                jQuery('#total_items2').html(response.total_item);
                jQuery('#cart_summary_ajax2').html(response.cart_body);
                jQuery('#cart_summary_ajax3').html(response.cart_body2);

                iziToast.success({
                    title: 'OK',
                    message: 'Successfully updated to shopping cart!',
                    position: 'topCenter',
                });
                location.reload();
            }

            if (response.result == 'error') {
                jQuery('#total_price').html(0.00);
                jQuery('#total_items').html(0);
                jQuery('#cart_summary_ajax').html('');

                jQuery('#total_items2').html(0);
                jQuery('#cart_summary_ajax2').html('');
                jQuery('#cart_summary_ajax3').html('');
                jQuery('#total_price_3').html('');
                jQuery('#total_cart_1').html(0);

                iziToast.error({
                    title: 'Whoops',
                    message: 'Something want wrong!',
                    position: 'topCenter',
                });

            }

        }).fail(function(jqXHR, textStatus) {
            alert("Request failed: " + jqXHR.responseText);
        });

        return false;

    });
    //Home page show more button for load more product using javascript.

    //Subcategory Filter SubmitCode.
    //Product Filter by Min-Max price range.

    $('#max_value').keyup(function(index, value) {

        var min_value = $('#min_value').val();
        var max_value = $('#max_value').val();

        $('#filter_max_price').val(max_value);
        $('#filter_min_price').val(min_value);
        $("#submit_search_filter").submit();

    });



    //Product shorting by Name, Price, Rating, Latest.

    $('.sort_by').change(function(index, value) {

        var sort_by = $("#sort_by option:selected").val();
        $('#filter_sort_by').val(sort_by);

        $("#submit_search_filter").submit();

    });

    //Product filter by product attribute ['size','color','etc'].

    $('input[type="checkbox"].attribute_filter').click(function(index, value) {

        var filter_value = $(this).val();
        var filter_attr_id = $(this).attr('data-id');
        $('#filter_attr_' + filter_attr_id).val(filter_value);
        $("#submit_search_filter").submit();

    });

    //Uncheck attribute and return previous filter mode.
    $('input[type="checkbox"].attribute_remove_filter').click(function(index, value) {

        var remove_attribute = $(this).val();

        var current_input_id = $(this).attr('data-id'); //get current input id

        var current_filter_attribute_value = $('#filter_attr_' + current_input_id).val(); //current att value
        var current_filter_attribute_value = changeText(current_filter_attribute_value,
            remove_attribute); //call change text function
        $('#filter_attr_' + current_input_id).val(current_filter_attribute_value);
        $('#submit_search_filter').submit();

    });


    //Change text function
    function changeText(oldText, text) {

        var oldTextArray = oldText.trim().split(',');
        var newText = [];
        oldTextArray.forEach(function(item, index) {
            newText.push(item.trim());
        });
        newText = newText.filter(function(a) {
            return a !== text;
        });
        return newText;
    }


    var counter = parseInt(jQuery(".soniacountereliment").val());
    // Display total
    $(".soniacountereliment").val(counter);

    $(".plus").click(function() {
        //Add 1 to counter
        counter = counter + 1;
        // Display total
        $(".soniacountereliment").val(counter);

    });

    //Subtract
    $(".minus").click(function() {

        counter = counter - 1;
        if (counter >= parseInt(1)) {
            $(".soniacountereliment").val(counter);
        } else {

            $(this).attr('disabled', 'disabled');
            $('.minusbutton').attr('disabled', 'disabled');
        }

    });


    $(document).delegate(".scarditemdetailul .tr1 .sdown", 'click', function(e) {

        var quantity = jQuery(this).parent().children('.sitemno').html();
        var product_id = jQuery(this).parent().children('.sitemno').attr('product_id');

        var data = [];
        data.push({
            'product_id': product_id,
            'product_quantity': quantity
        })


        var url = '{{ route('web.cart.update.ajax') }}';

        jQuery.ajax({
            url: url,
            method: "POST",
            data: {
                _token: '{!! csrf_token() !!}',
                data: data
            },
            dataType: "json",
            beforeSend: function(xhr) {

            }
        }).done(function(response) {

            if (response.result == 'success') {
                jQuery('#total_price').html(response.cart_total);
                jQuery('#total_items').html(response.total_item);

                jQuery('#total_price_3').html(response.cart_total);
                jQuery('#cart_summary_ajax').html(response.cart_body);

                jQuery('#total_items2').html(response.total_item);
                jQuery('#cart_summary_ajax2').html(response.cart_body);
                jQuery('#cart_summary_ajax3').html(response.cart_body2);
                jQuery('.total_cart_1').html(response.total_item);


                /*iziToast.success({
                	title: 'OK',
                	theme: 'dark',
                	message: 'Successfully updated to shopping cart!',
                	position: 'topCenter',
                }); */

                iziToast.show({
                    theme: 'dark',
                    title: 'Ok',
                    message: 'Successfully updated to shopping cart!',
                    position: 'topCenter',
                    progressBarColor: 'rgb(0, 255, 184)',
                });

            }

            if (response.result == 'error') {
                jQuery('#total_price').html(0);
                jQuery('#total_items').html(0);
                jQuery('#cart_summary_ajax').html('');
                jQuery('#total_price_3').html('');
                jQuery('#total_cart_1').html(0);

                jQuery('#total_items2').html(0);
                jQuery('#cart_summary_ajax2').html('');
                jQuery('#cart_summary_ajax3').html('');


            }

        }).fail(function(jqXHR, textStatus) {
            alert("Request failed: " + jqXHR.responseText);
        });

        return false;

    });



    $(document).delegate(".contaty .plus", 'click', function(e) {

        var quantity = jQuery('.soniacountereliment').val();
        var product_id = jQuery('.soniacountereliment').attr('product_id');

        //alert(quantity);

        var data = [];
        data.push({
            'product_id': product_id,
            'product_quantity': quantity
        })


        var url = '{{ route('web.cart.update.ajax') }}';

        jQuery.ajax({
            url: url,
            method: "POST",
            data: {
                _token: '{!! csrf_token() !!}',
                data: data
            },
            dataType: "json",
            beforeSend: function(xhr) {

            }
        }).done(function(response) {

            if (response.result == 'success') {
                jQuery('#total_price').html(response.cart_total);
                jQuery('#total_items').html(response.total_item);

                jQuery('#total_price_3').html(response.cart_total);
                jQuery('#cart_summary_ajax').html(response.cart_body);

                jQuery('#total_items2').html(response.total_item);
                jQuery('#cart_summary_ajax2').html(response.cart_body);
                jQuery('#cart_summary_ajax3').html(response.cart_body2);
                jQuery('.total_cart_1').html(response.total_item);


                iziToast.show({
                    theme: 'dark',
                    title: 'Ok',
                    message: 'Successfully updated to shopping cart!',
                    position: 'topCenter',
                    progressBarColor: 'rgb(0, 255, 184)',
                });

            }

            if (response.result == 'error') {
                jQuery('#total_price').html(0);
                jQuery('#total_items').html(0);
                jQuery('#cart_summary_ajax').html('');
                jQuery('#total_price_3').html('');
                jQuery('#total_cart_1').html(0);

                jQuery('#total_items2').html(0);
                jQuery('#cart_summary_ajax2').html('');
                jQuery('#cart_summary_ajax3').html('');


            }

        }).fail(function(jqXHR, textStatus) {
            alert("Request failed: " + jqXHR.responseText);
        });

        return false;

    });


    $(document).delegate(".contaty .minus", 'click', function(e) {

        var quantity = jQuery('.soniacountereliment').val();
        var product_id = jQuery('.soniacountereliment').attr('product_id');

        var data = [];
        data.push({
            'product_id': product_id,
            'product_quantity': quantity
        })


        var url = '{{ route('web.cart.update.ajax') }}';
        if (quantity >= parseInt(1)) {
            jQuery.ajax({
                url: url,
                method: "POST",
                data: {
                    _token: '{!! csrf_token() !!}',
                    data: data
                },
                dataType: "json",
                beforeSend: function(xhr) {

                }
            }).done(function(response) {

                if (response.result == 'success') {
                    jQuery('#total_price').html(response.cart_total);
                    jQuery('#total_items').html(response.total_item);
                    jQuery('#total_price_3').html(response.cart_total);
                    jQuery('.total_cart_1').html(response.total_item);

                    jQuery('#cart_summary_ajax').html(response.cart_body);
                    jQuery('#cart_summary_ajax3').html(response.cart_body2);

                    jQuery('#total_items2').html(response.total_item);

                    jQuery('#cart_summary_ajax2').html(response.cart_body);

                    iziToast.show({
                        theme: 'dark',
                        title: 'Ok',
                        message: 'Successfully updated to shopping cart!',
                        position: 'topCenter',
                        progressBarColor: 'rgb(0, 255, 184)',
                    });

                }

                if (response.result == 'error') {
                    jQuery('#total_items').html(0);
                    jQuery('#total_price').html(0);
                    jQuery('#cart_summary_ajax').html('');
                    jQuery('#total_price_3').html('');
                    jQuery('#total_items2').html(0);
                    jQuery('#total_cart_1').html(0);

                    jQuery('#cart_summary_ajax2').html('');
                    jQuery('#cart_summary_ajax3').html('');

                }

            }).fail(function(jqXHR, textStatus) {
                alert("Request failed: " + jqXHR.responseText);
            });
        }

        return false;

    });

    $(document).delegate(".scarditemdetailul .tr1 .sup", 'click', function(e) {

        var quantity = jQuery(this).parent().children('.sitemno').html();
        var product_id = jQuery(this).parent().children('.sitemno').attr('product_id');

        var data = [];
        data.push({
            'product_id': product_id,
            'product_quantity': quantity
        })


        var url = '{{ route('web.cart.update.ajax') }}';
        if (quantity >= parseInt(1)) {
            jQuery.ajax({
                url: url,
                method: "POST",
                data: {
                    _token: '{!! csrf_token() !!}',
                    data: data
                },
                dataType: "json",
                beforeSend: function(xhr) {

                }
            }).done(function(response) {

                if (response.result == 'success') {
                    jQuery('#total_price').html(response.cart_total);
                    jQuery('#total_items').html(response.total_item);
                    jQuery('#total_price_3').html(response.cart_total);
                    jQuery('.total_cart_1').html(response.total_item);

                    jQuery('#cart_summary_ajax').html(response.cart_body);
                    jQuery('#cart_summary_ajax3').html(response.cart_body2);

                    jQuery('#total_items2').html(response.total_item);

                    jQuery('#cart_summary_ajax2').html(response.cart_body);

                    iziToast.show({
                        theme: 'dark',
                        title: 'Ok',
                        message: 'Successfully updated to shopping cart!',
                        position: 'topCenter',
                        progressBarColor: 'rgb(0, 255, 184)',
                    });

                }

                if (response.result == 'error') {
                    jQuery('#total_items').html(0);
                    jQuery('#total_price').html(0);
                    jQuery('#cart_summary_ajax').html('');
                    jQuery('#total_price_3').html('');
                    jQuery('#total_items2').html(0);
                    jQuery('#total_cart_1').html(0);

                    jQuery('#cart_summary_ajax2').html('');
                    jQuery('#cart_summary_ajax3').html('');

                }

            }).fail(function(jqXHR, textStatus) {
                alert("Request failed: " + jqXHR.responseText);
            });
        }
        return false;

    });


    //Product review store by javascript
    //If auth user did not login then return login page
    //If login then show review form & also show product review
    $(document).delegate('#form-review', 'submit', function() {
        var form = $(this);
        var url = $(this).attr('action');
        var data = $(this).serializeArray();
        $.ajax({
            url: url,
            method: "POST",
            data: data,
            dataType: "json",
            beforeSend: function(xhr) {}
        }).done(function(response) {
            if (response.result == 'success') {

                alert(response.message);

                form[0].reset();

                location.reload();
            }
            if (response.result == 'error') {
                alert(response.message);
            }
        }).fail(function(jqXHR, textStatus) {

        });
        return false;
    });


    $(document).delegate('.add_to_wishlist', 'click', function() {

        var item = $(this);
        var url = $(this).attr('data-href');
        var product_id = $(this).attr('product-id');

        $.ajax({
            url: url,
            method: "GET",
            data: {
                product_id: product_id
            },
            dataType: "json",
            success: function(response) {
                iziToast.success({
                    title: 'OK',
                    message: response.message,
                    position: 'topCenter',
                });

                jQuery('#wishlist_item_count').html(response.total_item);
            }
        });
        return false;
    });


    $(document).ready(function() {

        $('#submit_coupon').click(function() {

            var coupon_code = document.getElementById('coupon_code_id').value;
            var gen_delivery_cost = $('#gen_delivery_cost').val();

            $.ajax({
                url: "{{ route('web.coupoon.price') }}",
                method: "POST",
                data: {
                    coupon_code: coupon_code,
                    gen_delivery_cost: gen_delivery_cost,
                    _token: '{!! csrf_token() !!}'
                },

                success: function(data) {

                    if (data.result == 'success') {
                        jQuery('.alert-coupon').show();
                        $('#coupon_amount').html(data.coupon_amount);
                        $('#total_coupon').html(data.cart_amount - data.coupon_amount);

                        iziToast.success({
                            title: 'OK',
                            message: 'Successfully added coupon in cart!',
                            position: 'topCenter',
                        });
                    }

                }
            });

        });

    });

    //for checkout page ,shipping address
    $(document).delegate('.city-ajax-shipping', 'change', function() {

        var city_name = $(this).val();

        $.ajax({
            url: '{{ url('call/city/area/shipping') }}',
            type: 'POST',
            data: {
                _token: '{!! csrf_token() !!}',
                city_name: city_name
            },
            dataType: "json",
            success: function(data) {

                if (data.result == 'success') {
                    $('.modal-area-ajax-shipping').html(data.data);
                } else {
                    alert(data.message);
                }
            }
        });

        return false;
    });

    $(document).delegate('.open-customer-edit-modal', 'click', function() {

        var url = $(this).attr('data-href');
        var id = '';

        $.ajax({
            url: url,
            method: "GET",
            data: {
                id: id
            },
            dataType: "json",
            beforeSend: function(xhr) {

            }
        }).done(function(response) {
            if (response.result == 'success') {

                $('.open_modal_update .modal-body').html(response.content);

                $('.open_modal_update').modal('show');

            } else {

            }
        }).fail(function(jqXHR, textStatus) {

        });


        return false;


    });


    //AddToCart script call
    //Add product in cart.
    //Add in session.
    //Add in right side popup cart.
    //Update product in header
    //Update in popup cart
    $(document).delegate(".product_add_cart_ajax", 'click', function() {

        var product_id = jQuery(this).attr('product_id');
        var product_quantity = jQuery('.soniacountereliment').val();
        var product_merchant_id = jQuery(this).attr('product_merchant_id');
        var product_image = jQuery(this).attr('product_image');
        var product_weight = jQuery(this).attr('product_weight');
        var product_category_id = jQuery(this).attr('product_category_id');

        var product_color = jQuery('#attribute_Color').val();
        var product_size = jQuery('#attribute_Size').val();

        //alert(product_color+'/'+product_size);

        if (product_color != 'null' && product_size != 'null') {
            var url = '{{ route('web.cart.add') }}';

            jQuery.ajax({
                url: url,
                method: "POST",
                data: {
                    _token: '{!! csrf_token() !!}',
                    product_id: product_id,
                    product_quantity: product_quantity,
                    product_merchant_id: product_merchant_id,
                    product_image: product_image,
                    product_weight: product_weight,
                    product_category_id: product_category_id,
                    product_color: product_color,
                    product_size: product_size
                },
                dataType: "json",
                success: function(response) {
                    if (response.result == 'success') {

                        jQuery('#total_price').html(response.cart_total);
                        jQuery('#total_price_3').html(response.cart_total);
                        jQuery('#total_items').html(response.total_item);
                        jQuery('#cart_summary_ajax').html(response.cart_body);

                        jQuery('.total_cart_1').html(response.total_item);

                        jQuery('#total_items2').html(response.total_item);
                        jQuery('#cart_summary_ajax2').html(response.cart_body);

                        iziToast.show({
                            theme: 'dark',
                            title: 'Ok',
                            message: 'Successfully updated to shopping cart!',
                            position: 'topCenter',
                            progressBarColor: 'rgb(0, 255, 184)',
                        });

                    } else {
                        jQuery('#total_price').html(0);
                        jQuery('#total_price_3').html(0);
                        jQuery('#total_cart_1').html('');
                        jQuery('#total_items').html(0);
                        jQuery('#cart_summary_ajax').html('');

                        jQuery('#total_items2').html(0);
                        jQuery('#cart_summary_ajax2').html('');

                        iziToast.error({
                            title: 'Whoops',
                            message: 'Something want wrong!',
                            position: 'topCenter',
                        });
                    }

                }
            });
        } else {
            //alert('Select Color & Size');

            iziToast.error({
                title: 'Alert',
                message: 'Please Select Color & Size.',
                position: 'topCenter',
            });
        }


        return false;
    });

    //Remove product from cart.
    //Delete from session.
    //Remove from right side popup cart.
    //Update product in header
    //Update in popup cart
</script>

<script type="text/javascript">
    $(document).delegate('.so-onepagecheckout input[name="same_as_avobe"]', 'change', function() {
        var $this = $(this);

        if ($this.is(':checked')) {
            $('.so-onepagecheckout #shipping-address').hide();
            $this.val(1);
            $(document).trigger('so_checkout_address_changed', 'payment');
        } else {
            $('.so-onepagecheckout #shipping-address').show().find('input[type="text"]').val('');
            $('.so-onepagecheckout #shipping-address').show().find('input[type="text"]').attr("required",
                "required");
            $('.so-onepagecheckout #shipping-address').show().find('input[type="number"]').attr("required",
                "required");
            $('.so-onepagecheckout #shipping-address').show().find('#shipping_address').attr("required",
                "required");

            $(document).trigger('so_checkout_address_changed', 'payment');
            $(document).trigger('so_checkout_address_changed', 'shipping');
            $this.val(0);
        }
    });

    $(document).delegate('.so-onepagecheckout input[name="account"]', 'change', function() {
        if (this.value === 'login') {
            $('.so-onepagecheckout .checkout-login').slideDown(300);
            $('.so-onepagecheckout .checkout-register').parent().addClass('login-mobile');
        } else {
            $('.so-onepagecheckout .checkout-login').slideUp(300);
            $('.so-onepagecheckout .checkout-register').parent().removeClass('login-mobile');
            if (this.value === 'register') {
                $('.so-onepagecheckout #password').slideDown(300);
            } else {
                $('.so-onepagecheckout #password').slideUp(300);
            }
        }
        $('html').removeClass('checkout-type-login checkout-type-register checkout-type-guest').addClass(
            'checkout-type-' + this.value);
    });

    $('#new_password, #confirm_new_password').on('keyup', function() {
        if ($('#new_password').val() == $('#confirm_new_password').val()) {
            $('#message').html('Password Matched').css('color', 'green');

        } else
            $('#message').html('Password Not Matching').css('color', 'red');
    });

    $('#agreeTerms').click(function() {
        var checked_status = this.checked;
        if (checked_status == true) {
            $("#so-checkout-confirm-button").removeAttr("disabled");
        } else {
            $("#so-checkout-confirm-button").attr("disabled", "disabled");
        }
    });
</script>
<script>
    $(document).delegate('.print_the_pages', 'click', function() {
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
</script>

<script type="text/javascript">
    //===================================== for increment image button @@
    $(document).ready(function() {

        $(".btn-success").click(function() {
            var html = $(".clone").html();
            $(".increment").before(html);
        });

        $("body").on("click", ".btn-danger", function() {
            $(this).parents(".control-group").remove();
        });

    });


    //===================================== for increment show and delete button @@
    function showchild(id) {
        $('#child-' + id).css('opacity', '1');

    }

    function hidechild(id) {
        $('#child-' + id).css('opacity', '0');
    }


    function DeleteImage(id) {

        if (confirm('Are you sure to Delete?')) {

            $.ajax({
                url: "{{ URL::to('prescription/image/delete') }}/" + id,
                type: 'GET',
                data: {},
                success: function(response) {
                    if (response.result == 'success') {
                        iziToast.success({
                            title: 'OK',
                            message: 'Successfully added to shopping cart!',
                            position: 'topCenter',
                        });
                        $('#parent-' + id).fadeOut();
                    } else if (response.result == 'error') {
                        iziToast.error({
                            title: 'Whoops',
                            message: 'Something want wrong!',
                            position: 'topCenter',
                        });
                    }
                }
            });
        }


    }


    $(document).ready(function() {
        jQuery('.scarditem').click(function() {
            jQuery('.scarditemdetail').animate({
                "right": "0px"
            }, 200);
        });
        jQuery('.shed2batton,.soshoppingCartButton').click(function() {
            jQuery('.scarditemdetail').animate({
                "right": "-366px"
            }, 200);
        });

        // $('.close-item').click(function(){$(this).closest("li").fadeOut("slow");});
        $('html body').on("click", "[data-opt]", function() {
            $operator = jQuery(this).attr("data-opt");
            $prev_qty = parseInt(jQuery(this).parent().find("[data-quantity]").text());
            if ($operator == "+") {
                $new_qty = $prev_qty + 1;
                jQuery(this).parent().find("[data-quantity]").text($new_qty);
            } else {
                $new_qty = $prev_qty - 1;
                if ($new_qty < 1) return false;
                jQuery(this).parent().find("[data-quantity]").text(parseInt($new_qty));
            }
        });
    });
</script>
