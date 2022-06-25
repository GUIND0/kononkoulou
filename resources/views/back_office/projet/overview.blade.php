@extends('back_office.partials.main')
@section('content')

    @if (auth()->user() != null)
        <div class="row justify-content-end" >
            @if (auth()->user()->profil->name == 'Porteur de Projet')
                <a class="btn btn-primary" href="{{ route('projet.list')}}"><i class="ti-home mr-2"></i>Retour</a>
            @endif
            @if (auth()->user()->profil->name == 'Admin')
                <a class="btn btn-primary" href="{{ route('campagne.checklist')}}"><i class="ti-home mr-2"></i>Retour</a>
            @endif
        </div>
        <div class="row justify-content-center">
            <div class="container-xl px-4 mt-4">

                <div class="row">
                    <div class="col-xl-4">
                        <!-- Profile picture card-->
                        <div class="card mb-4 mb-xl-0">

                            <div class="card-body text-center">
                                @if($project->photo_identite != '' && $project->photo_identite != null)
                                    <img class="img-account-profile rounded-circle mb-2" width="100" height="100" src="/{{ $project->photo_identite }}" alt="">
                                    <h5>Porteur : {{ $project->username }}</h5>
                                @else
                                    <h5>Porteur : {{ $project->username }}</h5>
                                @endif

                                @if (auth()->user()->profil->name != "admin")
                                    <a class="btn btn-primary" href="{{ route('funding.index','') }}/{{ $project->id }}">Financer ce projet</a>
                                @endif
                            </div>
                        </div>
                        <hr>
                        <div class="card mb-4 mb-xl-0">

                            <div class="card-body text-center">
                                @if ($project->vues == 0)
                                    <h5>Nombre de vues : 0</h5>
                                @else
                                    <h5>Nombre de vues : {{ $project->vues }}</h5>
                                @endif
                                @if ($nbre == 0)
                                    <h5>Nombre de contribution : 0</h5>
                                @else
                                    <h5>Nombre de contribution : {{ $nbre }}</h5>
                                @endif
                                @if ($total == 0)
                                    <h5>Montant recoltés : 0 FCFA</h5>
                                @else
                                    <h5>Montant recoltés : {{ $total }} FCFA</h5>
                                @endif
                                @if ($percentage == 0)
                                    <h5>Avancement : 0 %</h5>
                                @else
                                    <h5>Avancement : {{ $percentage }} %</h5>
                                @endif
                            </div>
                        </div>

                        <hr>

                        <div class="">
                            @if (auth()->user()->profil->name == "admin")
                                <a class="btn btn-success" href="{{ route('campagne.accepter',$project->id) }}">Valider la demande</a>
                                <a class="btn btn-danger ml-1" href="{{ route('campagne.rejeter',$project->id) }}">Réfuser la demande</a>
                            @endif
                        </div>

                    </div>
                    <div class="col-xl-8">
                        <!-- Account details card-->
                        <div class="card mb-4">
                            <img class="card-img-top" src="/{{ $project->logo }}" width="200" height="300" alt="Card image cap">
                            <div class="card-body">
                            <h5 class="card-title">{{ $project->nom }}</h5>
                            <h5>{{ number_format($project->budget_demande,0,',',' ')  }} FCFA</h5>
                            <p class="card-text">{{ $project->resume }}</p>
                            <a href="/{{ $project->description }}" class="btn btn-primary mt-1 mb-3">Télécharger le PDF</a>

                            <p class="card-text"><small class="text-muted">{{ $project->created_at->format('d/m/Y') }}</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @else
        <div class="row justify-content-end">
            <a class="btn btn-primary" href="{{ route('catalogue.index')}}"><i class="ti-arrow-left mr-2"></i>Retour</a>
        </div>
        <div class="row justify-content-center">
            <div class="container-xl px-4 mt-4">

                <div class="row">
                    <div class="col-xl-4">
                        <!-- Profile picture card-->
                        <div class="card mb-4 mb-xl-0">
                            <div class="card-header">Porteur de projet</div>
                            <div class="card-body text-center">
                                @if($project->photo_identite != '' && $project->photo_identite != null)
                                    <img class="img-account-profile rounded-circle mb-2" width="100" height="100" src="/{{ $project->photo_identite }}" alt="">
                                    <h5>{{ $project->username }}</h5>
                                @else
                                    <h5>{{ $project->username }}</h5>
                                @endif

                                <a class="btn btn-primary" href="{{ route('funding.index','') }}/$project->id">Financer ce projet</a>
                            </div>
                        </div>
                        <hr>
                        <div class="card mb-4 mb-xl-0">

                            <div class="card-body text-center">
                                @if ($project->vues == 0)
                                    <h5>Nombre de vues : 0</h5>
                                @else
                                    <h5>Nombre de vues : {{ $project->vues }}</h5>
                                @endif
                                @if ($nbre == 0)
                                    <h5>Nombre de contribution : 0</h5>
                                @else
                                    <h5>Nombre de contribution : {{ $nbre }}</h5>
                                @endif
                                @if ($total == 0)
                                    <h5>Montant recoltés : 0 FCFA</h5>
                                @else
                                    <h5>Montant recoltés : {{ $total }} FCFA</h5>
                                @endif
                                @if ($percentage == 0)
                                    <h5>Avancement : 0 %</h5>
                                @else
                                    <h5>Avancement : {{ $percentage }} %</h5>
                                @endif

                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <!-- Account details card-->
                        <div class="card mb-4">
                            <img class="card-img-top" src="/{{ $project->logo }}" width="200" height="300" alt="Card image cap">
                            <div class="card-body">
                            <h5 class="card-title">{{ $project->nom }}</h5>
                            <h5>{{ number_format($project->budget_demande,0,',',' ')  }} FCFA</h5>
                            <p class="card-text">{{ $project->description }}</p>
                            <p class="card-text"><small class="text-muted">{{ $project->created_at->format('d/m/Y') }}</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection
