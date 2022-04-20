<?php

namespace App\Http\Controllers;

use App\Jobs\RSS_scraperJob;
use App\Models\NewsArticle;
use App\Models\scraper_rss;
use App\Models\Searchterm;
use Atymic\Twitter\Contract\Twitter;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class NewsController extends Controller
{
    public function index()
    {
//        $artikelen = NewsArticle::usingSearchString('"Adrianne de Koning"')->get();

        $artikelen = NewsArticle::orderByDesc('pubDate')->simplePaginate(10);

        return view('news.index')->with('artikelen', $artikelen);
    }

    public function RssIndex()
    {
        $rsses = scraper_rss::orderBy('omschrijving')->simplePaginate(20);

        return view('news.rssindex')->with('rsses', $rsses);
    }

    public function SearchTermsIndex()
    {
     $searchterms = Searchterm::all();

     return view('search.searchtermindex')->with('searchterms', $searchterms);
    }

    public function SearchTermSave(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'searchterm' => 'required',
        ]);

        $searchterm = new Searchterm;
        $searchterm->name = $request->name;
        $searchterm->searchterm = $request->searchterm;
        $searchterm->save();

        return redirect()->back()->with('message', 'Succesvol toegevoegd!');
    }

    public function SearchTermUpdate(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'searchterm' => 'required',
        ]);

        $searchterm = Searchterm::find($id);
        $searchterm->name = $request->name;
        $searchterm->searchterm = $request->searchterm;
        $searchterm->save();

        return redirect()->back()->with('message', 'Succesvol aangepast!');
    }

    public function SearchTermDelete($id)
    {
        $searchterm = Searchterm::find($id);
        $searchterm->delete();

        return redirect()->route('search-terms-index');
    }

    public function SearchResults($id)
    {
        $searchstring = Searchterm::find($id);

        $artikelen = NewsArticle::usingSearchString($searchstring->searchterm)->orderByDesc('pubDate')->simplePaginate(20);;

        return view('search.searchresults')->with('artikelen', $artikelen)->with('searchstring', $searchstring);
    }

    public function RSSsave(Request $request)
    {
        $validated = $request->validate([
            'link' => 'required|active_url|unique:scraper_rsses',
            'actief' => 'required|boolean',
        ]);

        $xml = simplexml_load_file($request->link, 'SimpleXMLElement', LIBXML_NOCDATA);
        $omschrijving = $xml->channel->title;

        if ($xml->channel->image->url != null) {
            $logo = $xml->channel->image->url;
        }else{
            $logo = 'https://pbs.twimg.com/profile_images/578844000267816960/6cj6d4oZ_400x400.png';
        }

        $rssfeed = new scraper_rss;
        $rssfeed->logo = $logo;
        $rssfeed->omschrijving =  $omschrijving;
        $rssfeed->link = $request->link;
        $rssfeed->actief = $request->actief;
        $rssfeed->save();

        return redirect()->back()->with('message', 'Succesvol toegevoegd!');
    }

    public function Rss_Scrape()
    {
        RSS_scraperJob::dispatch();
        return redirect()->back()->with('message', 'Scrapen gestart op de achtergrond');
    }

    public function TwitterSearch(Request $request)
    {
        $searchstring = 'laravel';

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.twitter.com/2/tweets/search/recent?query='.$searchstring.'&max_results=10&sort_order=recency&expansions=author_id,referenced_tweets.id,in_reply_to_user_id,geo.place_id,attachments.media_keys,attachments.poll_ids,entities.mentions.username,referenced_tweets.id.author_id&tweet.fields=id,created_at,text,author_id,in_reply_to_user_id,referenced_tweets,attachments,withheld,geo,entities,public_metrics,possibly_sensitive,source,lang,context_annotations,conversation_id,reply_settings&user.fields=id,created_at,name,username,protected,verified,withheld,profile_image_url,location,url,description,entities,pinned_tweet_id,public_metrics&media.fields=media_key,duration_ms,height,preview_image_url,type,url,width,public_metrics,alt_text&place.fields=id,name,country_code,place_type,full_name,country,contained_within,geo&poll.fields=id,options,voting_status,end_datetime,duration_minutes',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Content-Type:application/json',
                'Authorization: Bearer AAAAAAAAAAAAAAAAAAAAAHaMbgEAAAAA96LcZLizSjhKqkc%2FELxxWA%2F2Kxg%3DT6tsq30GbUaIfHFD4mLdBGdny9yFbAWAzO8etylMJYOLFTktEq',
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        dd($response);



    }
}
