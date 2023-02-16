<?php

namespace App\Console\Commands;

use App\Console\CrawlTable;
use App\Link;
use App\Models\Truyen;
use Goutte\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Sunra\PhpSimple\HtmlDomParser;

class CrawlData extends Command
{
    protected $signature = 'crawl';

    protected $description = 'Check queue';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $link = Link::query()->first();
        File::put('test.html',
            view('site.get-file')
                ->with(["link" => $link])
                ->render()
        );
        try {
            $client = new Client();
            $dataCrawl = [];
            for ($i = 1; $i <= 25; $i++) {
                $url = $i == 1 ? 'https://webtruyenfreez.com/de-cu/' : 'https://webtruyenfreez.com/de-cu/page/' . $i;
                $dom = HtmlDomParser::file_get_html($url);
                dd($dom);

                $crawler = $client->request('GET', $url);
                $crawler->filter('div.runninghorse.home-truyendecu')->each(function ($node) use (&$dataCrawl) {
                    $data = [];
                    $node->filter('div.each_truyen')->each(function ($ele) use (&$data) {
                        $html = $ele->html();
                        $doc = new \DOMDocument();
                        $doc->loadHTML($html);
                        $a = $doc->getElementsByTagName('a')->item(0);
                        $data['link'] = $a->getAttribute('href');
                        $img = $doc->getElementsByTagName('img')->item(0);
                        $data['img'] = $img->getAttribute('data-lazy-src');
                    });
                    $node->filter('div.caption')->each(function ($ele) use (&$data) {
                        $html = $ele->html();
                        $doc = new \DOMDocument();
                        $doc->loadHTML($html);
                        $a = $doc->getElementsByTagName('a');
                        $data['title'] = $a->item(0)->getAttribute('title');
                        $data['author'] = $a->item(1)->getAttribute('title');
                    });
                    $dataCrawl[] = $data;
                });
            }
            Truyen::query()->insert($dataCrawl);
            dd($dataCrawl);
        } catch (\Exception $e) {
            dd($e);
        }
    }
}
