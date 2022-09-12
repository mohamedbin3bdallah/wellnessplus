<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="description" content="WellnessPluse">
    <meta name="viewport" content="width=device-width, initial-scale=1,shrink-to-fit=no">
    <meta name="keywords" content="">
    <title>Arabia </title>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200&amp;display=swap"
        rel="stylesheet">
    <!--<link rel="icon" href="https://arabie.live/frontAssets/images/favicon.png" type="image/png">-->
</head>
<style>
    body {
        margin: 0px;
        padding: 0px;
        border: 0px;
        text-decoration: none;
        list-style: none;
        font-size: 14px;
        line-height: 28px;
        color: #4b4b4b;
        text-transform: capitalize;
        font-family: 'Poppins', sans-serif;
        direction: ltr;
        text-align: left;
        background: #fff;
    }

    .container {
        margin: 0 auto;
        width: 800px;
    }

    .header {
        width: 100%;
        text-align: center;
        background: #FFFFFF url('http://wellnessplus.live/frontAssets/images/logo-footer.png') no-repeat center center/cover;
        padding: 15px 0px;
    }

    .header img {
        max-width: 100px;
    }

    .complete {
        width: 100%;
        margin-top: 50px;
        text-align: center;
    }

    .complete .photo {
        width: 100%;
    }

    .complete .photo img {
        max-width: 400px;
    }

    .title {
        font-size: 28px;
        margin: 0px;
        width: 100%;
        font-weight: 600;
        color: #1d1d1d;
        margin-top: 30px;
    }

    .text {
        display: block;
        font-size: 18px;
        margin-top: 15px;
    }

    .bottom {
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        padding: 12px 40px;
        -webkit-transform: perspective(1px) translateZ(0);
        transform: perspective(1px) translateZ(0);
        overflow: hidden;
        color: #fff;
        outline: none;
        outline-style: none;
        border: 0px;
        font-size: 18px;
        background-image: -webkit-gradient(linear, left top, right top, from(#b1936f), to(#8a7658));
        background-image: -webkit-linear-gradient(top, #b1936f, #8a7658);
        background-image: -o-linear-gradient(top, #b1936f 0, #8a7658 100%);
        background-image: linear-gradient(top, #b1936f 0, #8a7658);
        text-align: center;
        -webkit-border-radius: 60px;
        border-radius: 60px;
        text-decoration: none;
        background-clip: padding-box;
        -moz-transition: all 0.5s ease-in-out 0s;
        -o-transition: all 0.5s ease-in-out 0s;
        -webkit-transition: all 0.5s ease-in-out 0s;
        transition: all 0.5s ease-in-out 0s;
        cursor: pointer;
        display: inline-block;
        margin-top: 15px;
        background-color: -internal-light-dark(rgb(239, 239, 239), rgb(59, 59, 59));

    }

    .bottom:hover {
        background-image: -webkit-gradient(linear, left top, right top, from(#4c4c4e), to(#363636));
        background-image: -webkit-linear-gradient(top, #4c4c4e, #363636);
        background-image: -o-linear-gradient(top, #4c4c4e 0, #363636 100%);
        background-image: linear-gradient(top, #4c4c4e 0, #363636);
    }

    .strong-profile {
        width: 100%;
        margin-top: 60px;
    }

    .profile-item {
        display: flex;
        justify-content: space-between;
        width: 100%;
    }

    .profile-item .col {
        min-width: 50%;
        margin-top: 30px;
    }

    .profile-item .col .photo {
        position: relative;
        width: 100%;
        height: 300px;
        overflow: hidden;
        border-radius: 10px;
        -webkit-box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        -moz-box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        -o-box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        -ms-box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    .profile-item .col .photo img {
        width: 100%;
        min-height: 100%;
        object-fit: cover;
    }

    .profile-item .col:last-child {
        padding-left: 5%;
        min-width: 45%;
    }

    .profile-item .col .title {
        color: #af8b62;
        font-size: 24px;
    }

    .profile-item .col .text {
        font-size: 16px;
        color: #8c8c8c;
    }

    .profile-item .col .bottom {
        font-size: 16px;
    }

    .cd-single-point {
        position: absolute;
        top: 40%;
        right: 0;
        left: 0;
        list-style-type: none;
        width: 60px;
        height: 60px;
        margin: 0px auto;
        cursor: pointer;
        text-align: center;
        z-index: 20;
    }

    .cd-single-point::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        border-radius: 50%;
        width: 100%;
        height: 100%;
        animation: cd-pulse 2s infinite;
    }

    .cd-single-point .cd-img-replace {
        position: relative;
        z-index: 2;
        display: block;
        width: 60px;
        height: 60px;
        -webkit-border-radius: 50%;
        border-radius: 50%;
        background-clip: padding-box;
        background: #7d614891;
        -moz-transition: all 0.2s ease-in-out 0s;
        -o-transition: all 0.2s ease-in-out 0s;
        -webkit-transition: all 0.2s ease-in-out 0s;
        transition: all 0.2s ease-in-out 0s;
    }

    .cd-single-point .innerbc {
        position: absolute;
        top: 8px;
        left: 8px;
        width: 45px;
        height: 45px;
        -webkit-border-radius: 50%;
        border-radius: 50%;
        background-clip: padding-box;
        background: #af8b62;
        z-index: 10;
        color: #fff;
        padding-top: 16px;
    }

    .cd-single-point svg {
        position: absolute;
        top: 18px;
        left: 0;
        right: 0;
        margin: 0 auto;
        z-index: 10;
        max-width: 15px;
    }

    @keyframes cd-pulse {
        0% {
            box-shadow: 0 0 0 0 #fff;
        }
        100% {
            box-shadow: 0 0 0 30px rgba(255, 150, 44, 0);
        }
    }

    .pro-item .col {
        width: 50%;
        margin-top: 60px;
        padding: 0px !important;
    }

    .pro-item .col .photo {
        float: right;
        width: 250px;
        height: 250px;
        margin-top: 30px;
    }

    .nopad .col .photo {
        box-shadow: none;
        margin-top: 30px;
    }

    .nopad .col .photo img {
        min-height: inherit;
        object-fit: none;
    }

    .text-center {
        text-align: center;
    }

    .text-center .bottom {
        margin: 0px !important;
        min-width: 350px;
        height: 40px;
        display: inline-flex;
    }

    .footer {
        width: 100%;
        padding: 30px;
        margin-top: 60px;
        position: relative;
        background: #FFFFFF url('http://wellnessplus.live/frontAssets/images/logo-footer.png') no-repeat center center/cover;
    }

    @media (max-width: 991px) {
    }

    .footer .logo img {
        max-width: 130px;
    }

    .footer .text {
        line-height: 22px;
        color: #000;
        font-size: 16px;
        margin-top: 15px;
    }

    .footer .text a {
        color: #af8b62;
        text-decoration: underline;
    }

    .footer .text a:hover {
        text-decoration: none;
    }

    .footer .copyright {
        position: relative;
        margin-top: 30px;
        padding-top: 30px;
        width: 100%;
        border-top: 1px solid #5b5b5b;
        text-align: center;
    }

    .footer .copyright p {
        color: #fff;
        line-height: 17px;
        margin: 0px;
    }

    @media (max-width: 991px) {
        .container {
            width: 100%;
        }

        .profile-item {
            display: block;
        }

        .profile-item .col {
            width: 100%;
            padding: 0px !important;
        }

        .complete .photo img {
            max-width: 100%;
        }

        .pro-item .col .photo {
            width: 100%;
            margin: 0;
        }

        .nopad .col .photo {
            height: 200px;
        }

        .text-center .bottom {
            max-width: 100%;
        }
    }
</style>

<body>

<div class="container">
    {{ $header ?? '' }}

    {{ Illuminate\Mail\Markdown::parse($slot) }}

    {{ $subcopy ?? '' }}



    {{ $footer ?? '' }}
</div>


</body>
</html>
