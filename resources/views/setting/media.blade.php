@extends('layouts.vertical', ['title' => 'Media', 'sub_title' => 'Apps', 'mode' => $mode ?? '', 'demo' => $demo ??
''])

@section('content')
<div class="flex flex-col gap-6">
    <div class="card">
        <div class="p-6">
            <form action="{{ route('media.store') }}" method="POST">
                @csrf
            <div class="grid lg:grid-cols-3 gap-6 mb-3">
                @foreach ($media as $item)
                <div>
                    <label for="simpleinput"
                        class="text-gray-800 text-sm font-medium inline-block mb-2">Faceboox</label>
                    <input type="text" class="form-input" name="facebook" value="{{ $item->facebook }}">
                </div>
                <div>
                    <label for="simpleinput"
                        class="text-gray-800 text-sm font-medium inline-block mb-2">Instagram</label>
                    <input type="text" class="form-input" name="instagram" value="{{ $item->instagram }}">
                </div>
                <div>
                    <label for="simpleinput" class="text-gray-800 text-sm font-medium inline-block mb-2">Tiktok</label>
                    <input type="text" class="form-input" name="tiktok" value="{{ $item->tiktok }}">
                </div>
                <div>
                    <label for="simpleinput" class="text-gray-800 text-sm font-medium inline-block mb-2">Twitter</label>
                    <input type="text" class="form-input" name="twitter" value="{{ $item->twitter }}">
                </div>
                <div>
                    <label for="simpleinput" class="text-gray-800 text-sm font-medium inline-block mb-2">Youtube</label>
                    <input type="text" class="form-input" name="youtube" value="{{ $item->youtube }}">
                </div>
            </div>
            @endforeach
            <button type="submit"
                class="btn btn-sm border-primary text-primary hover:bg-primary hover:text-white">Save</button>
            </form>
        </div>
    </div>
</div>

@endsection

@section('script')
@vite('resources/js/pages/apps-calendar.js')
@endsection
