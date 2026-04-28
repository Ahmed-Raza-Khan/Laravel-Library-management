<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    public function issues()
    {
        protected $fillable = ['name','email','phone','address','status'];

        return $this->hasMany(BookIssue::class);
    }
}
