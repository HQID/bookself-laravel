<!DOCTYPE html>
<html lang="en">
<head>
@include('layouts.head', ['title' => 'Collection - BookSelf App'])
</head>
<body>
    @include('layouts.header')

    <section class="text-2xl py-12 px-16">
        <div class="flex justify-between mb-4 items-center">
            <h2 class="text-3xl text-gray-800 font-bold mb-6">My Collection</h2>
            <button onclick="openModal()" class="text-lg bg-gray-800 text-white rounded-lg px-5 py-3 cursor-pointer font-semibold">Add Book</button>
        </div>
        <div class="flex flex-wrap gap-12">
            @foreach($books as $book)
            <div class="flex items-start rounded-lg shadow-gray-800 shadow-md gap-4 w-96">
                <img src="{{ $book->image_url }}" alt="Book Cover" class="w-32 object-cover rounded-lg">
                <div class="flex flex-col gap-2 flex-1 pl-0 p-4">
                    <div>
                        <p class="text-lg text-gray-400">{{ $book->author }}</p>
                        <h3 class="text-xl font-semibold">{{ $book->title }}</h3>
                    </div>
                    <p class="text-sm line-clamp-4">{{ $book->description }}</p>
                    <button class="text-sm bg-gray-800 text-white rounded-lg px-4 py-2 cursor-pointer self-start">{{ $book->status }}</button>
                    <div class="flex justify-end gap-4 mt-4">
                        <button onclick="editBook({{ $book }})" class="text-lg bg-gray-800 text-white rounded-lg px-4 py-2 cursor-pointer">Edit</button>
                        <form method="POST" action="{{ route('collection.destroy', $book) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-lg bg-red-600 text-white rounded-lg px-4 py-2 cursor-pointer">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <section class="text-2xl py-12 px-16">
        <div class="flex justify-between mb-4 items-center">
            <h2 class="text-3xl text-gray-800 font-bold mb-6">My Review</h2>
            <button onclick="openReviewModal()" class="text-lg bg-gray-800 text-white rounded-lg px-5 py-3 cursor-pointer font-semibold">Add Review</button>
        </div>
        <div class="flex flex-col gap-6">
            @foreach($reviews as $review)
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
                    <div class="flex justify-end gap-4 mt-4">
                        <button onclick="editReview({{ $review }})" class="text-lg bg-gray-800 text-white rounded-lg px-4 py-2 cursor-pointer">Edit</button>
                        @can('delete', $review)
                        <form method="POST" action="{{ route('reviews.destroy', $review) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-lg bg-red-600 text-white rounded-lg px-4 py-2 cursor-pointer">Delete</button>
                        </form>
                        @endcan
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <!-- Add Review Modal -->
    <div id="addReviewModal" class="fixed inset-0 bg-black/50 flex justify-center items-center hidden">
        <div class="bg-white rounded-lg p-6 w-96 shadow-lg">
            <h2 id="reviewModalTitle" class="text-2xl font-semibold mb-4">Add New Review</h2>
            <form id="reviewForm" method="POST" action="{{ route('reviews.store') }}">
                @csrf
                <div class="mb-3">
                    <label class="block text-gray-700">Book</label>
                    <select id="book_id" name="book_id" class="w-full border rounded-lg px-3 py-2" required>
                        @foreach($books as $book)
                            <option value="{{ $book->id }}">{{ $book->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="block text-gray-700">Rating</label>
                    <select id="rating" name="rating" class="w-full border rounded-lg px-3 py-2" required>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="block text-gray-700">Review</label>
                    <textarea id="review" name="review" class="resize-none w-full border rounded-lg px-3 py-2" rows="3" required></textarea>
                </div>
                <div class="flex justify-end gap-3">
                    <button type="button" onclick="closeReviewModal()" class="px-4 py-2 bg-red-600 text-white rounded-lg cursor-pointer">Cancel</button>
                    <button type="submit" id="reviewSubmitButton" class="px-4 py-2 bg-gray-800 cursor-pointer text-white rounded-lg">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Popup Modal -->
    <div id="addBookModal" class="fixed inset-0 bg-black/50 flex justify-center items-center hidden">
        <div class="bg-white rounded-lg p-6 w-96 shadow-lg">
            <h2 id="modalTitle" class="text-2xl font-semibold mb-4">Add New Book</h2>
            <form id="bookForm" method="POST" action="{{ route('collection.store') }}">
                @csrf
                <input type="hidden" id="bookId" name="bookId">
                <div class="mb-3">
                    <label class="block text-gray-700">Title</label>
                    <input type="text" id="title" name="title" class="w-full border rounded-lg px-3 py-2" required>
                </div>
                <div class="mb-3">
                    <label class="block text-gray-700">Author</label>
                    <input type="text" id="author" name="author" class="w-full border rounded-lg px-3 py-2" required>
                </div>
                <div class="mb-3">
                    <label class="block text-gray-700">Description</label>
                    <textarea id="description" name="description" class="resize-none w-full border rounded-lg px-3 py-2" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label class="block text-gray-700">Status</label>
                    <select id="status" name="status" class="w-full border rounded-lg px-3 py-2">
                        <option value="Reading">Reading</option>
                        <option value="Finished">Finished</option>
                    </select>
                </div>
                <div class="flex justify-end gap-3">
                    <button type="button" onclick="closeModal()" class="px-4 py-2 bg-red-600 text-white rounded-lg cursor-pointer">Cancel</button>
                    <button type="submit" id="submitButton" class="px-4 py-2 bg-gray-800 cursor-pointer text-white rounded-lg">Save</button>
                </div>
            </form>
        </div>
    </div>

    @include('layouts.footer')

    <script>
        function openModal() {
            document.getElementById('modalTitle').innerText = 'Add New Book';
            document.getElementById('bookForm').reset();
            document.getElementById('bookId').value = '';
            document.getElementById('bookForm').action = '{{ route('collection.store') }}';
            document.getElementById('submitButton').innerText = 'Add Book';
            document.getElementById('addBookModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('addBookModal').classList.add('hidden');
        }

        function editBook(book) {
            document.getElementById('modalTitle').innerText = 'Edit Book';
            document.getElementById('bookId').value = book.id;
            document.getElementById('title').value = book.title;
            document.getElementById('author').value = book.author;
            document.getElementById('description').value = book.description;
            document.getElementById('status').value = book.status;
            document.getElementById('bookForm').action = '{{ route('collection.update', '') }}/' + book.id;
            document.getElementById('bookForm').method = 'POST';
            document.getElementById('bookForm').insertAdjacentHTML('beforeend', '@method('PATCH')');
            document.getElementById('submitButton').innerText = 'Update Book';
            document.getElementById('addBookModal').classList.remove('hidden');
        }

        function openReviewModal() {
            document.getElementById('reviewModalTitle').innerText = 'Add New Review';
            document.getElementById('reviewForm').reset();
            document.getElementById('reviewForm').action = '{{ route('reviews.store') }}';
            document.getElementById('reviewSubmitButton').innerText = 'Add Review';
            document.getElementById('addReviewModal').classList.remove('hidden');
        }

        function closeReviewModal() {
            document.getElementById('addReviewModal').classList.add('hidden');
        }

        function editReview(review) {
            document.getElementById('reviewModalTitle').innerText = 'Edit Review';
            document.getElementById('book_id').value = review.book_id;
            document.getElementById('rating').value = review.rating;
            document.getElementById('review').value = review.review;
            document.getElementById('reviewForm').action = '{{ route('reviews.update', '') }}/' + review.id;
            document.getElementById('reviewForm').method = 'POST';
            document.getElementById('reviewForm').insertAdjacentHTML('beforeend', '@method('PATCH')');
            document.getElementById('reviewSubmitButton').innerText = 'Update Review';
            document.getElementById('addReviewModal').classList.remove('hidden');
        }

        document.getElementById('bookForm').addEventListener('submit', function(event) {
            alert('Book saved successfully!');
            closeModal();
        });
    </script>
</body>
</html>