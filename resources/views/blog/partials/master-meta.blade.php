<meta charset="utf-8">
    <title>
        {{ request()->is('/') ? 'Akurat Menyajikan Informasi, Berita Terkini, Kabar Terbaru Indonesia dan Internasional' : ($post->title ?? 'Akurat Menyajikan Informasi, Berita Terkini, Kabar Terbaru Indonesia dan Internasional') }}
    </title>
    <meta name="description" content="
        {{ request()->is('/') ? 'FTNews - Berita terkini hari ini, nasional, hukum, politik, daerah, metropolitan, lifestyle, kesehatan' : ($post->description ?? 'FTNews - Berita terkini hari ini, nasional, hukum, politik, daerah, metropolitan, lifestyle, kesehatan') }}
    ">
    <meta name="keywords" content="
        {{ request()->is('/') ? 'news, updates, FTnews' : ($post->keyword ?? 'news, updates, FTnews') }}
    ">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="
        {{ request()->is('/') ? 'FTnews' : ($post->title ?? 'FTnews') }}
    ">
    <meta property="og:description" content="
        {{ request()->is('/') ? 'FTNews - Berita terkini hari ini, nasional, hukum, politik, daerah, metropolitan, lifestyle, kesehatan' : ($post->description ?? 'FTNews - Berita terkini hari ini, nasional, hukum, politik, daerah, metropolitan, lifestyle, kesehatan') }}
    ">
    <meta property="og:image" content="
        {{
            !empty($post->gambar)
                ? (is_array($post->gambar)
                    ? (isset($post->gambar[0]) ? asset('storage/' . $post->gambar[0]) : asset('images/icon-ftnews.png'))
                    : asset('storage/' . $post->gambar))
                : asset('images/icon-ftnews.png')
        }}
    ">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="FTnews">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="
        {{ request()->is('/') ? 'FTnews' : ($post->title ?? 'FTnews') }}
    ">
    <meta name="twitter:description" content="
        {{ request()->is('/') ? 'FTNews - Berita terkini hari ini, nasional, hukum, politik, daerah, metropolitan, lifestyle, kesehatan' : ($post->description ?? 'FTNews - Berita terkini hari ini, nasional, hukum, politik, daerah, metropolitan, lifestyle, kesehatan') }}
    ">
    <meta name="twitter:image" content="
               {{
            !empty($post->gambar)
                ? (is_array($post->gambar)
                    ? (isset($post->gambar[0]) ? asset('storage/' . $post->gambar[0]) : asset('images/icon-ftnews.png'))
                    : asset('storage/' . $post->gambar))
                : asset('images/icon-ftnews.png')
        }}
    ">

    <!-- Favicon -->
    <link rel="apple-touch-icon" href="{{ asset('/images/icon-ftnews.png') }}">
    <link rel="shortcut icon" href="{{ asset('/images/icon-ftnews.png') }}">

    <meta name="theme-color" content="#030303">
