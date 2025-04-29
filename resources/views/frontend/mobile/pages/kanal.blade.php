@extends('frontend.mobile.master.master-app')
@section('content')
    <div style="margin-top: 150px">
        <h2 class="card-headline-no-image-title text-center fw-bold">{{ $category->nama_kategori }}</h2>
        <ul class="scrollable-subtitles"
            style="display: flex; overflow-x: auto; white-space: nowrap; padding: 10px 0; margin-bottom: 30px">
            <li class="menu-item-scroll active" style="padding: 0 15px; font-size: 14px; color: #333;"><a href="#">Hukum</a></li>
            <li class="menu-item-scroll" style="padding: 0 15px; font-size: 14px; color: #333;"><a href="#">Ekonomi Bisnis</a></li>
            <li class="menu-item-scroll" style="padding: 0 15px; font-size: 14px; color: #333;"><a href="#">Metropolitan</a></li>
            <li class="menu-item-scroll" style="padding: 0 15px; font-size: 14px; color: #333;"><a href="#">Politik</a></li>
            <li class="menu-item-scroll" style="padding: 0 15px; font-size: 14px; color: #333;"><a href="#">Sosial Budaya</a></li>
        </ul>
    </ul>

    @if ($post->isNotEmpty())
        @php $latestPost = $post->first(); @endphp
        <div>
            <article class="card-headline">
                <img alt="{{ $latestPost->title }}" class="card-headline-img"
                    src="{{ is_array($latestPost->gambar) ? $latestPost->gambar[0] : $latestPost->gambar }}" />
                <div class="card-headline-info">
                    <h4 class="card-headline-title">
                        <a href="{{ route('detail.desktop', ['slug' => $latestPost->slug]) }}">{{ $latestPost->title }}</a>
                    </h4>
                    <div class="category-and-time">
                        <div class="card-one-headline--desc">{!! Str::limit(strip_tags($latestPost->content), 60) !!}</ul>
                        <span>{{ \Carbon\Carbon::parse($latestPost->created_at)->format('Y-m-d') }}</span>
                    </ul>
                </ul>
            </article>
        </ul>

        <div class="card-headline-small-wrap">
            @foreach ($post->skip(1)->take(4) as $item)
                <article class="card-headline-small">
                    <img alt="{{ $item->title }}" class="card-headline-small-img"
                        src="{{ is_array($item->gambar) ? $item->gambar[0] : $item->gambar }}" />
                    <div class="card-headline-small-info">
                        <h4 class="card-headline-small-title">
                            <a href="{{ route('detail.desktop', ['slug' => $item->slug]) }}">{{ $item->title }}</a>
                        </h4>
                        <div class="category-and-time-head">
                            <span
                                style="font-size: 10px;">{{ $item->created_at ? \Carbon\Carbon::parse($item->created_at)->isoFormat('DD MMMM, YYYY') : '' }}
                                |
                                {{ $item->created_at ? \Carbon\Carbon::parse($item->created_at)->format('H:i:s') : '' }}</span>
                        </ul>
                    </ul>
                </article>
            @endforeach
        </ul>
    @endif

    <div>
        @foreach ($post->skip(5)->sortByDesc('created_at') as $item)
            <article class="main-card">
                <div class="main-card-img-wrap">
                    <img alt="{{ $item->title }}" class="main-card-img"
                        src="{{ is_array($item->gambar) ? $item->gambar[0] : $item->gambar }}" />
                </ul>
                <div class="main-card--info">
                    <h4 class="main-card--title">
                        <a href="{{ route('detail.desktop', ['slug' => $item->slug]) }}">{{ $item->title }}</a>
                    </h4>
                    <div class="category-and-time">
                        <a href="{{ route('kanal.desktop', ['slug' => $item->kategori->slug]) }}">
                            {{ $item->kategori->nama_kategori }}
                        </a>
                        <span
                            style="font-size: 10px;">{{ $item->created_at ? \Carbon\Carbon::parse($item->created_at)->isoFormat('DD MMMM, YYYY') : '' }}
                            |
                            {{ $item->created_at ? \Carbon\Carbon::parse($item->created_at)->format('H:i:s') : '' }}</span>
                    </ul>
                </ul>
            </article>
        @endforeach
    </ul>
@endsection
