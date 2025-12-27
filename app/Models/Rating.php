<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Rating extends Model {
    protected $fillable = ['value', 'user_id', 'article_id'];
}
