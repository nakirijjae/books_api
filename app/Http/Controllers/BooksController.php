<?php

//declare (strict_types=1);

namespace App\Http\Controllers;

use App\User;
use App\Book;
use App\BookReview;
use App\Http\Requests\PostBookRequest;
use App\Http\Requests\PostBookReviewRequest;
use App\Http\Resources\BookResource;
use App\Http\Resources\BookReviewResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\QueryBuilder;

class BooksController extends Controller
{
    public function getCollection(Request $request)
    {
      //$avg_reviews = BookResource::collection(Book::class)->avgReviews()->get();
      //$collection = BookResource::collection(Book::paginate(5));
      $collection = BookResource::collection(
        // GET /books?sort=-title
        QueryBuilder::for(Book::class)
        ->join('book_reviews', 'book_reviews.book_id', '=', 'books.id')
        ->select(DB::raw('description, isbn, title, books.id, avg(book_reviews.review) as avg_reviews'))
        ->groupBy('books.title', 'books.id', 'books.isbn', 'books.description')
        ->allowedSorts([
          'title','books.id','avg_reviews'
        ])
        ->allowedFilters('name')
        ->get()
      );

      return $collection;
    }

    public function post(PostBookRequest $request)
    {

        // @TODO implement

    }

    public function postReview(int $bookId, PostBookReviewRequest $request)
    {

        // @TODO implement


    }
}
