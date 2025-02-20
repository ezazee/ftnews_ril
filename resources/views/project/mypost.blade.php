@extends('layouts.vertical', ['title' => 'MY Post List', 'sub_title' => 'MY Post List', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
@include('sweetalert::alert')

<form action="{{ route('post.mypost') }}" method="GET" class="flex items-center p-4 bg-gray-100 dark:bg-gray-700 rounded-md">
    <input
        type="text"
        name="search"
        id="searchInput"
        placeholder="Search..."
        class="w-64 px-2 py-1 border rounded-md mr-2"
        aria-label="Search"
        value="{{ request()->input('search') }}"
    >
    <button type="submit" class="px-4 py-1 border rounded-md bg-blue-500 text-white">
        Search
    </button>
</form>

<div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-3">
  <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
      <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
          <tr>
              <th scope="col" class="px-6 py-3">Title</th>
              <th scope="col" class="px-6 py-3">Status</th>
              <th scope="col" class="px-6 py-3">Categories</th>
              <th scope="col" class="px-6 py-3">Tags</th>
              <th scope="col" class="px-6 py-3">Headline</th>
              <th scope="col" class="px-6 py-3">Action</th>
          </tr>
      </thead>
      <tbody>
        @foreach ($post as $item)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-normal dark:text-white break-words">
                        {{ $item->title }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $item->status }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $item->kategori->nama_kategori ?? 'Uncategorized' }}
                    </td>
                    <td class="px-6 py-4">
                        @foreach ($item->tags as $tag)
                            <span class="inline-block bg-blue-100 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800">
                                {{ $tag->nama_tags }}
                            </span>
                        @endforeach
                    </td>
                    <td class="px-6 py-4">
                        {{ empty($item->headline) || strtolower($item->headline) == 'no' ? '-' : $item->headline }}
                    </td>
                    <td class="px-6 py-4">
                        <button class="text-gray-600 dark:text-gray-400" data-fc-type="dropdown"
                        data-fc-placement="left-start" type="button">
                        <i class="mgc_more_1_fill text-xl"></i>
                    </button>

                    <div
                        class="hidden fc-dropdown fc-dropdown-open:opacity-100 opacity-0 w-36 z-50 mt-2 transition-[margin,opacity] duration-300 bg-white dark:bg-gray-800 shadow-lg border border-gray-200 dark:border-gray-700 rounded-lg p-2">
                        <a class="flex items-center gap-1.5 py-1.5 px-3.5 rounded text-sm transition-all duration-300 bg-transparent text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-200"
                            href="{{ route('list.edit', $item->id) }}">
                            <i class="mgc_edit_line"></i> Edit
                        </a>
                        <div class="h-px bg-gray-200 dark:bg-gray-700 my-2 -mx-2"></div>

                        <form action="{{ route('list.destroy', $item->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="flex items-center gap-1.5 py-1.5 px-3.5 rounded text-sm transition-all duration-300 bg-transparent text-danger hover:bg-danger/5">
                                <i class="mgc_delete_line"></i> Delete
                            </button>
                        </form>
                    </div>
                    </td>
                </tr>
            @endforeach
      </tbody>
  </table>

  <nav aria-label="Page navigation example" class="p-3">
      {{ $post->links() }}
  </nav>

</div>
@endsection

@section('script')
@vite('resources/js/pages/apps-calendar.js')
@endsection
