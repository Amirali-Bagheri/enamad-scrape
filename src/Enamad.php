<?php

namespace AmiraliBagheri\EnamadScrape;

use Goutte\Client;
use Hekmatinasser\Verta\Facades\Verta;
use Illuminate\Support\Str;

class Enamad
{
    protected $domain;
    protected $client;
    protected $crawler;
    protected $http_parameters = [
        'timeout'          => 300,
        'read_timeout'     => 300,
        'connect_timeout'  => 300,
        'http_errors'      => false,
        'force_ip_resolve' => 'v4',
        'http_version'     => '1.1',
        'verify'           => false,
    ];

    public function __construct($domain)
    {
        $this->domain = $domain;
        $this->client = new Client();

        $this->crawler = $this->client->request('GET', 'https://enamad.ir/DomainListForMIMT?se=' .
            $domain, $this->http_parameters);
    }

    public function get()
    {

        if ($this->hasEnamad()) {

            $trustseal_url = $this->crawler->filter('#ListContent #Div_Content .row a')->first()->attr('href');

            $crawl_trustseal = $this->client->request('GET', $trustseal_url, $this->http_parameters);

            $data = [];

            $data[] = $crawl_trustseal->filter('div.contentinformation.col-md-6')->each(function ($node) {
                return $node->text();
            });

            $data[] = $crawl_trustseal->filter('div.contentinformation.col-md-8')->each(function ($node) {
                return $node->text();
            });

            $data[] = $crawl_trustseal->filter('.myskill_area p.txtcenter span')->each(function ($node, $i) use ($data) {
                if ($i == 5) {
                    return $node->text();
                }
            });

            $data   = collect($data)->collapse()->filter()->values();
            $data[] = Str::before(Str::after($crawl_trustseal->filter('h4.mobiledes img')->attr('src'), 'Star/star'), '.png');

            $keys = collect([
                'name',
                'start_date',
                'expire_date',
                'address',
                'phone',
                'email',
                'work_time',
                'history',
                'star',
            ]);

            return $keys->combine($data)->all();
        }
    }

    public function hasEnamad(): bool
    {
        return $this->crawler->filter('#ListContent #Div_Content .row a')->count() > 0;
    }

    public function isExpired()
    {
        if ($this->hasEnamad()) {
            return Verta::parse(substr($this->get()['expire_date'], -10))->isPast();
        }
    }
}
