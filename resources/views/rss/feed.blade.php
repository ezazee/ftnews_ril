<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<rss 
    version="2.0"
    xmlns:dc="http://purl.org/dc/elements/1.1/" 
    xmlns:content="http://purl.org/rss/1.0/modules/content/" 
    xmlns:atom="http://www.w3.org/2005/Atom"
    xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
    xmlns:slash="http://purl.org/rss/1.0/modules/slash/"
    xmlns:media="http://search.yahoo.com/mrss/"
>

<channel>
    <title>Berita Terkini - FTNews</title>
    <description>Feed Artikel {{ url('/') }} | FTNews - Berita terkini hari ini, nasional, hukum, politik, daerah, metropolitan, lifestyle, kesehatan</description>
    <link>{{ url('/') }}</link>

    <image>
        <url>{{ url('public/favicon.ico') }}</url>
        <title>FTNews</title>
        <link>{{ url('/') }}</link>
    </image>

    <generator>{{ url('/') }}</generator>
    <lastBuildDate>{{ now()->toRfc2822String() }}</lastBuildDate>
    <atom:link href="{{ request()->fullUrl() }}" rel="self" type="application/rss+xml" />
    <language>id</language>
    <copyright>Copyright {{ now()->format('Y') }}, FTNews</copyright>

    @foreach($posts as $post)
        <item>
            <title><![CDATA[{{ $post->title }}]]></title>
            <link>{{ url($post->slug) }}</link>
            <description><![CDATA[
                {!! nl2br(e($post->two_paragraphs_text)) !!}
            ]]></description>
            <pubDate>{{ $post->created_at->toRfc2822String() }}</pubDate>
            <guid isPermaLink="true">{{ url($post->slug) }}</guid>

            @if (!empty($post->gambar))
                <media:thumbnail 
                    medium="image" 
                    type="image/jpg" 
                    url="{{ filter_var($post->gambar, FILTER_VALIDATE_URL) ? $post->gambar : url($post->gambar) }}" />
            @endif
        </item>
    @endforeach

</channel>
</rss>
