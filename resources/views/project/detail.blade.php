@extends('layouts.vertical', ['title' => 'Post Detail', 'sub_title' => 'Post', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    <div class="grid lg:grid-cols-3 gap-6">
        <div class="lg:col-span-3">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">Post Overview</h6>
                </div>

                <div class="p-6">
                    <div class="grid lg:grid-cols-4 gap-6">
                        <!-- stat 1 -->
                        <div class="flex items-center gap-5">
                            <i data-feather="grid" class="h-10 w-10"></i>
                            <div class="">
                                <h4 class="text-lg text-gray-700 dark:text-gray-300 font-medium">{{ $totalPosts }}</h4>
                                <span class="text-sm">Total Content</span>
                            </div>
                        </div>

                        <!-- stat 2 -->
                        <div class="flex items-center gap-5">
                            <i data-feather="check-square" class="h-10 w-10"></i>
                            <div class="">
                                <h4 class="text-lg text-gray-700 dark:text-gray-300 font-medium">{{ $totalPublicPosts }}</h4>
                                <span class="text-sm">Total Content Public</span>
                            </div>
                        </div>

                        <!-- stat 3 -->
                        <div class="flex items-center gap-5">
                            <i data-feather="users" class="h-10 w-10"></i>
                            <div class="">
                                <h4 class="text-lg text-gray-700 dark:text-gray-300 font-medium">{{ $totalViews }}</h4>
                                <span class="text-sm">Total View</span>
                            </div>
                        </div>
                        <!-- stat 3 -->
                        <div class="flex items-center gap-5">
                            <i data-feather="clock" class="h-10 w-10"></i>
                            <div class="">
                                <a href="{{ route('post.shedule') }}"><h4 class="text-lg text-gray-700 dark:text-gray-300 font-medium">{{ $totalSchedulePosts }}</h4></a>
                                <span class="text-sm">Content Schedule</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-2">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Most View Post</h4>
                </div>

                <div class="p-6">
                    <div>
                        <h3 class="mb-3">{{ $mostViewedPost->title ?? '' }}</h3>
                        {!! preg_replace('/\[caption[^\]]*\](.*?)\[\/caption\]/s', '$1', $mostViewedPost->content ?? '') !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-span-1">
            <div class="card overflow-hidden bg-white shadow rounded-md">
                <div class="card-header p-4 border-b border-gray-200">
                    <h6 class="card-title text-lg font-semibold">Post Activities</h6>
                </div>
                <div class="table overflow-hidden w-full">
                    <div class="divide-y divide-gray-300 dark:divide-gray-700">
                        @foreach ($activity as $item)
                            <div class="p-4">
                                <div class="flex flex-col gap-3">
                                    <div class="flex-grow">
                                        <div class="font-medium text-gray-900 dark:text-gray-300 break-words">{{ $item->title }}</div>
                                    </div>
                                    <div class="px-3 py-1 hidden md:block rounded text-xs font-small text-gray-600 dark:text-gray-400">
                                        {{ \Carbon\Carbon::parse($item->created_at)->isoFormat('DD MMMM, YYYY') }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
