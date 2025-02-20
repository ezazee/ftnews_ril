@extends('layouts.vertical', ['title' => 'Documentation', 'sub_title' => 'Apps', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')

<main class="flex-grow p-6">
    <div class="flex flex-col gap-6">
        <div class="card">
            <div class="p-6">
                <h4 class="card-title mb-4">Dashboard</h4>
                <p>
                    Dashboard adalah Kumpulan-Kumpulan data pada website yang diringkas sedemikian rupa agar mudah dipahami, diantara nya adalah <strong>data-data seperti</strong> :
                </p>

                <!-- Menggunakan grid untuk membagi UL dan LI ke dalam dua kolom -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <ul class="ps-8">
                        <li class="list-disc">
                            <p class="my-2.5"><strong>Most Post</strong></p>
                            <p class="mb-3.5">Author Yang Paling Banyak Posting</p>
                        </li>
                        <li class="list-disc">
                            <p class="my-2.5"><strong>Activity Post</strong></p>
                            <p class="mb-3.5">Ini adalah Aktifitas postingan terakhir dari Author</p>
                        </li>
                    </ul>
                </div>

                <div class="mt-4 rounded p-1">
                    <img src="{{ asset('images/docs/dashboard.jpeg') }}" alt="">
                </div>
            </div>
        </div>

        <div class="card">
            <div class="p-6">
                <h4 class="card-title mb-4">Category</h4>
                <p>
                    Category disini mengacu pada <strong>"KANAL/CHANNEL"</strong> yang dapat <em>ditambah, dihapus, dan diedit</em>. Berikut elemen-elemen yang dapat diklik beserta fungsi nya:
                </p>

                <!-- Table 1: Menggunakan grid untuk membagi elemen ke dalam dua kolom -->
                <h4 class="ml-4 mt-5">Table Category Name, Sub Category, Action</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <ul class="ps-8">
                        <li class="list-disc">
                            <p class="my-2.5"><strong>Category Name</strong></p>
                            <p class="mb-3.5">Nama Category / Kanal</p>
                        </li>
                        <li class="list-disc">
                            <p class="my-2.5"><strong>Sub Category</strong></p>
                            <p class="mb-3.5">Nama Dari Sub Katategori / Kanal</p>
                        </li>
                    </ul>

                    <ul class="ps-8">
                        <li class="list-disc">
                            <p class="my-2.5"><strong>Action</strong></p>
                            <p class="mb-3.5">Berisi Button Action Edit & Delete</p>
                        </li>
                    </ul>
                </div>

                <!-- Table 2: Menggunakan grid untuk membagi elemen ke dalam dua kolom -->
                <h4 class="ml-4 mt-5">Button Action</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <ul class="ps-8">
                        <li class="list-disc">
                            <p class="my-2.5"><strong>Add Category (Button Biru)</strong></p>
                            <p class="mb-3.5">Berfungsi untuk menambah Category baru / Kanal Baru</p>
                        </li>
                        <li class="list-disc">
                            <p class="my-2.5"><strong>Delete Button (Table Sub Category)</strong></p>
                            <p class="mb-3.5">Berfungsi untuk menghapus sub category yang sudah ada</p>
                        </li>
                    </ul>

                    <ul class="ps-8">
                        <li class="list-disc">
                            <p class="my-2.5"><strong>Edit Button (Table Action)</strong></p>
                            <p class="mb-3.5">Berfungsi untuk mengedit Category / Kanal yang ada <em>(Tidak dengan Sub Category)</em></p>
                        </li>
                        <li class="list-disc">
                            <p class="my-2.5"><strong>Delete Button (Table Action)</strong></p>
                            <p class="mb-3.5">Akan mendelete Category beserta dengan sub category</p>
                        </li>
                    </ul>
                </div>

                <div class="mt-4 rounded p-1">
                    <img src="{{ asset('images/docs/category.png') }}" alt="">
                </div>
            </div>
        </div>

        <div class="card">
            <div class="p-6">
                <h4 class="card-title mb-4">Tags</h4>
                <p>
                    Page Tags disini untuk melihat dan mengedit tag tag yang sudah dibuat, anda juga bisa membuat tag sendiri jika tag nya belum terdaftar, berikut button fungsionalitas pada page Tags :
                </p>

                <!-- Table 1: Menggunakan grid untuk membagi elemen ke dalam dua kolom -->
                <h4 class="ml-4 mt-5">Table Tags Name, Action</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <ul class="ps-8">
                        <li class="list-disc">
                            <p class="my-2.5"><strong>Tags Name</strong></p>
                            <p class="mb-3.5">Berisi tags-tags yang sudah dibuat sebelumnya</p>
                        </li>
                    </ul>

                    <ul class="ps-8">
                        <li class="list-disc">
                            <p class="my-2.5"><strong>Action</strong></p>
                            <p class="mb-3.5">Berisi Button Action Edit & Delete</p>
                        </li>
                    </ul>
                </div>

                <!-- Table 2: Menggunakan grid untuk membagi elemen ke dalam dua kolom -->
                <h4 class="ml-4 mt-5">Button Action</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <ul class="ps-8">
                        <li class="list-disc">
                            <p class="my-2.5"><strong>Add Tags (Button Biru)</strong></p>
                            <p class="mb-3.5">Berfungsi untuk menambah Tags Baru</p>
                        </li>
                        <li class="list-disc">
                            <p class="my-2.5"><strong>Edit Button (Table Action)</strong></p>
                            <p class="mb-3.5">Berfungsi untuk mengedit Category / Kanal yang ada <em>(Tidak dengan Sub Category)</em></p>
                        </li>
                    </ul>

                    <ul class="ps-8">

                        <li class="list-disc">
                            <p class="my-2.5"><strong>Delete Button (Table Action)</strong></p>
                            <p class="mb-3.5">Akan mendelete tag yang dipilih</p>
                        </li>
                    </ul>
                </div>

                <div class="mt-4 rounded p-1">
                    <img src="{{ asset('images/docs/tags.png') }}" alt="">
                </div>
            </div>
        </div>

        <div class="flex justify-between items-center">
            <h4 class="text-slate-900 dark:text-slate-200 text-lg font-medium">Post</h4>
        </div>
        <div class="card">
            <div class="p-6">
                <h4 class="card-title mb-4">Add Post</h4>
                <p>
                    Add Post disini berguna untuk penambahan postingan article terbaru. Page ini juga tidak hanya menambah postingan, Add Post juga berguna dan berpengaruh untuk SEO setiap article yang akan dibuat. Berikut beberapa penjelasan dari setiap button fungsi nya :
                </p>

                <!-- Table 1: Menggunakan grid untuk membagi elemen ke dalam dua kolom -->
                <h4 class="ml-4 mt-5">Side Left Page (Sisi Kiri Page)</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <ul class="ps-8">
                        <li class="list-disc">
                            <p class="my-2.5"><strong>Featured Image</strong></p>
                            <p class="mb-3.5">Berfungsi agar Author dapat mengupload gambar untuk <em>Cover (Thumbnail)</em> dari artikel</p>
                        </li>
                        <li class="list-disc">
                            <p class="my-2.5"><strong>Image Caption</strong></p>
                            <p class="mb-3.5">Berfungsi untuk menambahkan Captio Image, biasanya diisi untuk source image berasal dan lain sebagainya</p>
                        </li>
                        <li class="list-disc">
                            <p class="my-2.5"><strong>Tag Select</strong></p>
                            <p class="mb-3.5">Berfungsi Agar postingan memiliki Tag, untuk mendorong postingan Author berada pada tag yang ditentukan <br> <em class="text-danger">(Jika Tag yang dicari tidak ditemukan, Author bisa mengetik tag yang diinginkan lalu akan muncul tombol "Add")</em></p>
                        </li>

                    </ul>

                    <ul class="ps-8">
                        <li class="list-disc">
                            <p class="my-2.5"><strong>Category & Sub Category</strong></p>
                            <p class="mb-3.5">Berfungsi agar postingan / artikel yang akan dibuat, masuk ke dalam kategory & sub category <br><em class="text-danger">(Jika postingan dipublikasikan tanpa category & sub category itu tidak akan bisa di posting)</em></p>
                        </li>
                        <li class="list-disc">
                            <p class="my-2.5"><strong>Headline Checkbox</strong></p>
                            <p class="mb-3.5">Berguna jika Author ini akan memasukan artikel nya pada Headline</p>
                        </li>
                    </ul>
                </div>

                <!-- Table 2: Menggunakan grid untuk membagi elemen ke dalam dua kolom -->
                <h4 class="ml-4 mt-5">Side Right Page (Sisi Kanan Page)</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <ul class="ps-8">
                        <li class="list-disc">
                            <p class="my-2.5"><strong>Title</strong></p>
                            <p class="mb-3.5">Berfungsi untuk menambah Title pada artikel yang akan dibuat</p>
                        </li>
                        <li class="list-disc">
                            <p class="my-2.5"><strong>Content</strong></p>
                            <p class="mb-3.5">Berfungsi untuk menambahkan isi dari artikel yang akan dibuat. Bisa menambahkan Embed Video, gambar dan hal-hal kecil lain seperti text align dan sebagainya</em></p>
                        </li>
                        <li class="list-disc">
                            <p class="my-2.5"><strong>Generate URL & Generated Embed URL</strong></p>
                            <p class="mb-3.5">Berfungsi untuk mengolah link yang sudah dimasukan oleh Author, ketika di klik "Insert Video", akan muncul link baru pada kolom <em>Generated Embbed URL</em></p>
                        </li>
                    </ul>

                    <ul class="ps-8">

                        <li class="list-disc">
                            <p class="my-2.5"><strong>Status</strong></p>
                            <p class="mb-3.5">Status berfungsi agar artikel yang sudah dibuat akan dipublikasikan langsung atau tidak, jika tidak bisa di privat atau di jadwalkan post (Schedule Post)</p>
                        </li>
                        <li class="list-disc">
                            <p class="my-2.5"><strong>SEO</strong></p>
                            <p class="mb-3.5">SEO disini akan membantu penayangan artikel yang akan dibuat, dimulai dari pengisian Keyword.. dimana pengisian keyword dapat membantu artikel naik ke publik dengan keyword yang tepat sesuai dengan topik artikel. Description akan membantu juga pada gambar cover yang bisa cepat dilihat oleh publik</p>
                        </li>
                        <li class="list-disc">
                            <p class="my-2.5"><strong>Save Button</strong></p>
                            <p class="mb-3.5">Berfungsi ketika semua pilihan dan kolom sudah diisi</p>
                        </li>
                    </ul>
                </div>

                <div class="mt-4 rounded p-1">
                    <img src="{{ asset('images/docs/ad-post.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>
</main>

@endsection

@section('script')
@vite('resources/js/pages/apps-calendar.js')
@endsection
