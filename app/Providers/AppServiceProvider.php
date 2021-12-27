<?php

namespace MyJesus\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Schema;
use MyJesus\Models\Members;
use MyJesus\Models\Settings;
use MyJesus\Models\Category;
use MyJesus\Models\Pages;
use MyJesus\Models\Comment;
use MyJesus\Models\Languages; 
use Illuminate\Support\Facades\View;
use Auth;
use Illuminate\Support\Facades\Config;
use Route;
use Request;
use Cookie;
use Illuminate\Support\Facades\Crypt;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
	public function language_call()
	{
	   return 'hello sara';
	} 
	 
	 
    public function boot()
    {
        Schema::defaultStringLength(191);
		$admin = Members::adminData();
		View::share('admin', $admin);
		
		$allsettings = Settings::allSettings();
		View::share('allsettings', $allsettings);
		
		$extrasettings = Settings::extraSettings();
		View::share('extrasettings', $extrasettings);
		
		$demo_mode = 'off'; // on
		View::share('demo_mode', $demo_mode);
		
		$languages['view'] = Languages::allLanguage();
		View::share('languages', $languages);
						
		$allpages['pages'] = Pages::menupageData();
		View::share('allpages', $allpages);
		
		if(!empty(Cookie::get('translate')))
		{
		$translate = Crypt::decrypt(Cookie::get('translate'), false);
		   $lang_title['view'] = Languages::getLanguage($translate);
		   $language_title = $lang_title['view']->language_name;
		}
		else
		{
		  $default_count = Languages::defaultLanguageCount();
		  if($default_count == 0)
		  { 
		  $translate = "en";
		  $lang_title['view'] = Languages::getLanguage($translate);
		   $language_title = $lang_title['view']->language_name;
		  }
		  else
		  {
		  $default['lang'] = Languages::defaultLanguage();
		  $translate =  $default['lang']->language_code;
		  $lang_title['view'] = Languages::getLanguage($translate);
		   $language_title = $lang_title['view']->language_name;
		  }
		 
		}
		View::share('translate', $translate);
		View::share('language_title', $language_title);
		
		$totalpageCount = Pages::totalpageData();
		View::share('totalpageCount', $totalpageCount);
		
		$footerpages['pages'] = Pages::footermenuData();
		View::share('footerpages', $footerpages);
		
			
		view()->composer('*', function($view){
            $view_name = str_replace('.', '-', $view->getName());
            view()->share('view_name', $view_name);
        });
		
				
		if($allsettings->stripe_mode == 0) 
		{ 
		$stripe_publish_key = $allsettings->test_publish_key; 
		$stripe_secret_key = $allsettings->test_secret_key;
		
		}
		else
		{ 
		$stripe_publish_key = $allsettings->live_publish_key;
		$stripe_secret_key = $allsettings->live_secret_key;
		}
		View::share('stripe_publish_key', $stripe_publish_key);
		View::share('stripe_secret_key', $stripe_secret_key);
		
			
		
		Config::set('mail.driver', $allsettings->mail_driver);
		Config::set('mail.host', $allsettings->mail_host);
		Config::set('mail.port', $allsettings->mail_port);
		Config::set('mail.username', $allsettings->mail_username);
		Config::set('mail.password', $allsettings->mail_password);
		Config::set('mail.encryption', $allsettings->mail_encryption);
		
		
		Config::set('services.facebook.client_id', $allsettings->facebook_client_id);
		Config::set('services.facebook.client_secret', $allsettings->facebook_client_secret);
		Config::set('services.facebook.redirect', $allsettings->facebook_callback_url);
		Config::set('services.google.client_id', $allsettings->google_client_id);
		Config::set('services.google.client_secret', $allsettings->google_client_secret);
		Config::set('services.google.redirect', $allsettings->google_callback_url);
		
				
    }
}
