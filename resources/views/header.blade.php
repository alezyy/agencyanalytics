<header id="header" class="alt">
					<div id="logo">
                    @if($allsettings->site_logo != '')
                    <a href="{{ URL::to('/') }}" class="navbar-brand">
                    <img src="{{ url('/') }}/public/storage/settings/{{ $allsettings->site_logo }}" alt="{{ $allsettings->site_title }}" class="logo">
                    </a>
                    @endif
                    </div>

					<nav id="nav">
						<ul>
							<li><a href="{{ URL::to('/') }}">{{ Helper::translation(2,$translate) }}</a></li>

							<li class="submenu">
								<a href="javascript:void(0)">{{ Helper::translation(75,$translate) }}</a>
								<ul>
                                   @if($totalpageCount != 0)
                                   @foreach($allpages['pages'] as $pages)
									<li><a href="{{ URL::to('/page/') }}/{{ $pages->page_slug }}">{{ $pages->page_title }}</a></li>
								   @endforeach
                                   @endif
                                   @if($allsettings->display_contact == 1)
                                   <li><a href="{{ URL::to('/contact') }}"><i class="fa fa-envelope-square"></i> {{ Helper::translation(36,$translate) }}</a></li>
                                   @endif
								</ul>
							</li>


                            @if($allsettings->site_multilanguage == 1)
                            <li class="submenu">
								<a href="javascript:void(0)">{{ $language_title }}</a>
								<ul>
                                @foreach($languages['view'] as $language)
                                 <li><a href="{{ URL::to('/translate') }}/{{ $language->language_code }}">{{ $language->language_name }}</a></li>
                                @endforeach
                                </ul>
							</li>
                            @endif
                            @if(Auth::guest())
								<li><a href="{{ URL::to('/login') }}"><i class="fa fa-sign-in"></i> {{ Helper::translation(84,$translate) }}</a></li>
                            @endif
                            @if (Auth::check())
                            <li class="submenu">
								<a href="javascript:void(0);">{{ Helper::translation(85,$translate) }}</a>
								<ul>
                                    @if(Auth::user()->id != 1)
									<li><a href="{{ URL::to('/profile') }}">{{ Helper::translation(86,$translate) }}</a></li>
									<li><a href="{{ URL::to('/cart') }}">{{ Helper::translation(87,$translate) }}</a></li>
                                    <li><a href="{{ URL::to('/my-donation') }}">{{ Helper::translation(88,$translate) }}</a></li>
                                    <li><a href="{{ URL::to('/my-order') }}">{{ Helper::translation(89,$translate) }}</a></li>
                                    <li><a href="{{ URL::to('/logout') }}">{{ Helper::translation(90,$translate) }}</a></li>
                                    @else
									<li><a href="{{ URL::to('/admin') }}">{{ Helper::translation(91,$translate) }}</a></li>
                                    <li><a href="{{ URL::to('/logout') }}">{{ Helper::translation(90,$translate) }}</a></li>
								    @endif
								</ul>
							</li>
                            @endif
                            @if(Auth::guest())
							<li><a href="{{ URL::to('/register') }}" class="button">{{ Helper::translation(92,$translate) }}</a></li>
                            @endif
                            @if (Auth::check())
                            <li><a href="{{ URL::to('/donate-now') }}" class="button"> {{ Helper::translation(39,$translate) }}</a></li>
                            @endif
						</ul>
					</nav>
</header>
