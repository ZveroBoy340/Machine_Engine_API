jQuery(document).ready(function($) {

    var product;
    var product_item;

    $('body').on('click', '#search-single', function() {
        send_request_single('product');
    });

    function send_request_single(type) {

        var product_number = $('#search-name-product').val();

        $('.preloader-filters').css("display", "flex").hide().fadeIn(200);

        $.ajax({
            url: admin.ajaxurl,
            data: {
                'action': 'get_data_from_api',
                'product': product_number,
                'type': type,
                'nonce': admin.nonce
            },
            type:'POST',
            dataType: 'json',
            success:function(response) {
                $('.preloader-filters').fadeOut(200);
                if(response.type === 'product') {
                    $('.wpm_fitment_products').html(response.data);
                    $('.lightzoom').lightzoom({
                        isOverlayClickClosing: true
                    });
                }
            }
        });
    }


    $('body').on('change', '#fitment-year', function() {
        send_request('makes');
    });

    $('body').on('change', '#fitment-make', function() {
        send_request('models');
    });

    $('body').on('change', '#fitment-model', function() {
        send_request('engines');
    });

    $('body').on('change', '#fitment-engine', function() {
        send_request('transmissions');
    });

    $('body').on('change', '#fitment-transmission', function() {
        send_request('product_list');
    });

    $('body').on('click', '.open-fitment', function() {
        product = $(this).data('product');
        product_item = $(this).closest('.fitment-product');
        send_request('product');
    });

    function send_request(type) {

        var year = $('#fitment-year').val();
        var make = $('#fitment-make').val();
        var model = $('#fitment-model').val();
        var engine = $('#fitment-engine').val();
        var transmission = $('#fitment-transmission').val();

        $('.preloader-filters').css("display", "flex").hide().fadeIn(200);

        $.ajax({
            url: admin.ajaxurl,
            data: {
                'action': 'get_data_from_api',
                'year': year,
                'make': make,
                'model': model,
                'engine': engine,
                'transmission': transmission,
                'product': product,
                'type': type,
                'nonce': admin.nonce
            },
            type:'POST',
            dataType: 'json',
            success:function(response) {
                $('.preloader-filters').fadeOut(200);

                if(response.type === 'makes') {
                    $('#fitment-make option').remove();
                    $('#fitment-make').prop('disabled', false).append('<option value="" selected="true" disabled="disabled" hidden>Make</option>');
                    $.each(response.data.data, function (i, item) {
                        $('#fitment-make').append($('<option>', {
                            value: item.id,
                            text : item.value
                        }));
                    });
                } else if(response.type === 'models') {
                    $('#fitment-model option').remove();
                    $('#fitment-model').prop('disabled', false).append('<option value="" selected="true" disabled="disabled" hidden>Model</option>');
                    $.each(response.data.data, function (i, item) {
                        $('#fitment-model').append($('<option>', {
                            value: item.id,
                            text : item.value
                        }));
                    });
                } else if(response.type === 'engines') {
                    $('#fitment-engine option').remove();
                    $('#fitment-engine').prop('disabled', false).append('<option value="" selected="true" disabled="disabled" hidden>Engine</option>');
                    $.each(response.data.data, function (i, item) {
                        $('#fitment-engine').append($('<option>', {
                            value: item.id,
                            text : item.Liter+'L '+item.BlockType+item.Cylinders
                        }));
                    });
                } else if(response.type === 'transmissions') {
                    $('#fitment-transmission option').remove();
                    $('#fitment-transmission').prop('disabled', false).append('<option value="" selected="true" disabled="disabled" hidden>Transmission</option>');
                    $.each(response.data.data, function (i, item) {
                        $('#fitment-transmission').append($('<option>', {
                            value: item.id,
                            text : item.value
                        }));
                    });
                } else if(response.type === 'product_list') {
                    $('.wpm_fitment_products').html(response.data);
                    $('.lightzoom').lightzoom({
                        isOverlayClickClosing: true
                    });
                } else if(response.type === 'product') {
                    product_item.html(response.data);
                    $('.lightzoom').lightzoom({
                        isOverlayClickClosing: true
                    });
                }
            }
        });
    }

});