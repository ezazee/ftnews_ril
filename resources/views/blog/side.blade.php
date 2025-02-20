<div class="col-md-4">
    <div class="sidebar-sticky">
        <!-- Advertisement Section -->
        <aside class="wrapper__list__article mb-4">
            <div class="widget ad-widget vstack gap-2 text-center p-1">
                <div class="panel gap-2 h-100">
                    <div>
                        <div class="widget ad-widget vstack gap-2">
                            <div class="widget-content">
                                <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7366174212541814"
                                     crossorigin="anonymous"></script>
                                <!-- Search-pages -->
                                <ins class="adsbygoogle"
                                     style="display:block"
                                     data-ad-client="ca-pub-7366174212541814"
                                     data-ad-slot="4734141912"
                                     data-ad-format="auto"
                                     data-full-width-responsive="true"></ins>
                                <script>
                                     (adsbygoogle = window.adsbygoogle || []).push({});
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </aside>
        <!-- Popular Articles Section -->
        <aside class="wrapper__list__article mb-4">
            <h4 class="border_section text-primary">Berita Terpopuler</h4>
            <div class="wrapper__list__article-small">
                @foreach ($populer as $index => $item)
                <div class="mb-3">
                    <div class="card__post card__post-list d-flex align-items-start">
                        <div class="image-sm flex-shrink-0">
                            <a href="{{ route('bytitle', $item->slug) }}">
                                @if(!empty($item->gambar) && is_array($item->gambar) && count($item->gambar) > 0)
                                    <img width="100" height="100" src="{{ asset('storage/' . $item->gambar[0]) }}" alt="{{ $item->title }}" class="img-fluid rounded">
                                @endif
                            </a>
                        </div>
                        <div class="card__post__body ms-3">
                            <div class="card__post__content">
                                <div class="card__post__author-info">
                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item small text-primary">
                                            By {{ $item->user->name }}
                                        </li>
                                        <li class="list-inline-item small text-muted">
                                            {{ \Carbon\Carbon::parse($item->created_at)->isoFormat('DD MMMM, YYYY') }}
                                        </li>
                                    </ul>
                                </div>
                                <div class="card__post__title">
                                    <h6 class="text-dark mb-0">
                                        <a href="{{ route('bytitle', $item->slug) }}" class="text-none text-dark dark:text-white">
                                            {{ $item->title }}
                                        </a>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        
                <!-- Menyisipkan Iklan AdSense setelah setiap 3 artikel -->
                @if (($index + 1) % 3 == 0)
                <div class="ad-inside-feed my-4">
                    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7366174212541814"
                         crossorigin="anonymous"></script>
                    <ins class="adsbygoogle"
                         style="display:block"
                         data-ad-format="fluid"
                         data-ad-layout-key="-hm-26+1x-1b+cb"
                         data-ad-client="ca-pub-7366174212541814"
                         data-ad-slot="8985713277">
                    </ins>
                    <script>
                         (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
                </div>
                @endif
        
                @endforeach
            </div>
        </aside>

    </div>
</div>
