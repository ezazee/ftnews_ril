@extends('frontend.mobile.master.master-app')

@section('content')
    <div>
        <div>
            @if ($topPostheadline)
                @php
                    $images = explode('|', $topPostheadline->gambar);
                @endphp
                <article class="card-headline">
                    <a href="{{ route('detail.desktop', ['slug' => $topPostheadline->slug]) }}">
                        <img alt="{{ $topPostheadline->title }}" class="card-headline-img"
                            src="{{ isset($images[0]) ? asset('storage/comp/' . basename($images[0])) : '' }}" />
                    </a>
                    <div class="card-headline-info">
                        <div class="category-and-time">
                            <span>
                                @if ($topPostheadline->subCategory)
                                    <a href="{{ route('kanal.desktop', ['slug' => $topPostheadline->slug]) }}">
                                        {{ $topPostheadline->kategori->nama_kategori }}
                                    </a>|
                                    <a
                                        href="{{ route('subcateg.desktop', ['categ' => $topPostheadline->kategori->slug, 'subcateg' => $topPostheadline->subCategory->slug]) }}">
                                        {{ $topPostheadline->subCategory->nama_sub_kategori }}
                                    </a>
                                @else
                                    <a href="{{ route('kanal.desktop', ['slug' => $topPostheadline->slug]) }}">
                                        {{ $topPostheadline->kategori->nama_kategori }}
                                    </a>
                                @endif
                                <span>{{ $topPostheadline->created_at ? \Carbon\Carbon::parse($topPostheadline->created_at)->isoFormat('DD MMMM YYYY') : '' }}
                                    |</span>
                                <span>{{ $topPostheadline->created_at ? \Carbon\Carbon::parse($topPostheadline->created_at)->format('H:i:s') : '' }}</span>
                            </span>
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
                        <img alt="{{ $item->title }}" class="card-headline-small-img"
                            src="{{ asset('storage/comp/' . (is_array($item->gambar) ? basename($item->gambar[0]) : basename($item->gambar))) }}" />
                        <div class="card-headline-small-info">
                            <h4 class="card-headline-small-title">
                                <a href="{{ route('detail.desktop', ['slug' => $item->slug]) }}">{{ $item->title }}</a>
                            </h4>
                            <div class="category-and-time-head">
                                <span>{{ $item->created_at ? \Carbon\Carbon::parse($item->created_at)->isoFormat('DD MMMM YYYY') : '' }}
                                    |</span>
                                <span>{{ $item->created_at ? \Carbon\Carbon::parse($item->created_at)->format('H:i:s') : '' }}</span>
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
                        <img alt="{{ $item->title }}" class="main-card-img"
                            src="{{ asset('storage/comp/' . (is_array($item->gambar) ? basename($item->gambar[0]) : basename($item->gambar))) }}" />
                    </div>
                    <div class="main-card--info">
                        <h4 class="main-card--title">
                            <a href="{{ route('detail.desktop', ['slug' => $item->slug]) }}">{{ $item->title }}</a>
                        </h4>
                        <div class="category-and-time">
                            <span>
                                @if ($item->subCategory)
                                    <a href="{{ route('kanal.desktop', ['slug' => $item->slug]) }}">
                                        {{ $item->kategori->nama_kategori }}
                                    </a>|
                                    <a
                                        href="{{ route('subcateg.desktop', ['categ' => $item->kategori->slug, 'subcateg' => $item->subCategory->slug]) }}">
                                        {{ $item->subCategory->nama_sub_kategori }}
                                    </a>
                                @else
                                    <a href="{{ route('kanal.desktop', ['slug' => $item->slug]) }}">
                                        {{ $item->kategori->nama_kategori }}
                                    </a>
                                @endif
                                <span>{{ $item->created_at ? \Carbon\Carbon::parse($item->created_at)->isoFormat('DD MMMM YYYY') : '' }}
                                    |</span>
                                <span>{{ $item->created_at ? \Carbon\Carbon::parse($item->created_at)->format('H:i:s') : '' }}</span>
                            </span>
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
                                    <span>{{ $item->created_at ? \Carbon\Carbon::parse($item->created_at)->isoFormat('DD MMMM YYYY') : '' }}
                                        |</span>
                                    <span>{{ $item->created_at ? \Carbon\Carbon::parse($item->created_at)->format('H:i:s') : '' }}</span>
                                </div>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
        </div>
        <!-- end terpopuler -->

        @include('frontend.mobile.components.ads-3')

        <!-- Nasional -->
        <div class="mt-20">
            <h3 class="base-title pl-20 mb-10 fw-bold">Nasional</h3>
            @if ($topPostNasional)
                @php
                    $images = explode('|', $topPostNasional->gambar);
                @endphp
                <article class="card-headline">
                    <img alt="{{ $topPostNasional->title }}" class="card-headline-img"
                        src="{{ isset($images[0]) ? asset('storage/comp/' . basename($images[0])) : '' }}" />
                    <div class="card-headline-info">
                        <h4 class="card-headline-title">
                            <a
                                href="{{ route('detail.desktop', ['slug' => $topPostNasional->slug]) }}">{{ $topPostNasional->title }}</a>
                        </h4>
                        <div class="category-and-time">
                            <p class="card-headline-desc">{!! Str::limit(strip_tags($topPostNasional->content), 60) !!}</p>
                            <span>{{ $topPostNasional->created_at ? \Carbon\Carbon::parse($topPostNasional->created_at)->isoFormat('DD MMMM YYYY') : '' }}
                                |</span>
                            <span>{{ $topPostNasional->created_at ? \Carbon\Carbon::parse($topPostNasional->created_at)->format('H:i:s') : '' }}</span>
                        </div>
                    </div>
                </article>
            @else
                <p>No post found.</p>
            @endif
            <div>
                @foreach ($otherPostsNasional as $post)
                    <article class="main-card">
                        <div class="main-card-img-wrap">
                            <img alt="{{ $post->title }}" class="main-card-img"
                                src="{{ asset('storage/comp/' . (is_array($post->gambar) ? basename($post->gambar[0]) : basename($post->gambar))) }}" />
                        </div>
                        <div class="main-card--info">
                            <h4 class="main-card--title">
                                <a href="{{ route('detail.desktop', ['slug' => $post->slug]) }}">{{ $post->title }}</a>
                            </h4>
                            <div class="category-and-time">
                                <span>{{ $post->created_at ? \Carbon\Carbon::parse($post->created_at)->isoFormat('DD MMMM YYYY') : '' }}
                                    |</span>
                                <span>{{ $post->created_at ? \Carbon\Carbon::parse($post->created_at)->format('H:i:s') : '' }}</span>
                            </div>
                        </div>
                    </article>
                @endforeach
                <div class="t10-b20 mb-20">
                    <a href="{{ route('kanal.desktop', ['slug' => 'Nasional']) }}">
                        <button class="main-card-loadmore">Selengkapnya</button>
                    </a>
                </div>
            </div>
        </div>
        <!-- end Nasional -->

        <!-- Daerah -->
        <div class="mt-20">
            <h3 class="base-title pl-20 mb-10 fw-bold">Daerah</h3>
            @if ($topPostDaerah)
                @php
                    $images = explode('|', $topPostDaerah->gambar);
                @endphp
                <article class="card-headline">
                    <img alt="{{ $topPostDaerah->title }}" class="card-headline-img"
                        src="{{ is_array($topPostDaerah->gambar) ? $topPostDaerah->gambar[0] : $topPostDaerah->gambar }}" />
                    <div class="card-headline-info">
                        <h4 class="card-headline-title">
                            <a
                                href="{{ route('detail.desktop', ['slug' => $topPostDaerah->slug]) }}">{{ $topPostDaerah->title }}</a>
                        </h4>
                        <div class="category-and-time">
                            <p class="card-headline-desc">{!! Str::limit(strip_tags($topPostDaerah->content), 60) !!}</p>
                            <span>{{ $topPostDaerah->created_at ? \Carbon\Carbon::parse($topPostDaerah->created_at)->isoFormat('DD MMMM YYYY') : '' }}
                                |</span>
                            <span>{{ $topPostDaerah->created_at ? \Carbon\Carbon::parse($topPostDaerah->created_at)->format('H:i:s') : '' }}</span>
                        </div>
                    </div>
                </article>
            @else
                <p>No post found.</p>
            @endif
            <div>
                @foreach ($otherPostsDaerah as $post)
                    <article class="main-card">
                        <div class="main-card--infomr10">
                            <h4 class="main-card--title">
                                <a href="{{ route('detail.desktop', ['slug' => $post->slug]) }}">{{ $post->title }}</a>
                            </h4>
                            <div class="category-and-time">
                                <span>{{ $post->created_at ? \Carbon\Carbon::parse($post->created_at)->isoFormat('DD MMMM YYYY') : '' }}
                                    |</span>
                                <span>{{ $post->created_at ? \Carbon\Carbon::parse($post->created_at)->format('H:i:s') : '' }}</span>
                            </div>
                        </div>
                        <div class="main-card-img-wrap">
                            <img alt="{{ $post->title }}" class="main-card-img"
                                src="{{ asset('storage/comp/' . (is_array($post->gambar) ? basename($post->gambar[0]) : basename($post->gambar))) }}" />
                        </div>
                    </article>
                @endforeach
                <div class="t10-b20 mb-20">
                    <a href="{{ route('kanal.desktop', ['slug' => 'Daerah']) }}">
                        <button class="main-card-loadmore" id="loadmore">Selengkapnya</button>
                    </a>
                </div>
            </div>
        </div>
        <!-- end Daerah -->

        @include('frontend.mobile.components.ads-4')

        <!-- Lifestyle -->
        <div class="mt-20">
            <h3 class="base-title pl-20 mb-10 fw-bold">Lifestyle</h3>
            @if ($topPostLifestyle)
                @php
                    $images = explode('|', $topPostLifestyle->gambar);
                @endphp
                <article class="card-headline">
                    <img alt="{{ $topPostLifestyle->title }}" class="card-headline-img"
                        src="{{ isset($images[0]) ? asset('storage/comp/' . basename($images[0])) : '' }}" />
                    <div class="card-headline-info">
                        <h4 class="card-headline-title">
                            <a
                                href="{{ route('detail.desktop', ['slug' => $topPostLifestyle->slug]) }}">{{ $topPostLifestyle->title }}</a>
                        </h4>
                        <div class="category-and-time">
                            <p class="card-headline-desc">{!! Str::limit(strip_tags($topPostLifestyle->content), 60) !!}</p>
                            <span>{{ $topPostLifestyle->created_at ? \Carbon\Carbon::parse($topPostLifestyle->created_at)->isoFormat('DD MMMM YYYY') : '' }}
                                |</span>
                            <span>{{ $topPostLifestyle->created_at ? \Carbon\Carbon::parse($topPostLifestyle->created_at)->format('H:i:s') : '' }}</span>
                        </div>
                    </div>
                </article>
            @else
                <p>No post found.</p>
            @endif
            <div>
                @foreach ($otherPostsLifestyle as $post)
                    <article class="main-card">
                        <div class="main-card-img-wrap">
                            <img alt="{{ $post->title }}" class="main-card-img"
                                src="{{ asset('storage/comp/' . (is_array($post->gambar) ? basename($post->gambar[0]) : basename($post->gambar))) }}" />
                        </div>
                        <div class="main-card--info">
                            <h4 class="main-card--title">
                                <a href="{{ route('detail.desktop', ['slug' => $post->slug]) }}">{{ $post->title }}
                                </a>
                            </h4>
                            <div class="category-and-time">
                                <span>{{ $post->created_at ? \Carbon\Carbon::parse($post->created_at)->isoFormat('DD MMMM YYYY') : '' }}
                                    |</span>
                                <span>{{ $post->created_at ? \Carbon\Carbon::parse($post->created_at)->format('H:i:s') : '' }}</span>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
        <!-- end Lifestyle -->

        <!-- K-Pop -->
        <div class="mt-20">
            <h3 class="base-title pl-20 mb-10 fw-bold">Teknologi</h3>
            @if ($topPostTeknologi)
                @php
                    $images = explode('|', $topPostTeknologi->gambar);
                @endphp
                <article class="card-headline">
                    <img alt="{{ $topPostTeknologi->title }}" class="card-headline-img"
                        src="{{ isset($images[0]) ? asset('storage/comp/' . basename($images[0])) : '' }}" />
                    <div class="card-headline-info">
                        <h4 class="card-headline-title">
                            <a
                                href="{{ route('detail.desktop', ['slug' => $topPostTeknologi->slug]) }}">{{ $topPostTeknologi->title }}</a>
                        </h4>
                        <div class="category-and-time">
                            <p class="card-headline-desc">{!! Str::limit(strip_tags($topPostTeknologi->content), 60) !!}</p>
                            <span>{{ $topPostTeknologi->created_at ? \Carbon\Carbon::parse($topPostTeknologi->created_at)->isoFormat('DD MMMM YYYY') : '' }}
                                |</span>
                            <span>{{ $topPostTeknologi->created_at ? \Carbon\Carbon::parse($topPostTeknologi->created_at)->format('H:i:s') : '' }}</span>
                        </div>
                    </div>
                </article>
            @else
                <p>No post found.</p>
            @endif
            <div>
                @foreach ($otherPostsTeknologi as $post)
                    <article class="main-card">
                        <div class="main-card--infomr10">
                            <h4 class="main-card--title">
                                <a href="{{ route('detail.desktop', ['slug' => $post->slug]) }}">{{ $post->title }}</a>
                            </h4>
                            <div class="category-and-time">
                                <span>{{ $post->created_at ? \Carbon\Carbon::parse($post->created_at)->isoFormat('DD MMMM YYYY') : '' }}
                                    |</span>
                                <span>{{ $post->created_at ? \Carbon\Carbon::parse($post->created_at)->format('H:i:s') : '' }}</span>
                            </div>
                        </div>
                        <div class="main-card-img-wrap">
                            <img alt="{{ $post->title }}" class="main-card-img"
                                src="{{ asset('storage/comp/' . (is_array($post->gambar) ? basename($post->gambar[0]) : basename($post->gambar))) }}" />
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

        <!-- Olahraga -->
        <div class="mt-20">
            <h3 class="base-title pl-20 mb-10 fw-bold">Olahraga</h3>
            @if ($topPostOlahraga)
                @php
                    $images = explode('|', $topPostOlahraga->gambar);
                @endphp
                <article class="card-headline">
                    <img alt="{{ $topPostOlahraga->title }}" class="card-headline-img"
                        src="{{ isset($images[0]) ? asset('storage/comp/' . basename($images[0])) : '' }}" />
                    <div class="card-headline-info">
                        <h4 class="card-headline-title">
                            <a
                                href="{{ route('detail.desktop', ['slug' => $topPostOlahraga->slug]) }}">{{ $topPostOlahraga->title }}</a>
                        </h4>
                        <div class="category-and-time">
                            <p class="card-headline-desc">{!! Str::limit(strip_tags($topPostOlahraga->content), 60) !!}</p>
                            <span>{{ $topPostOlahraga->created_at ? \Carbon\Carbon::parse($topPostOlahraga->created_at)->isoFormat('DD MMMM YYYY') : '' }}
                                |</span>
                            <span>{{ $topPostOlahraga->created_at ? \Carbon\Carbon::parse($topPostOlahraga->created_at)->format('H:i:s') : '' }}</span>
                        </div>
                    </div>
                </article>
            @else
                <p>No post found.</p>
            @endif
            <div>
                @foreach ($otherPostsOlahraga as $post)
                    <article class="main-card">
                        <div class="main-card-img-wrap">
                            <img alt="{{ $post->title }}" class="main-card-img"
                                src="{{ asset('storage/comp/' . (is_array($post->gambar) ? basename($post->gambar[0]) : basename($post->gambar))) }}" />
                        </div>
                        <div class="main-card--info">
                            <h4 class="main-card--title">
                                <a href="{{ route('detail.desktop', ['slug' => $post->slug]) }}">{{ $post->title }}</a>
                            </h4>
                            <div class="category-and-time">
                                <span>{{ $post->created_at ? \Carbon\Carbon::parse($post->created_at)->isoFormat('DD MMMM YYYY') : '' }}
                                    |</span>
                                <span>{{ $post->created_at ? \Carbon\Carbon::parse($post->created_at)->format('H:i:s') : '' }}</span>
                            </div>
                        </div>
                    </article>
                @endforeach
                <div class="t10-b20 mb-20">
                    <a href="{{ route('kanal.desktop', ['slug' => 'Olahraga']) }}">
                        <button class="main-card-loadmore" id="loadmore">Selengkapnya</button>
                    </a>
                </div>
            </div>
        </div>
        <!-- end Olahraga -->

        <!-- Me And Moms -->
        <div class="mt-20">
            <h3 class="base-title pl-20 mb-10 fw-bold">Otomotif</h3>
            @if ($topPostOtomotif)
                @php
                    $images = explode('|', $topPostOtomotif->gambar);
                @endphp
                <article class="card-headline">
                    <img alt="{{ $topPostOtomotif->title }}" class="card-headline-img"
                        src="{{ isset($images[0]) ? asset('storage/comp/' . basename($images[0])) : '' }}" />
                    <div class="card-headline-info">
                        <h4 class="card-headline-title">
                            <a
                                href="{{ route('detail.desktop', ['slug' => $topPostOtomotif->slug]) }}">{{ $topPostOtomotif->title }}</a>
                        </h4>
                        <div class="category-and-time">
                            <p class="card-headline-desc">{!! Str::limit(strip_tags($topPostOtomotif->content), 60) !!}</p>
                            <span>{{ $topPostOtomotif->created_at ? \Carbon\Carbon::parse($topPostOtomotif->created_at)->isoFormat('DD MMMM YYYY') : '' }}
                                |</span>
                            <span>{{ $topPostOtomotif->created_at ? \Carbon\Carbon::parse($topPostOtomotif->created_at)->format('H:i:s') : '' }}</span>
                        </div>
                    </div>
                </article>
            @else
                <p>No post found.</p>
            @endif
            <div>
                @foreach ($otherPostsOtomotif as $post)
                    <article class="main-card">
                        <div class="main-card--infomr10">
                            <h4 class="main-card--title">
                                <a
                                    href="{{ route('detail.desktop', ['slug' => $post->slug]) }}">{{ $post->title }}</a>
                            </h4>
                            <div class="category-and-time">
                                <span>{{ $post->created_at ? \Carbon\Carbon::parse($post->created_at)->isoFormat('DD MMMM YYYY') : '' }}
                                    |</span>
                                <span>{{ $post->created_at ? \Carbon\Carbon::parse($post->created_at)->format('H:i:s') : '' }}</span>
                            </div>
                        </div>
                        <div class="main-card-img-wrap">
                            <img alt="{{ $post->title }}" class="main-card-img"
                                src="{{ asset('storage/comp/' . (is_array($post->gambar) ? basename($post->gambar[0]) : basename($post->gambar))) }}" />
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
                                    <img alt="{{ $post->title }}" class="main-card-img"
                                        src="{{ asset('storage/comp/' . (is_array($post->gambar) ? basename($post->gambar[0]) : basename($post->gambar))) }}" />
                                </div>
                                <div class="main-card--info">
                                    <h4 class="main-card--title">
                                        <a
                                            href="{{ route('detail.desktop', ['slug' => $post->slug]) }}">{{ $post->title }}</a>
                                    </h4>
                                    <div class="category-and-time">
                                        <span>
                                            @if ($post->subCategory)
                                                <a href="{{ route('kanal.desktop', ['slug' => $post->slug]) }}">
                                                    {{ $post->kategori->nama_kategori }}
                                                </a>|
                                                <a
                                                    href="{{ route('subcateg.desktop', ['categ' => $post->kategori->slug, 'subcateg' => $post->subCategory->slug]) }}">
                                                    {{ $post->subCategory->nama_sub_kategori }}
                                                </a>
                                            @else
                                                <a href="{{ route('kanal.desktop', ['slug' => $post->slug]) }}">
                                                    {{ $post->kategori->nama_kategori }}
                                                </a>
                                            @endif
                                            <span>{{ $post->created_at ? \Carbon\Carbon::parse($post->created_at)->isoFormat('DD MMMM YYYY') : '' }}
                                                |</span>
                                            <span>{{ $post->created_at ? \Carbon\Carbon::parse($post->created_at)->format('H:i:s') : '' }}</span>
                                        </span>
                                    </div>
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>
                <div class="t10-b20 mb-20">
                        <button class="main-card-loadmore" id="loadmore">Tampilkan lebih banyak</button>
                </div>
            </div>
        </div>
    </div>
@endsection
