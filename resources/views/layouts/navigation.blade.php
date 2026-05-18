<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between h-16">

            <!-- LEFT MENU -->
            <div class="flex">

                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="/dashboard">
                        <b>INVENTORY APP</b>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:flex sm:ml-10">

                    <a href="/dashboard" class="text-gray-700 hover:text-blue-500">
                        Dashboard
                    </a>

                    <a href="/items" class="text-gray-700 hover:text-blue-500">
                        Data Barang
                    </a>

                    <a href="/loans" class="text-gray-700 hover:text-blue-500">
                        Peminjaman
                    </a>

                </div>
            </div>

            <!-- RIGHT MENU -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">

                <div class="ml-3 relative">
                    <div>
                        <span>{{ Auth::user()->name }}</span>
                    </div>

                    <div class="mt-2">
                        <a href="/profile">Profile</a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit">Logout</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</nav>