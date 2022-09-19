var fnInput = '';
var lnInput = '';
var emailInput = '';
var phoneInput = '';
var pwInput = '';
var isFnOk = false;
var isLnOk = false;
var isEmOk = false;
var isPhOk = false;
var isPwOk = false;

$(document).ready(function () {

    $('.text-warning').hide();
    $('#ca-submit').prop('disabled', true)

    //FIRSTNAME VALIDATION
    $('#fnInput').keyup(function () {

        isFnOk = false;
        fnInput = $('#fnInput').val();
        if(!isName(fnInput)){
            $('.fn-w').hide();
            $('.fn-not-valid').show();
            if(fnInput.length <= 0){
                $('.fn-w').hide();
                $('.fn-no-text').show();
            }
        }else if(fnInput.length>=20){
            $('.fn-w').hide();
            $('.fn-long').show();
        }else{
            $('.fn-w').hide();
            isFnOk = true;
        }

        updateButton(isFnOk, isLnOk, isEmOk, isPhOk, isPwOk);
    });

    //LASTNAME VALIDATION
    $('#lnInput').keyup(function () {

        isLnOk = false;
        lnInput = $('#lnInput').val();
        if(!isName(lnInput)){
            $('.ln-w').hide();
            $('.ln-not-valid').show();
            if(lnInput.length <= 0){
                $('.ln-w').hide();
                $('.ln-no-text').show();
            }
        }else if(lnInput.length>=20){
            $('.ln-w').hide();
            $('.ln-long').show();
        }else{
            $('.ln-w').hide();
            isLnOk = true;
        }

        updateButton(isFnOk, isLnOk, isEmOk, isPhOk, isPwOk);
    });

    //EMAIL VALIDATION
    $('#emInput').keyup(function () {
        
        isEmOk = false;
        emailInput = $('#emInput').val();
        if(!isEmail(emailInput)){
            $('.em-w').hide();
            $('.em-not-valid').show();
            if(emailInput.length <= 0){
                $('.em-w').hide();
                $('.em-no-text').show();
            }
        }else{
            $('.em-exists').load("../script/server/email_validation.php", {
                regEmail: emailInput
            }, function () {
                if($('.em-exists').text().length <= 0) {
                    isEmOk = true;
                } else {
                    isEmOk = false;
                }
                updateButton(isFnOk, isLnOk, isEmOk, isPhOk, isPwOk);
            });
            $('.em-w').hide();
            $('.em-exists').show();
        }
        updateButton(isFnOk, isLnOk, isEmOk, isPhOk, isPwOk);
    });

    //PHONE NUMBER VALIDATION
    $('#pnInput').keyup(function () {

        isPhOk = false;
        phoneInput = $('#pnInput').val();
        if(!isPhone(phoneInput)){
            $('.ph-w').hide();
            $('.ph-not-valid').show();
            if(phoneInput.length <= 0){
                $('.ph-w').hide();
                $('.ph-no-text').show();
            }
        }else{
            $('.ph-exists').load("../script/server/phone_validation.php", {
                regPhone: phoneInput
            }, function () {
                if($('.ph-exists').text().length <= 0) {
                    isPhOk = true;
                } else {
                    isPhOk = false;
                }
                updateButton(isFnOk, isLnOk, isEmOk, isPhOk, isPwOk);
            });

            $('.ph-w').hide();
            $('.ph-exists').show();
        }

        updateButton(isFnOk, isLnOk, isEmOk, isPhOk, isPwOk);
    });

    //PASSWORD VALIDATION
    $('#pwInput').keyup(function () {

        isPwOk = false;
        pwInput = $('#pwInput').val();
        if(pwInput.length<= 7){
            $('.pw-w').hide();
            $('.pw-short').show();
            if(pwInput.length <= 0){
                $('.pw-w').hide();
                $('.pw-no-text').show();
            }
        }else if(pwInput.length>= 50){
            $('.pw-w').hide();
            $('.pw-long').show();
        }else{
            $('.pw-w').hide();
            isPwOk = true;
        }

        updateButton(isFnOk, isLnOk, isEmOk, isPhOk, isPwOk);
    });

    //CREATE ACCOUNT CLICK
    $('#ca-submit').click(function () {
        console.log("test")
        $('.toast-body').load("../script/server/register_server_validation.php", {
            firstname: fnInput,
            lastname: lnInput,
            email: emailInput,
            phone: phoneInput,
            password: pwInput
    
        }, function () {
            const toast = new bootstrap.Toast($('#liveToast'));
            toast.show();
            reset();
        });

    })
});

function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})$/;
    return regex.test(email);
}

function isPhone(phone) {
    var regex = /((^(\+63)(\d{10}))|(^(0)(\d{10}))|(^(9)(\d{9})))$/ // or /^(\+\d{2})?(\d{1})?\(?(\d{3})\)?[- ]?(\d{3})[- ]?(\d{4})$/;
    return regex.test(phone);
}

function isName(name) {
    var regex = /^([a-zA-Z])+([-. ]([a-zA-Z])+)?([-. ]([a-zA-Z])+)?$/;
    return regex.test(name);
}
function updateButton(fn, ln, em, ph, pw) {
    if(fn && ln && em && ph && pw){
        $('#ca-submit').prop('disabled', false)
    }else{
        $('#ca-submit').prop('disabled', true)
    }
}
function reset(){
    $('#fnInput').val('');
    $('#lnInput').val('');
    $('#emInput').val('');
    $('#pnInput').val('');
    $('#pwInput').val('');
    isFnOk = false;
    isLnOk = false;
    isEmOk = false;
    isPhOk = false;
    isPwOk = false;
    updateButton(isFnOk, isLnOk, isEmOk, isPhOk, isPwOk);
}