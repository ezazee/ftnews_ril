@extends('frontend.dekstop.master.master-app')
@section('content')
    @include('frontend.dekstop.components.ads-1')
    <div class="mt-20">
        <h3 class="card-headline-no-image-title">Lorem ipsum dolor sit amet.</h3>
    </div>
    <div class="content-home" id="content">
        <div class="content-article">
            <div>
                {{-- @foreach ($post->take(1) as $item) --}}
                <article class="card-one-headline">
                    <div class="card-one-headline-img"><a href="#"><img class="card-one-headline-img"
                                src="#" /></a></div>
                    <div class="card-one-headline--info">
                        <h4 class="card-one-headline--title">
                            <a href="#">Lorem ipsum dolor sit amet.</a>
                        </h4>
                        <div class="category-and-time">
                            <div class="card-one-headline--desc">Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto, aperiam?</div>
                            <span>{sadasd}</span>
                        </div>
                    </div>
                </article>
                {{-- @endforeach --}}
                <div class="card-two-wrap">
                    {{-- @foreach ($post->slice(1, 4) as $item) --}}
                    <article class="card-two-headline">
                        <div class="card-two-headline-img-wrap">
                            <img class="card-two-headline-img" src="#" />
                        </div>
                        <div class="card-two-headline--info">
                            <h4 class="card-two-headline--title">
                                <a href="#"></a>
                            </h4>
                            <div class="category-and-time">
                                <span>{sadasd}</span>
                            </div>
                        </div>
                    </article>
                    {{-- @endforeach --}}
                </div>
            </div>
            <div class="mt-20">
                <div class="list">
                    {{-- @foreach ($post->slice(4, 25) as $item) --}}
                    <div class="list-element">
                        <article class="main-card">
                            <div class="main-card-img-wrap">
                                <img alt="image" class="main-card-img" width="213" height="130"
                                    src="#" />
                            </div>
                            <div class="main-card--info">
                                <h4 class="main-card--title">
                                    <a href="#"</a>
                                </h4>
                                <p class="main-card--desc">Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem aspernatur quod officia unde sapiente consequatur.</p>
                                <div class="category-and-time">
                                    <span>{sadasd}</span>
                                </div>
                            </div>
                        </article>
                    </div>
                    {{-- @endforeach --}}
                </div>
                <div class="mb-20">
                    <button class="main-card-loadmore" id="loadmore">Tampilkan lebih banyak</button>
                </div>
            </div>
        </div>
        @include('frontend.dekstop.components.sidebar')
    </div>
@endsection
