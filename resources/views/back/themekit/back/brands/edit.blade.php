@extends(back_view_path('layouts.base'))


@section('title','Edition ' . $brand->name)

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
                                <a href="{{ route(config('administrable.guard') . '.dashboard') }}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ back_route('extensions.shop.statistic.index') }}">Boutique</a></li>
                            <li class="breadcrumb-item"><a href="{{ back_route('extensions.shop.brand.show', $brand) }}">{{ $brand->name }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a href="#">Edition</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h3 class="card-title">Edition</h3>
                        <div class="btn-group float-right">
                            <a href="{{ back_route('extensions.shop.brand.destroy', $brand) }}" class="btn btn-danger" data-method="delete"
                                data-confirm="Etes vous sûr de bien vouloir procéder à la suppression ?">
                                <i class="fas fa-trash"></i> Supprimer</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                @include('administrable-shop::' . Str::lower(config('administrable.back_namespace')) . '.brands._form',['edit' => true])
                            </div>
                            <div class="col-md-4">
                                @imagemanager([
                                    'collection' => 'front-image',
                                    'label'      => 'Image mise en avant',
                                    'model'      => $form->getModel(),
                                ])
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection





