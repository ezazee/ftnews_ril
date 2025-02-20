<div class="sidebar-sticky">
    <!-- Advertisement Section -->
    <aside class="wrapper__list__article mb-4 mt-3">
        <div class="widget ad-widget vstack gap-2 text-center">
            <div class="panel gap-2 h-100">
                <div>
                    <div class="widget ad-widget vstack gap-2">
                        <div class="widget-content">
                            <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7366174212541814"
                                 crossorigin="anonymous"></script>
                            <!-- square-artikel-detail-right-1 -->
                            <ins class="adsbygoogle"
                                 style="display:block"
                                 data-ad-client="ca-pub-7366174212541814"
                                 data-ad-slot="8531112239"
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
        <div class="block-header panel pb-4">
            <h5 class="ft-tertiary fw-bold ls-0 text-uppercase m-0 text-black dark:text-white position-relative underline-title">
                <strong class="dark:text-white">BERITA TERPOPULER</strong>
            </h5>
        </div>
        <div class="wrapper__list__article-small">
            @foreach ($populer as $index => $item)
                <div class="mb-3">
                    <div class="card__post card__post-list d-flex align-items-start">
                        <div class="image-sm flex-shrink-0">
                            <a href="{{ route('bytitle', $item->slug) }}">
                                @if (!empty($item->gambar) && is_array($item->gambar) && count($item->gambar) > 0)
                                    <img width="100" height="100" src="{{ asset('storage/' . $item->gambar[0]) }}"
                                        alt="{{ $item->title }}" class="img-fluid rounded">
                                @endif
                            </a>
                        </div>
                        <div class="card__post__body ms-3">
                            <div class="card__post__content">
                                <div class="card__post__title">
                                    <h6 class="text-dark mb-0">
                                        <a href="{{ route('bytitle', $item->slug) }}"
                                            class="text-none text-dark dark:text-white">
                                            {{ $item->title }}
                                        </a>
                                    </h6>
                                </div>
                                <div class="card__post__author-info">
                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item small text-muted">
                                            {{ \Carbon\Carbon::parse($item->created_at)->isoFormat('DD MMMM, YYYY') }}
                                        </li>
                                    </ul>
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
                         data-ad-layout-key="-ib-l-g-5q+ir"
                         data-ad-client="ca-pub-7366174212541814"
                         data-ad-slot="9022104818"></ins>
                    <script>
                         (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
                </div>
                @endif
    
            @endforeach
        </div>
    </aside>


    <div class="widget ad-widget vstack gap-2 text-center">
        <div class="panel gap-2 h-100">
            <div>
                <div class="widget ad-widget vstack gap-2">
                    <div class="widget-content">
                        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7366174212541814"
                             crossorigin="anonymous"></script>
                        <!-- square-artikel-detail-right-2 -->
                        <ins class="adsbygoogle"
                             style="display:block"
                             data-ad-client="ca-pub-7366174212541814"
                             data-ad-slot="6974386357"
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

    <aside class="wrapper__list__article mb-4  sticky-sidebar">
        <div class="widget popular-widget vstack gap-3 mt-5 border rounded-3 p-3">
            <!-- Judul Sidebar -->
            <div class="widget-title text-center">
                <h5 class="fs-3 fw-bold text-primary-category m-0">BERITA TERKINI</h5>
            </div>

            <!-- Daftar Topik -->
            <div class="widget-content sticky">
                @foreach ($postTerkini as $index => $kini)
                    <div class="hstack gap-2 align-items-center py-2">
                        <!-- Ikon dan Nomor -->
                        <div class="icon-circle bg-primary text-white text-center rounded-circle">
                            <span
                                class="h3 lg:h2 ft-tertiary fst-italic text-center text-primary m-0 min-w-24px">{{ $index + 1 }}</span>
                        </div>
                        <!-- Judul Topik -->
                        <div class="post-header">
                            <h6 class="post-title m-0">
                                <a class="text-none text-dark hover:text-primary"
                                    href="{{ route('bytitle', $kini->slug) }}">{{ $kini->title }}</a>
                            </h6>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </aside>

</div>
