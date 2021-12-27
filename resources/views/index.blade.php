<!DOCTYPE html>
<html lang="en">
<head>
<title>{{ $allsettings->site_title }}</title>
@include('style')
<!-- Google Tag Manager -->
<!-- End Google Tag Manager -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

</head>
<body class="index">
<!-- Google Tag Manager (noscript) -->
<!-- End Google Tag Manager (noscript) -->
    <div id="page-wrapper">

        <!-- Header -->
        @include('header')

        <!-- Banner -->
            <section id="banner">

                <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
                <div class="carousel-inner">
                    @php $i=1; @endphp
                    @foreach($slideshow['view'] as $slideshow)
                        <div class="carousel-item @if($i==1) active @endif">
                          <img src="{{ url('/') }}/public/storage/slideshow/{{ $slideshow->slide_image }}" alt="First slide">
                              <div class="carousel-caption">
                                <div class="mb-3 mt-5 h1">{{ $slideshow->slide_heading }}</div>
                                <div class="h4">{{ $slideshow->slide_subheading }}</div>
                              </div>
                        </div>
                    @php $i++; @endphp
                   @endforeach

                      </div>
                      <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">{{ Helper::translation(93,$translate) }}</span>
                      </a>
                      <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">{{ Helper::translation(94,$translate) }}</span>
                      </a>
                </div>

            </section>

       @if($allsettings->display_newsletter == 1)
       <section class="subscribe-area pb-5 pt-5">
        <div class="container">
            <div>
              @if ($message = Session::get('news-success'))
              <div class="alert alert-success" role="alert">
                                                    <span class="alert_icon lnr lnr-checkmark-circle"></span>
                                                    {{ $message }}
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span class="fa fa-close" aria-hidden="true"></span>
                                                    </button>
              </div>
              @endif
              @if ($message = Session::get('news-error'))
              <div class="alert alert-danger" role="alert">
                          <span class="alert_icon lnr lnr-warning"></span>
                                                    {{ $message }}
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span class="fa fa-close" aria-hidden="true"></span>
                                                    </button>
                         </div>
              @endif
              </div>

            <div class="row pb-5 pt-4">

                <div class="col-md-4">
                    <div class="subscribe-text mb-3">
                        <span>{{ Helper::translation(97,$translate) }}</span>
                        <h2>{{ Helper::translation(98,$translate) }}</h2>
                    </div>
                </div>
                <div class="col-md-8">

                    <div class="subscribe-wrapper subscribe2-wrapper mb-3">
                        <div class="subscribe-form">
                            <form action="{{ route('crawlerSite') }}" id="footer_form" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                                <input placeholder="{{ Helper::translation(79,$translate) }}" type="URL" name="website" class="rounded mb-3" >
                                <button type="submit" class="black-button text-white text-upper rounded"> {{ Helper::translation(99,$translate) }}</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        </section>
        @endif

        <!-- Footer image-hover img-inner-shadow -->
        @include('footer')

    </div>

</div>
@include('script')
</body>
</html>
