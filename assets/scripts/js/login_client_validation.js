var emailInput = '';
var pwInput = '';
var isEmOk = false;
var isPwOk = false;

$(document).ready(function () {

    $('.text-warning').hide();
    $('#log-submit').prop('disabled', true)

    //SHOW TOAST IF VERIFY VALUE IS SET FOR ACCOUNT VERIFICATION
    if($('#verify').val() != ''){
        var getCode = $('#verify').val();
        $('.toast-body').load("./assets/scripts/server/email_verification.php", {
            code: getCode
        }, function () {
            const toast = new bootstrap.Toast($('#liveToast'));
            toast.show();
        });
    }

    //EMAIL VALIDATION
    $('#emInput').keyup(function() {
        
        isEmOk = false;
        emailInput = $('#emInput').val();
        if(!isEmail(emailInput)) {
            $('.em-w').hide();
            $('.em-not-valid').show();
            if(emailInput.length <= 0){
                $('.em-w').hide();
                $('.em-no-text').show();
            }
        } else {
            $('.em-exists').load("./assets/scripts/server/email_validation.php", {
                logEmail: emailInput
            }, function () {
                if($('.em-exists').text().length <= 0) {
                    isEmOk = true;
                } else {
                    isEmOk = false;
                }
                updateButton(isEmOk, isPwOk);
            });
            $('.em-w').hide();
            $('.em-exists').show();
        }
        updateButton(isEmOk, isPwOk);
    });

    //PASSWORD VALIDATION
    $('#pwInput').keyup(function () {

        isPwOk = false;
        pwInput = $('#pwInput').val();
        if(pwInput.length <= 0) {
            $('.pw-w').hide();
            $('.pw-no-text').show();
        } else {
        $('.pw-w').hide();
        isPwOk = true;
        }

        updateButton(isEmOk, isPwOk);
    });

    //LOGIN CLICK
    $('#log-submit').click(function () {

        $('.toast-body').load("./assets/scripts/server/login_server_validation.php", {
            email: emailInput,
            password: pwInput
    
        }, function () {
            const toast = new bootstrap.Toast($('#liveToast'));
            toast.show();
            if($('#check').val() == "success") {
                setTimeout(function(){
                    location.reload();
                }, 2000);
                $('.navbar').hide();
                $('.test').load("./assets/scripts/server/loading.php");
            } else {
            }
        });

    })
});

function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})$/;
    return regex.test(email);
}
function updateButton(em, pw) {
    if(em && pw){
        $('#log-submit').prop('disabled', false)
    }else{
        $('#log-submit').prop('disabled', true)
    }
}