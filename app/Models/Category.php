<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'user_id'
    ]; //end of fillable

    protected $hidden = [
        'user_id'
    ]; //end of hidden

    public function user()
    {
        return $this->belongsTo(User::class);
    } //end of user relation

    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'movies_categories');
    } //end of movies relation
}
