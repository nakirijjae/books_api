<?php

declare (strict_types=1);


namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Book;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
      $authors = $this->authors([
        'id' => $this->id,
        'name' => $this->name,
        'surname' => $this->surname,
      ])->get();

      $reviews = $this->reviews()->get(['review','comment']);
      $avg_reviews = $this->reviews()->avg('review');

        return [
            'id' => $this->id,
            'isbn' => $this->isbn,
            'title' => $this->title,
            'description' => $this->description,
            'authors' => $authors,
            'reviews' => $reviews,
            'avg_reviews' => $avg_reviews,
        ];
    }
}
