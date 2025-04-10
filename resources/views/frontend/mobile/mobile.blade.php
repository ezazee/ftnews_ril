@extends('frontend.mobile.master.master-app')

@section('content')
    <div>
        <div id="div-ad-top" data-ad-type="msite_top" class="ads ads--top_home">
            <script type="text/javascript">
                googletag.cmd.push(function() {
                    googletag.display('div-ad-top');
                });
            </script>
        </div>
        <!-- Headline -->
        <div>
            @if ($topPostheadline)
                @php
                    $images = explode('|', $topPostheadline->gambar);
                @endphp
                <article class="card-headline">
                    <a href="{{ route('detail.desktop', ['slug' => $topPostheadline->slug]) }}">
                        <img alt="image" class="card-headline-img" src="{{ isset($images[0]) ? $images[0] : '' }}" />
                    </a>
                    <div class="card-headline-info">
                        <div class="category-and-time">
                            <a
                                href="{{ route('kanal.desktop', ['slug' => $topPostheadline->slug]) }}">{{ $topPostheadline->kategori->nama_kategori }}</a>
                            <span>{{ \Carbon\Carbon::parse($topPostheadline->created_at)->format('Y-m-d') }}</span>
                        </div>
                        <h4 class="card-headline-title">
                            <a
                                href="{{ route('detail.desktop', ['slug' => $topPostheadline->slug]) }}">{{ $topPostheadline->title }}</a>
                        </h4>
                        <p class="card-headline-desc">{!! Str::limit(strip_tags($topPostheadline->content), 60) !!}</p>
                    </div>
                </article>
            @else
                <p>No post found.</p>
            @endif
            <div class="card-headline-small-wrap">
                @foreach ($otherPostsheadline->take(4) as $item)
                    <article class="card-headline-small">
                        <img alt="image" class="card-headline-small-img"
                            src="{{ is_array($item->gambar) ? $item->gambar[0] : $item->gambar }}" />
                        <div class="card-headline-small-info">
                            <h4 class="card-headline-small-title">
                                <a href="{{ route('detail.desktop', ['slug' => $item->slug]) }}">{{ $item->title }}</a>
                            </h4>
                            <!-- <span class="card-headline-small-category">Seleb</span> -->
                            <div class="category-and-time-head">
                                <span>{{ \Carbon\Carbon::parse($item->created_at)->format('Y-m-d') }}</span>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>

        <div>
            @foreach ($otherPostsheadline->slice(4, 5) as $item)
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
                            <a
                                href="{{ route('kanal.desktop', ['slug' => $item->slug]) }}">{{ $item->kategori->nama_kategori }}</a>
                            <span>{{ \Carbon\Carbon::parse($item->created_at)->format('Y-m-d') }}</span>
                        </div>
                    </div>
                </article>
            @endforeach

        </div>

        <!-- terpopuler -->
        <div class="mb-20 bg1">
            <h3 class="base-title pl-20 pt-20 fw-bold">Terpopuler</h3>
            <div class="list">
                @foreach ($postTerpopuler as $item)
                    <div class="list-element">
                        <article class="main-card">
                            <div class="main-card--infoml0">
                                <h4 class="main-card--title">
                                    <a
                                        href="{{ route('detail.desktop', ['slug' => $item->slug]) }}">{{ $item->title }}</a>
                                </h4>
                                <div class="category-and-time">
                                    <span>{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</span>
                                </div>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
        </div>
        <!-- end terpopuler -->

        @include('frontend.mobile.components.ads-3')

        <!-- dangdut -->
        <div class="mt-20">
            <h3 class="base-title pl-20 mb-10 fw-bold">Dangdut</h3>
            @if ($topPostDangdut)
                @php
                    $images = explode('|', $topPostDangdut->gambar);
                @endphp
                <article class="card-headline">
                    <img alt="image" class="card-headline-img" src="{{ isset($images[0]) ? $images[0] : '' }}" />
                    <div class="card-headline-info">
                        <h4 class="card-headline-title">
                            <a
                                href="{{ route('detail.desktop', ['slug' => $topPostDangdut->slug]) }}">{{ $topPostDangdut->title }}</a>
                        </h4>
                        <div class="category-and-time">
                            <p class="card-headline-desc">{!! Str::limit(strip_tags($topPostDangdut->content), 60) !!}</p>
                            <span>{{ \Carbon\Carbon::parse($topPostDangdut->created_at)->format('d-m-Y') }}</span>
                        </div>
                    </div>
                </article>
            @else
                <p>No post found.</p>
            @endif
            <div>
                @foreach ($otherPostsDangdut as $post)
                    <article class="main-card">
                        <div class="main-card-img-wrap">
                            <img alt="image" class="main-card-img"
                                src="{{ is_array($post->gambar) ? $post->gambar[0] : $post->gambar }}" />
                        </div>
                        <div class="main-card--info">
                            <h4 class="main-card--title">
                                <a href="{{ route('detail.desktop', ['slug' => $post->slug]) }}">{{ $post->title }}</a>
                            </h4>
                            <div class="category-and-time">
                                <span>{{ \Carbon\Carbon::parse($post->created_at)->format('d-m-Y') }}</span>
                            </div>
                        </div>
                    </article>
                @endforeach
                <div class="t10-b20 mb-20">
                    <a href="{{ route('kanal.desktop', ['slug' => 'dangdut']) }}">
                        <button class="main-card-loadmore">Selengkapnya</button>
                    </a>
                </div>
            </div>
        </div>
        <!-- end Dangdut -->

        <!-- Flexing -->
        <div class="mt-20">
            <h3 class="base-title pl-20 mb-10 fw-bold">Flexing</h3>
            @if ($topPostFlexing)
                @php
                    $images = explode('|', $topPostFlexing->gambar);
                @endphp
                <article class="card-headline">
                    <img alt="image" class="card-headline-img"
                        src="{{ is_array($topPostFlexing->gambar) ? $topPostFlexing->gambar[0] : $topPostFlexing->gambar }}" />
                    <div class="card-headline-info">
                        <h4 class="card-headline-title">
                            <a
                                href="{{ route('detail.desktop', ['slug' => $topPostFlexing->slug]) }}">{{ $topPostFlexing->title }}</a>
                        </h4>
                        <div class="category-and-time">
                            <p class="card-headline-desc">{!! Str::limit(strip_tags($topPostFlexing->content), 60) !!}</p>
                            <span>{{ \Carbon\Carbon::parse($topPostFlexing->created_at)->format('d-m-Y') }}</span>
                        </div>
                    </div>
                </article>
            @else
                <p>No post found.</p>
            @endif
            <div>
                @foreach ($otherPostsFlexing as $post)
                    <article class="main-card">
                        <div class="main-card--infomr10">
                            <h4 class="main-card--title">
                                <a href="{{ route('detail.desktop', ['slug' => $post->slug]) }}">{{ $post->title }}</a>
                            </h4>
                            <div class="category-and-time">
                                <span>{{ \Carbon\Carbon::parse($post->created_at)->format('Y-m-d') }}</span>
                            </div>
                        </div>
                        <div class="main-card-img-wrap">
                            <img alt="image" class="main-card-img"
                                src="{{ is_array($post->gambar) ? $post->gambar[0] : $post->gambar }}" />
                        </div>
                    </article>
                @endforeach
                <div class="t10-b20 mb-20">
                    <a href="{{ route('kanal.desktop', ['slug' => 'flexing']) }}">
                        <button class="main-card-loadmore" id="loadmore">Selengkapnya</button>
                    </a>
                </div>
            </div>
        </div>
        <!-- end Flexing -->

        @include('frontend.mobile.components.ads-4')

        <!-- Gosip -->
        <div class="mt-20">
            <h3 class="base-title pl-20 mb-10 fw-bold">Gosip</h3>
            @if ($topPostGosip)
                @php
                    $images = explode('|', $topPostGosip->gambar);
                @endphp
                <article class="card-headline">
                    <img alt="image" class="card-headline-img" src="{{ isset($images[0]) ? $images[0] : '' }}" />
                    <div class="card-headline-info">
                        <h4 class="card-headline-title">
                            <a
                                href="{{ route('detail.desktop', ['slug' => $topPostGosip->slug]) }}">{{ $topPostGosip->title }}</a>
                        </h4>
                        <div class="category-and-time">
                            <p class="card-headline-desc">{!! Str::limit(strip_tags($topPostGosip->content), 60) !!}</p>
                            <span>{{ \Carbon\Carbon::parse($topPostGosip->created_at)->format('d-m-Y') }}</span>
                        </div>
                    </div>
                </article>
            @else
                <p>No post found.</p>
            @endif
            <div>
                @foreach ($otherPostsGosip as $post)
                    <article class="main-card">
                        <div class="main-card-img-wrap">
                            <img alt="image" class="main-card-img"
                                src="{{ is_array($post->gambar) ? $post->gambar[0] : $post->gambar }}" />
                        </div>
                        <div class="main-card--info">
                            <h4 class="main-card--title">
                                <a href="{{ route('detail.desktop', ['slug' => $post->slug]) }}">{{ $post->title }}
                                </a>
                            </h4>
                            <div class="category-and-time">
                                <span>{{ \Carbon\Carbon::parse($post->created_at)->format('Y-m-d') }}</span>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
        <!-- end Gosip -->

        <!-- K-Pop -->
        <div class="mt-20">
            <h3 class="base-title pl-20 mb-10 fw-bold">K-Pop</h3>
            @if ($topPostKPop)
                @php
                    $images = explode('|', $topPostKPop->gambar);
                @endphp
                <article class="card-headline">
                    <img alt="image" class="card-headline-img" src="{{ isset($images[0]) ? $images[0] : '' }}" />
                    <div class="card-headline-info">
                        <h4 class="card-headline-title">
                            <a
                                href="{{ route('detail.desktop', ['slug' => $topPostKPop->slug]) }}">{{ $topPostKPop->title }}</a>
                        </h4>
                        <div class="category-and-time">
                            <p class="card-headline-desc">{!! Str::limit(strip_tags($topPostKPop->content), 60) !!}</p>
                            <span>{{ \Carbon\Carbon::parse($topPostKPop->created_at)->format('d-m-Y') }}</span>
                        </div>
                    </div>
                </article>
            @else
                <p>No post found.</p>
            @endif
            <div>
                @foreach ($otherPostsKPop as $post)
                    <article class="main-card">
                        <div class="main-card--infomr10">
                            <h4 class="main-card--title">
                                <a href="{{ route('detail.desktop', ['slug' => $post->slug]) }}">{{ $post->title }}</a>
                            </h4>
                            <div class="category-and-time">
                                <span>{{ \Carbon\Carbon::parse($item->created_at)->format('Y-m-d') }}</span>
                            </div>
                        </div>
                        <div class="main-card-img-wrap">
                            <img alt="image" class="main-card-img"
                                src="{{ is_array($post->gambar) ? $post->gambar[0] : $post->gambar }}" />
                        </div>
                    </article>
                @endforeach
                <div class="t10-b20 mb-20">
                    <a href="{{ route('kanal.desktop', ['slug' => 'k-pop']) }}">
                        <button class="main-card-loadmore" id="loadmore">Selengkapnya</button>
                    </a>
                </div>
            </div>
        </div>
        <!-- end K-Pop -->

        @include('frontend.mobile.components.ads-5')

        <!-- Vibes -->
        <div class="mt-20">
            <h3 class="base-title pl-20 mb-10 fw-bold">Vibes</h3>
            @if ($topPostVibes)
                @php
                    $images = explode('|', $topPostVibes->gambar);
                @endphp
                <article class="card-headline">
                    <img alt="image" class="card-headline-img" src="{{ isset($images[0]) ? $images[0] : '' }}" />
                    <div class="card-headline-info">
                        <h4 class="card-headline-title">
                            <a
                                href="{{ route('detail.desktop', ['slug' => $topPostVibes->slug]) }}">{{ $topPostVibes->title }}</a>
                        </h4>
                        <div class="category-and-time">
                            <p class="card-headline-desc">{!! Str::limit(strip_tags($topPostVibes->content), 60) !!}</p>
                            <span>{{ \Carbon\Carbon::parse($topPostVibes->created_at)->format('d-m-Y') }}</span>
                        </div>
                    </div>
                </article>
            @else
                <p>No post found.</p>
            @endif
            <div>
                @foreach ($otherPostsVibes as $post)
                    <article class="main-card">
                        <div class="main-card-img-wrap">
                            <img alt="image" class="main-card-img"
                                src="{{ is_array($post->gambar) ? $post->gambar[0] : $post->gambar }}" />
                        </div>
                        <div class="main-card--info">
                            <h4 class="main-card--title">
                                <a href="{{ route('detail.desktop', ['slug' => $post->slug]) }}">{{ $post->title }}</a>
                            </h4>
                            <div class="category-and-time">
                                <span>{{ \Carbon\Carbon::parse($post->created_at)->format('Y-m-d') }}</span>
                            </div>
                        </div>
                    </article>
                @endforeach
                <div class="t10-b20 mb-20">
                    <a href="{{ route('kanal.desktop', ['slug' => 'vibes']) }}">
                        <button class="main-card-loadmore" id="loadmore">Selengkapnya</button>
                    </a>
                </div>
            </div>
        </div>
        <!-- end Vibes -->

        <!-- Me And Moms -->
        <div class="mt-20">
            <h3 class="base-title pl-20 mb-10 fw-bold">Me And Moms</h3>
            @if ($topPostMeandmom)
                @php
                    $images = explode('|', $topPostMeandmom->gambar);
                @endphp
                <article class="card-headline">
                    <img alt="image" class="card-headline-img" src="{{ isset($images[0]) ? $images[0] : '' }}" />
                    <div class="card-headline-info">
                        <h4 class="card-headline-title">
                            <a
                                href="{{ route('detail.desktop', ['slug' => $topPostMeandmom->slug]) }}">{{ $topPostMeandmom->title }}</a>
                        </h4>
                        <div class="category-and-time">
                            <p class="card-headline-desc">{!! Str::limit(strip_tags($topPostMeandmom->content), 60) !!}</p>
                            <span>{{ \Carbon\Carbon::parse($topPostMeandmom->created_at)->format('d-m-Y') }}</span>
                        </div>
                    </div>
                </article>
            @else
                <p>No post found.</p>
            @endif
            <div>
                @foreach ($otherPostsMeandmom as $post)
                    <article class="main-card">
                        <div class="main-card--infomr10">
                            <h4 class="main-card--title">
                                <a href="{{ route('detail.desktop', ['slug' => $post->slug]) }}">{{ $post->title }}</a>
                            </h4>
                            <div class="category-and-time">
                                <span>{{ \Carbon\Carbon::parse($post->created_at)->format('Y-m-d') }}</span>
                            </div>
                        </div>
                        <div class="main-card-img-wrap">
                            <img alt="image" class="main-card-img"
                                src="{{ is_array($post->gambar) ? $post->gambar[0] : $post->gambar }}" />
                        </div>
                    </article>
                @endforeach
                <div class="t10-b20 mb-20">
                    <a href="{{ route('kanal.desktop', ['slug' => 'me-and-moms']) }}">
                        <button class="main-card-loadmore" id="loadmore">Tampilkan lebih banyak</button>
                    </a>
                </div>
            </div>
        </div>
        <!-- end Me And Moms -->

        @include('frontend.mobile.components.ads-6')

        <!-- start terkini -->
        <div class="mt-20">
            <h3 class="base-title pl-20 fw-bold">Terkini</h3>
            <div>

                <div class="list">
                    @foreach ($postTerkini as $post)
                        <div class="list-element">
                            <article class="main-card">
                                <div class="main-card-img-wrap">
                                    <img alt="image" class="main-card-img"
                                        src="{{ is_array($post->gambar) ? $post->gambar[0] : $post->gambar }}" />
                                </div>
                                <div class="main-card--info">
                                    <h4 class="main-card--title">
                                        <a
                                            href="{{ route('detail.desktop', ['slug' => $post->slug]) }}">{{ $post->title }}</a>
                                    </h4>
                                    <div class="category-and-time">
                                        <a
                                            href="{{ route('kanal.desktop', ['slug' => $item->slug]) }}">{{ $post->kategori->nama_kategori }}</a>
                                        <span>{{ \Carbon\Carbon::parse($post->created_at)->format('Y-m-d') }}</span>
                                    </div>
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>
                <div class="t10-b20 mb-20">
                    <a href="">
                        <button class="main-card-loadmore" id="loadmore">Tampilkan lebih banyak</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
