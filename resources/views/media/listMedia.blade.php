<!-- resources/views/admin/media/list.blade.php -->
@extends('layout')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Daftar Media yang Telah Diupload</h1>

    @if($media->isEmpty())
        <p class="text-gray-500">Belum ada media yang di-upload.</p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($media as $item)
            <div class="border p-4 rounded-lg shadow-md">
                <h3 class="font-bold text-lg">Media {{ $loop->iteration }}</h3>
                @foreach (['media_1', 'media_2', 'media_3', 'media_4', 'media_5'] as $key)
                    @if($item->$key)
                        <div class="mt-2">
                            <strong>{{ ucfirst(str_replace('_', ' ', $key)) }}:</strong>
                            <img src="{{ $item->$key }}" alt="{{ $key }}" class="w-full h-auto">
                            <form action="{{ route('media.delete', $item->id) }}" method="POST" class="mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-6 py-2 rounded">Hapus</button>
                            </form>
                        </div>
                    @endif
                @endforeach
            </div>
        @endforeach
        </div>
    @endif
</div>
@endsection
