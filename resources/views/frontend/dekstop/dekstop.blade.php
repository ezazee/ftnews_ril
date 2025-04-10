@extends('frontend.dekstop.master.master-app')

@section('content')
    @include('frontend.dekstop.components.ads-1')
    <div class="content-home" id="content">
        <div class="content-article">
            <div>
                @if ($topPostheadline)
                    @php
                        $images = explode('|', $topPostheadline->gambar);
                    @endphp
                    <article class="card-one-headline">
                        <a href="{{ route('detail.desktop', ['slug' => $topPostheadline->slug]) }}">
                            <img alt="image" class="card-one-headline-img" width="310" height="230"
                                src="{{ isset($images[0]) ? $images[0] : '' }}" />
                        </a>
                        <div class="card-one-headline--info">
                            <div class="category-and-time">
                                <span> <a href="{{ route('detail.desktop', ['slug' => $topPostheadline->slug]) }}">{{ $topPostheadline->kategori->nama_kategori }}</a> | {{ \Carbon\Carbon::parse($topPostheadline->created_at)->format('Y-m-d') }}</span>
                            </div>
                            <h2 class="card-one-headline--title">
                                <a
                                    href="{{ route('detail.desktop', ['slug' => $topPostheadline->slug]) }}">{{ $topPostheadline->title }}</a>
                            </h2>
                            <div class="category-and-time">
                                <div class="card-one-headline--desc">{!! Str::limit(strip_tags($topPostheadline->content), 150) !!}</div>
                            </div>
                        </div>
                    </article>
                @else
                    <p>No post found.</p>
                @endif
                <div class="card-two-wrap">
                    @foreach ($otherPostsheadline->take(4) as $item)
                        <article class="card-two-headline">
                            <div class="card-two-headline-img-wrap">
                                <img alt="image" class="card-two-headline-img" width="100" height="74"
                                    src="{{ is_array($item->gambar) ? $item->gambar[0] : $item->gambar }}" />
                            </div>
                            <div class="card-two-headline--info">
                                <h4 class="card-two-headline--title">
                                    <a href="{{ route('detail.desktop', ['slug' => $item->slug]) }}">{{ $item->title }}</a>
                                </h4>
                                <div class="category-and-time">
                                    <span>{{ \Carbon\Carbon::parse($item->created_at)->format('Y-m-d') }}</span>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
            <div class="list mt-10">
                @foreach ($otherPostsheadline->slice(4, 10) as $item)
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
                                <p class="main-card--desc">{!! Str::limit(strip_tags($item->content), 150) !!} </p>
                                <div class="category-and-time">
                                    <a href="">{{ $item->kategori->nama_kategori }}</a>
                                    <span>{{ \Carbon\Carbon::parse($item->created_at)->format('Y-m-d') }}</span>
                                </div>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
            <div>
                <button class="main-card-loadmore" id="loadmore">Tampilkan lebih banyak</button>
            </div>
            <div class="mt-20">
                <h3 class="card-headline-no-image-title fw-bold">Dangdut</h3>
                @if ($topPostDangdut)
                    @php
                        $images = explode('|', $topPostDangdut->gambar);
                    @endphp
                    <article class="card-one-headline">
                        <img alt="image" class="card-one-headline-img" width="310" height="230"
                            src="{{ isset($images[0]) ? $images[0] : '' }}" />
                        <div class="card-one-headline--info">
                            <h2 class="card-one-headline--title">
                                <a
                                    href="{{ route('detail.desktop', ['slug' => $topPostDangdut->slug]) }}">{{ $topPostDangdut->title }}</a>
                            </h2>
                            <div class="category-and-time">
                                <div class="card-one-headline--desc">{!! Str::limit(strip_tags($topPostDangdut->content), 150) !!}</div>
                                <span>{{ \Carbon\Carbon::parse($topPostDangdut->created_at)->format('Y-m-d') }}</span>
                            </div>
                        </div>
                    </article>
                @else
                    <p>No post found.</p>
                @endif

                <div class="card-two-wrap">
                    @foreach ($otherPostsDangdut as $post)
                        <article class="card-two-headline">
                            <div class="card-two-headline-img-wrap">
                                <img alt="image" class="card-two-headline-img" width="100" height="74"
                                    src="{{ is_array($post->gambar) ? $post->gambar[0] : $post->gambar }}" />
                            </div>
                            <div class="card-two-headline--info">
                                <h4 class="card-two-headline--title">
                                    <a
                                        href="{{ route('detail.desktop', ['slug' => $post->slug]) }}">{{ $post->title }}</a>
                                </h4>
                                <div class="category-and-time">
                                    <span>{{ \Carbon\Carbon::parse($post->created_at)->format('Y-m-d') }}</span>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
            <div class="mt-20">
                <h3 class="card-headline-no-image-title fw-bold">Flexing</h3>
                @if ($topPostFlexing)
                    @php
                        $images = explode('|', $topPostFlexing->gambar);
                    @endphp
                    <article class="card-kanal-headline">
                        <img alt="image" class="card-kanal-headline-img" width="310" height="230"
                            src="{{ isset($images[0]) ? $images[0] : '' }}" />
                        <div class="card-kanal-headline--info">
                            <h2 class="card-kanal-headline--title">
                                <a
                                    href="{{ route('detail.desktop', ['slug' => $topPostFlexing->slug]) }}">{{ $topPostFlexing->title }}</a>
                            </h2>
                            <div class="category-and-time">
                                <div class="card-one-headline--desc">{!! Str::limit(strip_tags($topPostFlexing->content), 150) !!}</div>
                                <span>{{ \Carbon\Carbon::parse($topPostFlexing->created_at)->format('Y-m-d') }}</span>
                            </div>
                        </div>
                    </article>
                @else
                    <p>No post found.</p>
                @endif
                <div class="card-two-wrap">
                    @foreach ($otherPostsFlexing as $post)
                        <article class="card-two-headline">
                            <div class="card-two-headline-img-wrap">
                                <img alt="image" class="card-two-headline-img" width="100" height="74"
                                    src="{{ is_array($post->gambar) ? $post->gambar[0] : $post->gambar }}" />
                            </div>
                            <div class="card-two-headline--info">
                                <h4 class="card-two-headline--title">
                                    <a
                                        href="{{ route('detail.desktop', ['slug' => $post->slug]) }}">{{ $post->title }}</a>
                                </h4>
                                <div class="category-and-time">
                                    <span>{{ \Carbon\Carbon::parse($post->created_at)->format('Y-m-d') }}</span>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
            <div class="mt-20">
                <h3 class="card-headline-no-image-title fw-bold">Gosip</h3>
                @if ($topPostGosip)
                    @php
                        $images = explode('|', $topPostGosip->gambar);
                    @endphp
                    <article class="card-one-headline">
                        <img alt="image" class="card-one-headline-img" width="310" height="230"
                            src="{{ isset($images[0]) ? $images[0] : '' }}" />
                        <div class="card-one-headline--info">
                            <h2 class="card-one-headline--title">
                                <a
                                    href="{{ route('detail.desktop', ['slug' => $topPostGosip->slug]) }}">{{ $topPostGosip->title }}</a>
                            </h2>
                            <div class="category-and-time">
                                <div class="card-one-headline--desc">{!! Str::limit(strip_tags($topPostGosip->content), 150) !!}</div>
                                <span>{{ \Carbon\Carbon::parse($topPostGosip->created_at)->format('Y-m-d') }}</span>
                            </div>
                        </div>
                    </article>
                @else
                    <p>No post found.</p>
                @endif
                <div class="card-two-wrap">
                    @foreach ($otherPostsGosip as $post)
                        <article class="card-two-headline">
                            <div class="card-two-headline-img-wrap">
                                <img alt="image" class="card-two-headline-img" width="100" height="74"
                                    src="{{ is_array($post->gambar) ? $post->gambar[0] : $post->gambar }}" />
                            </div>
                            <div class="card-two-headline--info">
                                <h4 class="card-two-headline--title">
                                    <a
                                        href="{{ route('detail.desktop', ['slug' => $post->slug]) }}">{{ $post->title }}</a>
                                </h4>
                                <div class="category-and-time">
                                    <span>{{ \Carbon\Carbon::parse($post->created_at)->format('Y-m-d') }}</span>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>

            <div class="mt-20">
                <h3 class="card-headline-no-image-title fw-bold">K-Pop</h3>
                @if ($topPostKPop)
                    @php
                        $images = explode('|', $topPostKPop->gambar);
                    @endphp
                    <article class="card-kanal-headline">
                        <img alt="image" class="card-kanal-headline-img" width="310" height="230"
                            src="{{ isset($images[0]) ? $images[0] : '' }}" />
                        <div class="card-kanal-headline--info">
                            <h2 class="card-kanal-headline--title">
                                <a
                                    href="{{ route('detail.desktop', ['slug' => $topPostKPop->slug]) }}">{{ $topPostKPop->title }}</a>
                            </h2>
                            <div class="category-and-time">
                                <div class="card-one-headline--desc">{!! Str::limit(strip_tags($topPostKPop->content), 150) !!}</div>
                                <span>{{ \Carbon\Carbon::parse($topPostKPop->created_at)->format('Y-m-d') }}</span>
                            </div>
                        </div>
                    </article>
                @else
                    <p>No post found.</p>
                @endif
                <div class="card-two-wrap">
                    @foreach ($otherPostsKPop as $post)
                        <article class="card-two-headline">
                            <div class="card-two-headline-img-wrap">
                                <img alt="image" class="card-two-headline-img" width="100" height="74"
                                    src="{{ is_array($post->gambar) ? $post->gambar[0] : $post->gambar }}" />
                            </div>
                            <div class="card-two-headline--info">
                                <h4 class="card-two-headline--title">
                                    <a
                                        href="{{ route('detail.desktop', ['slug' => $post->slug]) }}">{{ $post->title }}</a>
                                </h4>
                                <div class="category-and-time">
                                    <span>{{ \Carbon\Carbon::parse($post->created_at)->format('Y-m-d') }}</span>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>

            <div class="mt-20">
                <h3 class="card-headline-no-image-title fw-bold">Vibes</h3>
                @if ($topPostVibes)
                    @php
                        $images = explode('|', $topPostVibes->gambar);
                    @endphp
                    <article class="card-one-headline">
                        <img alt="image" class="card-one-headline-img" width="310" height="230"
                            src="{{ isset($images[0]) ? $images[0] : '' }}" />
                        <div class="card-one-headline--info">
                            <h2 class="card-one-headline--title">
                                <a
                                    href="{{ route('detail.desktop', ['slug' => $topPostVibes->slug]) }}">{{ $topPostVibes->title }}</a>
                            </h2>
                            <div class="category-and-time">
                                <div class="card-one-headline--desc">{!! Str::limit(strip_tags($topPostVibes->content), 150) !!}</div>
                                <span>{{ \Carbon\Carbon::parse($topPostVibes->created_at)->format('Y-m-d') }}</span>
                            </div>
                        </div>
                    </article>
                @else
                    <p>No post found.</p>
                @endif
                <div class="card-two-wrap">
                    @foreach ($otherPostsVibes as $post)
                        <article class="card-two-headline">
                            <div class="card-two-headline-img-wrap">
                                <img alt="image" class="card-two-headline-img" width="100" height="74"
                                    src="{{ is_array($post->gambar) ? $post->gambar[0] : $post->gambar }}" />
                            </div>
                            <div class="card-two-headline--info">
                                <h4 class="card-two-headline--title">
                                    <a
                                        href="{{ route('detail.desktop', ['slug' => $post->slug]) }}">{{ $post->title }}</a>
                                </h4>
                                <div class="category-and-time">
                                    <span>{{ \Carbon\Carbon::parse($post->created_at)->format('Y-m-d') }}</span>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>

            <div class="mt-20">
                <h3 class="card-headline-no-image-title fw-bold">Me And Moms</h3>
                @if ($topPostMeandmom)
                    @php
                        $images = explode('|', $topPostMeandmom->gambar);
                    @endphp
                    <article class="card-kanal-headline">
                        <img alt="image" class="card-kanal-headline-img" width="310" height="230"
                            src="{{ isset($images[0]) ? $images[0] : '' }}" />
                        <div class="card-kanal-headline--info">
                            <h2 class="card-kanal-headline--title">
                                <a
                                    href="{{ route('detail.desktop', ['slug' => $topPostMeandmom->slug]) }}">{{ $topPostMeandmom->title }}</a>
                            </h2>
                            <div class="category-and-time">
                                <div class="card-one-headline--desc">{!! Str::limit(strip_tags($topPostMeandmom->content), 150) !!}</div>
                                <span>{{ \Carbon\Carbon::parse($topPostMeandmom->created_at)->format('Y-m-d') }}</span>
                            </div>
                        </div>
                    </article>
                @else
                    <p>No post found.</p>
                @endif
                <div class="card-two-wrap">
                    @foreach ($otherPostsMeandmom as $post)
                        <article class="card-two-headline">
                            <div class="card-two-headline-img-wrap">
                                <img alt="image" class="card-two-headline-img" width="100" height="74"
                                    src="{{ is_array($post->gambar) ? $post->gambar[0] : $post->gambar }}" />
                            </div>
                            <div class="card-two-headline--info">
                                <h4 class="card-two-headline--title">
                                    <a
                                        href="{{ route('detail.desktop', ['slug' => $post->slug]) }}">{{ $post->title }}</a>
                                </h4>
                                <div class="category-and-time">
                                    <span>{{ \Carbon\Carbon::parse($post->created_at)->format('Y-m-d') }}</span>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
            <div class="mt-20">
                <h3 class="card-headline-no-image-title fw-bold">Terkini</h3>
                <div class="list">
                    @foreach ($postTerkini as $post)
                        <div class="list-element">
                            <article class="main-card">
                                <div class="main-card-img-wrap">
                                    <img alt="image" class="main-card-img" width="350" height="261"
                                        src="{{ is_array($post->gambar) ? $post->gambar[0] : $post->gambar }}" />
                                </div>
                                <div class="main-card--info">
                                    <h4 class="main-card--title">
                                        <a
                                            href="{{ route('detail.desktop', ['slug' => $post->slug]) }}">{{ $post->title }}</a>
                                    </h4>
                                    <p class="main-card--desc">{!! Str::limit(strip_tags($post->content), 100) !!}</p>
                                    <div class="category-and-time">
                                        <a href="/detail">{{ $post->kategori->nama_kategori }}</a>
                                        <span>{{ \Carbon\Carbon::parse($post->created_at)->format('Y-m-d') }}</span>
                                    </div>
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        @include('frontend.dekstop.components.sidebar')
    </div>
@endsection
