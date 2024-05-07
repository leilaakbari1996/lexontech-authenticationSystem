<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="vertical" data-theme-mode="light" data-header-styles="light" data-menu-styles="light" data-toggled="close">

<head>

    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> login </title>
    <meta name="Description" content="Bootstrap Responsive Admin Web Dashboard HTML5 Template">
    <meta name="Author" content="Spruko Technologies Private Limited">
    <meta name="keywords" content="admin dashboard,dashboard design htmlbootstrap admin template,html admin panel,admin dashboard html,admin panel html template,bootstrap dashboard,html admin template,html dashboard,html admin dashboard template,bootstrap dashboard template,dashboard html template,bootstrap admin panel,dashboard admin bootstrap,bootstrap admin dashboard">

    <link  href="{{\TransferFacade::loadAsset('/root/assets/libs/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet" >

    <!-- Main Theme Js -->
    <script src="{{TransferFacade::loadAsset('/root/assets/js/authentication-main.js')}}"></script>

    <!-- Bootstrap Css -->
    <link id="style" href="{{TransferFacade::loadAsset('/root/assets/libs/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" >

    <!-- Style Css -->
    <link href="{{TransferFacade::loadAsset('/root/assets/css/styles.min.css')}}" rel="stylesheet" >

    <!-- Icons Css -->
    <link href="{{TransferFacade::loadAsset('/root/assets/css/icons.min.css')}}" rel="stylesheet" >
    <link href="{{TransferFacade::loadAsset('/root/assets/css/myStyle.css')}}" rel="stylesheet" >
    <link href="{{TransferFacade::loadAsset('/authenticationSystem/assets/css/myStyle.css')}}" rel="stylesheet" >


</head>

<body>
<!-- Loader -->
<div id="loader" >
{{--    <img src="{{myAsset('/assets/images/media/loader.svg')}}" alt="">--}}
</div>
<!-- Loader -->

<div class="autentication-bg">

    <div class="container">
        <div class="row justify-content-center authentication authentication-basic align-items-center h-100">
            <div class="col-xxl-5 col-xl-5 col-lg-5 col-md-12 col-sm-12 col-12">
                <div class="my-4 d-flex justify-content-center">
                    <a href="/">
{{--                        <img src="{{myAsset('/assets/images/brand-logos/desktop-white.png')}}" alt="logo">--}}
                    </a>
                </div>
                <div class="card custom-card card-phone">
                    <div class="card-body p-5">
                        <p class="h5 fw-semibold mb-2 text-center">ورود و ثبت نام</p>
                        <div class="row gy-3">
                            <form action="">
                                @csrf
                                <input type="hidden" value="{{$url}}" name="url">

                                <div class="col-xl-12">
                                    <div class="text-end">
                                        <label for="signup-lastname" class="form-label text-default label_phone">شماره تلفن</label>
                                    </div>
                                    <input type="text" class="form-control form-control-lg" name="PhoneNumber" placeholder="0912 111 1111">
                                </div>
                                <div class="col-xl-12 d-grid mt-2">
                                    <button type="submit" class="btn btn-lg btn-primary">ارسال کد یکبار مصرف</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card-otp">
                    <div class="card custom-card cart_otp">
                        <div class="card-body p-lg-5 p-md-5 p-xl-5 p-sm-5 p-4">
                            <p class="mb-4 text-muted op-7 fw-normal text-center">لطفا کد 4 رقمی پیامک شده را وارد کنید.</p>
                            <div class="row gy-3">
                                <form action="">
                                <div class="col-xl-12 mb-2">
                                    <div class="row">
                                            @csrf
                                            <input name="dateOtp" type="hidden" id="expireOtp1">

                                        <div class="col">
                                            <input type="number" class="form-control form-control-lg text-center" name="one" id="one" maxlength="1" onkeyup="clickEvent(this,'two')">
                                        </div>
                                        <div class="col">
                                            <input type="number" class="form-control form-control-lg text-center" name="two" id="two" maxlength="1" onkeyup="clickEvent(this,'three')">
                                        </div>
                                        <div class="col">
                                            <input type="number" class="form-control form-control-lg text-center" name="three" id="three" maxlength="1" onkeyup="clickEvent(this,'four')">
                                        </div>
                                        <div class="col">
                                            <input type="number" class="form-control form-control-lg text-center" name="four" id="four" maxlength="1">
                                        </div>

                                    </div>
                                </div>
                                <div class="col-xl-12 d-grid mt-2">
                                    <input type="submit" class="btn btn-lg btn-primary" value="تایید">
                                </div>
                                </form>
                                <form action="">
                                    <div class="form-check mt-2 resend-otp">
                                        <label class="form-check-label" for="defaultCheck1">
                                            <span class="text-primary ms-2 d-inline-block resend-code">ارسال مجدد</span>
                                        </label>
                                    </div>
                                </form>
                                <div id="timer"></div>
                            </div>

                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom-Switcher JS -->
<script src="{{TransferFacade::loadAsset('/root/assets/js/jquery-3.6.1.min.js')}}" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

<!-- Bootstrap JS -->

<!-- Show Password JS -->
<script src="{{TransferFacade::loadAsset('/root/assets/js/sweetalert2@10')}}"></script>

<script src="{{TransferFacade::loadAsset('/root/assets/js/custom-switcher.min.js')}}"></script>

<!-- Bootstrap JS -->
<script src="{{TransferFacade::loadAsset('/root/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Internal Two Step Verification JS -->
<script src="{{TransferFacade::loadAsset('/root/assets/js/two-step-verification.js')}}"></script>

<script src="{{TransferFacade::loadAsset('/root/assets/js/functions.js')}}"></script>
<script src="{{TransferFacade::loadAsset('/authenticationSystem/assets/js/timer.js')}}"></script>
<script src="{{TransferFacade::loadAsset('/authenticationSystem/assets/js/login.js')}}"></script>

</body>

</html>
