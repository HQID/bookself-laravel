<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <title>BookSelf App</title>
</head>
<body>
    <header>
        <nav class="flex py-4 px-8 bg-gray-800 text-white justify-between text-xl items-center">
            <h1 class="text-2xl font-semibold">BookSelf</h1>
            <ul class="flex gap-12 justify-center items-center">
                <li class="cursor-pointer hover:text-gray-400 transition"><a href="/">Home</a></li>
                <li class="cursor-pointer hover:text-gray-400 transition"><a href="/about">About</a></li>
                <li class="cursor-pointer hover:text-gray-400 transition"><a href="/collection">Collection</a></li>
            </ul>
            <div class="flex gap-6">
                @auth
                    <div class="relative">
                        <span class="cursor-pointer">{{ Auth::user()->name }}</span>
                        <button onclick="toggleDropdown()" class="ml-2 py-2 px-4 rounded-xl border-2 hover:bg-gray-900 transition-all ease-in-out duration-300 cursor-pointer">▼</button>
                        <div id="dropdown" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-2 z-20 hidden">
                            <a href="/profile" class="block px-4 py-2 text-gray-800 hover:bg-gray-200 cursor-pointer">Edit Profile</a>
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

    <section class="text-xl shadow-gray-800 shadow-sm">
        <div class="relative bg-cover bg-center h-[90vh]" style="background-image: url('https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')">
            <div class="absolute inset-0 bg-black opacity-20"></div>
            <div class="absolute inset-0 flex items-center justify-center flex-col">
                <h1 class="text-white text-4xl font-bold">Welcome to BookSelf</h1>
                <p class="text-white text-center mt-4 max-w-2xl">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione necessitatibus possimus repellendus ipsam. Aspernatur quaerat iure, ducimus in ab eaque.</p>
            </div>
        </div>
    </section>

    <section class="flex flex-col gap-2 text-2xl py-12 px-16">
        <h2 class="text-3xl text-gray-800 font-bold mb-6">My Books</h2>
        <div class="flex flex-wrap gap-12">
            @foreach($books->take(5) as $book)
            <div class="w-52 rounded-lg shadow-gray-800 shadow-md">
                <img src="{{ $book->image_url }}" alt="Book Cover" class="object-cover rounded-lg w-full">
                <div class="flex flex-col gap-6 p-4">
                    <h3 class="text-xl font-semibold">{{ $book->title }}</h3>
                    <button class="text-lg bg-gray-800 text-white rounded-lg px-4 py-2 self-end cursor-pointer">{{ $book->status }}</button>
                </div>
            </div>
            @endforeach
        </div>
        <a href="/collection" class="self-end"><button class="py-2 px-4 rounded-xl bg-gray-800 text-white hover:bg-gray-900 transition-all ease-in-out duration-300 cursor-pointer mt-8 ">More...</button></a>
    </section>

    <footer class="bg-gray-800 text-white pt-12 pb-4 px-8 mt-12">
        <div class="container mx-auto flex flex-col md:flex-row justify-between items-center mb-12">
            <div class="mb-4 md:mb-0">
                <h2 class="text-3xl font-semibold">BookSelf</h2>
                <p class="text-gray-400 text-md mt-2">Read, Share, and Enjoy Your Favorite Books.</p>
            </div>
            
            <nav class="flex flex-col gap-4 text-lg">
                <a href="/" class="hover:text-gray-400 transition">Home</a>
                <a href="/about" class="hover:text-gray-400 transition">About</a>
                <a href="/collection" class="hover:text-gray-400 transition">Collection</a>
            </nav>

            <div class="flex gap-6 mt-4 md:mt-0">
                <a href="#" class="hover:text-gray-400 transition">
                    <i class="fa-brands fa-facebook text-2xl"></i>
                </a>
                <a href="#" class="hover:text-gray-400 transition">
                    <i class="fa-brands fa-twitter text-2xl"></i>
                </a>
                <a href="#" class="hover:text-gray-400 transition">
                    <i class="fa-brands fa-instagram text-2xl"></i>
                </a>
            </div>
        </div>

        <div class="border-t border-gray-700 mt-6 pt-4 text-center text-gray-400 text-sm">
            &copy; <?php echo date('Y'); ?> BookSelf. All rights reserved.
        </div>
    </footer>

    <script>
        function toggleDropdown() {
            var dropdown = document.getElementById('dropdown');
            dropdown.classList.toggle('hidden');
        }
    </script>
</body>
</html>