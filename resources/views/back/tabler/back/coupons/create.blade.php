@extends(back_view_path('layouts.base'))

@section('title', 'Ajout de coupon')

@section('content')

<div class="row mb-5">
    <div class="col-12">
        <div class="d-flex justify-content-between">
            <ol class="breadcrumb breadcrumb-arrows" aria-label="breadcrumbs">
                <li class="breadcrumb-item"><a href="{{ route(config('administrable.guard') . '.dashboard') }}">Tableau de bord</a></li>
                <li class="breadcrumb-item"><a href="{{ back_route('extensions.shop.statistic.index') }}">Boutique</a></li>
                <li class="breadcrumb-item"><a href="{{ back_route('extensions.shop.statistic.index') }}">Boutique</a></li>
                <li class="breadcrumb-item">
                    <a href="{{ back_route('extensions.shop.coupon.index') }}">Coupons</a>
                </li>
                <li class="breadcrumb-item active">Ajout</li>
            </ol>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <h3 class="title-5 m-b-35">
            Création de coupon
        </h3>
        <div class="row">
            <div class="col-md-12">
                @include('administrable-shop::' . Str::lower(config('administrable.back_namespace')) . '.coupons._form')
            </div>
        </div>
    </div>
</div>
@endsection
