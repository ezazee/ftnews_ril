@extends('backend.master.app')

@section('content')
<div class="page-header d-print-none">
   <div class="container-xl">
       <div class="row g-2 align-items-center">
           <div class="col">
               <div class="page-pretitle">
                   <nav aria-label="breadcrumb">
                       <ol class="breadcrumb">
                           <li class="breadcrumb-item active" aria-current="page">
                              <h1 class="mb-0 d-inline-block fs-6 lh-1">Trash</h1>
                          </li>
                       </ol>
                   </nav>
               </div>
           </div>
           <div class="col-auto ms-auto d-print-none">
               <div class="btn-list">
                   <a href="{{ route('blog.post') }}" class="btn btn-secondary">Back to Posts</a>
               </div>
           </div>
       </div>
   </div>
</div>

<div class="page-body page-content">
    <div class="container-xl">
        <div class="table-wrapper">
            <div class="card mb-3 table-configuration-wrap" style="display: none;">
                <div class="card-body">
                    <button class="btn btn-icon btn-sm btn-show-table-options rounded-pill" type="button">
                        <svg class="icon icon-sm icon-left svg-icon-ti-ti-x" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M18 6l-12 12" />
                            <path d="M6 6l12 12" />
                        </svg>
                    </button>
                    <div class="wrapper-filter">
                        <p>Filters</p>
                        <form method="GET" action="{{ route('blog.trash') }}" accept-charset="UTF-8" class="filter-form">
                            <div class="row filter-item form-filter filter-item-default">
                                <div class="col-auto">
                                    <div class="mb-3">
                                        <select class="form-select filter-column-key" name="filter_columns[]" required>
                                            <option value="" selected>Select field</option>
                                            <option value="title">Title</option>
                                            <option value="categori">Categories</option>
                                            <option value="author">Author</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <div class="mb-3">
                                        <select class="form-select filter-operator filter-column-operator" name="filter_operators[]">
                                            <option value="like" selected>Contains</option>
                                            <option value="=">Is equal to</option>
                                            <option value=">">Greater than</option>
                                            <option value="<">Less than</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <div class="mb-3">
                                        <input class="form-control filter-column-value" type="text" placeholder="Value"
                                            name="filter_values[]" required>
                                    </div>
                                </div>
                            </div>
                            <div class="btn-list mt-3">
                                <button class="btn btn-primary" type="submit">Apply</button>
                                <a class="btn btn-light" href="{{ route('blog.trash') }}">Reset</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="card has-actions has-filter">
                <div class="card-header">
                    <div class="w-100 justify-content-between d-flex flex-wrap align-items-center gap-1">
                        <div class="d-flex flex-wrap flex-md-nowrap align-items-center gap-1">
                            <button class="btn btn-show-table-options" type="button">Filters</button>
                        </div>
                        <div class="d-flex align-items-center gap-1">
                            <button class="btn" type="button" onclick="location.reload();">
                                <svg class="icon icon-left svg-icon-ti-ti-refresh" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" />
                                    <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" />
                                </svg>
                                Reload
                            </button>
                        </div>
                    </div>
                </div>

                <div class="card-table">
                    <div class="table-responsive table-has-actions table-has-filter">
                        @if($trashedPosts->isEmpty())
                            <div class="text-center mt-4">
                                <p>No trashed posts found.</p>
                            </div>
                        @else
                        <table class="table card-table table-vcenter table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Author</th>
                                    <th>Created At</th>
                                    <th>Deleted At</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($trashedPosts as $item)
                                @php
                                    $images = explode('|', $item->gambar);
                                    $imageSrc = is_array($images) ? $images[0] : $images;
                                @endphp
                                <tr>
                                    <td>{{ $loop->iteration + ($trashedPosts->currentPage() - 1) * $trashedPosts->perPage() }}</td>
                                    <td><img src="{{ $imageSrc }}" width="50" alt="Image"></td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->kategori->nama_kategori ?? '-' }}</td>
                                    <td>{{ $item->user->name ?? '-' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d F Y H:i') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->deleted_at)->format('d F Y H:i') }}</td>
                                    <td class="text-center">
                                        <form action="{{ route('blog.restore', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success" 
                                                data-bs-toggle="tooltip" data-bs-title="Restore"
                                                onclick="return confirm('Restore this post?')">
                                                <svg class="icon svg-icon-ti-ti-restore" xmlns="http://www.w3.org/2000/svg"
                                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path d="M3 7v6h6" />
                                                    <path d="M3 13a9 9 0 1 0 9-9" />
                                                </svg>
                                            </button>
                                        </form>
                                        <form action="{{ route('blog.forceDelete', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                data-bs-toggle="tooltip" data-bs-title="Force Delete"
                                                onclick="return confirm('Force delete permanently?')">
                                                <svg class="icon svg-icon-ti-ti-trash" xmlns="http://www.w3.org/2000/svg"
                                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M4 7h16" />
                                                    <path d="M10 11v6" />
                                                    <path d="M14 11v6" />
                                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                    <path d="M9 7V4h6v3" />
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif
                        <div class="mt-3">
                            {{ $trashedPosts->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
