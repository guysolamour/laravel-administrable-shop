@extends(back_view_path('layouts.base'))


@section('title', 'Statistiques')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    {{-- <h1>Statistiques</h1> --}}
                </div>
                <div class="col-sm-6">
                    <div class='float-sm-right'>
                         <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route(config('administrable.guard') . '.dashboard') }}">Tableau de bord</a></li>
                            <li class="breadcrumb-item"><a href="{{ back_route('extensions.shop.statistic.index') }}">Boutique</a></a></li>
                            <li class="breadcrumb-item active">Statistiques</li>
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
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                        title="Réduire">
                        <i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class='row'>
                    <div class="col-md-12">
                        <div class="card">

                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Statistiques</h3>

                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card text-white bg-primary">
                                    <div class="card-body">
                                        <div class="card-title">Entrées (mois en cours)</div>
                                        <p class="card-text">{{ format_price($current_month_amount) }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card text-white bg-primary">
                                    <div class="card-body">
                                        <div class="card-title">Entrées (année en cours)</div>
                                        <p class="card-text">{{ format_price($current_year_amount) }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card text-white bg-primary">
                                    <div class="card-body">
                                        <div class="card-title">Total entrées</div>
                                        <p class="card-text">{{ format_price($total_orders) }}</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                       <div>
                           <h6>Liste des paiements</h6>
                            <table class="table table-striped">
                                <thead>
                                    <th>#</th>
                                    <th>Commande</th>
                                    <th>Nbr. produits</th>
                                    <th>Nom du Livreur</th>
                                    <th>Prix du Livreur</th>
                                    <th>Total</th>
                                    <th>Actions</th>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                    <tr>
                                        <td>{{ $order->command->reference }}</td>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $order->products_count }}</td>
                                        <td>{{ $order->deliver_name }}</td>
                                        <td>{{ format_price($order->deliver_price) }}</td>
                                        <td>{{ format_price($order->total) }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ back_route('extensions.shop.command.edit', $order->command) }}" class="btn btn-info ">Voir la
                                                commande</a>
                                                <a href="{{ Storage::url($order->invoice) }}" class="btn btn-primary " target="_blank">Voir la
                                                facture</a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                       </div>
                       <hr>
                       <div>
                           <h6>Meilleurs clients</h6>
                            <table class="table table-striped">
                                <thead>
                                    <th>#</th>
                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th>Numéro téléphone</th>
                                    <th>Total dépensé</th>
                                </thead>
                                <tbody>
                                    @foreach ($users_sorted_by_expense as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone_number }}</td>
                                        <td>{{ format_price($user->total_expense) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                       </div>
                       <hr>
                       <div>
                           <h6>Les produits les plus vendus</h6>
                            <table class="table table-striped">
                                <thead>
                                    <th>#</th>
                                    <th>Nom</th>
                                    <th>Nbr d'achat</th>
                                    <th>Montant total</th>
                                </thead>
                                <tbody>
                                    @foreach ($most_sales_products as $product)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><a href="{{ back_route('extensions.shop.product.edit', $product) }}">{{ $product->name }}</a></td>
                                        <td>{{ $product->sold_count }}</td>
                                        <td>{{ format_price($product->sold_amount) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                       </div>
                       @if(shop_settings('stock_management'))
                       <div>
                           <h6>Stock des produits faible</h6>
                            <table class="table table-striped">
                                <thead>
                                    <th>#</th>
                                    <th>Nom</th>
                                    <th>Qté stock</th>
                                    <th>Stock Min</th>
                                    <th>Etat</th>
                                </thead>
                                <tbody>
                                    @foreach ($sold_out_products as $product)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->stock }}</td>
                                        <td>{{ $product->safety_stock }}</td>
                                        <td><span class="alert alert-danger">Rupture de stock</span></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                       </div>
                       @endif
                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.mail-box-messages -->
                            </div>

                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>

        </div>
        <!-- /.card-body -->

        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>

<x-administrable::datatable />
@deleteall()

@endsection
