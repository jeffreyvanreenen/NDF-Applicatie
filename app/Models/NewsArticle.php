<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsArticle extends Model
{
    protected $fillable = [
      'title',
      'link',
      'pubDate',
      'description',
      'source',
      'author',
    ];
}
