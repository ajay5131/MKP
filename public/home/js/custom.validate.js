function validateRegister(current_fs) {
    
    valid = true;
    $('.error-msg').remove();
    current_fs.find('select, input, textarea').each(function() {
        if($(this).attr('data-validate') && !$(this).parent().hasClass('hide')) {
            
            var validation = $(this).attr('data-validate');
            var validations = validation.split(',');

            for (i = 0; i < validations.length; i++) {
                var lbl = $(this).prev('label').text();
                if(lbl == "") {
                    lbl = $(this).parents('.help-block').find('label').text();
                }
            
                switch (validations[i]) {
                    case 'required':
                        if($(this).attr('type') != "checkbox" && $(this).attr('type') != "radio") {
                            if($(this).val() == "") {
                                valid = false;
                                $(this).parent().append("<span class='help-block text-danger error-msg'>The "+ lbl.replace(/\*/g, '').toLowerCase() +" is required!</span>")
                                // $("<span class='help-block text-danger error-msg'>The "+ lbl.replace(/\*/g, '').toLowerCase() +" is required!</span>").insertAfter($(this));
                            }
                        } else {
                            if(!$(this).prop('checked')) {
                                valid = false;
                                $(this).parent().append("<span class='help-block text-danger error-msg'>The "+ lbl.replace(/\*/g, '').toLowerCase() +" is required!</span>")
                                // $("<span class='help-block text-danger error-msg'>The "+ lbl.replace(/\*/g, '').toLowerCase() +" is required!</span>").insertAfter($(this));
                            }
                        }
                        break;
                    case 'required_radio_any_one':
                        if($(this).attr('type') == "checkbox" || $(this).attr('type') == "radio") {
                            var name = $(this).attr("name");
                            if($("input:radio[name="+name+"]:checked").length <= 0 ) {
                                valid = false;
                                if(!$(this).parent().parent().find('.error-msg').length) {
                                    $(this).parent().parent().append("<span class='help-block text-danger error-msg'>Select at least one option!</span>")
                                }
                            }
                        }
                        break;
                    case 'alphaspace':
                        var pattern = /^[a-zA-Z\s]*$/;
                        if(!pattern.test($(this).val())) {
                            valid = false;
                            $(this).parent().append("<span class='help-block text-danger error-msg'>The "+ lbl.replace(/\*/g, '').toLowerCase() +" only contains letters and spaces!</span>")
                            // $("<span class='help-block text-danger error-msg'>The "+ lbl.replace(/\*/g, '').toLowerCase() +" only contains letters and spaces!</span>").insertAfter($(this));
                        }
                        break;
                    case 'alphaspacenumeric':
                        var pattern = /^[0-9a-zA-Z\s]*$/;
                        if(!pattern.test($(this).val())) {
                            valid = false;
                            $(this).parent().append("<span class='help-block text-danger error-msg'>The "+ lbl.replace(/\*/g, '').toLowerCase() +" only contains letters, numbers and spaces!</span>")
                            // $("<span class='help-block text-danger error-msg'>The "+ lbl.replace(/\*/g, '').toLowerCase() +" only contains letters and spaces!</span>").insertAfter($(this));
                        }
                        break;
                    case 'alphaunderscore':
                        var pattern = /^[a-zA-Z_]*$/;
                        if(!pattern.test($(this).val())) {
                            valid = false;
                            $(this).parent().append("<span class='help-block text-danger error-msg'>The "+ lbl.replace(/\*/g, '').toLowerCase() +" only contains letters and underscore!</span>")
                            // $("<span class='help-block text-danger error-msg'>The "+ lbl.replace(/\*/g, '').toLowerCase() +" only contains letters and spaces!</span>").insertAfter($(this));
                        }
                        break;
                    case 'alphaunderscorenumeric':
                        var pattern = /^[0-9a-zA-Z_]*$/;
                        if(!pattern.test($(this).val())) {
                            valid = false;
                            $(this).parent().append("<span class='help-block text-danger error-msg'>The "+ lbl.replace(/\*/g, '').toLowerCase() +" only contains letters, underscore and numbers!</span>")
                            // $("<span class='help-block text-danger error-msg'>The "+ lbl.replace(/\*/g, '').toLowerCase() +" only contains letters and spaces!</span>").insertAfter($(this));
                        }
                        break;
                    case 'numeric':
                        var pattern = /^[0-9]*$/;
                        if(!pattern.test($(this).val())) {
                            valid = false;
                            $(this).parent().append("<span class='help-block text-danger error-msg'>The "+ lbl.replace(/\*/g, '').toLowerCase() +" only contains numbers!</span>")
                            // $("<span class='help-block text-danger error-msg'>The "+ lbl.replace(/\*/g, '').toLowerCase() +" only contains numbers!</span>").insertAfter($(this));
                        }
                        break;
                    case 'email':
                        var pattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
                        if($(this).val() != "" && !pattern.test($(this).val())) {
                            valid = false;
                            $(this).parent().append("<span class='help-block text-danger error-msg'>The "+ lbl.replace(/\*/g, '').toLowerCase() +" is invalid!</span>")
                            // $("<span class='help-block text-danger error-msg'>The "+ lbl.replace(/\*/g, '').toLowerCase() +" only contains numbers!</span>").insertAfter($(this));
                        }
                        break;
                    case 'max_selection': 
                        if($(this).attr('data-maximum-selection-length')) {
                            if($(this).val().length > $(this).attr('data-maximum-selection-length')) {
                                valid = false;
                                $(this).parent().append("<span class='help-block text-danger error-msg'>You can select "+ $(this).attr('data-maximum-selection-length') +" items</span>")
                            }
                        } 
                        break;
                    case 'url':
                        var userInput = $(this).val();
                        var regex = /(http|https):\/\/(\w+:{0,1}\w*)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%!\-\/]))?/;
                        // var res = str.match(/(http(s)?:\/\/.)?(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/g);
                        if($(this).val() != "" && !regex.test(userInput)) {
                            valid = false;
                            $(this).parent().append("<span class='help-block text-danger error-msg'>Invalid URL!</span>");
                        }
                        break;
                }
                
                // console.log(validations[i]);
                if($(this).val() != "" && validations[i].includes('maxage')) {
                    var age = getAge($(this).val());
                    var validate_age = validations[i].split(':');
                    if(age < validate_age[1]) {
                        valid = false;
                        $(this).parent().append("<span class='help-block text-danger error-msg'>Age must be greater than "+ validate_age[1] +" years!</span>")
                    }
                }

                if($(this).val() != "" && validations[i].includes('match_any_one:')) {
                    var userInput = $(this).val();
                    var regex = /(http|https):\/\/(\w+:{0,1}\w*)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%!\-\/]))?/;
                    // var res = str.match(/(http(s)?:\/\/.)?(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/g);
                    if(regex.test(userInput)) {
                        var field = validations[i].split(':');
                        var array = field[1].split('/');
                        const substring = $(this).val();

                        const match = array.find(element => {
                            if (substring.includes(element)) {
                            return true;
                            }
                        });
                        if(match == undefined) {
                            valid = false;
                            $(this).parent().append("<span class='help-block text-danger error-msg'>The field contain "+ field[1].replaceAll('.', '') +" URL!</span>")
                        }
                    }
                }

                if($(this).val() != "" && validations[i].includes('match:')) {
                    
                    var field = validations[i].split(':');
                    if($(this).val() != $('input[name="'+field[1]+'"]').val()) {
                        valid = false;
                        $(this).parent().append("<span class='help-block text-danger error-msg'>The field doesn't match to "+ field[1] +"!</span>")
                    }
                }
                if($(this).val() != "" && validations[i].includes('max:')) {
                    console.log("in max")
                    var field = validations[i].split(':');
                    if($(this).val().length > field[1]) {
                        valid = false;
                        $(this).parent().append("<span class='help-block text-danger error-msg'>The field should be less than "+ field[1] +" character!</span>")
                    }
                }
                if($(this).val() != "" && validations[i].includes('min')) {
                    var field = validations[i].split(':');
                    if($(this).val().length < field[1]) {
                        valid = false;
                        $(this).parent().append("<span class='help-block text-danger error-msg'>The field should be more than "+ field[1] +" character!</span>")
                    }
                }
                if(validations[i].includes('requiredifcheckbox')) {
                    var field = validations[i].split(':');
                    if($('#' + field[1]).prop('checked') && $(this).val() == "") {
                        valid = false;
                        $(this).parent().append("<span class='help-block text-danger error-msg'>The field is required!</span>")
                    }
                }

            }
        }
    });
    // valid = false;
    // console.log(valid);
    return valid;
}


function getAge(dateString) {
    var today = new Date();
    var birthDate = new Date(dateString);
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
    return age;
}

$(document).on('change', 'select, input', function(e) {
    $(this).nextAll('.error-msg').remove();
});