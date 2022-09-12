<head>
<meta charset="utf-8" />
<title>@yield('title') | {{ $project_title }}</title>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="{{ $gsetting->meta_data_desc }}" />
<meta name="keywords" content="{{ $gsetting->meta_data_keyword }}">
<meta name="author" content="Media City" />
<meta name="MobileOptimized" content="320" />
<link rel="icon" type="image/icon" href="{{ asset('images/favicon/'.$gsetting->favicon) }}"> <!-- favicon-icon -->
<!-- theme styles -->
<link href="{{ url('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/> <!-- bootstrap css -->
<link href="https://fonts.googleapis.com/css?family=Great+Vibes|Poppins:300,400,500,700" rel="stylesheet"> <!--  google fonts -->
<link href="https://fonts.googleapis.com/css?family=Muli&display=swap:400,500,600,700" rel="stylesheet"><!-- google fonts -->
<link rel="stylesheet" href="{{ url('vendor/fontawesome/css/all.css') }}" /> <!--  fontawesome css -->
<link rel="stylesheet" href="{{ url('vendor/font/flaticon.css') }}" /> <!-- fontawesome css -->
<link rel="stylesheet" href="{{ url('vendor/navigation/menumaker.css') }}" /> <!-- navigation css -->
<link rel="stylesheet" href="{{ url('vendor/owl/css/owl.carousel.min.css') }}" /> <!-- owl carousel css -->
<link rel="stylesheet" href="{{ url('vendor/protip/protip.css') }}" /> <!-- menu css -->

<?php
$language = Session::get('changed_language'); //or 'english' //set the system language
$rtl = array('ar','he','ur', 'arc', 'az', 'dv', 'ku'); //make a list of rtl languages
?>
@if (in_array($language,$rtl))
<link href="{{ url('css/rtl.css') }}" rel="stylesheet" type="text/css"/> <!-- rtl css -->
@else
 
<link href="{{ url('css/style.css') }}" rel="stylesheet" type="text/css"/> <!-- custom css -->
@endif
<link rel="stylesheet" href="{{ url('css/colorbox.css') }}">
<link rel="stylesheet" href="{{url('admins/bower_components/font-awesome/css/font-awesome.min.css')}}"><!-- fontawesome css -->
<link rel="stylesheet" href="{{ url('css/select2.min.css') }}"> <!-- select2 css -->
<link rel="stylesheet" href="{{ URL::asset('css/pace.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ url('css/protip.css') }}" /> <!-- protip css -->
<link rel="manifest" href="{{url('manifest.json')}}">
<link rel="stylesheet" href="{{ asset('css/custom-style.css') }}"/>

<!-- end theme styles -->

<!-- Global site tag (gtag.js) - Google Ads: 437506638 -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-437506638"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'AW-437506638');
</script>

<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '438607774183219');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=438607774183219&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-3TSMNYBXBV">
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date()); gtag('config', 'G-3TSMNYBXBV');
</script>

<!-- Event snippet for Submit lead form conversion page -->
<script>
  gtag('event', 'conversion', {'send_to': 'AW-437506638/iVMKCLKti4sDEM6kz9AB'});
</script>
</head>
