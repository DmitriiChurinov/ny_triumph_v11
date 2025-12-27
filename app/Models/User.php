<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
class User extends Authenticatable {
    use HasApiTokens;
    protected $fillable = ['name', 'email', 'password', 'avatar'];
    public function articles() { return $this->hasMany(Article::class); }
}
