<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['title','book_code','category_id','author_id','publisher','isbn','quantity','available_quantity','description','status'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function issues()
    {
        return $this->hasMany(BookIssue::class);
    }
}
