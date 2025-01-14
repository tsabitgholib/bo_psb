@extends('layout')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-blue-50">
    <div class="border-4 border-blue-500 p-8 rounded-lg bg-white shadow-2xl">
        <h1 class="text-2xl font-bold mb-6 text-center text-blue-700">Manage Media</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach(range(1, 5) as $mediaNum)
                @php $mediaKey = 'media_' . $mediaNum; @endphp
                <div class="flex flex-col items-center border-4 border-blue-500 p-6 rounded-lg bg-blue-100 shadow-lg">
                    <div class="border-4 border-blue-500 w-40 h-56 mb-6 bg-white">
                        @if($media && $media->$mediaKey)
                            <img src="{{ $media->$mediaKey }}" alt="Media {{ $mediaNum }}" class="w-full h-full object-cover">
                        @endif
                    </div>
                    <div class="text-center text-blue-700">
                        @if($media && $media->$mediaKey)
                            {{-- Form Hapus --}}
                            <form action="{{ route('media.delete', $media->id) }}" method="POST" onsubmit="return confirmDelete(event, '{{ $mediaKey }}')">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="media_key" value="{{ $mediaKey }}">
                                <button type="submit" class="bg-red-500 text-white px-6 py-2 rounded mb-2">Hapus</button>
                            </form>
                            {{-- Tombol Upload/Edit --}}
                            <form action="{{ route('media.upload') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="media_key" value="{{ $mediaKey }}">
                                <input type="file" name="file" id="media_{{ $mediaNum }}" class="hidden" onchange="this.form.submit(); showUploadSuccess()">
                                <button type="button" class="bg-blue-500 text-white px-6 py-2 rounded mb-2" onclick="document.getElementById('media_{{ $mediaNum }}').click()">Upload/Edit</button>
                            </form>
                        @else
                            {{-- Form Upload Baru --}}
                            <form action="{{ route('media.upload') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="media_key" value="{{ $mediaKey }}">
                                <input type="file" name="file" id="media_{{ $mediaNum }}" class="hidden" onchange="this.form.submit(); showUploadSuccess()">
                                <button type="button" class="bg-blue-500 text-white px-6 py-2 rounded mb-2" onclick="document.getElementById('media_{{ $mediaNum }}').click()">Upload</button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div id="deleteModal" class="fixed inset-0 bg-gray-500 bg-opacity-50 hidden justify-center items-center">
    <div class="bg-white p-8 rounded-lg shadow-lg w-96">
        <h2 class="text-lg font-bold text-center text-blue-700">Are you sure you want to delete this media?</h2>
        <div class="flex justify-between mt-4">
            <button class="bg-red-500 text-white px-4 py-2 rounded" onclick="closeModal()">Cancel</button>
            <button id="confirmDeleteBtn" class="bg-blue-500 text-white px-4 py-2 rounded">Yes, delete</button>
        </div>
    </div>
</div>

<!-- Modal Pemberitahuan Upload Berhasil -->
<div id="uploadSuccessModal" class="fixed inset-0 bg-gray-500 bg-opacity-50 hidden justify-center items-center">
    <div class="bg-white p-8 rounded-lg shadow-lg w-96">
        <h2 class="text-lg font-bold text-center text-blue-700">Media uploaded successfully!</h2>
        <button class="bg-blue-500 text-white px-4 py-2 rounded mt-4" onclick="closeModal('uploadSuccessModal')">Close</button>
    </div>
</div>

@endsection

@section('scripts')
<script>
    // Menampilkan Modal Konfirmasi Hapus
    function confirmDelete(event, mediaKey) {
        event.preventDefault();
        document.getElementById('deleteModal').classList.remove('hidden');
        document.getElementById('confirmDeleteBtn').onclick = function() {
            event.target.submit(); // Submit form untuk menghapus media
        };
    }

    // Menutup Modal
    function closeModal(modalId = 'deleteModal') {
        document.getElementById(modalId).classList.add('hidden');
    }

    // Menampilkan Modal Pemberitahuan Upload Berhasil
    function showUploadSuccess() {
        setTimeout(function() {
            document.getElementById('uploadSuccessModal').classList.remove('hidden');
        }, 500); // Delay sedikit agar modal tidak langsung muncul saat upload
    }

</script>
@endsection
