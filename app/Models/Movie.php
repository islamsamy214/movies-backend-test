<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'image', 'user_id'
    ]; //end of fillable

    protected $appends = [
        'image_path', 'rate'
    ]; //end of appends

    protected $hidden = [
        'user_id'
    ]; //end of hidden

    public function getRateAttribute()
    {
        $rates = [];
        foreach ($this->usersRates as $user_rate) {
            array_push($rates, $user_rate->pivot->rate);
        }
        if (array_sum($rates) == 0) {
            return 0;
        }
        $avg_rate = round(array_sum($rates) / count($rates));
        return $avg_rate;
    } //end of getRateAttribute

    public function getImagePathAttribute()
    {
        return asset('images/movies/' . $this->image);
    } //end of image path

    public function user()
    {
        return $this->belongsTo(User::class);
    } //end of user relation

    public function usersRates()
    {
        return $this->belongsToMany(User::class, 'rate')->withPivot('rate');
    } //end of usersRates relation

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'movies_categories');
    } //end of categories relation
}
