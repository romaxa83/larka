<?php

namespace App\Http\Controllers\Admin\Blogs;

use App\Http\Controllers\Controller;
use Goutte\Client;

class ArticleController extends Controller
{
    public function demiart()
    {
        $url = 'https://laravel.demiart.ru/';

        $client = new Client();

        $crawler = $client->request('GET', $url);

//        $links = $crawler->filter('h2 > a')->links();
        $links = $crawler->filter('a.page-numbers')->links();

        $crawler = $client->click($links[0]);

        $links = $crawler->filter('a.page-numbers')->links();
//        dd($links);

        $all_links = [];

        foreach ($links as $link) {
            $all_links[] = $link->getURI();

        }

        $all_links = array_unique($all_links);

        echo "All Avialble Links From this page $url Page<pre>"; print_r($all_links);echo "</pre>";

        die();

        return view('admin.articles.demiart', compact('url'));
    }
}