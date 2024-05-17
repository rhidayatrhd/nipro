@extends('layouts.main')

@section('container')
<div class="carousel slide carousel-fade" id="NIJCarousel" data-bs-ride="carousel">

    <ul class="carousel-indicators">
        <?php
        $i = 0;
        foreach (getProducts() as $menu) {
            $acvt = '';
            if ($i == 0) {
                $acvt = 'active';
            } ?>
            <li data-bs-target="#NIJCarousel" data-bs-slide-to="<?= $i; ?>" class="<?= $acvt; ?>"></li>
        <?php $i++;
        }
        ?>
    </ul>
    <div class="carousel-inner">
        <?php
        $i = 0;
        $sl = count(getProducts());
        foreach (getProducts() as $menu) {
            $acvt = '';
            $slid = '';
            if ($i == 0) {
                $acvt = 'active';
                $slid = 'text-start';
            } elseif ($i == $sl) {
                $slid = 'text-end';
            } ?>
            <div class="carousel-item <?= $acvt; ?>">
                <?php if ($menu->image) { ?>
                    <img src="<?= asset('storage/' . $menu->image); ?>" width="100%" class="img-fluid row-cols-6 w-100">
                <?php } else { ?>
                    <img src="https://source.unsplash.com/1800x560? {{ $menu->name }}" alt="{{ $menu->name }}" class="img-fluid row-cols-6 w-100">
                <?php } ?>
                <div class="container">
                    <div class="carousel-caption {{ $slid }}">
                        <h2>{{ $menu->name }}</h2>
                        <p>{{ $menu->excerpt }}</p>
                        <p><a href="/posts?productcategory={{ $menu->slug }}" class="btn btn-lg btn-primary">Read more..</a></p>
                    </div>
                </div>
            </div>
        <?php $i++;
        } ?>
    </div>

    <button type="button" class="carousel-control-prev" data-bs-target="#NIJCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button type="button" class="carousel-control-next" data-bs-target="#NIJCarousel" data-bs-slide="Next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<footer class="container mt-3">
    <p class="float-end"><a href="#">Back to top</a></p>
    <p>&copy; 2023-2024 PT. NIPRO INDONESIA JAYA</p>
</footer>

@endsection