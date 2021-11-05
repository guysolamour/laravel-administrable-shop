@extends(back_view_path('layouts.base'))

@section('title', $category->name)


@section('content')
<div class="main-content">
    <div class="card ">
        <nav aria-label="breadcrumb" class="d-flex justify-content-end" style="padding-top:10px;padding-right:20px;">
            <ol class="breadcrumb">
                 <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route(config('administrable.guard') . '.dashboard') }}">Tableau de bord</a></li>
                      <li class="breadcrumb-item"><a href="{{ back_route('extensions.blog.category.index') }}">Catégories</a></li>
                      <li class="breadcrumb-item active">{{ $category->name }}</li>
                  </ol>
            </ol>
        </nav>

    </div>

    <div class="card">
        {{-- <h4 class="card-title">
                Articles
            </h4> --}}

        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                {{-- add fields here --}}

                <div>
                    <p><span class="font-weight-bold">Nom:</span></p>
                    <p>
                        {{ $category->name }}
                    </p>
                </div>

                <div>
                    <p><span class="font-weight-bold">Date ajout:</span></p>
                    <p>
                        {{ $category->created_at->format('d/m/Y h:i') }}
                    </p>
                </div>


                </div>
                <div class="col-md-4">
                    <section style="margin-bottom: 2rem;">

                        <div class="btn-group-horizontal">
                            <a href="{{ back_route('extensions.blog.category.edit', $category) }}" class="btn btn-info"
                                data-toggle="tooltip" data-placement="top" title="Editer"><i class="fas fa-edit"></i>Editer</a>
                            <a href="{{ back_route('extensions.blog.category.destroy', $category) }}" data-method="delete"
                                data-toggle="tooltip" data-placement="top" title="Supprimer"
                                data-confirm="Etes vous sûr de bien vouloir procéder à la suppression ?" class="btn btn-danger"><i
                                    class="fa fa-trash"></i> Supprimer</a>
                        </div>
                    </section>
                </div>

            </div>
        </div>
    </div>

    <div class="fab fab-fixed">
        <button class="btn btn-float btn-primary" data-toggle="button">
            <i class="fab-icon-default ti-plus"></i>
            <i class="fab-icon-active ti-close"></i>
        </button>

        <ul class="fab-buttons">
            <li><a class="btn btn-float btn-sm btn-info" href="{{ back_route('extensions.blog.category.edit', $category) }}"  data-provide="tooltip" data-placement="left"
                    title="Editer"><i class="ti-pencil"></i> </a></li>
            <li><a class="btn btn-float btn-sm btn-danger" href="{{ back_route('extensions.blog.category.destroy',$category) }}" data-method="delete" data-confirm="Etes vous sur de bien vouloir procéder à la suppression ?"   data-provide="tooltip"
                    data-placement="left" title="Supprimer"><i class="ti-trash"></i> </a></li>

        </ul>
    </div>
</div>



@endsection
