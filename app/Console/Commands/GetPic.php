<?php

namespace App\Console\Commands;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\DomCrawler\Crawler;

class GetPic extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:pic';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Getting a comics picture.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return array
     * @throws GuzzleException
     */
    public function handle(): array
    {

        $comics = [];

        for ($i = 2568; $i > 2558; $i--) {
            $body = $this->cacheOrGet("https://xkcd.com/$i/");

            $crawler = new Crawler($body);

            $imageElement = $crawler->filter('div#comic > img');

            $src = $imageElement->attr('src');
            $title = $imageElement->attr('alt');
            $text = $imageElement->attr('title');

            $comics[] = [ $src, $title, $text ];
        }

        dd($comics);

        return $comics;
    }

    /**
     * Caching our requests.
     *
     * @param $url
     * @return string
     * @throws GuzzleException
     */
    public function cacheOrGet($url): string
    {
        if (Cache::has($url)) {
            return Cache::get($url);
        }

        $guzzle = new Client();
        $response = $guzzle->get($url);

        $body = $response->getBody()->getContents();
        echo "Request was made \n";
        Cache::put($url, $body);

        return $body;
    }
}
