<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Post extends Model
{
    use HasFactory;

    protected $with = ['user', 'category'];
    protected $guarded = [];

    public function scopeFilter(Builder $query, array $filters)
    {
        $query->when($filters['search'] ?? false, fn(Builder $query, $search) =>
            $query->where(fn($query) =>
                $query
                    ->where('title', 'like', '%' . $search . '%')
                    ->orWhere('body', 'like', '%' . $search . '%')));

        $query->when(
            $filters['category'] ?? false,
            fn(Builder $query, $category) =>
            $query
                ->whereHas('category', fn(Builder $query) =>
                    $query
                        ->where('slug', $category))
        );

        $query->when(
            $filters['user'] ?? false,
            function (Builder $query, $userId) {
                $query->whereHas('user')
                    ->where('user_id', $userId);
            }
        );
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}