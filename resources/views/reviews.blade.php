<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.head', ['title' => 'Reviews - BookSelf App'])
</head>
<body>
    @include('layouts.header')

    <section class="flex flex-col gap-2 text-2xl py-12 px-16">
        <h2 class="text-3xl text-gray-800 font-bold mb-6">User Reviews</h2>
        <div class="flex flex-col gap-6">
            @foreach($reviews->sortByDesc('created_at') as $review)
            <div class="flex items-start rounded-lg shadow-gray-800 shadow-md gap-4 p-6 bg-white">
                <img src="{{ $review->book->image_url }}" alt="Book Cover" class="w-32 object-cover rounded-lg">
                <div class="flex flex-col gap-2 flex-1">
                    <div>
                        <h3 class="text-lg font-semibold">{{ $review->book->title }}</h3>
                        <p class="text-sm text-gray-500">By {{ $review->user->name }} - {{ $review->created_at->diffForHumans() }}</p>
                    </div>
                    <div class="text-yellow-500">
                        @for ($i = 0; $i < $review->rating; $i++)
                            ★
                        @endfor
                    </div>
                    <p class="mt-4 text-gray-700">{{ $review->review }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    @include('layouts.footer')
</body>
</html>
