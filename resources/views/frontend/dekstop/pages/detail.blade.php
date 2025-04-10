@extends('frontend.dekstop.master.master-app')

<style>
    .article-detail--body img {
        width: 100% !important;
        height: auto !important;
        border-radius: 8px !important;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1) !important;
    }

    .article-detail--body  iframe {
        width: 100% !important;
        height: 800px !important;
        margin: 10px 0 !important;
        border-radius: 8px !important;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1) !important;
    }

    .article-detail--body i {
        display: flex ;
        justify-content: center;
        padding: 10px;
        font-style: normal;
        font-weight: normal;
        font-size: 12px;
        line-height: 16px;
        color: var(--gray-color);
        background: #f2f2f2;
    }

</style>
@section('content')
        {{-- Ads --}}
        @include('frontend.dekstop.components.ads-1')

        <div class="mt-20">
            <h3 class="card-headline-no-image-title">{{ $post->kategori->nama_kategori }}</h3>
        </div>

        <div class="content-home" id="content">
            <div class="content-article">
                <article class="article-detail">
                    <h1 class="article-detail--title">{{ $post->title }}</h1>
                    @if ($post->description)
                        <div class="article-detail--desc">{{ $post->description }}</div>
                    @endif
                    <div class="article-detail--info">
                        <div class="author">
                            <strong>{{ $post->user->name }}</strong>
                        </div>
                        <div class="date">
                            {{ \Carbon\Carbon::parse($post->created_at)->translatedFormat('l, d F Y | H:i') }} WIB
                        </div>
                    </div>

                    <div class="share-baru-header">
                        <?php $url = urlencode(url()->current()); ?>

                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ $url }}" target="_blank">
                            <img src="{{ asset('frontend/icons/fb.svg') }}" alt="Facebook">
                        </a>

                        <!-- Twitter -->
                        <a href="https://twitter.com/intent/tweet?url={{ $url }}" target="_blank">
                            <img src="{{ asset('frontend/icons/twitter.svg') }}" alt="Twitter">
                        </a>

                        <!-- Telegram -->
                        <a href="https://t.me/share/url?url={{ $url }}" target="_blank">
                            <img src="{{ asset('frontend/icons/tele.svg') }}" alt="Telegram">
                        </a>

                        <!-- WhatsApp -->
                        <a href="https://api.whatsapp.com/send?text={{ $url }}" target="_blank">
                            <img src="{{ asset('frontend/icons/wa.svg') }}" alt="WhatsApp">
                        </a>

                        <!-- Copy Link -->
                        <a href="javascript:void(0);" onclick="copyToClipboard()">
                            <img src="{{ asset('frontend/icons/link.svg') }}" alt="Copy Link">
                        </a>
                    </div>

                    <figure class="article-detail-figure">
                        <img alt="image" width="660" height="497"
                            src="{{ is_array($post->gambar) ? $post->gambar[0] : $post->gambar }}"
                            class="card-headline-img" />
                    <figcaption>{{ $post->image_caption }}</figcaption>
                    </figure>
                    <div class="article-detail--body">
                        <p>{!! preg_replace_callback(
                            '/<img[^>]+alt="([^"]*)"[^>]*>/i',
                            function ($matches) {
                                return $matches[0] . '<i>' . htmlspecialchars($matches[1]) . '</i><br>';
                            },
                            preg_replace_callback(
                                '/(?:<caption\b[^>]*>|\\[caption[^\]]*\\])(.*?)(?:<\\/caption>|\\[\\/caption\\])/is', 
                                function ($matches) {
                                    preg_match_all('/<img[^>]+>/i', $matches[1], $images);
                                    return implode('', $images[0]); 
                                },
                                $post->content
                            )
                        ) !!}
                        </p>
                        
                    </div>
                    <div class="article-detail-tag">
                        <span class="label card-headline-no-image-title-detail2">Tag</span>
                        @foreach ($tagsdetail as $index => $tags)
                            <a href="{{ route('bytag', ['slug' => $tags->slug]) }}" class="tag-item">
                                {{ $tags->nama_tags }}</a>
                        @endforeach
                    </div>

                    <div class="share-baru-bottom">
                        <span>Share link :</span>
                        <?php $url = urlencode(url()->current()); ?>

                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ $url }}" target="_blank">
                            <img src="{{ asset('frontend/icons/fb.svg') }}" alt="Facebook">
                        </a>

                        <!-- Twitter -->
                        <a href="https://twitter.com/intent/tweet?url={{ $url }}" target="_blank">
                            <img src="{{ asset('frontend/icons/twitter.svg') }}" alt="Twitter">
                        </a>

                        <!-- Telegram -->
                        <a href="https://t.me/share/url?url={{ $url }}" target="_blank">
                            <img src="{{ asset('frontend/icons/tele.svg') }}" alt="Telegram">
                        </a>

                        <!-- WhatsApp -->
                        <a href="https://api.whatsapp.com/send?text={{ $url }}" target="_blank">
                            <img src="{{ asset('frontend/icons/wa.svg') }}" alt="WhatsApp">
                        </a>

                        <!-- Copy Link -->
                        <a href="javascript:void(0);" onclick="copyToClipboard()">
                            <img src="{{ asset('frontend/icons/link.svg') }}" alt="Copy Link">
                        </a>
                    </div>

                </article>

                <div class="mt-30">
                    <h3 class="card-headline-no-image-title">Terkini</h3>
                    <div class="list">
                        @foreach ($postTerkiniBottom as $item)
                            <div class="list-element">
                                <article class="main-card">
                                    <div class="main-card-img-wrap">
                                        <img alt="image" class="main-card-img" width="213" height="130"
                                            src="{{ is_array($item->gambar) ? $item->gambar[0] : $item->gambar }}" />
                                    </div>
                                    <div class="main-card--info">
                                        <h4 class="main-card--title">
                                            <a
                                                href="{{ route('detail.desktop', ['slug' => $item->slug]) }}">{{ $item->title }}</a>
                                        </h4>
                                        <p class="main-card--desc">{!! Str::limit(strip_tags($item->content), 100) !!}</p>
                                        <div class="category-and-time">
                                            <span>{{ \Carbon\Carbon::parse($item->created_at)->format('H:i') }} WIB</span>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        @endforeach
                    </div>
                    <div>
                        <button class="main-card-loadmore" id="loadmore">Tampilkan lebih banyak</button>
                    </div>
                </div>
            </div>
            @include('frontend.dekstop.components.sidebar')
        </div>
    <script>
        function copyToClipboard() {
        var tempInput = document.createElement("input");
        tempInput.value = window.location.href;
        document.body.appendChild(tempInput);
        tempInput.select();
        document.execCommand("copy");
        document.body.removeChild(tempInput);
        alert("Link copied to clipboard!");
    }

    </script>
@endsection
