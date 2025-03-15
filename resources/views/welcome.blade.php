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
                <a href="/login"><button class="py-2 px-4 rounded-xl border-2 hover:bg-gray-900 transition-all ease-in-out duration-300 cursor-pointer">Login</button></a>
                <button class="py-2 px-4 rounded-xl border-2 bg-white text-gray-800 hover:bg-gray-200 transition-all ease-in-out duration-300 cursor-pointer">Signup</button>
            </div>
        </nav>
    </header>

    <section class="text-xl">
        <div class="relative bg-cover bg-center h-[90vh]" style="background-image: url('https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')">
            <div class="absolute inset-0 bg-black opacity-20"></div>
            <div class="absolute inset-0 flex items-center justify-center flex-col">
                <h1 class="text-white text-4xl font-bold">Welcome to BookSelf</h1>
                <p class="text-white text-center mt-4 max-w-2xl">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione necessitatibus possimus repellendus ipsam. Aspernatur quaerat iure, ducimus in ab eaque.</p>
            </div>
        </div>
    </section>
</body>
</html>