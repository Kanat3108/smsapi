$(function () {
    var
        COUNTRIES = {};

    const
        FIELDS = {
            countryCustom: $('.js-country-custom'),
            countryDefault: $('.js-country-default'),
            countryCodePhone: $('.js-fullnumber'),
            phone: $(".js-input-phone"),
            predictive: $('.js-country-predictive'),
            checkbox: $('.js-checkbox-click'),
            year: $('.js-get-year'),
            input: $('.js-focus'),
            code: $('.js-country-code'),
            email: $('.js-check-email'),
            anchorlink: $('.js-anchor-link'),
            formblock: $('.form-cover'),
            toformlink: $('.js-scroll-to-form'),
            formglow: $('.form-glow')
        },
        ACTIONS = {
            showMenu: $('.js-show-menu'),
            checkbox: $('input[type="checkbox"]'),
            radio: $('.js-reset-radio'),
            selectDefault: $('.js-select-default'),
            selectCustom: $('.js-select-custom'),
            submit: $('.js-submit-from')
        };

    $.get("https://restcountries.eu/rest/v2/all", function (data) {
        for (let i = 0; i < data.length; i++) {
            COUNTRIES[i] = {
                name:  data[i]['name'],
                code:  data[i]['callingCodes'][0],
                alpha: data[i]['alpha2Code'].toLowerCase(),
                flag:  'https://static.imediafile.com/alexandr/assets/images/flags/4x3/'+data[i]['alpha2Code'].toLowerCase()+'.svg'
            };
        }
        FIELDS_country__build(ACTION__checkDevice());
    });
    $(window).resize(function() {
        FIELDS_country__build(ACTION__checkDevice());
    });
    $(document).on('click tap', '.js-set-country-value', function () {
        $(this).parents('.form__input').addClass('form__input--success');
        FIELDS.code.html('+' + $(this).data('tel')).attr('data-code', '+' + $(this).data('tel'));
        FIELDS.predictive.val($(this).data('val')).addClass('form__input-field--contains');
        FIELDS.countryDefault.find('option').removeAttr('selected');
        FIELDS.countryDefault.find('option[value="' + $(this).data('val') + '"]').attr('selected', 'selected');
        FIELDS.countryCodePhone.val('+' + $(this).data('tel'));
        ACTION__removeError($(this).parents('.input'));
    });

    /** === START === */
    FIELDS.year.html(new Date().getFullYear());

    /** === EVENTS === */
    FIELDS.toformlink.click(function(event){
        var anchor = 0;

        if ($(window).width() < 576) {
            anchor = $('#form').offset().top - 50;
        }
        event.preventDefault();
        $("html, body").animate({ scrollTop: anchor }, 500);
        FIELDS.formglow.animate({
            opacity: 1,
        }, 300);
        FIELDS.formblock.show().animate({
            opacity: 1,
        }, 300);
        setTimeout(function(){
            FIELDS.formblock.animate({
                opacity: 0,
            }, 2000);
            FIELDS.formglow.animate({
                opacity: 0,
            }, 2000);
            $('input[name="firstName"]').focus();
        }, 400);
        setTimeout(function(){
            FIELDS.formblock.hide();
        }, 3400);
    })
    FIELDS.anchorlink.click(function(event) {
        event.preventDefault();
        var offset = $($(this).attr("href")).offset().top - 80;
        /*if ($(this).attr('href') == '#sec-02') {
            offset = offset - 160;
        }*/
        $("html, body").animate({ scrollTop: offset }, 500);
    });
    FIELDS.predictive.on('keyup', function(){
        FIELDS__addContains($(this));
        let value = $(this).val().toLowerCase();
        $('.js-country-custom').html('');

        var counter = 0;
        $.each(COUNTRIES, function (key) {
            let dom = '<div class="form__input-dropdown-link js-set-country-value" data-val="' + COUNTRIES[key].name + '" data-tel="' + COUNTRIES[key].code + '" data-code="' + COUNTRIES[key].alpha + '" data-icon=""><img src="' + COUNTRIES[key].flag + '" alt="flag"><p>' + COUNTRIES[key].name + '</p></div>',
                country = COUNTRIES[key].name.toLowerCase();

            if (value.length > 0) {
                if (country.indexOf(value)+1 > 0) {
                    $('.js-country-custom').append(dom);
                    counter++;
                }
            } else {
                $('.js-country-custom').append(dom);
            }
        });
        if (value.length > 0 && counter == 0) {
            $('.js-country-custom').append('<div class="form__input-dropdown-link input__dropdown-option--notfound"><p>No country found! Please choose country from existing list</p></div>');
            FIELDS.countryDefault.val('').find('option').removeAttr('selected');
            ACTION__addError($(this).parents('.form__input'));
        } else {
            ACTION__removeError($(this).parents('.form__input'));
        }
    });
    FIELDS.phone.on('keyup', function () {
        let code = FIELDS.code.attr('data-code'),
            fullPhone = code + $(this).val();
        console.log(fullPhone);
        console.log(code);
        FIELDS.countryCodePhone.val(code);
        FIELDS__addContains($(this));
        FIELDS_phone__clear($(this));
    });
    FIELDS.input.on('keyup', function(){
        FIELDS__addContains($(this));
    });
    FIELDS.input.focus(function(){
        ACTION__removeError($(this).parents('.form__input'));
    });
    FIELDS.email.blur(function(){
        if ($(this).val().length > 0) {
            ACTION__checkEmail($(this)) ? ACTION__removeErrorEmail($(this).parent()) : ACTION__addErrorEmail($(this).parent());
        } else {
            ACTION__removeError($(this).parent());
        }
    });
    FIELDS.countryDefault.change(function () {
        let code = FIELDS.countryDefault.find('option:selected').data('tel'),
            country = FIELDS.countryDefault.find('option:selected').val();
        FIELDS.code.html('+' + code).attr('data-code', code);
        FIELDS.predictive.val(country);
        ACTION__removeError($(this).parent());
        // $('.js-fullnumber').val($('.js-country-code').attr('data-code') + '' + $('#phone').val());
        // checkValidation();
    });
    FIELDS.checkbox.on('click tap', function(){
        ACTION__removeError($(this).parents('.input'));
    });

    /** === ACTIONS === */
    ACTIONS.showMenu.on('click tap', function(){
        var status = $('#lines-menu').is(":checked"),
            bar = $('.js-menu-bar'),
            WD = $(window).width(),
            contWD = $('.js-container-width').width() + 30,
            menuWD = bar .width(),
            space = (WD - contWD),
            offset = menuWD - space / 2;

        console.log(WD + ' ' + contWD + ' ' + space);

        status ? bar.removeClass('menu--open') : bar.addClass('menu--open');

        if (status) {
            //$('.header').removeClass('header--covered');
        } else {
            $('.header').addClass('header--covered');
        }

        if (WD > 576) {
            if (!status) {
                anime({
                    targets: '.js-toggle-menu',
                    translateX: -offset,
                    easing: 'easeInOutQuad',
                    duration: 300
                });
            } else {
                anime({
                    targets: '.js-toggle-menu',
                    translateX: 0,
                    easing: 'easeInOutQuad',
                    duration: 300
                });
            }
        } else {
            /*if (!status) {
                ACTIONS.showMenu.addClass('header__hamburger-button--black');
            } else {
                ACTIONS.showMenu.removeClass('header__hamburger-button--black');
            }*/
        }
        // $('.js-toggle-menu').
        //$('.cover').fadeToggle();
    });
    ACTIONS.checkbox.prop('checked', false);
    ACTIONS.radio.on('click tap', function(){
        $(this).parents('.header__menu').find('input[type="checkbox"]').prop('checked', false);
    });
    ACTIONS.submit.on('click tap', function () {
        console.log(FIELDS__checkValidation());
    });

    function FIELDS_phone__clear(input) {
        let value = input.val();
        let rep = /[-\.;":'a-zA-Zа-яА-Я]/;
        if (rep.test(value)) {
            value = value.replace(rep, '');
            input.val(value);
        }
        //$('.js-fullnumber').val($('.js-country-code').attr('data-code') + '' + input.val())
    }
    function FIELDS__checkValidation() {
        var pool = ['#name', '#surname', '#email', '#country', '#phone', '#phoneNumber', '#age'],
            poolRes = [],
            result = true;

        pool.forEach(function (item) {
            var parentForm = $('#form');

            if (item == '#age') {
                poolRes.push(parentForm.find(item).prop('checked'));
            } else {
                let value = parentForm.find(item).val();
                poolRes.push(value !== '' && value !== null ? true : false)
            }
        });
        poolRes.forEach(function (item, i) {
            if (!item) {
                if (pool[i] == '#country') {
                    ACTION__addError($('#countryCustom').parent());
                }
                ACTION__addError($(pool[i]).parent());
                result = false;
            }
        });
        return result;
    }
    function FIELDS_country__build(isMobile) {
        console.log(123);
        let domCustom, domDefault;
        $.each(COUNTRIES, function (i) {
            if (!isMobile) {
                ACTIONS.selectDefault.hide();
                ACTIONS.selectCustom.show().find('input').attr('required', 'required');
            } else {
                ACTIONS.selectCustom.hide();
                ACTIONS.selectDefault.show().find('select').attr('required', 'required');;
            }
            domCustom  = '<div class="form__input-dropdown-link js-set-country-value" data-val="' + COUNTRIES[i].name + '" data-tel="' + COUNTRIES[i].code + '" data-code="' + COUNTRIES[i].alpha + '"><img src="' + COUNTRIES[i].flag + '" alt="flag"><p>' + COUNTRIES[i].name + '</p></div>';
            domDefault = '<option value="' + COUNTRIES[i].name + '" data-tel="' + COUNTRIES[i].code + '" data-code="' + COUNTRIES[i].alpha + '">' + COUNTRIES[i].name + '</option>';

            FIELDS.countryCustom.append(domCustom);
            FIELDS.countryDefault.append(domDefault);
        });

    }
    function FIELDS__addContains(input) {
        input.val().length > 0 ? input.addClass('form__input-field--contains') : input.removeClass('form__input-field--contains');
    }
    function ACTION__checkEmail(input) {
        let re = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        var resp = re.test(String(input.val()).toLowerCase());

        return resp;
    }
    function ACTION__checkDevice() {
        let width = $(window).width();
        var resp = false;
        if (width < 772) {resp = true}
        return resp;
    }
    function ACTION__addError(parent) {
        parent.addClass('form__input--error');
    }
    function ACTION__removeError(parent) {
        parent.removeClass('form__input--error form__input--notice form__input--success input--error-email');
    }
    function ACTION__addErrorEmail(parent) {
        parent.addClass('form__input--error input--error-email');
    }
    function ACTION__removeErrorEmail(parent) {
        parent.removeClass('form__input--error form__input--notice form__input--success input--error-email');
    }
});

function getURLparams() {
    var params = window.location.href;
    params = params.split('?');
    if (params.length > 1) {
        params = params[1];
        return params;
    }
    return '';
}
function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
if (getURLparams() != "") {
    if (getCookie("lead") != "") {
        var cookieParams = getCookie("lead").split("&");
        var urlParams = getURLparams().split("&");
        var mergedParams = cookieParams.slice();
        for (var i = 0; i < urlParams.length; i++) {
            var found = -1;
            for (var j = 0; j < cookieParams.length; j++) {
                if (cookieParams[j].split("=")[0] == urlParams[i].split("=")[0]) {
                    found = j;
                    break;
                }
            }
            if (found != -1) {
                mergedParams[found] = urlParams[i];
            } else {
                mergedParams.push(urlParams[i]);
            }
        }
        var url = document.location.protocol + "//" + document.location.host + document.location.pathname;
        document.cookie = "lead=" + mergedParams.join('&') + "; expires=Thu, 01 Jan 2030 00:00:00 UTC; path=" + url + ";";
        window.history.pushState({path: url + "?" + mergedParams.join('&')}, '', url + "?" + getCookie("lead"));
    } else {
        var url = document.location.protocol + "//" + document.location.host + document.location.pathname;
        document.cookie = "lead=" + getURLparams() + "; expires=Thu, 01 Jan 2030 00:00:00 UTC; path=" + url + ";";
    }
} else if (getURLparams() == "") {
    if (getCookie("lead") != "") {
        var url = document.location.protocol + "//" + document.location.host + document.location.pathname;
        window.history.pushState({path: url + "?" + getCookie("lead")}, '', url + "?" + getCookie("lead"));
    }
}