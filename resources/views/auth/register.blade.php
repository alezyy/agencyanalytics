<!doctype html>
<html class="no-js" lang="en">
    <head>
        <title>{{ Helper::translation(153,$translate) }} - {{ $allsettings->site_title }}</title>
        @include('style')
        {!! NoCaptcha::renderJs() !!}
    </head>
	
    <body id="LoginForm">
	
        <div class="container mt-5">
        
        <div align="center" class="mt-5 mb-5">
        @if($allsettings->site_logo != '')
    	<a href="{{ URL::to('/') }}" class="navbar-brand">
    	<img src="{{ url('/') }}/public/storage/settings/{{ $allsettings->site_logo }}" alt="{{ $allsettings->site_title }}" class="logo">
    	</a>
    	@endif
        </div>
        <div class="login-form mt-5">
           <div class="main-div col-md-5 mx-auto">
               <div>
                    @if ($message = Session::get('success'))
                           <div class="alert alert-success" role="alert">
                                            <span class="alert_icon lnr lnr-checkmark-circle"></span>
                                            {{ $message }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span class="fa fa-close" aria-hidden="true"></span>
                                            </button>
                                        </div>
                    @endif
                    @if ($message = Session::get('error'))
                    <div class="alert alert-danger" role="alert">
                                            <span class="alert_icon lnr lnr-warning"></span>
                                            {{ $message }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span class="fa fa-close" aria-hidden="true"></span>
                                            </button>
                                        </div>
                    @endif
                    @if (!$errors->isEmpty())
                    <div class="alert alert-danger" role="alert">
                    <span class="alert_icon lnr lnr-warning"></span>
                    @foreach ($errors->all() as $error)
                     
                    {{ $error }}
            
                    @endforeach
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span class="fa fa-close" aria-hidden="true"></span>
                    </button>
                    </div>
                    @endif
               </div>
               <div class="panel">
               <h2>{{ Helper::translation(154,$translate) }}</h2>
                   <p>{{ Helper::translation(155,$translate) }} <br/> {{ Helper::translation(156,$translate) }}</p>
               </div>
              <form method="POST" action="{{ route('register') }}" id="login_form">
                    @csrf
               <div class="form-group">
                    <label for="urname">{{ Helper::translation(157,$translate) }} <span class="required">*</span></label>
                                   <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"  value="{{ old('name') }}" data-bvalidator="required" autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
        
                   
        
                </div>
        
                <div class="form-group">
                    <label for="user_name">{{ Helper::translation(137,$translate) }} <span class="required">*</span></label>
                    <input id="username" type="text" name="username" class="form-control"  data-bvalidator="required">
                    
        
                </div>
                
                
                <div class="form-group">
                <label for="email_ad">{{ Helper::translation(158,$translate) }} <span class="required">*</span></label>
                                   <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email" data-bvalidator="email,required">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    
        
                </div>
                
                
                <div class="form-group">
                    <label for="password">{{ Helper::translation(138,$translate) }}<span class="required">*</span></label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password" data-bvalidator="required">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                </div>
                
                 <div class="form-group">
                    <label for="con_pass"> {{ Helper::translation(159,$translate) }} <span class="required">*</span></label>
                                   
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  data-bvalidator="equal[password],required" autocomplete="new-password">
                                </div>
                                
                                <input type="hidden" name="user_type" value="customer">
                 
                 
                 <div class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                <label for="con_pass">{{ Helper::translation(160,$translate) }}<span class="required">*</span></label>
                
                  {!! app('captcha')->display() !!}
                                @if ($errors->has('g-recaptcha-response'))
                                    <span class="help-block">
                                        <strong class="red">{{ $errors->first('g-recaptcha-response') }}</strong>
                                    </span>
                                @endif
                
              </div>
                
                
                
                <button type="submit" class="button rounded btn-block">{{ Helper::translation(153,$translate) }}</button>
                <div class="d-flex justify-content-between forgot">
                <div>
                </div>
                <div>
                  <a href="{{ URL::to('/login') }}">{{ Helper::translation(161,$translate) }}</a>
                </div>
                </div>
        </div>
            </form>
         </div>

      </div>
    </div>
    </div>
    @include('script')
    </body>
</html>


