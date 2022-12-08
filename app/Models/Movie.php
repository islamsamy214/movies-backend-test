<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'image', 'rate', 'user_id'
    ]; //end of fillable

    protected $appends = [
        'image_path'
    ]; //end of appends

    protected $hidden = [
        'user_id'
    ]; //end of hidden

    public function getImagePathAttribute()
    {
        return asset('images/movies/' . $this->image);
    } //end of image path

    public function user()
    {
        return $this->belongsTo(User::class);
    } //end of user relation

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'movies_categories');
    } //end of categories relation
}
