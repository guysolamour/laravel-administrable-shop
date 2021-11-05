@extends(back_view_path('layouts.base'))

@section('title','Ajout de zone de couverture')


@section('content')
<div class="main-content">
    <div class="card ">
        <nav aria-label="breadcrumb" class="d-flex justify-content-end" style="padding-top:10px;padding-right:20px;">
             <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route(config('administrable.guard') . '.dashboard') }}">Tableau de bord</a></li>
                <li class="breadcrumb-item"><a href="{{ back_route('extensions.shop.statistic.index') }}">Boutique</a></li>
                <li class="breadcrumb-item">
                    <a href="{{ back_route('extensions.shop.coveragearea.index') }}">Zone de couverture</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page"><a href="#">Ajout</a></li>
              </ol>
        </nav>
    </div>

    <div class="card">
        <h4 class="card-title">
            Ajout
        </h4>

        <div class="card-body">
            <div class="row">
               <div class="col-md-12">
                    @include('administrable-shop::' . Str::lower(config('administrable.back_namespace')) . '.coverageareas._form')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
