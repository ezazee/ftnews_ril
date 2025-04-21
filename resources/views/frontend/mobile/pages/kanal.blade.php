@extends('frontend.mobile.master.master-app')
@section('content')
    <div class="mt-20">
        <h3 class="card-headline-no-image-title ml-10 fw-bold">Lorem ipsum dolor sit amet.</h3>
    </div>

    {{-- @if ($post->isNotEmpty()) --}}
        {{-- @php $latestPost = $post->first(); @endphp --}}
        <div>
            <article class="card-headline">
                <img alt="lorem ipsum dolor sit amet" class="card-headline-img" src="#" />
                <div class="card-headline-info">
                    <h4 class="card-headline-title">
                        <a href="#">lorem ipsum dolor sit amet</a>
                    </h4>
                    <div class="category-and-time">
                        <div class="card-one-headline--desc">Lorem ipsum, dolor sit amet consectetur adipisicing elit.</div>
                        <span>Lorem, ipsum dolor.</span>
                    </div>
                </div>
            </article>
        </div>

        <div class="card-headline-small-wrap">
            {{-- @foreach ($post->skip(1)->take(4) as $item) --}}
                <article class="card-headline-small">
                    <img alt="lorem" class="card-headline-small-img" src="#" />
                    <div class="card-headline-small-info">
                        <h4 class="card-headline-small-title">
                            <a href="#">lorem</a>
                        </h4>
                        <div class="category-and-time-head">
                            <span>Lorem ipsum dolor sit amet.</span>
                        </div>
                    </div>
                </article>
            {{-- @endforeach --}}
        </div>
    {{-- @endif --}}

    <div>
        {{-- @foreach ($post->skip(5)->sortByDesc('created_at') as $item) --}}
            <article class="main-card">
                <div class="main-card-img-wrap">
                    <img alt="lorem" class="main-card-img"
                        src="#" />
                </div>
                <div class="main-card--info">
                    <h4 class="main-card--title">
                        <a href="#">lorem</a>
                    </h4>
                    <div class="category-and-time">
                        <a href="#">
                            Lorem ipsum dolor sit.
                        </a>
                        <span>Lorem ipsum dolor sit amet.</span>
                    </div>
                </div>
            </article>
        {{-- @endforeach --}}
    </div>
@endsection
