<?php

namespace App\Jobs;

use App\Models\NewsArticle;
use App\Models\scraper_rss;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Api;

class RSS_scraperJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct()
    {
    }

    public function handle()
    {
        $rss_feeds = scraper_rss::where('actief', 1)->get();

        foreach ($rss_feeds as $rss_feed) {
            $xml = simplexml_load_file($rss_feed->link, 'SimpleXMLElement', LIBXML_NOCDATA);
            $source = $xml->channel->title;

            foreach ($xml->channel->item as $item) {
                try {
                    if (!empty($item->pubDate)) {
                        $pubDate = strftime("%Y-%m-%d %H:%M:%S", strtotime($item->pubDate));
                        $date = Carbon::now()->subHours(48);
                        if ($date >= $pubDate) {
                            continue;
                        }
                    } else {
                        $pubDate = null;
                        continue;
                    }

                    if (!empty($item->author)) {
                        $author = $item->author;
                    } else {
                        $author = $source;
                    }

                    $artikel = NewsArticle::firstOrCreate([
                        'title' => $item->title,
                        'link' => $item->link,
                    ],
                        [
                            'pubDate' => $pubDate,
                            'link' => $item->link,
                            'description' => $item->description,
                            'author' => $author,
                            'source' => $source,
                        ]);

                    //Updated at updaten
                    $updated_at = scraper_rss::find($rss_feed->id);
                    $updated_at->touch();

                } catch (\Exception $e) {
                    Log::error($e);
                    continue;
                }
            }


        }
    }
}
