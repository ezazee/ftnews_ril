@extends('layouts.vertical', ['title' => 'Post Edit', 'sub_title' => 'Post', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])
@section('css')
    <link href="{{ asset('assets/css/quill.snow.css') }}" rel="stylesheet">
@endsection
<style>
    .dropzone {
        position: relative;
        overflow: hidden;
    }
    .dropzone img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover; 
    }
    #tags-container {
    max-height: calc(5 * 2.5rem);
    overflow-y: auto;
    border: 1px solid #ddd;
    padding: 0.5rem;
    border-radius: 0.25rem;
    }

    .tag-item {
        margin-bottom: 0.5rem;
    }
</style>
@section('content')
@include('sweetalert::alert')
<form action="{{ route('list.update', $post->id) }}" method="POST" enctype="multipart/form-data" id="contentForm" class="grid lg:grid-cols-4 gap-6">
    @csrf
    @method('PUT')

    <div class="col-span-1 flex flex-col gap-6">
        <label for="imageUpload">Featured Image</label>
        <div class="text-gray-700" id="imageDropzone">
            <div class="fallback">
                <input id="imageUpload" name="images[]" type="file" multiple="multiple">
            </div>
             <div class="card p-6">
                <div id="imagePreview" class="mt-2 d-flex flex-wrap justify-content-center">
                    <img src="{{ asset('storage/' . $post->gambar) }}" alt="Existing Image" class="img-thumbnail m-2 img-fluid" style="max-width: 100%; height: auto; object-fit: cover;">
                </div>
            </div>   
        </div>
        <div class="card p-6">
            <div class="flex flex-col">
                <label for="image_caption" class="mb-2 block">Image Caption</label>
                <input type="text" name="image_caption" id="image_caption" class="form-input mb-3" 
                       placeholder="Enter Image Caption" value="{{ old('image_caption', $post->image_caption) }}">
                @error('image_caption')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>        

        <div class="card p-6">
            <div class="flex flex-col gap-3">
                <div class="">
                    <label for="select-label-category" class="mb-2 block">Category</label>
                    <select id="select-label-category" name="category_id" class="form-select" required>
                        <option value="">Select</option>
                        @foreach ($categori as $category)
                            <option value="{{ $category->id }}" {{ $post->kategori_id == $category->id ? 'selected' : '' }}>
                                {{ $category->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="">
                    <label for="select-label-subcategory" class="mb-2 block">Subcategory</label>
                    <select id="select-label-subcategory" name="subcategory_id" class="form-select" {{ $post->sub_category_id ? '' : 'disabled' }}>
                        <option value="">Select Subcategory</option>
                    </select>
                    <div class="flex mt-3">
                        <input type="checkbox" name="headline" value="yes" class="form-checkbox"
                            {{ $post->headline === 'yes' ? 'checked' : '' }}>
                        <label for="yes" class="text-sm text-gray-500 ms-2 dark:text-gray-400">Headline</label>
                    </div>                    
                    @error('subcategory_id')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="card p-6">
            <div class="flex flex-col gap-3">
                <label for="tags" class="text-sm font-semibold">Tags</label>
                <input type="text" name="tags" id="tags" class="form-input" placeholder="Enter Tags" 
                       value="{{ isset($post) ? implode(',', $post->tags->pluck('nama_tags')->toArray()) : '' }}">
            </div>
        </div>
    </div>

    <div class="lg:col-span-3 space-y-6">
        <div class="card p-6">
            <div class="flex justify-between items-center mb-4">
                <p class="card-title">Update Detail Content</p>
                <div class="inline-flex items-center justify-center rounded-lg bg-slate-100 dark:bg-slate-700 w-9 h-9">
                    <i class="mgc_transfer_line"></i>
                </div>
            </div>

            <div class="flex flex-col gap-3">
                <div class="">
                    <label for="title" class="mb-2 block">Title</label>
                    <input type="text" id="title" name="title" class="form-input" placeholder="Enter Title" value="{{ old('title', $post->title) }}" aria-describedby="input-helper-text">
                </div>

                <div class="card">
                    <div class="p-6">
                        <label for="editor-content" class="mb-2 block">Content</label>
                        <input type="hidden" id="editor-content" name="content" value="{{ old('content', $post->content) }}">
                        <div id="snow-editor" style="height: 300px;"></div>
                    </div>
                    <label for="video-url" class="mt-4 block">Video URL</label>
                    <input type="text" id="video-url" class="border p-2 w-full" placeholder="Paste video URL di sini">
                    <button type="button" class="bg-blue-500 text-white p-2 mt-2 mb-3" onclick="insertVideo()">
                        Insert Video
                    </button>
                
                    <!-- Container to show generated embed link -->
                    <div id="embed-container" class="mt-4">
                        <label for="embed-url" class="block">Generated Embed URL:</label>
                        <input type="text" id="embed-url" class="border p-2 w-full" readonly>
                        <button type="button" class="bg-green-500 text-white p-2 mt-2" onclick="copyEmbedUrl()">
                            Copy Embed URL
                        </button>
                    </div>
                </div>

                
<div class="">
                    <label for="status" class="mb-3 block">Status <span class="text-red-500">*</span></label>
                    <div class="flex gap-x-6">
                        <div class="flex">
                            <input type="radio" name="status" value="public" class="form-radio" id="public" {{ old('status', $post->status) == 'public' ? 'checked' : '' }}>
                            <label for="public" class="text-lg text-gray-500 ms-2 dark:text-gray-400">Public</label>
                        </div>
                
                        <div class="flex">
                            <input type="radio" name="status" value="schedule" class="form-radio" id="schedule" {{ old('status', $post->status) == 'schedule' ? 'checked' : '' }}>
                            <label for="schedule" class="text-lg text-gray-500 ms-2 dark:text-gray-400">Schedule</label>
                        </div>
                
                        <div class="flex">
                            <input type="radio" name="status" value="private" class="form-radio" id="private" {{ old('status', $post->status) == 'private' ? 'checked' : '' }}>
                            <label for="private" class="text-lg text-gray-500 ms-2 dark:text-gray-400">Private</label>
                        </div>
                    </div>
                </div>
                
                <div id="schedule-fields" class="grid md:grid-cols-2 gap-3" style="display: none;">
                    <div class="">
                        <label for="start-date" class="mb-2 block">Start Date</label>
                        <input type="date" id="start-date" name="start_date" class="form-input" value="{{ old('start_date', $post->start_date) }}">
                    </div>
                    <div class="">
                        <label for="start-time" class="mb-2 block">Start Time</label>
                        <input type="time" id="start-time" name="start_time" class="form-input" value="{{ old('start_time', $post->start_time) }}">
                    </div>
                </div>
            </div>
        </div>

        <!-- SEO Section -->
        <div class="card p-6">
            <div class="flex justify-between items-center mb-4">
                <p class="card-title">SEO</p>
            </div>

            <div class="flex flex-col gap-3">
                <div class="">
                    <label for="keyword" class="mb-2 block">Keyword</label>
                    <input type="text" id="keyword" name="keyword" class="form-input" value="{{ old('keyword', $post->keyword) }}" aria-describedby="input-helper-text">
                </div>

                <div class="">
                    <label for="description" class="mb-2 block">Description</label>
                    <input type="text" id="description" name="description" class="form-input" value="{{ old('description', $post->description) }}" aria-describedby="input-helper-text">
                </div>
            </div>
        </div>
        <a href="{{ route('list.create') }}" class="inline-flex items-center rounded-md border border-transparent bg-red-500 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-red-600 focus:outline-none">
            Cancel
        </a>
        <button type="submit" class="inline-flex items-center rounded-md border border-transparent bg-green-500 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-green-600 focus:outline-none">
            Save
        </button>
    </div>
</form>


@endsection

@section('script')
@include('layouts.script-edit')
@endsection
