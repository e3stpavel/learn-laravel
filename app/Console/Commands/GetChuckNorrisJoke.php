<?php

namespace App\Console\Commands;

use GuzzleHttp\Client;
use Illuminate\Console\Command;

class GetChuckNorrisJoke extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:joke';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get a random Chuck Norris joke.';

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
     * @return string
     */
    public function handle()
    {
        $guzzle = new Client();
        $res = $guzzle->get('https://api.chucknorris.io/jokes/random');

        $response = $res->getBody()->getContents();

        $joke = json_decode($response, true);

        echo $joke['value'] . "\n";

        return $joke;
    }
}
