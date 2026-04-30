<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookIssue extends Model
{
    protected $casts = ['fine_amount' => 'integer',];

    protected $fillable = ['book_id','member_id','issue_date','due_date','return_date','status','fine_amount'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
