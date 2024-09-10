<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, Sluggable, HasSlug;

    protected $guarded = ['id'];
    protected $table = 'categories';

    public function Posts()
    {
        return $this->hasMany(ProductItem::class);
    }

    public function getRouteKey()
    {
        return 'slug';
    }

    public function sluggable(): array
    {
        return [
            'slug'  => [
                'source' => 'name',
            ]
        ];
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
}
