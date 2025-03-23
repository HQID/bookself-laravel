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
                <li class="cursor-pointer"><a href="/">Home</a></li>
                <li class="cursor-pointer"><a href="/about">About</a></li>
                <li class="cursor-pointer"><a href="/collection">Collection</a></li>
            </ul>
            <div class="flex gap-6">
                @auth
                    <div class="relative">
                        <span class="cursor-pointer">{{ Auth::user()->name }}</span>
                        <button onclick="toggleDropdown()" class="ml-2 py-2 px-4 rounded-xl border-2 hover:bg-gray-900 transition-all ease-in-out duration-300 cursor-pointer">▼</button>
                        <div id="dropdown" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-2 z-20 hidden">
                            <a href="/profile" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Edit Profile</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-gray-800 hover:bg-gray-200">Logout</button>
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

    <section class="text-2xl py-12 px-16">
        <div class="flex justify-between mb-4 items-center">
            <h2 class="text-3xl text-gray-800 font-bold mb-6">My Collection</h2>
                <button onclick="openModal()" class="text-lg bg-gray-800 text-white rounded-lg px-5 py-3 cursor-pointer font-semibold">Add Book</button>
            </div>
        <div class="flex flex-wrap gap-12">
            <div class="flex items-start rounded-lg shadow-gray-800 shadow-md gap-4 w-96">
                <img src="https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1516602134i/36393774.jpg" 
                    alt="Book Cover" class="w-32 object-cover rounded-lg">
                <div class="flex flex-col gap-2 flex-1 pl-0 p-4">
                    <div>
                        <p class="text-lg text-gray-400">Tere liye</p>
                        <h3 class="text-xl font-semibold">Laut Bercerita</h3>
                    </div>
                    <p class="text-sm line-clamp-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque optio commodi exercitationem. Error corporis laborum tempora beatae.</p>
                    <button class="text-sm bg-gray-800 text-white rounded-lg px-4 py-2 cursor-pointer self-start">Reading</button>
                    <div class="flex justify-end gap-4 mt-4">
                        <button class="text-lg bg-gray-800 text-white rounded-lg px-4 py-2 cursor-pointer">Edit</button>
                        <button class="text-lg bg-red-600 text-white rounded-lg px-4 py-2 cursor-pointer">Delete</button>
                    </div>
                </div>
            </div>
    </section>

    <!-- Popup Modal -->
    <div id="addBookModal" class="fixed inset-0 bg-black/50 flex justify-center items-center hidden">
        <div class="bg-white rounded-lg p-6 w-96 shadow-lg">
            <h2 class="text-2xl font-semibold mb-4">Add New Book</h2>
            <form id="bookForm">
                <div class="mb-3">
                    <label class="block text-gray-700">Title</label>
                    <input type="text" id="title" class="w-full border rounded-lg px-3 py-2" required>
                </div>
                <div class="mb-3">
                    <label class="block text-gray-700">Author</label>
                    <input type="text" id="author" class="w-full border rounded-lg px-3 py-2" required>
                </div>
                <div class="mb-3">
                    <label class="block text-gray-700">Description</label>
                    <textarea id="description" class="resize-none w-full border rounded-lg px-3 py-2" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label class="block text-gray-700">Status</label>
                    <select id="status" class="w-full border rounded-lg px-3 py-2">
                        <option value="Reading">Reading</option>
                        <option value="Finished">Finished</option>
                    </select>
                </div>
                <div class="flex justify-end gap-3">
                    <button type="button" onclick="closeModal()" class="px-4 py-2 bg-red-600 text-white rounded-lg cursor-pointer">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-gray-800 cursor-pointer text-white rounded-lg">Add</button>
                </div>
            </form>
        </div>
    </div>

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

        function openModal() {
            document.getElementById('addBookModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('addBookModal').classList.add('hidden');
        }

        document.getElementById('bookForm').addEventListener('submit', function(event) {
            event.preventDefault();
            alert('Book added successfully!');
            closeModal();
        });
    </script>
</body>
</html>