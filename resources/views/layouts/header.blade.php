<header>
    <nav class="flex py-4 px-8 bg-gray-800 text-white justify-between text-xl items-center">
        <h1 class="text-2xl font-semibold">BookSelf</h1>
        <ul class="flex gap-12 justify-center items-center">
            <li class="cursor-pointer hover:text-gray-400 transition"><a href="/">Home</a></li>
            <li class="cursor-pointer hover:text-gray-400 transition"><a href="/reviews">Reviews</a></li>
            <li class="cursor-pointer hover:text-gray-400 transition"><a href="/collection">Collection</a></li>
        </ul>
        <div class="flex gap-6">
            @auth
                <div class="relative">
                    <span class="cursor-pointer">{{ Auth::user()->name }}</span>
                    <button onclick="toggleDropdown()" class="ml-2 py-2 px-4 rounded-xl border-2 hover:bg-gray-900 transition-all ease-in-out duration-300 cursor-pointer">▼</button>
                    <div id="dropdown" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-2 z-20 hidden">
                        <!-- <a href="/profile" class="block px-4 py-2 text-gray-800 hover:bg-gray-200 cursor-pointer">Edit Profile</a> -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-gray-800 hover:bg-gray-200 cursor-pointer">Logout</button>
                        </form>
                    </div>
                </div>
            @else
                <a href="/login"><button class="py-2 px-4 rounded-xl border-2 hover:bg-gray-900 transition-all ease-in-out duration-300 cursor-pointer">Login</button></a>
                <a href="/register"><button class="py-2 px-4 rounded-xl border-2 bg-white text-gray-800 hover:bg-gray-200 transition-all ease-in-out duration-300 cursor-pointer">Signup</button></a>
            @endauth
        </div>
    </nav>
</header>
<script>
    function toggleDropdown() {
        var dropdown = document.getElementById('dropdown');
        dropdown.classList.toggle('hidden');
    }
</script>
