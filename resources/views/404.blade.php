<section id="banner">
                   <div class="headerbg overlay other-header" style="background-image: url('{{ url('/') }}/public/storage/settings/{{ $allsettings->site_banner }}');">
                      <div class="container text-center">
                          <div class="h2 text-white">{{ Helper::translation(1,$translate) }}</div>
                          <div><a href="{{ URL::to('/') }}" class="link-color">{{ Helper::translation(2,$translate) }}</a> <span class="split text-light">/</span> <span class="text-light">{{ Helper::translation(1,$translate) }}</span></div>
                        </div>
         </div>
</section>
<section id="team" class="pt-5 pb-5 mt-5 mb-5">
            <div class="container">
                 <div class="row">
                    <div class=" col-lg-12 col-md-12 col-sm-12 mb-3 pb-3">
                       <div class="h3 text-center text-black">{{ Helper::translation(1,$translate) }}</div>
                     </div>
                 </div>
            </div>
</section>                       