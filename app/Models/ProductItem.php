<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class ProductItem extends Model
{
    use HasFactory, Sluggable, HasSlug;

    protected $guarded = ['id'];
    // protected $table = ['product_items'];
    protected $with = ['categories', 'author'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? \false, function($query, $search) {
            return $query->where('title', 'like', '%' . $search . '%')->orWhere     ('body', 'like', '%' . $search . '%');
        });

        $query->when($filters['categories'] ?? \false, function($query, $category) {
            return $query->whereHas('categories', function($query) use ($category) {
                $query->where('slug', $category);
            });
        });

        $query->when($filters['author'] ?? \false,
            fn($query, $author) =>
            $query->whereHas('author', fn($query) =>
             $query->where('username', $author)
             )
        );
    }

    public function getRouteKey()
    {
        return 'slug';
    }

    public function sluggable(): array 
    {
        return [
            'slug'  => [
                'source' => 'title'
            ]
        ];
    }

    public function categories() 
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function author() 
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }
}
