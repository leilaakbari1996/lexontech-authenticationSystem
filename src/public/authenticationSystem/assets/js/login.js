const elementOtp   = $('input[type="submit"]');
const elementLogin = $('button[type="submit"]');
const resendCode   = $('.resend-code');
let swal = {
    'confirmButtonText': 'متوجه شدم!',
    'showCancelButton': false,
}
const Submit = function (e)
{
    e.preventDefault();
    $('.resend-otp').css('display','none');
    const PhoneNumber = $("[name=PhoneNumber]").val();
    $("[name=one]").val('');
    $("[name=two]").val('');
    $("[name=three]").val('');
    $("[name=four]").val('') ;

    let data = {
        PhoneNumber : PhoneNumber,
        _token: $('[name=_token]').val(),
    }

    $.myAjax('/send-sms/',data,callback,$.callbackErrorCreate,'POST',swal);
}

const SubmitOtp = function (e)
{
    e.preventDefault();
    const PhoneNumber = $("[name=PhoneNumber]").val();
    const one = $("[name=one]").val();
    const two = $("[name=two]").val();
    const three = $("[name=three]").val();
    const four = $("[name=four]").val();
    const Code = one+two+three+four;

    let data = {
        PhoneNumber : PhoneNumber,
        Otp         : Code,
        _token      : $('[name=_token]').val(),
    }

    $.myAjax('/login/',data,callbackOtp,$.callbackErrorCreate,'POST',swal);
}

elementLogin.on("click", Submit);
elementOtp.on("click", SubmitOtp);
resendCode.on("click", Submit);

const callback = function (result)
{
    $('.card-phone').css('display','none');
    $('.card-otp').css('display','block');
    $('[name=dateOtp]').val(result.dateOtp);
    $.timer();
    $.swal('موفقیت آمیز','لطفا رمز یکبار مصرف را وارد کنید.','info',null,swal)
}

const callbackOtp = function ()
{
    const url = $("[name=url]").val();
    $.swal('موفقیت آمیز','به سایت خوش آمدید!','success',url,swal)
}
