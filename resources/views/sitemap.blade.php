<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    <url>
        <loc>{{ route('home') }}</loc>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
        <lastmod>{{ now()->toAtomString() }}</lastmod>
    </url>

    <url>
        <loc>{{ route('about') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.5</priority>
    </url>

    @foreach($categories as $cat)
    <url>
        <loc>{{ route('category.show', $cat->name) }}</loc>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
        <lastmod>{{ now()->toAtomString() }}</lastmod>
    </url>
    @endforeach

    @foreach($profiles as $profile)
    <url>
        <loc>{{ route('profile.show', $profile->username) }}</loc>
        <changefreq>daily</changefreq>
        <priority>0.9</priority>
        @if($profile->last_updated_at)
        <lastmod>{{ \Carbon\Carbon::parse($profile->last_updated_at)->toAtomString() }}</lastmod>
        @endif
    </url>
    @endforeach

</urlset>
