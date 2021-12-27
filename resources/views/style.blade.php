@include('version')
<meta charset="UTF-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="description" content="{{ $allsettings->site_desc }}">
<meta name="keywords" content="{{ $allsettings->site_keywords }}">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="{{ URL::to('resources/views/theme/css/style.css') }}">
<link rel="stylesheet" href="{{ URL::to('resources/views/theme/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ URL::to('resources/views/theme/css/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ URL::to('resources/views/theme/validate/themes/red/red.css') }}" />
@if($allsettings->site_favicon != '')
<link rel="apple-touch-icon" href="{{ url('/') }}/public/storage/settings/{{ $allsettings->site_favicon }}">
<link rel="shortcut icon" href="{{ url('/') }}/public/storage/settings/{{ $allsettings->site_favicon }}">
@endif
<link rel="stylesheet" type="text/css" href="{{ URL::to('resources/views/theme/video/video.css') }}">
<link rel="stylesheet" href="{{ URL::to('resources/views/theme/animate/aos.css') }}" />
@include('dynamic')
<link rel="stylesheet" href="{{ URL::to('resources/views/theme/assets/css/main.css') }}" />
<noscript><link rel="stylesheet" href="{{ URL::to('resources/views/theme/assets/css/noscript.css') }}" /></noscript>
<link rel="stylesheet" href="{{ URL::to('resources/views/theme/audio/audioplayer.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ URL::to('resources/views/theme/lightbox/jquery.lightbox.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::to('resources/views/theme/testimonial/testimonial.css') }}">
<link rel="stylesheet" href="{{ URL::to('resources/views/theme/pagination/pagination.css') }}">
<link rel="stylesheet" href="{{ URL::to('resources/views/theme/product/swiper.css') }}">
<link type="text/css" href="{{ URL::to('resources/views/theme/countdown/jquery.countdown.css?v=1.0.0.0') }}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://touchcdn.clickatell.com/widget/styles.css">


