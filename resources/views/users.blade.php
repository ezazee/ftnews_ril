@extends('layouts.vertical', [
    'title' => 'User Profile',
    'sub_title' => 'Update Profile',
])

@section('content')

<div class="card">
    <div class="p-6">
        <form action="{{ route('updateprofile', $user->id) }}" method="POST" class="flex flex-col gap-3">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-4 items-center gap-6">
                <label for="inputUsername" class="text-gray-800 text-sm font-medium inline-block mb-2">Nama Lengkap</label>
                <div class="md:col-span-3">
                    <input type="text" class="form-input" name="name" placeholder="Nama Lengkap" value="{{ old('name', $user->name) }}">
                </div>
            </div>
            <div class="grid grid-cols-4 items-center gap-6">
                <label for="inputPassword3" class="text-gray-800 text-sm font-medium inline-block mb-2">Password</label>
                <div class="md:col-span-3">
                    <input type="password" class="form-input" name="password" placeholder="Password (leave blank to keep current)">
                </div>
            </div>
            <div class="grid grid-cols-4 items-center gap-6">
                <label for="inputPassword5" class="text-gray-800 text-sm font-medium inline-block mb-2">Re Password</label>
                <div class="md:col-span-3">
                    <input type="password" class="form-input" name="password_confirmation" placeholder="Retype Password (optional)">
                </div>
            </div>
            <div class="grid grid-cols-4 items-center gap-6">
                <div class="md:col-start-2">
                    <button type="submit" class="btn bg-info text-white">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>


@endsection
