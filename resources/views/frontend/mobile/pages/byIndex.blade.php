@extends('frontend.mobile.master.master-app')
@section('content')
    <div>
        @foreach ($post->sortByDesc('created_at') as $item)
            <article class="main-card">
                <div class="main-card-img-wrap">
                    <img alt="{{ $item->title }}" class="main-card-img"
                        src="{{ is_array($item->gambar) ? $item->gambar[0] : $item->gambar }}" />
                </div>
                <div class="main-card--info">
                    <h4 class="main-card--title">
                        <a href="{{ route('detail.desktop', ['slug' => $item->slug]) }}">{{ $item->title }}</a>
                    </h4>
                    <div class="category-and-time">
                        <a href="{{ route('kanal.desktop', ['slug' => $item->kategori->slug]) }}">
                            {{ $item->kategori->nama_kategori }}
                        </a>
                        <span>{{ \Carbon\Carbon::parse($item->created_at)->format('H:i') }} WIB</span>
                    </div>
                </div>
            </article>
        @endforeach
    </div>
@endsection
