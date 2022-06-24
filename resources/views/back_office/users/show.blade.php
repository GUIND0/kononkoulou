@extends('back_office.partials.main')
@section('content')
<div class="container">
    <div class="main-body">
        <div class="row justify-content-end mb-3 px-3">
            <a class="btn btn-primary" href="{{ route('user.list')}}"><i class="ti-home mr-2"></i>Retour</a>
        </div>
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                      @if ($user->photo != '')
                         <img src="/{{ $user->photo }}" alt="Admin" class="rounded-circle" width="150">
                      @endif
                    <div class="mt-3">
                      <h4>{{ $user->firstname }}&nbsp;{{ $user->lastname }}</h4>
                      <p class="text-secondary mb-1">{{ $user->profil->name }}</p>
                      @if ($user->validate == false)
                          <a href="{{ route('user.activate',$user->id) }}" class="btn btn-primary">Activer</a>
                      @else
                          <a href="{{ route('user.desactivate',$user->id) }}" class="btn btn-danger">Désactiver</a>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
              <div class="card mt-3">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter mr-2 icon-inline text-info"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>Twitter</h6>
                    <span class="text-secondary">{{ $user->twitter }}</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-instagram mr-2 icon-inline text-danger"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>Instagram</h6>
                    <span class="text-secondary">{{ $user->instagram }}</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook mr-2 icon-inline text-primary"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>Facebook</h6>
                    <span class="text-secondary">{{ $user->facebook }}</span>
                  </li>

                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook mr-2 icon-inline text-primary"><path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.542v7.225h2.401zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248-.822 0-1.359.54-1.359 1.248 0 .694.521 1.248 1.327 1.248h.016zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016a5.54 5.54 0 0 1 .016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225h2.4z"/></svg>Linkedin</h6>
                    <span class="text-secondary">{{ $user->linkedin }}</span>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">

                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      {{ $user->email }}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Téléphone</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      {{ $user->telephone }}
                    </div>
                  </div>
                  <hr>

                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Adresse</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                     {{ $user->address }}
                    </div>
                  </div>

                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Date Naissance</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                     {{ $user->date_naissance }}
                    </div>
                  </div>

                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Pays</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                     {{ $user->pays->libelle ?? '' }}
                    </div>
                  </div>


                </div>
              </div>

              @if ($user->bio != "")
              <div class="row gutters-sm">
                <div class="col-sm-12 mb-3">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <p>{{ $user->bio }}</p>
                    </div>
                </div>
                </div>
            </div>
              @endif

              @if ($user->photo_identite != '')
                <div class="row gutters-sm">
                    <div class="col-sm-12 mb-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <img src="{{ $user->photo_identite }}" alt="" srcset="">
                        </div>
                    </div>
                    </div>
                </div>
              @else
              <div class="row gutters-sm">
                <div class="col-sm-12 mb-3">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="badge badge-danger">Pas de piece d'identité</div>
                    </div>
                </div>
                </div>
              </div>
              @endif




            </div>
          </div>

        </div>
    </div>
@endsection

@section('script')

@endsection
