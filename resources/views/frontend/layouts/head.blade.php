<meta charset="utf-8">
<meta name="description" content="Arabic Language Marketplace">
<meta name="viewport" content="width=device-width, initial-scale=1,shrink-to-fit=no">
<meta name="keywords" content="">
<meta name="csrf-token" content="{{ csrf_token() }}" />

<title>@if($gsetting and trim($gsetting->project_title) != '' and $gsetting->project_title != NULL) {{ $gsetting->project_title }} @endif</title>
<link rel="stylesheet" href="/frontAssets/css/bootstrap.min.css">
<link rel="stylesheet" href="/frontAssets/css/jquery.fancybox.min.css" />

<link rel="stylesheet" href="/frontAssets/css/style.css">

@if(session()->has('changed_language') && session('changed_language') == 'ar')
	<link rel="stylesheet" href="/frontAssets/css/style-rtl.css">
	<link href="/frontAssets/css/whatsapp-rtl.css" rel="stylesheet" />
@else
	<link href="/frontAssets/css/whatsapp.css" rel="stylesheet" />
@endif

<link rel="stylesheet" href="/frontAssets/css/intlTelInput.css">
<link rel="stylesheet" href="/frontAssets/css/chosen.css">
<link rel="stylesheet" href="/frontAssets/css/jquery-calendar.css">
<link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200&amp;display=swap"
    rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
    integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
<link rel="icon" href="/frontAssets/images/logo.svg" type="image/png">
{{--<!--[if lt IE 9]>--}}
{{--<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>--}}
{{--<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>--}}
{{--<![endif]-->--}}

{{--    <script src="https://unpkg.com/webcam-easy/dist/webcam-easy.min.js"></script>--}}


