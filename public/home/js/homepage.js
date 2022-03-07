var submit__btn;
var action_url;
var form_data;

$(document).on('click', '.toggle__overview, .overview__cancel__btn', function(e) {
    $('.update__overview').toggleClass('hide');
});

$(document).on('submit', '#overview__form', function(e) {
    e.preventDefault();
    clearError();
    
    submit__btn = $(this).find('.btn_submit');
    toggleBtnLoader();

    form_data = $(this).serialize();
    action_url = $(this).attr('action');
    ajaxCall("overview_");
});

$(document).on('click', '.toggle__overview__desc, .ov_desc__cancel__btn', function(e) {
    $('.ov_desc').toggleClass('hide');
});

$(document).on('submit', '#ov_desc__form', function(e) {
    e.preventDefault();
    clearError();
    
    submit__btn = $(this).find('.btn_submit');
    toggleBtnLoader();

    form_data = $(this).serialize();
    action_url = $(this).attr('action');
    ajaxCall("ov_desc_");
});

$(document).on('click', '.toggle__service_detail, .service_detail__cancel__btn', function(e) {
    $('.update_service_detail').toggleClass('hide');
});

$(document).on('click', '.service__detail__submit', function(e) {
    e.preventDefault();
    clearError();
    
    submit__btn = $('#service_detail__form').find('.btn_submit');
    toggleBtnLoader();

    form_data = $('#service_detail__form').serialize();
    action_url = $('#service_detail__form').attr('action');
    ajaxCall("service_detail_");
    
});


$(document).on('click', '.toggle__about, .about__cancel__btn', function(e) {
    $('.update__aboutus').toggleClass('hide');
});

$(document).on('submit', '#about__form', function(e) {
    e.preventDefault();
    clearError();
    
    submit__btn = $(this).find('.btn_submit');
    toggleBtnLoader();

    form_data = $(this).serialize();
    action_url = $(this).attr('action');
    ajaxCall("about_");
});

$(document).on('click', '.toggle__service_title, .service__cancel__btn', function(e) {
    $('.update__service_title').toggleClass('hide');
});

$(document).on('submit', '#service_title__form', function(e) {
    e.preventDefault();
    clearError();
    
    submit__btn = $(this).find('.btn_submit');
    toggleBtnLoader();

    form_data = $(this).serialize();
    action_url = $(this).attr('action');
    ajaxCall("service_");
});



function ajaxCall(prefix) {
    
    $.ajax({
        url: action_url,
        type:'POST',
        data: form_data,
        success: function(data) {
            toggleBtnLoader();
            if($.isEmptyObject(data.error)){
                location.reload(true);
            }else{
                printErrorMsg(prefix, data.error);
            }
        }
    });
}

function printErrorMsg (prefix = null, msg) {
    $.each( msg, function( key, value ) {
        $('#' + prefix + key).html(value);
    });
}

function clearError() {
    $('.clear_error').html("");
}

function toggleBtnLoader() {
    submit__btn.removeAttr('disabled', 'disabled');
    submit__btn.toggleClass('loading', 100);
    if(submit__btn.hasClass('loading')) {
        submit__btn.attr('disabled', 'disabled');
    }
}