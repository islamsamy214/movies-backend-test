<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, LaratrustUserTrait;

    protected $fillable = [
        'name', 'email', 'password', 'birthdate'
    ]; //end of fillable

    protected $hidden = [
        'password',
        'remember_token',
    ]; //end of hidden

    protected $casts = [
        'email_verified_at' => 'datetime',
        'birthdate' => 'datetime'
    ]; //end of casts

    public function movies()
    {
        return $this->hasMany(Movie::class);
    } //end of movies relation

    public function moviesRates()
    {
        return $this->belongsToMany(Movie::class, 'rate')->withPivot('rate');
    } //end of moviesRates relation

    public function categories()
    {
        return $this->hasMany(Category::class);
    } //end of categories relation
}
