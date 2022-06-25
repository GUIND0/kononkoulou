@extends('back_office.partials.main')
@section('content')

<style>

</style>
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
      <div class="row">
                <div class="col-lg-12 mb-4 order-0">
                        <div class="card">
                                <div class="d-flex align-items-end row">
                                    <div class="col-sm-7">
                                            <div class="card-body">
                                            <h5 class="card-title text-primary">{{ $project->projects_nom }}</h5>
                                            <p class="mb-4">
                                                {{  substr($project->projects_resume, 0, 300) . '...' }}
                                            </p>

                                            <a href="{{ route('projet.overview',$project->projects_ids) }}" class="btn btn-sm btn-outline-primary">En savoir plus</a>
                                            </div>
                                    </div>
                                    <div class="col-sm-5 text-center text-sm-left">
                                            <div class="card-body pb-0 px-0 px-md-4">
                                                <img
                                                    src="/new/img/c.png"
                                                    height="200"
                                                    alt="View Badge User"
                                                    data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                                    data-app-light-img="illustrations/man-with-laptop-light.png"
                                                />
                                            </div>
                                    </div>
                                </div>
                        </div>
                </div>
                <div class="col-lg-3 order-0">
                    <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img
                                src="/new/assets/img/icons/unicons/chart-success.png"
                                alt="chart success"
                                class="rounded"
                              />
                            </div>
                            <div class="dropdown">
                              <button
                                class="btn p-0"
                                type="button"
                                id="cardOpt3"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                              >
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                <a class="dropdown-item" href="javascript:void(0);">Voir plus</a>
                              </div>
                            </div>
                          </div>
                          <span class="fw-semibold d-block mb-1">Nombre campagnes</span>
                          <h3 class="card-title mb-2">{{ $nbr_campagne_en_cours }}</h3>

                        </div>
                      </div>
                </div>


                <div class="col-lg-3 mb-4 order-0">
                    <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img
                                src="/new/assets/img/icons/unicons/chart-success.png"
                                alt="chart success"
                                class="rounded"
                              />
                            </div>
                            <div class="dropdown">
                              <button
                                class="btn p-0"
                                type="button"
                                id="cardOpt3"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                              >
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                <a class="dropdown-item" href="javascript:void(0);">Voir plus</a>

                              </div>
                            </div>
                          </div>
                          <span class="fw-semibold d-block mb-1">Nombre projet financé</span>
                          <h3 class="card-title mb-2">{{ $nbr_projet_finance }}</h3>

                        </div>
                      </div>
                </div>

                <div class="col-lg-3 mb-4 order-0">
                    <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img
                                src="/new/assets/img/icons/unicons/chart-success.png"
                                alt="chart success"
                                class="rounded"
                              />
                            </div>
                            <div class="dropdown">
                              <button
                                class="btn p-0"
                                type="button"
                                id="cardOpt3"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                              >
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                <a class="dropdown-item" href="javascript:void(0);">Voir plus</a>

                              </div>
                            </div>
                          </div>
                          <span class="fw-semibold d-block mb-1">Nombre financement echoué</span>
                          <h3 class="card-title mb-2">{{ $nbr_campagne_echoues }}</h3>

                        </div>
                      </div>
                </div>

                <div class="col-lg-3 mb-4 order-0">
                    <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img
                                src="/new/assets/img/icons/unicons/chart-success.png"
                                alt="chart success"
                                class="rounded"
                              />
                            </div>
                            <div class="dropdown">
                              <button
                                class="btn p-0"
                                type="button"
                                id="cardOpt3"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                              >
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                <a class="dropdown-item" href="javascript:void(0);">Voir plus</a>

                              </div>
                            </div>
                          </div>
                          <span class="fw-semibold d-block mb-1">Nombre contributions</span>
                          <h3 class="card-title mb-2">{{ $nbr_contributions }}</h3>

                        </div>
                      </div>
                </div>

      </div>


        <!-- Total Revenue -->
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title mb-0">Top 5 dernières contributions</p>
                  <div class="table-responsive">
                    <table class="table table-striped table-borderless">
                      <thead>
                        <tr>
                          <th>Donateur</th>
                          <th>Montant (FCFA)</th>
                          <th>Projet</th>
                          <th>Date</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach ($contributions as $contribution)
                          <tr>
                            <td>{{ $contribution->anonyme ? 'Anonyme' :  $contribution->username }}</td>
                            <td class="font-weight-bold">{{ number_format($contribution->montant,0,',',' ')  }} </td>
                            <td>{{ $contribution->projects_nom }}</td>
                            <td>{{ $contribution->created_at }}</td>
                          </tr>
                          @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
        </div>
        <!--/ Total Revenue -->


    </div>
    <!-- / Content -->

@endsection
