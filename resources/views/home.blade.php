@extends('layouts.vertical', [
    'title' => 'Dashboard',
    'sub_title' => 'Menu',
    'mode' => $mode ?? '',
    'demo' => $demo ?? ''
])

@section('content')
    <div class="grid 2xl:grid-cols gap-6 mb-6">

        <!-- Statistik Utama -->
        <div class="2xl:col-span-3">
            <div class="grid lg:grid-cols-4 md:grid-cols-2 gap-6 mb-6">

                <!-- Total Posts -->
                <div class="col-span-1">
                    <div class="card">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 me-3">
                                    <div class="w-12 h-12 flex justify-center items-center rounded text-primary bg-primary/25">
                                        <i class="mgc_document_2_line text-xl"></i>
                                    </div>
                                </div>
                                <div class="flex-grow">
                                    <h5 class="mb-1">Total Posts</h5>
                                    <p>{{ $totalPosts }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Tags -->
                <div class="col-span-1">
                    <div class="card">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 me-3">
                                    <div class="w-12 h-12 flex justify-center items-center rounded text-success bg-success/25">
                                        <i class="mgc_hashtag_fill text-xl"></i>
                                    </div>
                                </div>
                                <div class="flex-grow">
                                    <h5 class="mb-1">Total Tags</h5>
                                    <p>{{ $totalTags }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Authors -->
                <div class="col-span-1">
                    <div class="card">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 me-3">
                                    <div class="w-12 h-12 flex justify-center items-center rounded text-info bg-info/25">
                                        <i class="mgc_group_line text-xl"></i>
                                    </div>
                                </div>
                                <div class="flex-grow">
                                    <h5 class="mb-1">Total Authors</h5>
                                    <p>{{ $totalauthor }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Categories -->
                <div class="col-span-1">
                    <div class="card">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 me-3">
                                    <div class="w-12 h-12 flex justify-center items-center rounded text-warning bg-warning/25">
                                        <i class="mgc_folder_line text-xl"></i>
                                    </div>
                                </div>
                                <div class="flex-grow">
                                    <h5 class="mb-1">Total Categories</h5>
                                    <p>{{ $totalCategory }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div><!-- Grid End -->

    <!-- Tabel Most Posting dan Activity Post -->
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">

        <!-- Most Posting -->
        <div class="col-span-1">
            <div class="card">
                <div class="p-6">
                    <h5 class="mb-4">Most Post</h5>
                    <table class="min-w-full table-auto">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">Author</th>
                                <th class="px-4 py-2">Total Posts</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($mostPosting as $post)
                                <tr>
                                    <td class="border px-4 py-2">{{ $post->name }}</td>
                                    <td class="border px-4 py-2">{{ $post->total_posts }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Activity Post -->
        <div class="col-span-1">
            <div class="card">
                <div class="p-6">
                    <h5 class="mb-4">Activity Post</h5>
                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2">Image</th>
                                    <th class="px-4 py-2">Post Title</th>
                                    <th class="px-4 py-2">Last Activity</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($activityPost as $activity)
                                    <tr class="border-b">
                                        <td class="border px-4 py-2">
                                            <img src="{{ asset('storage/' . $activity->gambar) }}" alt="Post Image"
                                                class="w-20 h-16 object-contain rounded">
                                        </td>
                                        <td class="border px-4 py-2">{{ $activity->title }}</td>
                                        <td class="border px-4 py-2">{{ $activity->last_activity }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div><!-- Tabel End -->
@endsection
