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
                        $date = Carbon::now()->subHours(24);
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
                        'author' => $author,
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

//                    //Telegram
//                    if($artikel->wasRecentlyCreated) {
//                        $telegram = new Api(env('telegram_bot_token'));
//
//                        $message = $item->link.' - '.$item->title;
//
//                        $response = $telegram->sendMessage([
//                            'chat_id' => '-625938409',
//                            'text' => $message,
//                        ]);
//
//                        $messageId = $response->getMessageId();
//                    }

                } catch (\Exception $e) {
                    Log::error($e);

//                    //Telegram
//                    $telegram = new Api(env('telegram_bot_token'));
//
//                    $response = $telegram->sendMessage([
//                        'chat_id' => '-625938409',
//                        'text' => $e,
//                    ]);
//
//                    $messageId = $response->getMessageId();

                    continue;
                }
            }


        }
    }
}
