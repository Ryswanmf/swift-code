<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Project;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    /**
     * Generate dynamic sitemap.xml for search engines.
     */
    public function index(): Response
    {
        $baseUrl = config('app.url', url('/'));

        $projects = Project::query()
            ->where('is_published', true)
            ->orderBy('sort_order')
            ->get(['slug', 'updated_at']);

        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        // Homepage
        $xml .= '<url>';
        $xml .= '<loc>'.htmlspecialchars($baseUrl).'</loc>';
        $xml .= '<lastmod>'.now()->toAtomString().'</lastmod>';
        $xml .= '<changefreq>weekly</changefreq>';
        $xml .= '<priority>1.0</priority>';
        $xml .= '</url>';

        // Published Projects
        foreach ($projects as $project) {
            $xml .= '<url>';
            $xml .= '<loc>'.htmlspecialchars("{$baseUrl}/portofolio/{$project->slug}").'</loc>';
            $xml .= '<lastmod>'.$project->updated_at->toAtomString().'</lastmod>';
            $xml .= '<changefreq>monthly</changefreq>';
            $xml .= '<priority>0.8</priority>';
            $xml .= '</url>';
        }

        // Published Articles
        $articles = Article::query()
            ->where('is_published', true)
            ->get(['slug', 'updated_at']);

        foreach ($articles as $article) {
            $xml .= '<url>';
            $xml .= '<loc>'.htmlspecialchars("{$baseUrl}/artikel/{$article->slug}").'</loc>';
            $xml .= '<lastmod>'.$article->updated_at->toAtomString().'</lastmod>';
            $xml .= '<changefreq>weekly</changefreq>';
            $xml .= '<priority>0.7</priority>';
            $xml .= '</url>';
        }

        $xml .= '</urlset>';

        return response($xml, 200, [
            'Content-Type' => 'application/xml',
        ]);
    }
}
