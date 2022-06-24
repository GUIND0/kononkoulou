@extends('back_office.partials.main')
@section('content')

<style>

</style>
<div class="col-md-12 grid-margin">
    <div class="row">
      <div class="col-md-4 mb-4 stretch-card transparent">
        <div class="card" style="background: teal;color: white;">
          <div class="card-body">
            <p class="mb-4">Nombre de campagnes en cours</p>
            <p class="fs-30 mb-2">{{ $nbr_campagne_en_cours }}</p>
          </div>
        </div>
      </div>

      <div class="col-md-4 mb-4 stretch-card transparent">
        <div class="card card-light-blue">
          <div class="card-body">
            <p class="mb-4">Nombre de projet financé</p>
            <p class="fs-30 mb-2">{{ $nbr_campagne_valider }}</p>
          </div>
        </div>
      </div>

      <div class="col-md-4 mb-4 stretch-card transparent">
        <div class="card" style="background: teal;color: white;">
          <div class="card-body">
              <p class="mb-4">Nombre de financement echoué</p>
              <p class="fs-30 mb-2">{{ $nbr_campagne_echoues }}</p>
          </div>
        </div>
      </div>

    </div>



    <div class="row">
        <div class="col-md-4 mb-4 stretch-card transparent">
            <div class="card card-light-blue">
              <div class="card-body">
                  <p class="mb-4">Nombre de contributions</p>
                  <p class="fs-30 mb-2">{{ $nbr_contributions }}</p>
              </div>
            </div>
        </div>

        <div class="col-md-4 mb-4 stretch-card transparent">
          <div class="card" style="background: teal;color: white;">
            <div class="card-body">
                <p class="mb-4">Montant total recolté</p>
                <p class="fs-30 mb-2">{{ number_format($montant_total,0,'.',' ') }} FCFA</p>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-4 stretch-card transparent">
          <div class="card card-light-blue">
            <div class="card-body">
                <p class="mb-4">Nombre d'utilisateur</p>
                <p class="fs-30 mb-2">{{ $nbre_utilisateur }}</p>
            </div>
          </div>
        </div>
    </div>




    <div class="row">
        <div class="col-md-6 mb-4 stretch-card transparent">
          <div class="card" style="background: teal;color: white;">
            <div class="card-body">
                <p class="mb-4">Montant total Prévisionnel</p>
                <p class="fs-30 mb-2">{{ number_format($montant_previsionnel,0,'.',' ') }} FCFA</p>
            </div>
          </div>
        </div>
        <div class="col-md-6 mb-4 stretch-card transparent">
          <div class="card card-light-blue">
            <div class="card-body">
                <p class="mb-4">Total vues</p>
                <p class="fs-30 mb-2">{{ $total_vues }}</p>
            </div>
          </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <p class="card-title mb-0">Nombre de campagne par Secteur</p>
              <div class="table-responsive">

                <table class="table table-striped table-borderless">
                  <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Nom</th>

                    </tr>
                  </thead>
                  <tbody>
                      @forelse ($rsCampaign as $campaign)
                      <tr>
                        <td>{{ $campaign["nombre"]  }}</td>
                        <td>{{ $campaign["name"]  }}</td>
                      </tr>
                      @empty
                      <td>Aucune données</td>
                      @endforelse
                  </tbody>
                </table>
              </div>
            </div>
        </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <p class="card-title mb-0">Nombre de campagne par Type de campagne</p>
              <div class="table-responsive">

                <table class="table table-striped table-borderless">
                  <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Nom</th>

                    </tr>
                  </thead>
                  <tbody>
                      @forelse ($rsTypeCampaign as $v)
                      <tr>
                        <td>{{ $v["nombre"]  }}</td>
                        <td>{{ $v["name"]  }}</td>
                      </tr>
                      @empty
                      <td>Aucune données</td>
                      @endforelse
                  </tbody>
                </table>
              </div>
            </div>
        </div>
    </div>
    </div>


    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <p class="card-title mb-0">Nombre d'utilisateur par pays</p>
              <div class="table-responsive">

                <table class="table table-striped table-borderless">
                  <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Nom</th>

                    </tr>
                  </thead>
                  <tbody>
                      @forelse ($rsUser as $user)
                      <tr>
                        <td>{{ $user["nombre"]  }}</td>
                        <td>{{ $user["libelle"]  }}</td>
                      </tr>
                      @empty
                      <td>Aucune données</td>
                      @endforelse
                  </tbody>
                </table>
              </div>
            </div>
        </div>
    </div>
    </div>

  </div>
</div>

@endsection
