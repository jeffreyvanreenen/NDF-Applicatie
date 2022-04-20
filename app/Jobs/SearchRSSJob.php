<?php

namespace App\Jobs;

use App\Models\NewsArticle;
use App\Models\scraper_rss;
use App\Models\Searchterm;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Api;

class SearchRSSJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $searchstrings = Searchterm::where('actief', 1)->get();

        foreach ($searchstrings as $searchstring) {
            $artikelen = NewsArticle::usingSearchString($searchstring->searchterm)->where('flag', 0)->get();

            foreach ($artikelen as $artikel) {
                $flag = NewsArticle::find($artikel->id);
                $flag->flag = 1;
                $flag->save();

                if (!empty($searchstring->telegram_chat_id)) {
                    try {
                        //Telegram
                        $telegram = new Api(config('services.telegram.key'));
                        $message = $artikel->link . ' - ' . $artikel->title;
                        $response = $telegram->sendMessage([
                            'chat_id' => $searchstring->telegram_chat_id,
                            'text' => $message,
                        ]);
                        $messageId = $response->getMessageId();
                    } catch (\Exception $e) {
                        Log::error($e);
                        continue;
                    }
                }
            }
        }
    }
}
