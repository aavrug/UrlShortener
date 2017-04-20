<?php
 
namespace App\Http\Controllers;
 
use App\Url;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use Validator;
use Illuminate\Support\Facades\DB;
 
class UrlsController extends Controller {

    /**
     * Show the page to create a new short url
     *
     * @return view
     */
    public function create()
    {
        return view('urls.create');
    }

    /**
     * redirect to the original url ad per device type.
     */
    public function switchToOriginal($url)
    {
        $url = Url::where('short_url', '=', $url)->first();
        if ($url) {
            $agent = new Agent();
            $targetField = 'pc_target_url';
            if ($agent->isPhone()) {
                $url->mobile_redirects += 1;
                $targetField = 'mobile_target_url';
            } else {
                $url->pc_redirects += 1;
            }
            $url->update();
            return redirect()->away($url->{$targetField});
        }

        session()->flash('flash_message', 'The short url doesn\'t exist.');

        return redirect('/');

    }

    /**
     * Store a new url.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'desktop_url' => 'required|url',
            'mobile_url' => 'required|url'
        ]);

        $shortUrl = $this->saveUrl($request);

        session()->flash('flash_message', 'The generated short url is '.url('/').'/switch/'.$shortUrl);

        return redirect('/');
    }

    /**
     * Create a new short url.
     *
     * @param  Request  $request
     * @return Json Response
     */
	public function createUrl(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'desktop_url' => 'required|url',
            'mobile_url' => 'required|url'
        ]);

        if ($validator->fails()) {
            $response = ['error' => 'Please pass valid URLs.'];
            return response()->json($response);
        }

        $shortUrl = $this->saveUrl($request);
        $response = ['url' => url('/').'/switch/'.$shortUrl];

    	return response()->json($response);
	}

    /**
     * Return list of short urls.
     *
     * @return Json Response
     */
    public function index(){
        $urls = DB::table('urls')->select('short_url', 'pc_target_url', 'mobile_target_url', 'pc_redirects', 'mobile_redirects', 'created_at')->get();

        return response()->json($urls);
    }

    /**
     * Generate random string.
     *
     * @return string
     */
    public function generateShortUrl()
    {
        $key = 'abcdefghijklmnopABCDEFGHIJKLMNOP';
        $string = substr(str_shuffle($key), 0, 6);
        if (Url::where('short_url', '=', $string)->exists()) {
            $this->generateShortUrl();
        }

        return $string;
    }

    /**
     * Create a new entry.
     *
     * @param  Request  $data
     * @return $shortUrl string
     */
    public function saveUrl($data)
    {
        $url = new Url;
        $shortUrl = $this->generateShortUrl();
        $url->short_url = $shortUrl;
        $url->pc_target_url = $data->desktop_url;
        $url->mobile_target_url = $data->mobile_url;
        $url->save();

        return $shortUrl;
    }
}
?>