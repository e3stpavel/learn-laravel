<?php

namespace App\Console\Commands;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\DomCrawler\Crawler;

class GetComics extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:comics';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get comics.';

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

        $i = 0;
        $url = "http://wumo.com/wumo";
        while ($i < 10) {
            $body = $this->cacheOrGet($url);

            $crawler = new Crawler($body);

            $imageElement = $crawler->filter('div.box-content > a > img');

            $src = $imageElement->attr('src');

            // changing url
            $url = "http://wumo.com" . $crawler->filter('a.prev')->attr('href');

            $comics[] = [ $src ];

            $i++;
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
        Cache::put($url, $body, 3600); // 1 hour

        return $body;
    }
}
