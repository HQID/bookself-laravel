<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <link rel="shortcut icon" href="{{ asset('bookself.png') }}" type="image/x-icon">
    <title>Login - BookSelf App</title>
</head>
<body>
    <section class="flex items-center justify-center bg-gray-100 h-[100vh]">
        <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md">
            <h2 class="text-2xl font-bold mb-6 text-gray-800 text-center">Login to BookSelf</h2>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Email</label>
                    <input type="email" id="email" name="email" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-800" required>
                </div>
                <div class="mb-6">
                    <label for="password" class="block text-gray-700">Password</label>
                    <input type="password" id="password" name="password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-800" required>
                </div>
                <button type="submit" class="w-full py-2 px-4 bg-gray-800 text-white rounded-lg hover:bg-gray-900 transition-all ease-in-out duration-300 cursor-pointer">Login</button>
            </form>
            <p class="mt-4 text-center text-gray-600">Don't have an account? <a href="{{ route('register') }}" class="text-gray-800 hover:underline">Register</a></p>
        </div>
    </section>
</body>
</html>
