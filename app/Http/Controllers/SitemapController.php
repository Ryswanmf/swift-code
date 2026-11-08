<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Project;
use App\Models\Setting;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    /**
     * Generate dynamic sitemap.xml for search engines.
     */
    public function index(): Response
    {
        $baseUrl = rtrim(config('app.url', url('/')), '/');

        $staticPages = [
            ['url' => '', 'priority' => '1.0', 'changefreq' => 'weekly'],
            ['url' => '/layanan', 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['url' => '/harga', 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['url' => '/portofolio', 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['url' => '/artikel', 'priority' => '0.8', 'changefreq' => 'daily'],
            ['url' => '/tentang', 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['url' => '/kontak', 'priority' => '0.8', 'changefreq' => 'monthly'],
        ];

        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        // Core Static Pages
        foreach ($staticPages as $page) {
            $loc = $page['url'] === '' ? $baseUrl : "{$baseUrl}{$page['url']}";
            $xml .= '<url>';
            $xml .= '<loc>'.htmlspecialchars($loc).'</loc>';
            $xml .= '<lastmod>'.now()->toAtomString().'</lastmod>';
            $xml .= '<changefreq>'.$page['changefreq'].'</changefreq>';
            $xml .= '<priority>'.$page['priority'].'</priority>';
            $xml .= '</url>';
        }

        // Published Projects
        $projects = Project::query()
            ->where('is_published', true)
            ->orderBy('sort_order')
            ->get(['slug', 'updated_at']);

        foreach ($projects as $project) {
            $xml .= '<url>';
            $xml .= '<loc>'.htmlspecialchars("{$baseUrl}/portofolio/{$project->slug}").'</loc>';
            $xml .= '<lastmod>'.$project->updated_at->toAtomString().'</lastmod>';
            $xml .= '<changefreq>monthly</changefreq>';
            $xml .= '<priority>0.8</priority>';
            $xml .= '</url>';
        }

        // Published Articles
        $articles = Article::published()
            ->orderByDesc('published_at')
            ->get(['slug', 'updated_at', 'published_at']);

        foreach ($articles as $article) {
            $lastmod = ($article->updated_at ?? $article->published_at ?? now())->toAtomString();
            $xml .= '<url>';
            $xml .= '<loc>'.htmlspecialchars("{$baseUrl}/artikel/{$article->slug}").'</loc>';
            $xml .= '<lastmod>'.$lastmod.'</lastmod>';
            $xml .= '<changefreq>weekly</changefreq>';
            $xml .= '<priority>0.7</priority>';
            $xml .= '</url>';
        }

        $xml .= '</urlset>';

        return response($xml, 200, [
            'Content-Type' => 'application/xml',
        ]);
    }

    /**
     * Generate dynamic RSS 2.0 Feed for blog articles.
     */
    public function rss(): Response
    {
        $baseUrl = rtrim(config('app.url', url('/')), '/');
        $siteName = Setting::get('site_name', 'Swift Code Lampung');
        $siteDescription = Setting::get('meta_description', 'Jasa Pembuatan Website Profesional & Cepat di Lampung');

        $articles = Article::published()
            ->orderByDesc('published_at')
            ->limit(30)
            ->get();

        $rss = '<?xml version="1.0" encoding="UTF-8"?>';
        $rss .= '<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">';
        $rss .= '<channel>';
        $rss .= '<title>'.htmlspecialchars($siteName).' - Blog &amp; Artikel</title>';
        $rss .= '<link>'.htmlspecialchars($baseUrl).'</link>';
        $rss .= '<description>'.htmlspecialchars($siteDescription).'</description>';
        $rss .= '<language>id-ID</language>';
        $rss .= '<lastBuildDate>'.now()->toRfc2822String().'</lastBuildDate>';
        $rss .= '<atom:link href="'.htmlspecialchars("{$baseUrl}/rss.xml").'" rel="self" type="application/rss+xml" />';

        foreach ($articles as $article) {
            $url = "{$baseUrl}/artikel/{$article->slug}";
            $pubDate = ($article->published_at ?? $article->created_at ?? now())->toRfc2822String();
            $summary = htmlspecialchars($article->summary ?? $article->excerpt ?? $article->title);

            $rss .= '<item>';
            $rss .= '<title>'.htmlspecialchars($article->title).'</title>';
            $rss .= '<link>'.htmlspecialchars($url).'</link>';
            $rss .= '<guid isPermaLink="true">'.htmlspecialchars($url).'</guid>';
            $rss .= '<pubDate>'.$pubDate.'</pubDate>';
            $rss .= '<description>'.$summary.'</description>';
            if ($article->author) {
                $rss .= '<author>'.htmlspecialchars($article->author).'</author>';
            }
            $rss .= '</item>';
        }

        $rss .= '</channel>';
        $rss .= '</rss>';

        return response($rss, 200, [
            'Content-Type' => 'application/rss+xml',
        ]);
    }
}
