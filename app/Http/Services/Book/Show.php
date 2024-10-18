<?php

namespace App\Http\Services\Book;

use App\Models\Book;

class Show
{
    public function __invoke(array $data)
    {
        return Book::findOrFail($data['id']);
    }
}
