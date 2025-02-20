<footer id="uc-footer" class="uc-footer uc-dark z-footer-999">
    <div class="footer-outer py-4 lg:py-6 xl:py-9 dark:bg-gray-900 dark:text-white">
        <div class="container max-w-lg">
            <div class="footer-inner vstack gap-3">
                <!--{{-- ShortCut Link --}}-->
                <div class="uc-footer-top">
                    <div class="row child-cols col-match gx-4 gy-6">
                        <div class="col-12 md:col-5">
                            <div class="widget newsletter-widget vstack gap-3">
                                <a href="/">
                                    <img class=" uc-transition-scale-up uc-transition-opaque uc-logo w-150px text-gray-900 dark:text-white"
                                        src="{{ URL::asset('assets/images/logo/ftlogo.webp') }}" alt="FTNews"
                                        data-uc-svg>
                                </a>
                                <div class="widgt-content fs-6">
                                    Merupakan media siber yang mengedepankan akurasi. Penyajian berita dengan
                                    mengutamakan kecepatan bukan prioritas utama kami. Menjadikan berita sebagai
                                    inspirasi sudah pasti. Itulah ciri kami.
                                </div>
                            </div>
                        </div>

                        <div class="col lg:d-block">
                            <div class="widgt-title text-center">
                                <h4 class="h4 lg:-ls-2 m-0">Network</h4>
                            </div>
                            <!-- Container untuk logo media partner -->
                            <div class="media-partners d-flex gap-4 py-3">
                                <a href="https://indopop.id"target="_blank" rel="noopener noreferrer"><img
                                        src="{{ URL::asset('assets/images/logo/media-partners/indopop.png') }}"
                                        alt="Indopop" class="media-partner-logo"></a>
                                <a href="https://automoto.id/" target="_blank" rel="noopener noreferrer"><img
                                        src="{{ URL::asset('assets/images/logo/media-partners/automoto.png') }}"
                                        alt="Automoto" class="media-partner-logo"></a>
                                <a href="https://tobanews.com/" target="_blank" rel="noopener noreferrer">
                                    <img src="{{ URL::asset('assets/images/logo/media-partners/tobanews.png') }}"
                                        alt="Tobanews" class="media-partner-logo">
                                </a>
                                <a href="https://terasmalioboronews.com/" target="_blank" rel="noopener noreferrer">
                                    <img src="{{ URL::asset('assets/images/logo/media-partners/terasmalioboro.png') }}"
                                        alt="Teras Malioboro News" class="media-partner-logo">
                                </a>
                                <a href="https://ikngreen.id/" target="_blank" rel="noopener noreferrer">
                                    <img src="{{ URL::asset('assets/images/logo/media-partners/ikngreen.png') }}"
                                        alt="IKN Green" class="media-partner-logo">
                                </a>

                                <a href="https://milenialasik.com/" target="_blank" rel="noopener noreferrer">
                                    <img src="{{ URL::asset('assets/images/logo/media-partners/milenial.png') }}"
                                        alt="Milenial Asik" class="media-partner-logo">
                                </a>
                                <a href="https://satukata.net/" target="_blank" rel="noopener noreferrer">
                                    <img src="{{ URL::asset('assets/images/logo/media-partners/satukata.png') }}"
                                        alt="Satukata" class="media-partner-logo">
                                </a>
                                <a href="https://voxindonews.com/" target="_blank" rel="noopener noreferrer">
                                    <img src="{{ URL::asset('assets/images/logo/media-partners/voxindo.png') }}"
                                        alt="Voxi Indo News" class="media-partner-logo">
                                </a>
                                <a href="https://jayakartanews.com/" target="_blank" rel="noopener noreferrer">
                                    <img src="{{ URL::asset('assets/images/logo/media-partners/jayakarta.png') }}"
                                        alt="Jayakarta News" class="media-partner-logo">
                                </a>
                                <a href="https://pilarmerdeka.com/" target="_blank" rel="noopener noreferrer">
                                    <img src="{{ URL::asset('assets/images/logo/media-partners/pilar.png') }}"
                                        alt="Pilar Merdeka News News" class="media-partner-logo">
                                </a>
                                <a href="{{ route('slim') }}">
                                    <img src="{{ URL::asset('assets/images/logo/media-partners/slimonline.png') }}"
                                        alt="Slim Online" class="media-partner-logo">
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
                <hr class="m-0" style="height: 2px">
                {{-- Policy --}}
                <div class="container max-w-lg">
                    <div class="footer-inner vstack gap-6 xl:gap-8">
                        <div class="uc-footer-bottom panel vstack gap-4 justify-center lg:fs-5">

                            <div class="footer-social flex flex-col text-center items-center gap-2 lg:gap-3">
                                <div class="d-inline-block mb-2">
                                    <h6 class="m-0">Ikuti Kami</h6>
                                </div>

                                <ul class="footer-social nav-x flex justify-center gap-2">
                                    @foreach ($media as $me)
                                        <li>
                                            <a class="text-white hover:text-gray-900 dark:hover:text-white duration-150"
                                                href="{{ $me->facebook }}" target="_blank">
                                                <i class="icon icon-2 fa-brands fa-facebook"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="text-white hover:text-gray-900 dark:hover:text-white duration-150"
                                                href="{{ $me->twitter }}" target="_blank">
                                                <i class="icon icon-2 fa-brands fa-x-twitter"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="text-white hover:text-gray-900 dark:hover:text-white duration-150"
                                                href="{{ $me->instagram }}" target="_blank">
                                                <i class="icon icon-2 fa-brands fa-instagram"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="text-white hover:text-gray-900 dark:hover:text-white duration-150"
                                                href="{{ $me->tiktok }}" target="_blank">
                                                <i class="icon icon-2 fa-brands fa-tiktok"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="text-white hover:text-gray-900 dark:hover:text-white duration-150"
                                                href="{{ $me->youtube }}" target="_blank">
                                                <i class="icon icon-2 fa-brands fa-youtube"></i>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div
                                class="footer-copyright d-none d-md-block flex-column justify-center items-center gap-1 lg:gap-2 text-center">
                                <ul class="nav-x gap-2 fw-medium d-flex flex-wrap justify-center">
                                    <li><a class="text-white text-primary-hover dark:hover:text-white duration-150"
                                            href="{{ url('/home/redaksi') }}">Redaksi</a></li>
                                    <li><a class="text-white text-primary-hover dark:hover:text-white duration-150"
                                            href="{{ url('/home/pedoman-media-siber') }}">Pedoman Media Siber</a></li>
                                    <li><a class="text-white text-primary-hover dark:hover:text-white duration-150"
                                            href="{{ url('/home/standar-perlindungan-profesi-wartawan') }}">Standar
                                            Perlidungan Profesi Wartawan</a></li>
                                    <li><a class="text-white text-primary-hover dark:hover:text-white duration-150"
                                            href="{{ url('/home/kode-etik-jurnalistik') }}">Kode Etik Jurnalistik</a>
                                    </li>
                                </ul>
                            </div>
                            <p class="mb-0 text-center fs-6">
                               PT Forum Terkini Media, 
                               <script>
                                  document.write(new Date().getFullYear());
                               </script> © All Rights Reserved
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
