<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') - {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">
    @auth
        <!-- Admin Sidebar -->
        <div class="flex h-screen">
            <!-- Sidebar -->
            <div class="w-64 bg-gray-800 text-white">
                <div class="p-4">
                    <h1 class="text-xl font-bold">Admin Panel</h1>
                </div>
                <nav class="mt-4">
                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 hover:bg-gray-700">Dashboard</a>
                    <a href="{{ route('admin.news.index') }}" class="block px-4 py-2 hover:bg-gray-700">Berita</a>
                    <a href="{{ route('admin.officials.index') }}"
                        class="block px-4 py-2 hover:bg-gray-700">Pemerintahan</a>
                    <a href="{{ route('admin.services.index') }}" class="block px-4 py-2 hover:bg-gray-700">Layanan</a>
                    <a href="{{ route('admin.galleries.index') }}" class="block px-4 py-2 hover:bg-gray-700">Galeri</a>
                    <a href="{{ route('admin.contacts.index') }}" class="block px-4 py-2 hover:bg-gray-700">Pesan</a>
                    <a href="{{ route('admin.profile.edit') }}" class="block px-4 py-2 hover:bg-gray-700">Profil Desa</a>
                    <form method="POST" action="{{ route('admin.logout') }}" class="px-4 py-2">
                        @csrf
                        <button type="submit" class="w-full text-left hover:text-red-400">Logout</button>
                    </form>
                </nav>
            </div>

            <!-- Main Content -->
            <div class="flex-1 overflow-y-auto">
                <div class="p-8">
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                            {{ session('error') }}
                        </div>
                    @endif

                    @yield('content')
                </div>
            </div>
        </div>
    @else
        @yield('content')
    @endauth
</body>

</html>
