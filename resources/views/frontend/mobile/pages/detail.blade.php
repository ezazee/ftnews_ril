@extends('frontend.mobile.master.master-app')

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
    <div class="kanal-wrap">
        <h3 class="base-title-desc">{{ $post->kategori->nama_kategori }}</h3>
        <div class="date">{{ \Carbon\Carbon::parse($post->created_at)->translatedFormat('l, d F Y | H:i') }} WIB </div>
    </div>
    <article class="article-detail">
        <div class="t5-b20">
            <h1 class="article-detail--title">{{ $post->title }}</h1>
            @if ($post->description)
                <div class="article-detail--desc">{{ $post->description }}</div>
            @endif
            <div class="article-detail--info">
                <div class="author"> {{ $post->user->name }} </div>
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
            <img alt="image" src="{{ is_array($post->gambar) ? $post->gambar[0] : $post->gambar }}"
                class="card-headline-img" />
            <figcaption>{{ $post->image_caption }}</figcaption>
        </figure>
        <a href="#!" rel="">
            <div class="banner-ads--big">
                @include('frontend.mobile.components.ads-7')
            </div>
        </a>
        <div class="t0-b20">
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
                <span class="label card-headline-no-image-title">Tag</span>
                @foreach ($tagsdetail as $index => $tags)
                    <a href="{{ route('bytag', ['slug' => $tags->slug]) }}" class="tag-item"> {{ $tags->nama_tags }}</a>
                @endforeach
            </div>
            <div class="share-baru-bottom mb-20">
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
        </div>
    </article>
    <a href="#!" rel="">
        <div class="banner-ads--big">
            @include('frontend.mobile.components.ads-3')
        </div>
    </a>
    <!-- terpopuler -->
    <div class="mt-20 bg1">
        <h3 class="base-title pl-20 pt-20">Terpopuler</h3>
        <div class="list">
            @foreach ($postTerpopuler as $item)
                <div class="list-element">
                    <article class="main-card">
                        <div class="main-card--infoml0">
                            <h4 class="main-card--title">
                                <a href="{{ route('detail.desktop', ['slug' => $item->slug]) }}">{{ $item->title }}</a>
                            </h4>
                            <div class="category-and-time">
                                <span>{{ \Carbon\Carbon::parse($item->created_at)->format('H:i') }} WIB</span>
                            </div>
                        </div>
                    </article>
                </div>
            @endforeach
        </div>
    </div>
    <!-- end terpopuler -->
    <!-- dangdut -->
    <div class="mt-20">
        <h3 class="base-title pl-20 mb-10">{{ $post->kategori->nama_kategori }}</h3>
        @foreach ($relatedPosts->take(1) as $item)
            <article class="card-headline">
                <img alt="image" class="card-headline-img"
                    src="{{ is_array($item->gambar) ? $item->gambar[0] : $item->gambar }}" />
                <div class="card-headline-info">
                    <h4 class="card-headline-title">
                        <a href="{{ route('detail.desktop', ['slug' => $item->slug]) }}">{{ $item->title }}</a>
                    </h4>
                    <p class="card-headline-desc">{!! Str::limit(strip_tags($item->content), 100) !!}</p>
                </div>
            </article>
        @endforeach
        <div>
            @foreach ($relatedPosts->slice(1, 5) as $item)
                <article class="main-card">
                    <div class="main-card-img-wrap">
                        <img alt="image" class="main-card-img"
                            src="{{ is_array($item->gambar) ? $item->gambar[0] : $item->gambar }}" />
                    </div>
                    <div class="main-card--info">
                        <h4 class="main-card--title">
                            <a href="{{ route('detail.desktop', ['slug' => $item->slug]) }}">{{ $item->title }}</a>
                        </h4>
                        <div class="category-and-time">
                            <span>{{ \Carbon\Carbon::parse($item->created_at)->format('H:i') }} WIB</span>
                        </div>
                    </div>
                </article>
            @endforeach
            <div class="t10-b20 mb-20">
                <button class="main-card-loadmore" id="loadmore">Tampilkan lebih banyak</button>
            </div>
        </div>
    </div>
    <!-- end Dangdut -->
    <!-- start terkini -->
    <div class="mt-20">
        <h3 class="base-title pl-20">Terkini</h3>
        <div>
            <div class="list">
                @foreach ($postTerkini as $item)
                    <div class="list-element">
                        <article class="main-card">
                            <div class="main-card-img-wrap">
                                <img alt="image" class="main-card-img"
                                    src="{{ is_array($item->gambar) ? $item->gambar[0] : $item->gambar }}" />
                            </div>
                            <div class="main-card--info">
                                <h4 class="main-card--title">
                                    <a
                                        href="{{ route('detail.desktop', ['slug' => $item->slug]) }}">{{ $item->title }}</a>
                                </h4>
                                <div class="category-and-time">
                                    <a href="{{ route('detail.desktop', ['slug' => $item->slug]) }}">{{ $item->kategori->nama_kategori }}</a>
                                    <span>{{ \Carbon\Carbon::parse($item->created_at)->format('H:i') }} WIB</span>
                                </div>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
            <div class="t10-b20 mb-20">
                <button class="main-card-loadmore" id="loadmore">Tampilkan lebih banyak</button>
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
