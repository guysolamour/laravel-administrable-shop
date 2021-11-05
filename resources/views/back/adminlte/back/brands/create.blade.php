@extends(back_view_path('layouts.base'))

@section('title', 'Ajout de marque')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    {{-- <h1>Ajout</h1> --}}
                </div>
                <div class="col-sm-6">
                    <div class="float-sm-right">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route(config('administrable.guard') . '.dashboard') }}">Tableau de bord</a></li>
                            <li class="breadcrumb-item"><a href="{{ back_route('extensions.shop.statistic.index') }}">Boutique</a></li>
                            <li class="breadcrumb-item"><a href="{{ back_route('extensions.shop.brand.index') }}">Marques</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a href="#">Ajout</a></li>
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

                <h3 class="card-title">Ajout</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                        title="Réduire">
                        <i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        @include('administrable-shop::' . Str::lower(config('administrable.back_namespace')) . '.brands._form')
                    </div>
                    <div class="col-md-4">
                        @imagemanagerfront([
                            'label'      => 'Image mise en avant',
                            'model'      => $form->getModel(),
                        ])
                    </div>
                </div>
            </div>

        </div>
        <!-- /.card-body -->

        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection
