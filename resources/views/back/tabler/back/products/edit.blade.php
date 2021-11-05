@extends(back_view_path('layouts.base'))


@section('title', 'Edition ' . $product->name)


@section('content')

<div class="row mb-5">
    <div class="col-12">
        <div class="d-flex justify-content-between">
            <ol class="breadcrumb breadcrumb-arrows" aria-label="breadcrumbs">
                <li class="breadcrumb-item"><a href="{{ route(config('administrable.guard') . '.dashboard') }}">Tableau de bord</a></li>
                <li class="breadcrumb-item"><a href="{{ back_route('extensions.shop.statistic.index') }}">Boutique</a></li>
                <li class="breadcrumb-item"><a href="{{ back_route('extensions.shop.product.edit', $product) }}">{{ Str::limit($product->name, 30) }}</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="#">Edition</a></li>
            </ol>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <h3 class="title-5 m-b-35">
            Edition
        </h3>
        <div class="row">
            <div class="col-md-12">
                @include('administrable-shop::' . Str::lower(config('administrable.back_namespace')) . '.products._form',['edit' => true])
            </div>
        </div>
    </div>
</div>
@endsection



