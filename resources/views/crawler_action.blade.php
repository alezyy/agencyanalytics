<!DOCTYPE html>
<html lang="en">
<head>
    @if($allsettings->display_contact == 1)
        <title>{{ Helper::translation(36,$translate) }} - {{ $allsettings->site_title }}</title>
    @else
        <title>404 not found - {{ $allsettings->site_title }}</title>
    @endif
    @include('style')
    {!! NoCaptcha::renderJs() !!}
</head>
<body>
<div id="page-wrapper">

    <!-- Header -->
    @include('header')

        <section id="banner">
            <div class="" height="9px" style="background-image: url('{{ url('/') }}/public/storage/settings/{{ $allsettings->site_banner }}');" >
                <div class="container text-center">
                    <div class="h2 text-white">{{ "Results" }}</div>
                    <div><a href="{{ URL::to('/') }}" class="link-color">{{ Helper::translation(2,$translate) }}</a> <span class="split text-light">/</span> <span class="text-light">{{ "Results" }}</span></div>
                </div>
            </div>
        </section>

        <section class="contact pt-5 pb-5 mt-5 mb-5" id="contact">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <ol>
                            <li class="list-item">
                                Number of pages crawled : <b> {{ $nPages_crawled }} </b>
                            </li>
                            <br>
                            <li class="list-item">
                                Number of a unique images : <b> {{ $nUniqueImages }} </b>
                            </li>
                            <br>
                            <li class="list-item">
                                Number of unique internal links : <b> {{ $nUniqueInternalLinks  }} </b>
                            </li>
                            <br>
                            <li class="list-item">
                                Number of unique external links : <b>  {{ $nUniqueExternalLinks }} </b>
                            </li>
                            <br>
                            <li class="list-item">
                                Average page load: <b>  {{ $averagePageLoad }} {{ 'seconds' }} </b>
                            </li>
                            <br>

                            <br>
                        </ol>
                    </div>
                    <div class="col-md-8">
                        <table class="table">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Pages</th>
                                <th scope="col">Http Status code</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($pages as $key=>$pg)
                                <tr>
                                    <th scope="row">{{ $key }}</th>
                                    <td>{{ $pg['page']  }}</td>
                                    <td>{{ $pg['status'] }}</td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </section>

    @include('footer')

</div>

</div>
@include('script')
</body>
</html>
