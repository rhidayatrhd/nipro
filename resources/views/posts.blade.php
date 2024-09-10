@extends('layouts.main')

@section('container')
@if(request('product'))
<input type="hidden" name="product" value="{{ request('product') }}">
@endif
@if(request('author')) 
<input type="hidden" name="product" value="{{ request('author') }}">
@endif

<div class="row justify-content-center mt-5 mb-3">
    <div class="col-md-6">
        <form action="/posts">
            <div class="input-group mb-3">
                <input type="text" name="search" id="search" class="form-control" placeholder="Search..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-danger">Search</button>
            </div>
        </form>
    </div>
</div>

@if($posts->count())

<div class="posts card mb-3">
    @if($posts[0]->image)
    <div class=":max-block-size:400px; overflow:hidden">
        <img src="{{ asset('storage/' . $posts[0]->image) }}" alt="{{ $posts[0]->categories->name }}" class="img_fluid">
    </div>
    @else  
    <img src="https://source.unsplash.com/1200x400? {{ $posts[0]->categories->name }}" alt="" srcset="{{ encrypt($posts[0]->categories->name) }}">
    @endif

    <div class="card-body text-center">
        <h3 class="card-title"><a href="/posts/{{ $posts[0]->slug }}" class="text-decoration-none">{{ $posts[0]->title }}</a></h3>
        <p>
            <small class="text-muted"> By . <a href="/posts?author={{ $posts[0]->author->username }}" class="text-decoration-none">{{ $posts[0]->author->name }}</a> in <a href="/posts?categories={{ $posts[0]->categories->slug }}" class="text-decoration-none">{{ $posts[0]->categories->name }}</a>{{ $posts[0]->created_at->diffForHumans() }}
            </small>
        </p>
        <a href="/posts/{{ $posts[0]->slug }}" class="text-decoration-none btn btn-primary">Read more...</a>
    </div>
</div>

<div class="container">
    <div class="row">
        @foreach($posts->skip(1) as $post)
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="position-absolute" style="background-color: rgba(0, 0, 0, 0.7);"><a href="/posts?categories={{ $post->categories->slug }}" class="text-white text-decoration-none">{{ $post->categories->name }}</a>
                </div>
                @if($post->image)
                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->categories->name }}" class="img_fluid">
                @else
                <img src="https://source.unsplash.com/500x400?{{ $post->categories->name }}" alt="{{ $post->categories->name }}" class="img-fluid">
                @endif

                <div class="card-body">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p>
                        <small class="text-muted"> By . <a href="/posts?author={{ $post->author->username }}" class="text-decoration-none">{{ $post->author->name }}</a>{{ $post->created_at->diffForHumans() }}
                        </small>
                    </p>
                    <p class="card-text">{{ $post->excerpt }}</p>
                    <a href="/posts/{{ $post->slug }}" class="btn btn-primary">Read more...</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@else
<p class="text-center no-data mb-5"><span class="text-center">404 - No data post found..</span></p>
@endif

@endsection