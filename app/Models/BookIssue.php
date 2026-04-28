<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookIssue extends Model
{
    protected $fillable = ['book_id','member_id','issue_date','due_date','return_date','status','fine_amount'];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
