<?php

namespace MyJesus\Http\Controllers;

use DOMDocument;
use Illuminate\Http\Request;
use MyJesus\Models\Settings;
use MyJesus\Models\Slideshow;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\Rule;
use URL;
use Cookie;
use Redirect;
use Illuminate\Support\Facades\Config;

class CommonController extends Controller
{
    public function view_index()
	{

	   $sid = 1;
	   $setting['setting'] = Settings::editGeneral($sid);
	   $extra['setting'] = Settings::editExtra($sid);
	   $slideshow['view'] = Slideshow::viewSlideshow();
	   $data = array('setting' => $setting, 'slideshow' => $slideshow);
	   return view('index')->with($data);
	}

	public function cookie_translate($id)
	{

	  Cookie::queue(Cookie::make('translate', $id, 3000));
      return Redirect::route('index')->withCookie('translate');

	}

    public function update_crawlerSite(Request $request)
    {
        $website = $request->input('website');

        $request->validate([
            'website' => 'required|url',
        ]);

        $n_pages_to_crawl = 6;

        //get the 6 pages from the web site
        $sitemap_URL = $website.'/'.'sitemap.xml';
        $pagesList = json_decode(json_encode(simplexml_load_file($sitemap_URL) ), TRUE);
        unset($pagesList["url"][0]);

        foreach ($pagesList["url"] as $key => $pageL) {

            if($key <= $n_pages_to_crawl) {
                $pagesL[$key] = $pageL["loc"];
            }
        }
        return $this->crawlerAction($pagesL, $n_pages_to_crawl );

    }

    /**
     * @param $pagesL
     * @param $n_pages_to_crawl
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function crawlerAction($pagesL, $n_pages_to_crawl)
    {
        foreach ($pagesL as $key => $page) {

            //Get HTTP status code
            $pages[] = $this->getHttpSatus($page);

            //Average page load in seconds
            $speed = $this->getAverageLoad($page);

            //Number of a unique images
            $uniqueImage[] = sizeof($this->getUniqueImage($page));

            // Number of unique internal links
            $nInternalLinks[] = $this->getInternalLinks($page);

            // Number of unique external links
            $nExternalLinks[] = $this->getExternalLinks($page);

        }

        $nPages_crawled = $n_pages_to_crawl;
        $speed_average = $speed/$n_pages_to_crawl;

        $data = array(
            'nPages_crawled' => $nPages_crawled,
            'nUniqueImages' => array_sum($uniqueImage),
            'nUniqueInternalLinks' => array_sum($nInternalLinks),
            'nUniqueExternalLinks' => array_sum($nExternalLinks),
            'averagePageLoad' => $speed_average,
            'pages' => $pages
        );

        return view('crawler_action')->with($data);
    }

    public function preg_substr($start, $end, $str)
    {

        $temp =preg_split($start, $str);
        $content = preg_split($end, $temp[1]);
        return $content[0];

    }

    /**
     * @param $str
     */
    public function writelog($str)
    {

        @unlink(base_path() . '/public/storage/log/log.txt');
        $open = fopen(base_path() . '/public/storage/log/log.txt','a');
        fwrite($open,$str);
        fclose($open);

    }

    public function str_substr($start, $end, $str) // string split
    {

        $temp = explode($start, $str, 2);
        $content = explode($end, $temp[1], 2);
        return $content[0];

    }

    public function getHttpSatus($page)
    {
        //Get HTTP status code
        $headers = get_headers($page);
        $status = substr($headers[0], 9, 3);
        return ['page' => $page, 'status' => $status] ;
    }

    public function getAverageLoad($page)
    {
        //Average page load in seconds
        $speed = 0;
        $t = microtime( TRUE );
        file_get_contents($page);
        $t = microtime( TRUE ) - $t;
        return $speed + $t;
    }

    public function getUniqueImage($page)
    {
        //Send a GET request to the URL of the web page using file_get_contents.
        //This will return the HTML source of the page as a string.
        $htmlString = file_get_contents($page);

        //Create a new DOMDocument object.
        $htmlDom = new DOMDocument;

        //Load the HTML string into our DOMDocument object.
        @$htmlDom->loadHTML($htmlString);

        //Extract all img elements / tags from the HTML.
        $imageTags = $htmlDom->getElementsByTagName('img');

        //Create an array to add extracted images to.
        $extractedImages = array();

        //Loop through the image tags that DOMDocument found.
        foreach($imageTags as $imageTag){

            //Get the src attribute of the image.
            $imgSrc = $imageTag->getAttribute('src');

            if ($imgSrc !=null) {
                //Add the image details to our $extractedImages array.
                $extractedImages[] = array(
                    'src' => $imgSrc,
                );
            }

        }
        return $extractedImages;

    }

    public function getExternalLinks($url)
    {
        $pUrl = parse_url($url);

        // Load the HTML into a DOMDocument
        $doc = new DOMDocument;
        @$doc->loadHTMLFile($url);

        // Look for all the 'a' elements
        $links = $doc->getElementsByTagName('a');

        $numLinks = 0;
        foreach ($links as $link) {

            // Exclude if not a link or has 'nofollow'
            preg_match_all('/\S+/', strtolower($link->getAttribute('rel')), $rel);
            if (!$link->hasAttribute('href') || in_array('nofollow', $rel[0])) {
                continue;
            }

            // Exclude if internal link
            $href = $link->getAttribute('href');

            if (substr($href, 0, 2) === '//') {
                $href = $pUrl['scheme'] . ':' . $href;
            }

            $pHref = @parse_url($href);
            if (!$pHref || !isset($pHref['host']) ||
                strtolower($pHref['host']) === strtolower($pUrl['host'])
            ) {
                continue;
            }

            // Increment counter otherwise
            $numLinks++;

        }

         return $numLinks;
    }

    public function getInternalLinks($url)
    {
        $pUrl = parse_url($url);

        // Load the HTML into a DOMDocument
        $doc = new DOMDocument;
        @$doc->loadHTMLFile($url);

        // Look for all the 'a' elements
        $links = $doc->getElementsByTagName('a');

        $numLinks = 0;
        foreach ($links as $link) {

            // Exclude if not a link or has 'nofollow'
            preg_match_all('/\S+/', strtolower($link->getAttribute('rel')), $rel);
            if (!$link->hasAttribute('href') || in_array('nofollow', $rel[0])) {
                continue;
            }

            $href = $link->getAttribute('href');

            if (isset($href) ) {

                // Increment counter
                $numLinks++;
            }

        }

        return $numLinks;
    }

}
