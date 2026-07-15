<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Carbon;

class SeoController extends Controller
{
    public function sitemap()
    {
        $urls = [];

        $static = [
            'home' => '1.0', 'approach' => '0.7', 'services' => '0.8', 'work' => '0.6',
            'about' => '0.6', 'contact' => '0.7', 'blog.index' => '0.7',
            'privacy' => '0.3', 'terms' => '0.3',
        ];
        foreach ($static as $name => $priority) {
            $urls[] = ['loc' => route($name), 'changefreq' => 'monthly', 'priority' => $priority];
        }

        foreach (Post::published()->get() as $post) {
            $urls[] = [
                'loc' => route('blog.show', $post),
                'lastmod' => optional($post->updated_at ?? $post->published_at)->toAtomString(),
                'changefreq' => 'yearly',
                'priority' => '0.6',
            ];
        }

        $xml = '<?xml version="1.0" encoding="UTF-8"?>'."\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n";
        foreach ($urls as $u) {
            $xml .= '  <url>'."\n".'    <loc>'.e($u['loc']).'</loc>'."\n";
            if (! empty($u['lastmod'])) {
                $xml .= '    <lastmod>'.e($u['lastmod']).'</lastmod>'."\n";
            }
            $xml .= '    <changefreq>'.$u['changefreq'].'</changefreq>'."\n";
            $xml .= '    <priority>'.$u['priority'].'</priority>'."\n".'  </url>'."\n";
        }
        $xml .= '</urlset>'."\n";

        return response($xml, 200, ['Content-Type' => 'application/xml; charset=UTF-8']);
    }

    public function feed()
    {
        $posts = Post::published()->limit(30)->get();
        $self = url('/jornal/feed');
        $home = url('/jornal');

        $xml = '<?xml version="1.0" encoding="UTF-8"?>'."\n";
        $xml .= '<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">'."\n<channel>\n";
        $xml .= '  <title>asfouri — '.e(__('Jornal')).'</title>'."\n";
        $xml .= '  <link>'.e($home).'</link>'."\n";
        $xml .= '  <description>'.e(__('Notas e histórias sobre comunicação regenerativa, design, tecnologia e regeneração.')).'</description>'."\n";
        $xml .= '  <language>'.(app()->getLocale() === 'pt' ? 'pt-PT' : 'en-GB').'</language>'."\n";
        $xml .= '  <atom:link href="'.e($self).'" rel="self" type="application/rss+xml" />'."\n";
        foreach ($posts as $post) {
            $xml .= "  <item>\n";
            $xml .= '    <title>'.e($post->title()).'</title>'."\n";
            $xml .= '    <link>'.e(route('blog.show', $post)).'</link>'."\n";
            $xml .= '    <guid isPermaLink="true">'.e(route('blog.show', $post)).'</guid>'."\n";
            if ($post->excerpt()) {
                $xml .= '    <description>'.e($post->excerpt()).'</description>'."\n";
            }
            if ($post->published_at) {
                $xml .= '    <pubDate>'.$post->published_at->toRssString().'</pubDate>'."\n";
            }
            $xml .= "  </item>\n";
        }
        $xml .= "</channel>\n</rss>\n";

        return response($xml, 200, ['Content-Type' => 'application/rss+xml; charset=UTF-8']);
    }
}
