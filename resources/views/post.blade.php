@extends('layouts.main')

@section('container')
@if(request('product'))
<input type="hidden" name="product" value="{{ request('product') }}">
@endif
@if(request('author'))
<input type="hidden" name="product" value="{{ request('author') }}">
@endif

<div class="content-warpper">
    <div class="row">
        <div class="col-md-12 p-5">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-3">{{ $post[0]->title }}</h3>
                    <a href="/posts" class="btn btn-secondary"><span><i class="ti-back-left"></i></span></i></a>
                </div>
                <div class="card-body mt-5">
                    @if($post[0]->image)
                    <div style="max-block-size: 350px; overflow:hidden">
                        <img src="{{ asset('storage/' . $post[0]->image) }}" alt="{{ $post[0]->title }}" srcset="img-fluid mt-3">
                    </div>
                    @else
                    <img src="https://source.unsplash.com/1200x400? {{ $post[0]->title }}" alt="{{ $post[0]->title }}" srcset="img-fluid mt-3">
                    @endif

                    <article class="my-3 fs-5 mt-4">{!! $post[0]->body !!}</article>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection