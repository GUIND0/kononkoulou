@extends('back_office.partials.main')
@section('content')
<div class="row">
    <div class="col-md mb-4 mb-md-0">
      <small class="text-light fw-semibold">Recherche Avancée</small>
      <div class="accordion mt-3" id="accordionExample">
        <div class="card accordion-item">
          <h2 class="accordion-header" id="headingOne">
            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionOne" aria-expanded="false" aria-controls="accordionOne">
              Formulaire
            </button>
          </h2>

          <div id="accordionOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample" style="">
            <div class="accordion-body d-flex justify-content-center">
                <div class="col-12">
                    <div class="card mb-4">

                      <div class="card-body">
                        <form action="{{ route('catalogue.index') }}" enctype="multipart/form-data"  method="GET" class="form justify-content-center">
                            @csrf

                            <div class="form-group mt-1">
                                <label for="">Nom</label>
                                <input type="text" name="nom" value="{{ request()->input('nom') }}" class="form-control">
                            </div>

                            <div class="form-group mt-1">
                                <label for="">Porteur de projet</label>
                                <input type="text" name="porteur" value="{{ request()->input('porteur') }}" class="form-control">
                            </div>

                            <div class="form-group mt-1">
                              <label for="exampleInputName1">Type de Financemnt</label>
                              <select class="form-control" id="type" name="type">
                                  <option value="none">---</option>
                                  @foreach ($types as $type)
                                      <option {{ request()->input('type') == $type->id ? 'selected' : '' }} value="{{ $type->id }}">{{ $type->name }}</option>
                                  @endforeach
                              </select>
                            </div>

                            <div class="form-group mt-1">
                              <label for="">Status</label>
                              <select class="form-control" id="status" name="status">
                                  <option value="none">---</option>
                                  <option {{ request()->input('status') == "en_cours" ? 'selected' : '' }} value="en_cours">En cours de financement</option>
                                  <option {{ request()->input('status') == "success" ? 'selected' : '' }} value="success">Objectif atteint</option>
                                  <option {{ request()->input('status') == "echec" ? 'selected' : '' }} value="echec">Echec</option>
                              </select>
                            </div>


                           <div class="mt-5">
                              <button type="submit" class="btn btn-primary mr-2">Rechercher</button>
                              <a class="btn btn-danger" href="{{ request()->url() }}">Annuler</a>
                           </div>

                        </form>
                      </div>
                    </div>
                  </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>



<div class="row justify-content-center mt-3">
    <div class="col-md mb-4 mb-md-0">
        <div class="card">
            <h5 class="card-header">Listes des campagnes de financement</h5>
            <div class="table-responsive text-nowrap">
              <table class="table table-borderless text-center">
                <thead>
                  <tr>
                    <th>Nom du projet</th>
                    <th>Porteur de projet</th>
                    <th>Progression</th>
                    <th>Status du projet</th>
                    <th>Jour restant</th>
                    <th>Action</th>
                  </tr>
                </thead>
                    <tbody>
                        @forelse ($campagnes as $campagne)
                            <tr>
                                <td class="p-name">
                                    <a href="#">{{ $campagne->projects_nom }}</a>
                                    <br>
                                    <small>{{ $campagne->projects_created_at }}</small>
                                </td>
                                <td class="p-team">
                                    @if($campagne->users_photo != '')

                                            <img src="/{{ $campagne->users_photo }}" title="{{ $campagne->users_firstname }}&nbsp;{{ $campagne->users_lastname }}" alt="{{ $campagne->users_firstname }}&nbsp;{{ $campagne->users_lastname }}" class="w-px-40 h-auto rounded-circle">

                                    @else
                                        <h3>{{ $campagne->users_firstname }}&nbsp;{{ $campagne->users_lastname }}</h3>
                                    @endif
                                </td>
                                <td class="p-progress">
                                    @if ($campagne->percentage != null)
                                        <div class="progress progress-xs">
                                            <div style="width: {{$campagne->percentage}}%;" class="progress-bar progress-bar-success"></div>
                                        </div>
                                        <small>{{$campagne->percentage}}% Complete </small>
                                    @else
                                        <div class="progress progress-xs">
                                            <div style="width: 0%;" class="progress-bar progress-bar-success"></div>
                                        </div>
                                        <small>0% Complete </small>
                                    @endif

                                </td>
                                <td class="text-center">
                                    @if ($campagne->status == 'en_cours')
                                        <span class="text-center">En cours de traitement</span>
                                    @endif
                                    @if ($campagne->status == 'valider')
                                        <span class="text-center">Valider</span>
                                    @endif
                                    @if ($campagne->status == 'rejeter')
                                        <span class="text-center">Rejeter</span>
                                    @endif
                                    @if ($campagne->status == 'success')
                                        <span class="text-center">Objectif Atteint</span>
                                    @endif
                                    @if ($campagne->status == 'echec')
                                        <span class="text-center">Echec</span>
                                    @endif
                                </td>
                                <td>
                                    @if (intval($campagne->days_left) >= 0)
                                        {{ $campagne->days_left }}
                                    @else
                                    <span class="badge bg-primary">Cloturée</span>
                                    @endif

                                </td>
                                <td>
                                    <a href="{{ route('projet.overview',$campagne->projects_ids) }}" class="btn btn-outline-primary"><i class="fa fa-eye"></i> Détails </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td>Aucun resultat</td>
                            </tr>
                        @endforelse
                    </tbody>
              </table>
            </div>
          </div>
    </div>

</div>
<div class="row justify-content-center mt-5">
    {{ $campagnes->links() }}
</div>
@endsection

@section('script')

@endsection
