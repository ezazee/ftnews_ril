@extends('blog.partials.app')

@section('content')
<div id="wrapper" class="wrap overflow-hidden-x">
    {{-- <div class="breadcrumbs panel z-1 py-2 bg-gray-25 dark:bg-gray-100 dark:bg-opacity-5 dark:text-white">
        <div class="container max-w-xl">
            <ul class="breadcrumb nav-x justify-center gap-1 fs-7 sm:fs-6 m-0">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><i class="unicon-chevron-right opacity-50"></i></li>
                <li><span class="opacity-50">Pedoman Pemberitaan Media Siber</span></li>
            </ul>
        </div>
    </div> --}}

    <div class="section py-2">
        <div class="container max-w-lg">
            <div class="page-wrap panel vstack gap-2">
                <header class="page-header panel vstack justify-center gap-2 text-center">
                    <div class="panel">
                        <h1 class="h3 lg:h1 m-0">Pedoman Pemberitaan Media Siber</h1>
                    </div>
                </header>
                <div class="page-content panel fs-6 md:fs-5">
                    <p>Kemerdekaan berpendapat, kemerdekaan berekspresi, dan kemerdekaan pers adalah hak asasi manusia yang dilindungi Pancasila, Undang-Undang Dasar 1945, dan Deklarasi Universal Hak Asasi Manusia PBB. Keberadaan media siber di Indonesia juga merupakan bagian dari kemerdekaan berpendapat, kemerdekaan berekspresi, dan kemerdekaan pers.</p>
                    <p>Media siber memiliki karakter khusus sehingga memerlukan pedoman agar pengelolaannya dapat dilaksanakan secara profesional, memenuhi fungsi, hak, dan kewajibannya sesuai Undang-Undang Nomor 40 Tahun 1999 tentang Pers dan Kode Etik Jurnalistik. Untuk itu Dewan Pers bersama organisasi pers, pengelola media siber, dan masyarakat menyusun Pedoman Pemberitaan Media Siber sebagai berikut:</p>

                    <h3 class="h4 md:h3 mt-3 lg:mt-6 mb-2">1. Ruang Lingkup</h3>
                    <p>a) Media Siber adalah segala bentuk media yang menggunakan wahana internet dan melaksanakan kegiatan jurnalistik, serta memenuhi persyaratan Undang-Undang Pers dan Standar Perusahaan Pers yang ditetapkan Dewan Pers.</p>
                    <p>b) Isi Buatan Pengguna (User Generated Content) adalah segala isi yang dibuat dan atau dipublikasikan oleh pengguna media siber, antara lain, artikel, gambar, komentar, suara, video dan berbagai bentuk unggahan yang melekat pada media siber, seperti blog, forum, komentar pembaca atau pemirsa, dan bentuk lainnya.</p>

                    <h3 class="h4 md:h3 mt-3 lg:mt-6 mb-2">2. Verifikasi dan Keberimbangan Berita</h3>
                    <p>a) Pada prinsipnya setiap berita harus melalui verifikasi.</p>
                    <p>b) Berita yang dapat merugikan pihak lain memerlukan verifikasi pada berita yang sama untuk memenuhi prinsip akurasi dan keberimbangan.</p>
                    <p>c) Ketentuan dalam butir (a) di atas dikecualikan, dengan syarat:</p>
                    <ul>
                        <li>Berita benar-benar mengandung kepentingan publik yang bersifat mendesak;</li>
                        <li>Sumber berita yang pertama adalah sumber yang jelas disebutkan identitasnya, kredibel dan kompeten;</li>
                        <li>Subyek berita yang harus dikonfirmasi tidak diketahui keberadaannya dan atau tidak dapat diwawancarai;</li>
                        <li>Media memberikan penjelasan kepada pembaca bahwa berita tersebut masih memerlukan verifikasi lebih lanjut yang diupayakan dalam waktu sesegera mungkin. Penjelasan dimuat pada bagian akhir dari berita yang sama, di dalam kurung dan menggunakan huruf miring.</li>
                    </ul>
                    <p>d) Setelah memuat berita sesuai dengan butir (c), media wajib meneruskan upaya verifikasi, dan setelah verifikasi didapatkan, hasil verifikasi dicantumkan pada berita pemutakhiran (update) dengan tautan pada berita yang belum terverifikasi.</p>

                    <h3 class="h4 md:h3 mt-3 lg:mt-6 mb-2">3. Isi Buatan Pengguna (User Generated Content)</h3>
                    <p>a) Media siber wajib mencantumkan syarat dan ketentuan mengenai Isi Buatan Pengguna yang tidak bertentangan dengan Undang-Undang No. 40 tahun 1999 tentang Pers dan Kode Etik Jurnalistik, yang ditempatkan secara terang dan jelas.</p>
                    <p>b) Media siber mewajibkan setiap pengguna untuk melakukan registrasi keanggotaan dan melakukan proses log-in terlebih dahulu untuk dapat mempublikasikan semua bentuk Isi Buatan Pengguna. Ketentuan mengenai log-in akan diatur lebih lanjut.</p>
                    <p>c) Dalam registrasi tersebut, media siber mewajibkan pengguna memberi persetujuan tertulis bahwa Isi Buatan Pengguna yang dipublikasikan:</p>
                    <ul>
                        <li>Tidak memuat isi bohong, fitnah, sadis dan cabul;</li>
                        <li>Tidak memuat isi yang mengandung prasangka dan kebencian terkait dengan suku, agama, ras, dan antargolongan (SARA), serta menganjurkan tindakan kekerasan;</li>
                        <li>Tidak memuat isi diskriminatif atas dasar perbedaan jenis kelamin dan bahasa, serta tidak merendahkan martabat orang lemah, miskin, sakit, cacat jiwa, atau cacat fisik.</li>
                    </ul>
                    <p>d) Media siber memiliki kewenangan mutlak untuk mengedit atau menghapus Isi Buatan Pengguna yang bertentangan dengan butir (c).</p>
                    <p>e) Media siber wajib menyediakan mekanisme pengaduan Isi Buatan Pengguna yang dinilai melanggar ketentuan pada butir (c). Mekanisme tersebut harus disediakan di tempat yang dengan mudah dapat diakses pengguna.</p>
                    <p>f) Media siber wajib menyunting, menghapus, dan melakukan tindakan koreksi setiap Isi Buatan Pengguna yang dilaporkan dan melanggar ketentuan butir (c), sesegera mungkin secara proporsional selambat-lambatnya 2 x 24 jam setelah pengaduan diterima.</p>
                    <p>g) Media siber yang telah memenuhi ketentuan pada butir (a), (b), (c), dan (f) tidak dibebani tanggung jawab atas masalah yang ditimbulkan akibat pemuatan isi yang melanggar ketentuan pada butir (c).</p>
                    <p>h) Media siber bertanggung jawab atas Isi Buatan Pengguna yang dilaporkan bila tidak mengambil tindakan koreksi setelah batas waktu sebagaimana tersebut pada butir (f).</p>

                    <h3 class="h4 md:h3 mt-3 lg:mt-6 mb-2">4. Ralat, Koreksi, dan Hak Jawab</h3>
                    <p>a) Ralat, koreksi, dan hak jawab mengacu pada Undang-Undang Pers, Kode Etik Jurnalistik, dan Pedoman Hak Jawab yang ditetapkan Dewan Pers.</p>
                    <p>b) Ralat, koreksi dan atau hak jawab wajib ditautkan pada berita yang diralat, dikoreksi atau yang diberi hak jawab.</p>
                    <p>c) Di setiap berita ralat, koreksi, dan hak jawab wajib dicantumkan waktu pemuatan ralat, koreksi, dan atau hak jawab tersebut.</p>
                    <p>d) Bila suatu berita media siber tertentu disebarluaskan media siber lain, maka:</p>
                    <ul>
                        <li>Tanggung jawab media siber pembuat berita terbatas pada berita yang dipublikasikan di media siber tersebut atau media siber yang berada di bawah otoritas teknisnya;</li>
                        <li>Koreksi berita yang dilakukan oleh sebuah media siber, juga harus dilakukan oleh media siber lain yang mengutip berita dari media siber yang dikoreksi itu;</li>
                        <li>Media yang menyebarluaskan berita dari sebuah media siber dan tidak melakukan koreksi atas berita sesuai yang dilakukan oleh media siber pemilik dan atau pembuat berita tersebut, bertanggung jawab penuh atas semua akibat hukum dari berita yang tidak dikoreksinya itu.</li>
                    </ul>
                    <p>e) Sesuai dengan Undang-Undang Pers, media siber yang tidak melayani hak jawab dapat dijatuhi sanksi hukum pidana denda paling banyak Rp500.000.000 (Lima ratus juta rupiah).</p>

                    <h3 class="h4 md:h3 mt-3 lg:mt-6 mb-2">5. Pencabutan Berita</h3>
                    <p>a) Berita yang sudah dipublikasikan tidak dapat dicabut karena alasan penyensoran dari pihak luar redaksi, kecuali terkait masalah SARA, kesusilaan, masa depan anak, pengalaman traumatik korban atau berdasarkan pertimbangan khusus yang ditetapkan oleh Dewan Pers.</p>
                    <p>b) Media siber lain wajib mengikuti pencabutan kutipan berita dari media asal yang telah dicabut.</p>
                    <p>c) Pencabutan berita wajib disertai dengan alasan pencabutan dan diumumkan kepada publik.</p>

                    <h3 class="h4 md:h3 mt-3 lg:mt-6 mb-2">6. Iklan</h3>
                    <p>a) Media siber wajib membedakan dengan tegas antara produk berita dan iklan.</p>
                    <p>b) Setiap berita/artikel/isi yang merupakan iklan dan atau berita berbayar wajib mencantumkan keterangan "advertorial", "iklan", "ads", "sponsored", atau kata lain yang menjelaskan bahwa berita/artikel/isi tersebut adalah iklan.</p>

                    <h3 class="h4 md:h3 mt-3 lg:mt-6 mb-2">7. Hak Cipta</h3>
                    <p>Media siber wajib menghormati hak cipta sebagaimana diatur dalam peraturan perundang-undangan yang berlaku.</p>

                    <h3 class="h4 md:h3 mt-3 lg:mt-6 mb-2">8. Pencantuman Pedoman</h3>
                    <p>Pedoman ini wajib dicantumkan di media siber secara terang dan jelas.</p>

                    <h3 class="h4 md:h3 mt-3 lg:mt-6 mb-2">9. Sengketa</h3>
                    <p>Penilaian akhir atas sengketa mengenai pelaksanaan Pedoman ini diselesaikan oleh Dewan Pers.</p>

                    <h3 class="h4 md:h3 mt-3 lg:mt-6 mb-2">Disepakati oleh:</h3>
                    <h3 class="h6">ORGANISASI WARTAWAN DAN ORGANISASI PERUSAHAAN PERS</h3>
                        <ul class="fw-bold">
                            <li>Aliansi Jurnalis Independen (AJI)</li>
                            <li>Persatuan Wartawan Indonesia (PWI)</li>
                            <li>Ikatan Jurnalis Televisi Indonesia (IJTI)</li>
                            <li>Asosiasi Televisi Lokal Indonesia (ATVLI)</li>
                            <li>Asosiasi Televisi Swasta Indonesia (ATVSI)</li>
                            <li>Serikat Perusahaan Pers (SPS)</li>
                            <li>Persatuan Radio Siaran Swasta Nasional Indonesia (PRSSNI)</li>
                        </ul>

                    <div class="page-agreement panel">
                        <h3 class="h4 md:h3 mt-4 lg:mt-6 mb-3 text-center"></h3>

                        <p class="text-center mt-4 h5">Mengetahui</p>
                        <p class="text-center fs-5 fw-bold h5">ttd</p>
                        <p class="text-center h5">Bagir Manan</p>
                        <p class="text-center h5">Ketua Dewan Pers</p>
                    </div>
                </div>

                <div class="page-footer panel">
                    <p class="fs-7 opacity-60 m-0">Terakhir Update: 16 September, 2024</p>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
