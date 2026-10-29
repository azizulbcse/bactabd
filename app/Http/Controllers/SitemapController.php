<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;

class SitemapController extends Controller
{
    /**
     * Public, crawlable frontend pages only — admin, auth, and the
     * auth-gated /executive-minutes page are intentionally excluded.
     */
    private array $routes = [
        ['name' => 'home', 'priority' => '1.0', 'changefreq' => 'weekly'],
        ['name' => 'about', 'priority' => '0.8', 'changefreq' => 'monthly'],
        ['name' => 'committee', 'priority' => '0.7', 'changefreq' => 'monthly'],
        ['name' => 'members.lifetime', 'priority' => '0.6', 'changefreq' => 'monthly'],
        ['name' => 'members.active', 'priority' => '0.6', 'changefreq' => 'monthly'],
        ['name' => 'president.message', 'priority' => '0.6', 'changefreq' => 'monthly'],
        ['name' => 'notice.archive', 'priority' => '0.7', 'changefreq' => 'weekly'],
        ['name' => 'frontend.events.index', 'priority' => '0.8', 'changefreq' => 'weekly'],
        ['name' => 'frontend.gallery.index', 'priority' => '0.6', 'changefreq' => 'monthly'],
        ['name' => 'frontend.guidelines.index', 'priority' => '0.8', 'changefreq' => 'monthly'],
        ['name' => 'frontend.education.research', 'priority' => '0.6', 'changefreq' => 'monthly'],
        ['name' => 'frontend.journals.index', 'priority' => '0.8', 'changefreq' => 'weekly'],
        ['name' => 'contact.archive', 'priority' => '0.6', 'changefreq' => 'yearly'],
        ['name' => 'membership.apply', 'priority' => '0.7', 'changefreq' => 'yearly'],
        ['name' => 'frontend.surgeries.stats', 'priority' => '0.6', 'changefreq' => 'monthly'],
        ['name' => 'frontend.congenital.stats', 'priority' => '0.6', 'changefreq' => 'monthly'],
        ['name' => 'frontend.valvular.stats', 'priority' => '0.6', 'changefreq' => 'monthly'],
        ['name' => 'frontend.history.bacta', 'priority' => '0.5', 'changefreq' => 'yearly'],
        ['name' => 'frontend.cardiology', 'priority' => '0.6', 'changefreq' => 'monthly'],
        ['name' => 'frontend.tte.index', 'priority' => '0.6', 'changefreq' => 'monthly'],
        ['name' => 'frontend.toe.index', 'priority' => '0.6', 'changefreq' => 'monthly'],
        ['name' => 'frontend.pre_anesthesia.index', 'priority' => '0.6', 'changefreq' => 'monthly'],
        ['name' => 'frontend.anesthesia.index', 'priority' => '0.6', 'changefreq' => 'monthly'],
        ['name' => 'frontend.icu.index', 'priority' => '0.6', 'changefreq' => 'monthly'],
    ];

    public function index()
    {
        $urls = collect($this->routes)->map(fn ($r) => [
            'loc' => route($r['name']),
            'priority' => $r['priority'],
            'changefreq' => $r['changefreq'],
        ]);

        $xml = view('sitemap', compact('urls'))->render();

        return Response::make($xml, 200, ['Content-Type' => 'application/xml']);
    }
}
