<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Lorisleiva\LaravelSearchString\Concerns\SearchString;

class NewsArticle extends Model
{

    use SearchString;

    protected $searchStringColumns = [
        "title" => ["searchable" => true],
        "description" => ["searchable" => true],
        "author" => ["searchable" => true],
        "pubDate" => ["searchable" => true],
        "source" => ["searchable" => true],
    ];

    protected $fillable = [
      'title',
      'link',
      'pubDate',
      'description',
      'source',
      'author',
      'flag',
    ];
}
