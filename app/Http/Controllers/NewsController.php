<?php

namespace App\Http\Controllers;

use App\Jobs\RSS_scraperJob;
use App\Models\NewsArticle;
use App\Models\scraper_rss;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class NewsController extends Controller
{
    public function index()
    {
        $artikelen = NewsArticle::orderByDesc('pubDate')->simplePaginate(10);

        return view('news.index')->with('artikelen', $artikelen);
    }

    public function RssIndex()
    {
        $rsses = scraper_rss::orderBy('omschrijving')->simplePaginate(20);

        return view('news.rssindex')->with('rsses', $rsses);
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
}
