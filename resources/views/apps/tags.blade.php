@extends('layouts.vertical', ['title' => 'Tags', 'sub_title' => 'Apps', 'mode' => $mode ?? '', 'demo' => $demo ??
''])

@section('content')
@include('sweetalert::alert')

<div class="flex items-center justify-between p-4 bg-gray-100 dark:bg-gray-700 rounded-md w-full">
    <form action="{{ route('tags.create') }}" method="GET" class="flex items-center">
        <input type="text" name="search" id="searchInput" placeholder="Search..."
            class="w-90 px-2 py-1 border rounded-md mr-2" aria-label="Search"
            value="{{ request()->input('search') }}">
        <button type="submit" class="px-4 py-1 border rounded-md bg-blue-500 text-white">
            Search
        </button>
    </form>

    <div class="flex items-center">
        <button data-modal-target="crud-modal" data-modal-toggle="crud-modal"
            class="ml-4 text-white bg-blue-700 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-small rounded-lg text-xs px-4 py-1 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-600"
            type="button">
            Add Tags
        </button>
    </div>
</div>

<div class="grid lg:grid-cols-4 gap-6">
    <!-- Main modal -->
    <div id="crud-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Add Tags
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="crud-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>

                <!-- Modal body -->
                <form class="p-4 md:p-5" action="{{ route('tags.store') }}" method="POST">
                  @csrf
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label 
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name Tags</label>
                            <input type="text" name="nama_tags" 
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Type Tags Name" required="">
                        </div>
                    </div>
                    <button type="submit"
                        class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Add new Tags
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-3">
  <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
      <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
          <tr>
              <th scope="col" class="px-6 py-3">Tags name</th>
              <th scope="col" class="px-6 py-3">Action</th>
          </tr>
      </thead>
      <tbody>
        @foreach ($tags as $item)
              <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                  <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $item->nama_tags }}</th>

                  <td class="px-6 py-4">
                    <form action="{{ route('tags.destroy', $item->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                            data-modal-target="#edittags-{{ $item->id }}"
                            data-modal-toggle="#edittags-{{ $item->id }}">Edit</a>
                        <button type="submit" class="font-medium text-red-600 dark:text-red-500 hover:underline" name="button">Delete</button>
                      </form>
                  </td>
              </tr>
              <!-- Modal untuk Edit Kategori -->
            <div id="edittags-{{ $item->id }}"
                class="fixed inset-0 z-50 flex items-center justify-center hidden p-4 overflow-x-hidden overflow-y-auto bg-black bg-opacity-50"
                data-modal-backdrop="static" aria-hidden="true">
                <div class="relative w-full max-w-md bg-white rounded-lg shadow dark:bg-gray-800">
                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-700">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Edit Tags
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="#edittags-{{ $item->id }}">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 011.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="p-6 space-y-6">
                        <form action="{{ route('tags.update', $item->id) }}" method="post">
                            @csrf
                            @method('put')
                            <div class="mb-4">
                                <label for="name"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tags Name</label>
                                <input type="text" name="nama_tags" id="name" value="{{ $item->nama_tags }}"
                                    class="w-full px-3 py-2 mt-1 text-gray-900 border rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required>
                            </div>
                            <div
                                class="flex items-center justify-end p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-700">
                                <button type="button"
                                    class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600"
                                    data-modal-hide="#edittags-{{ $item->id }}">Cancel</button>
                                <button type="submit"
                                    class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">Save
                                    Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
              @endforeach
      </tbody>
  </table>

    <nav aria-label="Page navigation example" class="p-3">
        {{ $tags->links() }}
    </nav>

</div>


@endsection

@section('script')
<script>
    document.querySelectorAll('[data-modal-target]').forEach(trigger => {
        trigger.addEventListener('click', function () {
            const modal = document.querySelector(trigger.getAttribute('data-modal-target'));
            modal.classList.remove('hidden');
        });
    });

    document.querySelectorAll('[data-modal-hide]').forEach(trigger => {
        trigger.addEventListener('click', function () {
            const modal = document.querySelector(trigger.getAttribute('data-modal-hide'));
            modal.classList.add('hidden');
        });
    });

</script>
@vite('resources/js/pages/apps-calendar.js')
@endsection
