@extends(back_view_path('layouts.base'))

@section('title','Ajout de zone de couverture')


@section('content')

<div class="main-content">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                </div>
                <div class="col-lg-4">
                   <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ back_route('extensions.shop.statistic.index') }}">Boutique</a></li>
                            <li class="breadcrumb-item">
                                <a href="{{ back_route('extensions.shop.coveragearea.index') }}">Zone de couverture</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page"><a href="#">Ajout</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h3 class="card-title">Ajout</h3>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                @include('administrable-shop::' . Str::lower(config('administrable.back_namespace')) . '.coverageareas._form')
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
