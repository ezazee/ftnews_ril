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
                        src="{{ isset($images[0]) ? asset('storage/comp/' . basename($images[0])) : '' }}" />
                </a>
                <div class="card-one-headline--info">
                    <div class="category-and-time">
                        <span>
                            @if ($topPostheadline->subCategory)
                            <a href="{{ route('kanal.desktop', ['slug' => $topPostheadline->slug]) }}">
                                {{ $topPostheadline->kategori->nama_kategori }}
                            </a>| 
                            <a href="{{ route('subcateg.desktop', ['categ' => $topPostheadline->kategori->slug, 'subcateg' => $topPostheadline->subCategory->slug]) }}">
                                {{ $topPostheadline->subCategory->nama_sub_kategori }}
                            </a>
                            @else
                            <a href="{{ route('kanal.desktop', ['slug' => $topPostheadline->slug]) }}">
                                {{ $topPostheadline->kategori->nama_kategori }}
                            </a>
                            @endif
                            | {{ \Carbon\Carbon::parse($topPostheadline->created_at)->format('Y-m-d') }}
                        </span>
                    </div>
                    <h2 class="card-one-headline--title">
                        <a
                            href="{{ route('detail.desktop', ['slug' => $topPostheadline->slug]) }}">{{ $topPostheadline->title }}</a>
                    </h2>
                    <div class="category-and-time">
                        <div class="card-one-headline--desc">{!! Str::limit(strip_tags($topPostheadline->content), 150)
                            !!}</div>
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
                            src="{{ asset('storage/comp/' . (is_array($item->gambar) ? basename($item->gambar[0]) : basename($item->gambar))) }}" />
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
                            src="{{ asset('storage/comp/' . (is_array($item->gambar) ? basename($item->gambar[0]) : basename($item->gambar))) }}" />
                    </div>
                    <div class="main-card--info">
                        <h4 class="main-card--title">
                            <a href="{{ route('detail.desktop', ['slug' => $item->slug]) }}">{{ $item->title }}</a>
                        </h4>
                        <p class="main-card--desc">{!! Str::limit(strip_tags($item->content), 150) !!} </p>
                        <div class="category-and-time">
                            <a href="">
                                <span>
                                    @if ($item->subCategory)
                                    <a href="{{ route('kanal.desktop', ['slug' => $item->slug]) }}">
                                        {{ $item->kategori->nama_kategori }}
                                    </a>| 
                                    <a href="{{ route('subcateg.desktop', ['categ' => $item->kategori->slug, 'subcateg' => $item->subCategory->slug]) }}">
                                        {{ $item->subCategory->nama_sub_kategori }}
                                    </a>
                                    @else
                                    <a href="{{ route('kanal.desktop', ['slug' => $item->slug]) }}">
                                        {{ $item->kategori->nama_kategori }}
                                    </a>
                                    @endif
                                    | {{ \Carbon\Carbon::parse($item->created_at)->format('Y-m-d') }}
                                </span>
                            </a>
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
            <h3 class="card-headline-no-image-title fw-bold">Nasional</h3>
            @if ($topPostNasional)
            @php
            $images = explode('|', $topPostNasional->gambar);
            @endphp
            <article class="card-one-headline">
                <img alt="image" class="card-one-headline-img" width="310" height="230"
                    src="{{ isset($images[0]) ? asset('storage/comp/' . basename($images[0])) : '' }}" />
                <div class="card-one-headline--info">
                    <h2 class="card-one-headline--title">
                        <a
                            href="{{ route('detail.desktop', ['slug' => $topPostNasional->slug]) }}">{{ $topPostNasional->title }}</a>
                    </h2>
                    <div class="category-and-time">
                        <div class="card-one-headline--desc">{!! Str::limit(strip_tags($topPostNasional->content), 150)
                            !!}</div>
                        <span>{{ \Carbon\Carbon::parse($topPostNasional->created_at)->format('Y-m-d') }}</span>
                    </div>
                </div>
            </article>
            @else
            <p>No post found.</p>
            @endif

            <div class="card-two-wrap">
                @foreach ($otherPostsNasional as $post)
                <article class="card-two-headline">
                    <div class="card-two-headline-img-wrap">
                        <img alt="image" class="card-two-headline-img" width="100" height="74"
                            src="{{ asset('storage/comp/' . (is_array($post->gambar) ? basename($post->gambar[0]) : basename($post->gambar))) }}" />
                    </div>
                    <div class="card-two-headline--info">
                        <h4 class="card-two-headline--title">
                            <a href="{{ route('detail.desktop', ['slug' => $post->slug]) }}">{{ $post->title }}</a>
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
            <h3 class="card-headline-no-image-title fw-bold">Daerah</h3>
            @if ($topPostDaerah)
            @php
            $images = explode('|', $topPostDaerah->gambar);
            @endphp
            <article class="card-kanal-headline">
                <img alt="image" class="card-kanal-headline-img" width="310" height="230"
                    src="{{ isset($images[0]) ? asset('storage/comp/' . basename($images[0])) : '' }}" />
                <div class="card-kanal-headline--info">
                    <h2 class="card-kanal-headline--title">
                        <a
                            href="{{ route('detail.desktop', ['slug' => $topPostDaerah->slug]) }}">{{ $topPostDaerah->title }}</a>
                    </h2>
                    <div class="category-and-time">
                        <div class="card-one-headline--desc">{!! Str::limit(strip_tags($topPostDaerah->content), 150)
                            !!}</div>
                        <span>{{ \Carbon\Carbon::parse($topPostDaerah->created_at)->format('Y-m-d') }}</span>
                    </div>
                </div>
            </article>
            @else
            <p>No post found.</p>
            @endif
            <div class="card-two-wrap">
                @foreach ($otherPostsDaerah as $post)
                <article class="card-two-headline">
                    <div class="card-two-headline-img-wrap">
                        <img alt="image" class="card-two-headline-img" width="100" height="74"
                            src="{{ asset('storage/comp/' . (is_array($post->gambar) ? basename($post->gambar[0]) : basename($post->gambar))) }}" />
                    </div>
                    <div class="card-two-headline--info">
                        <h4 class="card-two-headline--title">
                            <a href="{{ route('detail.desktop', ['slug' => $post->slug]) }}">{{ $post->title }}</a>
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
            <h3 class="card-headline-no-image-title fw-bold">Lifestyle</h3>
            @if ($topPostLifestyle)
            @php
            $images = explode('|', $topPostLifestyle->gambar);
            @endphp
            <article class="card-one-headline">
                <img alt="image" class="card-one-headline-img" width="310" height="230"
                    src="{{ isset($images[0]) ? asset('storage/comp/' . basename($images[0])) : '' }}" />
                <div class="card-one-headline--info">
                    <h2 class="card-one-headline--title">
                        <a
                            href="{{ route('detail.desktop', ['slug' => $topPostLifestyle->slug]) }}">{{ $topPostLifestyle->title }}</a>
                    </h2>
                    <div class="category-and-time">
                        <div class="card-one-headline--desc">{!! Str::limit(strip_tags($topPostLifestyle->content), 150)
                            !!}</div>
                        <span>{{ \Carbon\Carbon::parse($topPostLifestyle->created_at)->format('Y-m-d') }}</span>
                    </div>
                </div>
            </article>
            @else
            <p>No post found.</p>
            @endif
            <div class="card-two-wrap">
                @foreach ($otherPostsLifestyle as $post)
                <article class="card-two-headline">
                    <div class="card-two-headline-img-wrap">
                        <img alt="image" class="card-two-headline-img" width="100" height="74"
                            src="{{ asset('storage/comp/' . (is_array($post->gambar) ? basename($post->gambar[0]) : basename($post->gambar))) }}" />
                    </div>
                    <div class="card-two-headline--info">
                        <h4 class="card-two-headline--title">
                            <a href="{{ route('detail.desktop', ['slug' => $post->slug]) }}">{{ $post->title }}</a>
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
            <h3 class="card-headline-no-image-title fw-bold">Teknologi</h3>
            @if ($topPostTeknologi)
            @php
            $images = explode('|', $topPostTeknologi->gambar);
            @endphp
            <article class="card-kanal-headline">
                <img alt="image" class="card-kanal-headline-img" width="310" height="230"
                    src="{{ isset($images[0]) ? asset('storage/comp/' . basename($images[0])) : '' }}" />
                <div class="card-kanal-headline--info">
                    <h2 class="card-kanal-headline--title">
                        <a
                            href="{{ route('detail.desktop', ['slug' => $topPostTeknologi->slug]) }}">{{ $topPostTeknologi->title }}</a>
                    </h2>
                    <div class="category-and-time">
                        <div class="card-one-headline--desc">{!! Str::limit(strip_tags($topPostTeknologi->content), 150)
                            !!}</div>
                        <span>{{ \Carbon\Carbon::parse($topPostTeknologi->created_at)->format('Y-m-d') }}</span>
                    </div>
                </div>
            </article>
            @else
            <p>No post found.</p>
            @endif
            <div class="card-two-wrap">
                @foreach ($otherPostsTeknologi as $post)
                <article class="card-two-headline">
                    <div class="card-two-headline-img-wrap">
                        <img alt="image" class="card-two-headline-img" width="100" height="74"
                            src="{{ asset('storage/comp/' . (is_array($post->gambar) ? basename($post->gambar[0]) : basename($post->gambar))) }}" />
                    </div>
                    <div class="card-two-headline--info">
                        <h4 class="card-two-headline--title">
                            <a href="{{ route('detail.desktop', ['slug' => $post->slug]) }}">{{ $post->title }}</a>
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
            <h3 class="card-headline-no-image-title fw-bold">Olahraga</h3>
            @if ($topPostOlahraga)
            @php
            $images = explode('|', $topPostOlahraga->gambar);
            @endphp
            <article class="card-one-headline">
                <img alt="image" class="card-one-headline-img" width="310" height="230"
                    src="{{ isset($images[0]) ? asset('storage/comp/' . basename($images[0])) : '' }}" />
                <div class="card-one-headline--info">
                    <h2 class="card-one-headline--title">
                        <a
                            href="{{ route('detail.desktop', ['slug' => $topPostOlahraga->slug]) }}">{{ $topPostOlahraga->title }}</a>
                    </h2>
                    <div class="category-and-time">
                        <div class="card-one-headline--desc">{!! Str::limit(strip_tags($topPostOlahraga->content), 150)
                            !!}</div>
                        <span>{{ \Carbon\Carbon::parse($topPostOlahraga->created_at)->format('Y-m-d') }}</span>
                    </div>
                </div>
            </article>
            @else
            <p>No post found.</p>
            @endif
            <div class="card-two-wrap">
                @foreach ($otherPostsOlahraga as $post)
                <article class="card-two-headline">
                    <div class="card-two-headline-img-wrap">
                        <img alt="image" class="card-two-headline-img" width="100" height="74"
                            src="{{ asset('storage/comp/' . (is_array($post->gambar) ? basename($post->gambar[0]) : basename($post->gambar))) }}" />
                    </div>
                    <div class="card-two-headline--info">
                        <h4 class="card-two-headline--title">
                            <a href="{{ route('detail.desktop', ['slug' => $post->slug]) }}">{{ $post->title }}</a>
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
            <h3 class="card-headline-no-image-title fw-bold">Otomotif</h3>
            @if ($topPostOtomotif)
            @php
            $images = explode('|', $topPostOtomotif->gambar);
            @endphp
            <article class="card-kanal-headline">
                <img alt="image" class="card-kanal-headline-img" width="310" height="230"
                    src="{{ isset($images[0]) ? asset('storage/comp/' . basename($images[0])) : '' }}" />
                <div class="card-kanal-headline--info">
                    <h2 class="card-kanal-headline--title">
                        <a
                            href="{{ route('detail.desktop', ['slug' => $topPostOtomotif->slug]) }}">{{ $topPostOtomotif->title }}</a>
                    </h2>
                    <div class="category-and-time">
                        <div class="card-one-headline--desc">{!! Str::limit(strip_tags($topPostOtomotif->content), 150)
                            !!}</div>
                        <span>{{ \Carbon\Carbon::parse($topPostOtomotif->created_at)->format('Y-m-d') }}</span>
                    </div>
                </div>
            </article>
            @else
            <p>No post found.</p>
            @endif
            <div class="card-two-wrap">
                @foreach ($otherPostsOtomotif as $post)
                <article class="card-two-headline">
                    <div class="card-two-headline-img-wrap">
                        <img alt="image" class="card-two-headline-img" width="100" height="74"
                            src="{{ asset('storage/comp/' . (is_array($post->gambar) ? basename($post->gambar[0]) : basename($post->gambar))) }}" />
                    </div>
                    <div class="card-two-headline--info">
                        <h4 class="card-two-headline--title">
                            <a href="{{ route('detail.desktop', ['slug' => $post->slug]) }}">{{ $post->title }}</a>
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
                                src="{{ asset('storage/comp/' . (is_array($post->gambar) ? basename($post->gambar[0]) : basename($post->gambar))) }}" />
                        </div>
                        <div class="main-card--info">
                            <h4 class="main-card--title">
                                <a href="{{ route('detail.desktop', ['slug' => $post->slug]) }}">{{ $post->title }}</a>
                            </h4>
                            <p class="main-card--desc">{!! Str::limit(strip_tags($post->content), 100) !!}</p>
                            <div class="category-and-time">
                                <span>
                                    @if ($post->subCategory)
                                    <a href="{{ route('kanal.desktop', ['slug' => $post->slug]) }}">
                                        {{ $post->kategori->nama_kategori }}
                                    </a>| 
                                    <a href="{{ route('subcateg.desktop', ['categ' => $post->kategori->slug, 'subcateg' => $post->subCategory->slug]) }}">
                                        {{ $post->subCategory->nama_sub_kategori }}
                                    </a>
                                    @else
                                    <a href="{{ route('kanal.desktop', ['slug' => $post->slug]) }}">
                                        {{ $post->kategori->nama_kategori }}
                                    </a>
                                    @endif
                                    | {{ \Carbon\Carbon::parse($post->created_at)->format('Y-m-d') }}
                                </span>
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
