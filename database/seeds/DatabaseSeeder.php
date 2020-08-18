<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users = factory(App\User::class, 5)->create();
        $admin = factory(App\User::class, 1)->state('admin')->create();

        factory(App\Author::class, 15)->create()->each(function (App\Author $author) {
            factory(App\Book::class, 3)->create()->each(function (App\Book $book) use ($author) {
                $book->authors()->saveMany([
                    $author,
                ]);
            });
        });

        \App\Book::all()->each(function (App\Book $book) use ($users) {
            $reviews = factory(App\BookReview::class, 4)->make();
            $reviews->each(function (\App\BookReview $review) use ($users) {
                $review->user()->associate($users->random());
            });
            $book->reviews()->saveMany($reviews);
        });

        //testing avg review posts
/*        $user = factory(App\User::class)->create();

        $book1 = factory(App\Book::class)->create(['title' => 'PHP for begginers']); // 3
        $book1Review1 = factory(App\BookReview::class)->make(['review' => 1]);
        $book1Review1->user()->associate($user);
        $book1Review2 = factory(App\BookReview::class)->make(['review' => 5]);
        $book1Review2->user()->associate($user);
        $book1->reviews()->saveMany([$book1Review1, $book1Review2]);

        $book2 = factory(App\Book::class)->create(['title' => 'Javascript for dummies']); // 6
        $book2Review1 = factory(App\BookReview::class)->make(['review' => 4]);
        $book2Review1->user()->associate($user);
        $book2Review2 = factory(App\BookReview::class)->make(['review' => 8]);
        $book2Review2->user()->associate($user);
        $book2->reviews()->saveMany([$book2Review1, $book2Review2]);

        $book3 = factory(App\Book::class)->create(['title' => 'Advanced Python']); // 0

        */
    }
}
