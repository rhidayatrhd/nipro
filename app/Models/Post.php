<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = ['id'];
    protected $table = ['product_items'];
    protected $with = ['productcategory', 'author'];

    public function scopeFilter($query, array $filters) {

        $query->when($filter['search'] ?? \false, function ($query, $search) {
            return $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('body', 'like', '%' . $search . '%');
        });

        $query->when(
            $filters['productcategory'] ?? \false, function ($query, $productcategory) {
                return $query->whereHas('productcategory', function($query) use ($productcategory) {
                    $query->where('slug', $productcategory);
                });
            }
        );

        $query->when(
            $filters['author'] ?? false,
            fn ($query, $author) =>
            $query->whereHas(
                'author',
                fn ($query) =>
                $query->where('username', $author)
            )
        );

    }

    public function productcategory()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function getRouteKey()
    {
        return 'slug';
    }
    public function sluggable(): array
    {
        return [
            'slug'  => [
                'source'    => 'title'
            ]
        ];
    }

}
