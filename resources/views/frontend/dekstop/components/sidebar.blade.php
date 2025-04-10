<div class="content-sidebar">
    <div>
        @include('frontend.dekstop.components.ads-2')
        <div>
            <h3 class="card-headline-no-image-title">Terkini</h3>
            {{-- @foreach ($postTerkini as $item) --}}
                <article class="card-four">
                    <div class="card-four-img-wrap">
                        <a href="#">
                            <img alt="image" class="card-four-img"
                                src="#" />
                        </a>
                    </div>
                    <div class="card-four--info">
                        <h4 class="card-four--title">
                            <a href="#">asd</a>
                        </h4>
                        <div class="category-and-time">
                            <a
                                href="#">category</a>
                            <span>tgl jam waktu WIB</span>
                        </div>
                    </div>
                </article>
            {{-- @endforeach --}}
        </div>
        {{-- Ads --}}
        @include('frontend.dekstop.components.ads-3')
        <div>
            <h3 class="card-headline-no-image-title">Terpopuler</h3>
            {{-- @foreach ($postTerpopuler as $item)
            @php
                $images = is_string($item->gambar) ? explode('|', $item->gambar) : [];
                $firstImage = !empty($images[0]) ? $images[0] : asset('default.jpg');
            @endphp --}}
                <article class="card-four">
                    <div class="card-four-img-wrap">
                        <a href="#">
                            <img alt="image" class="card-four-img"
                                src="#" />
                        </a>
                    </div>
                    <div class="card-four--info">
                        <h4 class="card-four--title">
                            <a href="#">asd</a>
                        </h4>
                        <div class="category-and-time">
                            <a
                                href="#">category</a>
                            <span>tgl jam waktu WIB</span>
                        </div>
                    </div>
                </article>
            {{-- @endforeach --}}
        </div>
    </div>
</div>
