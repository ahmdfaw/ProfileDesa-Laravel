@extends('layouts.admin')

@section('title', 'Pesan Kontak')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Pesan Kontak</h1>
        <p class="text-gray-600">Daftar pesan yang dikirim melalui formulir kontak</p>
    </div>

    @if (session('success'))
        <div class="mb-4 rounded-lg bg-green-50 p-4 text-green-800">
            {{ session('success') }}
        </div>
    @endif

    <div class="space-y-4">
        @forelse ($contacts as $contact)
            <div
                class="overflow-hidden rounded-lg bg-white shadow {{ !$contact->is_read ? 'border-l-4 border-blue-500' : '' }}">
                <div class="p-6">
                    <div class="mb-4 flex items-start justify-between">
                        <div class="flex-1">
                            <div class="mb-1 flex items-center">
                                <h3 class="text-lg font-semibold text-gray-900">{{ $contact->name }}</h3>
                                @if (!$contact->is_read)
                                    <span
                                        class="ml-2 rounded-full bg-blue-100 px-2 py-1 text-xs font-semibold text-blue-800">
                                        Baru
                                    </span>
                                @endif
                            </div>
                            <p class="text-sm text-gray-600">{{ $contact->email }}</p>
                            <p class="mt-1 text-sm text-gray-500">{{ $contact->created_at->format('d F Y, H:i') }}</p>
                        </div>
                        <div class="flex space-x-2">
                            @if (!$contact->is_read)
                                <form action="{{ route('admin.contacts.mark-read', $contact->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                        class="rounded bg-blue-600 px-3 py-1 text-sm text-white hover:bg-blue-700">
                                        Tandai Dibaca
                                    </button>
                                </form>
                            @endif
                            <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="rounded bg-red-600 px-3 py-1 text-sm text-white hover:bg-red-700">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="mb-3 rounded-lg bg-gray-50 p-3">
                        <p class="text-sm font-semibold text-gray-700">Subjek:</p>
                        <p class="text-gray-900">{{ $contact->subject }}</p>
                    </div>

                    <div class="rounded-lg bg-gray-50 p-3">
                        <p class="text-sm font-semibold text-gray-700">Pesan:</p>
                        <p class="whitespace-pre-line text-gray-900">{{ $contact->message }}</p>
                    </div>
                </div>
            </div>
        @empty
            <div class="rounded-lg bg-white p-12 text-center shadow">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                <p class="mt-2 text-gray-500">Belum ada pesan kontak.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $contacts->links() }}
    </div>
@endsection
