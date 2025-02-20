@extends('blog.partials.app')

@section('content')
<div id="wrapper" class="wrap overflow-hidden-x">
    {{-- <div class="breadcrumbs panel z-1 py-2 bg-gray-25 dark:bg-gray-100 dark:bg-opacity-5 dark:text-white">
        <div class="container max-w-xl">
            <ul class="breadcrumb nav-x justify-center gap-1 fs-7 sm:fs-6 m-0">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><i class="unicon-chevron-right opacity-50"></i></li>
                <li><span class="opacity-50">Kode Etik Jurnalistik</span></li>
            </ul>
        </div>
    </div> --}}
    <div class="section py-2">
        <div class="container max-w-lg">
            <div class="page-wrap panel vstack gap-3">
                <header class="page-header panel vstack justify-center gap-2 text-center">
                    <div class="panel">
                        <h1 class="h3 lg:h1 m-0">Kode Etik Jurnalistik</h1>
                    </div>
                </header>
                <div class="page-content panel fs-6 md:fs-5">
                    <p>Kemerdekaan berpendapat, berekspresi, dan pers adalah hak asasi manusia yang dilindungi Pancasila, Undang-Undang Dasar 1945, dan Deklarasi Universal Hak Asasi Manusia PBB. Kemerdekaan pers adalah sarana masyarakat untuk memperoleh informasi dan berkomunikasi, guna memenuhi kebutuhan hakiki dan meningkatkan kualitas kehidupan manusia. Dalam mewujudkan kemerdekaan pers itu, wartawan Indonesia juga menyadari adanya kepentingan bangsa, tanggung jawab sosial, keberagaman masyarakat, dan norma-norma agama.</p>

                    <p>Dalam melaksanakan fungsi, hak, kewajiban dan peranannya, pers menghormati hak asasi setiap orang, karena itu pers dituntut profesional dan terbuka untuk dikontrol oleh masyarakat.</p>

                    <p>Untuk menjamin kemerdekaan pers dan memenuhi hak publik untuk memperoleh informasi yang benar, wartawan Indonesia memerlukan landasan moral dan etika profesi sebagai pedoman operasional dalam menjaga kepercayaan publik dan menegakkan integritas serta profesionalisme. Atas dasar itu, wartawan Indonesia menetapkan dan menaati Kode Etik Jurnalistik:</p>

                    <h3>Pasal 1</h3>
                    <p>Wartawan Indonesia bersikap independen, menghasilkan berita yang akurat, berimbang, dan tidak beritikad buruk.</p>

                    <h4>Penafsiran</h4>
                    <ul>
                        <li><strong>Independen</strong> berarti memberitakan peristiwa atau fakta sesuai dengan suara hati nurani tanpa campur tangan, paksaan, dan intervensi dari pihak lain termasuk pemilik perusahaan pers.</li>
                        <li><strong>Akurat</strong> berarti dipercaya benar sesuai keadaan objektif ketika peristiwa terjadi.</li>
                        <li><strong>Berimbang</strong> berarti semua pihak mendapat kesempatan setara.</li>
                        <li><strong>Tidak beritikad buruk</strong> berarti tidak ada niat secara sengaja dan semata-mata untuk menimbulkan kerugian pihak lain.</li>
                    </ul>

                    <h3>Pasal 2</h3>
                    <p>Wartawan Indonesia menempuh cara-cara yang profesional dalam melaksanakan tugas jurnalistik.</p>

                    <h4>Penafsiran</h4>
                    <ul>
                        <li>Menunjukkan identitas diri kepada narasumber;</li>
                        <li>Menghormati hak privasi;</li>
                        <li>Tidak menyuap;</li>
                        <li>Menghasilkan berita yang faktual dan jelas sumbernya;</li>
                        <li>Rekayasa pengambilan dan pemuatan atau penyiaran gambar, foto, suara dilengkapi dengan keterangan tentang sumber dan ditampilkan secara berimbang;</li>
                        <li>Menghormati pengalaman traumatik narasumber dalam penyajian gambar, foto, suara;</li>
                        <li>Tidak melakukan plagiat, termasuk menyatakan hasil liputan wartawan lain sebagai karya sendiri;</li>
                        <li>Penggunaan cara-cara tertentu dapat dipertimbangkan untuk peliputan berita investigasi bagi kepentingan publik.</li>
                    </ul>

                    <h3>Pasal 3</h3>
                    <p>Wartawan Indonesia selalu menguji informasi, memberitakan secara berimbang, tidak mencampurkan fakta dan opini yang menghakimi, serta menerapkan asas praduga tak bersalah.</p>

                    <h4>Penafsiran</h4>
                    <ul>
                        <li><strong>Menguji informasi</strong> berarti melakukan check and recheck tentang kebenaran informasi itu.</li>
                        <li><strong>Berimbang</strong> adalah memberikan ruang atau waktu pemberitaan kepada masing-masing pihak secara proporsional.</li>
                        <li><strong>Opini yang menghakimi</strong> adalah pendapat pribadi wartawan. Hal ini berbeda dengan opini interpretatif, yaitu pendapat yang berupa interpretasi wartawan atas fakta.</li>
                        <li><strong>Asas praduga tak bersalah</strong> adalah prinsip tidak menghakimi seseorang.</li>
                    </ul>

                    <h3>Pasal 4</h3>
                    <p>Wartawan Indonesia tidak membuat berita bohong, fitnah, sadis, dan cabul.</p>

                    <h4>Penafsiran</h4>
                    <ul>
                        <li><strong>Bohong</strong> berarti sesuatu yang sudah diketahui sebelumnya oleh wartawan sebagai hal yang tidak sesuai dengan fakta yang terjadi.</li>
                        <li><strong>Fitnah</strong> berarti tuduhan tanpa dasar yang dilakukan secara sengaja dengan niat buruk.</li>
                        <li><strong>Sadis</strong> berarti kejam dan tidak mengenal belas kasihan.</li>
                        <li><strong>Cabul</strong> berarti penggambaran tingkah laku secara erotis dengan foto, gambar, suara, grafis, atau tulisan yang semata-mata untuk membangkitkan nafsu birahi.</li>
                        <li>Dalam penyiaran gambar dan suara dari arsip, wartawan mencantumkan waktu pengambilan gambar dan suara.</li>
                    </ul>

                    <h3>Pasal 5</h3>
                    <p>Wartawan Indonesia tidak menyebutkan dan menyiarkan identitas korban kejahatan susila dan tidak menyebutkan identitas anak yang menjadi pelaku kejahatan.</p>

                    <h4>Penafsiran</h4>
                    <ul>
                        <li><strong>Identitas</strong> adalah semua data dan informasi yang menyangkut diri seseorang yang memudahkan orang lain untuk melacak.</li>
                        <li><strong>Anak</strong> adalah seorang yang berusia kurang dari 16 tahun dan belum menikah.</li>
                    </ul>

                    <h3>Pasal 6</h3>
                    <p>Wartawan Indonesia tidak menyalahgunakan profesi dan tidak menerima suap.</p>

                    <h4>Penafsiran</h4>
                    <ul>
                        <li><strong>Menyalahgunakan profesi</strong> adalah segala tindakan yang mengambil keuntungan pribadi atas informasi yang diperoleh saat bertugas sebelum informasi tersebut menjadi pengetahuan umum.</li>
                        <li><strong>Suap</strong> adalah segala pemberian dalam bentuk uang, benda, atau fasilitas dari pihak lain yang mempengaruhi independensi.</li>
                    </ul>

                    <h3>Pasal 7</h3>
                    <p>Wartawan Indonesia memiliki hak tolak untuk melindungi narasumber yang tidak bersedia diketahui identitas maupun keberadaannya, menghargai ketentuan embargo, informasi latar belakang, dan off the record sesuai dengan kesepakatan.</p>

                    <h4>Penafsiran</h4>
                    <ul>
                        <li><strong>Hak tolak</strong> adalah hak untuk tidak mengungkapkan identitas dan keberadaan narasumber demi keamanan narasumber dan keluarganya.</li>
                        <li><strong>Embargo</strong> adalah penundaan pemuatan atau penyiaran berita sesuai dengan permintaan narasumber.</li>
                        <li><strong>Informasi latar belakang</strong> adalah segala informasi atau data dari narasumber yang disiarkan atau diberitakan tanpa menyebutkan narasumbernya.</li>
                        <li><strong>Off the record</strong> adalah segala informasi atau data dari narasumber yang tidak boleh disiarkan atau diberitakan.</li>
                    </ul>
                    <h3>Pasal 8</h3>
                    <p>Wartawan Indonesia tidak menulis atau menyiarkan berita berdasarkan prasangka atau diskriminasi terhadap seseorang atas dasar perbedaan suku, ras, warna kulit, agama, jenis kelamin, dan bahasa serta tidak merendahkan martabat orang lemah, miskin, sakit, cacat jiwa atau cacat jasmani.</p>

                    <h4>Penafsiran</h4>
                    <ul>
                        <li><strong>Prasangka</strong> adalah anggapan yang kurang baik mengenai sesuatu sebelum mengetahui secara jelas.</li>
                        <li><strong>Diskriminasi</strong> adalah pembedaan perlakuan.</li>
                    </ul>

                    <h3>Pasal 9</h3>
                    <p>Wartawan Indonesia menghormati hak narasumber tentang kehidupan pribadinya, kecuali untuk kepentingan publik.</p>

                    <h4>Penafsiran</h4>
                    <ul>
                        <li><strong>Menghormati hak narasumber</strong> adalah sikap menahan diri dan berhati-hati.</li>
                        <li><strong>Kehidupan pribadi</strong> adalah segala segi kehidupan seseorang dan keluarganya selain yang terkait dengan kepentingan publik.</li>
                    </ul>

                    <h3>Pasal 10</h3>
                    <p>Wartawan Indonesia segera mencabut, meralat, dan memperbaiki berita yang keliru dan tidak akurat disertai dengan permintaan maaf kepada pembaca, pendengar, dan atau pemirsa.</p>

                    <h4>Penafsiran</h4>
                    <ul>
                        <li><strong>Segera</strong> berarti tindakan dalam waktu secepat mungkin, baik karena ada maupun tidak ada teguran dari pihak luar.</li>
                        <li><strong>Permintaan maaf</strong> disampaikan apabila kesalahan terkait dengan substansi pokok.</li>
                    </ul>

                    <h3>Pasal 11</h3>
                    <p>Wartawan Indonesia melayani hak jawab dan hak koreksi secara proporsional.</p>

                    <h4>Penafsiran</h4>
                    <ul>
                        <li><strong>Hak jawab</strong> adalah hak seseorang atau sekelompok orang untuk memberikan tanggapan atau sanggahan terhadap pemberitaan berupa fakta yang merugikan nama baiknya.</li>
                        <li><strong>Hak koreksi</strong> adalah hak setiap orang untuk membetulkan kekeliruan informasi yang diberitakan oleh pers, baik tentang dirinya maupun tentang orang lain.</li>
                        <li><strong>Proporsional</strong> berarti setara dengan bagian berita yang perlu diperbaiki.</li>
                    </ul>

                    <p>Penilaian akhir atas pelanggaran kode etik jurnalistik dilakukan Dewan Pers. Sanksi atas pelanggaran kode etik jurnalistik dilakukan oleh organisasi wartawan dan atau perusahaan pers.</p>

                    <p>Jakarta, Selasa, 14 Maret 2006</p>

                    <p>(Kode Etik Jurnalistik ditetapkan Dewan Pers melalui Peraturan Dewan Pers Nomor: 6/Peraturan-DP/V/2008 Tentang Pengesahan Surat Keputusan Dewan Pers Nomor 03/SK-DP/III/2006 tentang Kode Etik Jurnalistik Sebagai Peraturan Dewan Pers)</p>
                </div>
                <div class="page-footer panel">
                    <p class="fs-7 opacity-60 m-0">Terakhir Update: 16 September, 2024</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
