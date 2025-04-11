<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <link rel="shortcut icon" href="{{ asset('bookself.png') }}" type="image/x-icon">
    <title>BookSelf App</title>
</head>
<body>
    @include('layouts.header')

    <section class="text-xl shadow-gray-800 shadow-sm">
        <div class="relative bg-cover bg-center h-[90vh]" style="background-image: url('https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')">
            <div class="absolute inset-0 bg-black opacity-20"></div>
            <div class="absolute inset-0 flex items-center justify-center flex-col">
                <h1 class="text-white text-4xl font-bold">Welcome to BookSelf</h1>
                <p class="text-white text-center mt-4 max-w-2xl">Every book holds a story, and every reader brings a unique perspective. Write your reviews, share your inspiration, and build a collection that reflects who you are.</p>
            </div>
        </div>
    </section>

    <section class="flex flex-col gap-2 text-2xl py-12 px-16">
        <h2 class="text-3xl text-gray-800 font-bold mb-6">My Books</h2>
        <div class="flex flex-wrap gap-12">
            @foreach($books->where('user_id', Auth::id())->take(5) as $book)
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

    @include('layouts.footer')
</body>
</html>