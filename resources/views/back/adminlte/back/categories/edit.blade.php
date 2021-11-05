@extends(back_view_path('layouts.base'))

@section('title','Edition ' . $category->name)

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    {{-- <h1>Edition</h1> --}}
                </div>
                <div class="col-sm-6">
                    <div class="float-sm-right">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route(config('administrable.guard') . '.dashboard') }}">Tableau de bord</a></li>
                            <li class="breadcrumb-item"><a href="{{ back_route('extensions.shop.statistic.index') }}">Boutique</a></li>
                            <li class="breadcrumb-item"><a href="{{ back_route('extensions.shop.category.show', $category) }}">{{ $category->name }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a href="#">Edition</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edition</h3>
                <div class="btn-group float-right">
                    <a href="{{ back_route('extensions.shop.category.destroy', $category) }}" class="btn btn-danger" data-method="delete"
                        data-confirm="Etes vous sûr de bien vouloir procéder à la suppression ?">
                        <i class="fas fa-trash"></i> Supprimer</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        @include('administrable-shop::' . Str::lower(config('administrable.back_namespace')) . '.categories._form',['edit' => true])
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
    </section>
</div>
@endsection
