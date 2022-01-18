<?php

namespace App\Console\Commands;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\DomCrawler\Crawler;

class GetPennyArcadeComic extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:pennycomic';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get a Penny Arcade dot com comics.';

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
        // getting the last comic on their website
        $url = "https://www.penny-arcade.com/comic";
        $comics = [];

        // doing 10 comics
        for ($i = 0; $i < 10; $i++) {
            $res = $this->getCache($url);

            // creating a new instance of Crawler
            $crawler = new Crawler($res);

            // getting main comic container
            $comic = $crawler->filter('body > div#main #comic');

            //getting comic image and title
            $comicFrame = $comic->filter('div#comicFrame img');
            $title = $comicFrame->attr('alt');
            $image = $comicFrame->attr('src');
            //$width = $comicFrame->attr('width');

            $comics[] = array(
                "title" => $title,
                "src" => $image,
                "comic url" => $url
                // I don't use width because values are the same
                //"width" => $width
            );

            // changing the url
            $next_url = $comic->filter('ul.comicNav > li > a.btnPrev')->attr('href');
            $url = $next_url;
        }

        var_dump($comics);

        return $comics;
    }

    /**
     * Cache the requests.
     *
     * @param $url
     * @return string
     * @throws GuzzleException
     */
    public function getCache($url): string
    {
        if (Cache::has($url)) {
            return Cache::get($url);
        }

        // creating a new instance of Guzzle client
        $client = new Client();

        // making a request and getting all the content
        $res = $client->get($url)->getBody()->getContents();
        echo "Request was sent";

        // cache the response, cache valid for 1 hour
        Cache::put($url, $res, 3600);

        return $res;
    }
}
