@extends('back_office.partials.main')
@section('content')
@if(!auth()->user()->profil->name == "users")
<div class="justify-content-end px-3 mb-4">
    <a  href="{{ route('projet.add')}}" class="btn btn-primary">
        <i class="ti-plus"></i>
            Ajouter une tontine
      </a>
</div>
@endif

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">

        <div class="card-body">
          <p class="card-title mb-3 mt-3">Liste tontines</p>
              @if ($tontines != '[]')
                    <div class="table-responsive">
                        <table class="table text-center table-striped table-borderless">
                            <thead>
                            <tr>
                                <th>Tontine</th>
                                <th>Cotisation (FCFA)</th>
                                <th>Main disponible</th>
                                <th>Main Restant</th>
                                <th>Debut</th>
                                <th>Fin</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($tontines as $tontine)
                                <tr>
                                    <td><b>{{ $tontine->nom }}</b></td>
                                    <td> <span class="badge bg-success">{{ number_format($tontine->cotisation,0,',',' ')  }}</span></td>
                                    <td>{{ $tontine->nombre_main }}</td>
                                    @if (($tontine->nombre_main - $tontine->nbr) > 0)
                                        <td>{{ $tontine->nombre_main - $tontine->nbr }}</td>
                                    @else
                                        <td> <span class="badge bg-danger">0</span></td>
                                    @endif
                                    <td>{{ $tontine->debut }}</td>
                                    <td>{{ $tontine->fin }}</td>
                                    @if(auth()->user()->profil->name == "users")
                                        @if (($tontine->nombre_main - $tontine->nbr) > 0)
                                            <td>
                                                <button
                                                type="button"
                                                class="btn btn-primary"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalCenter{{$tontine->id}}">Rejoindre</button>
                                            </td>
                                        @else
                                            <td>
                                                <span class="badge bg-warning">Fermée</span>
                                            </td>
                                        @endif

                                    @else
                                        <td>
                                            <a class="btn btn-success" href="{{ route('tontine.startTontine',$tontine->id) }}">Lancer</a>
                                            <a class="btn btn-primary" href="{{ route('tontine.create',$tontine->id) }}">Modifier</a>
                                            <a data-id="{{ $tontine->id }}"  class="btn btn-danger delete text-white" onclick="" >Supprimer</a>
                                        </td>
                                    @endif

                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>

              @else
                    <h3 class="alert alert-info alert-block text-center">Aucune tontine enregistré</h3>
              @endif


        </div>
      </div>
    </div>
  </div>


<!-- Modal -->
@foreach ($tontines as $key => $tontine)
<div class="modal fade" id="modalCenter{{$tontine->id}}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <form action="{{route('tontine.demande',$tontine->id)}}" id="{{$tontine->id}}" method="POST">
            @csrf
            <div class="modal-header">
            <h5 class="modal-title" id="modalCenterTitle">Demande Participation</h5>
            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
            ></button>
            </div>
            <div class="modal-body">
            <div class="row">
                <div class="col mb-3">
                <label for="nameWithTitle" class="form-label">Main</label>

                        <input name="main" type="number" id="nameWithTitle" class="form-control" placeholder="Combien de main voulez-vous ?" />
                        <input name="users_id" type="hidden" id="nameWithTitle" class="form-control" value="{{ auth()->user()->id }}" />
                </form>
                </div>
            </div>
            </div>

            <div class="modal-footer">
                <button onclick="form_submit({{ $tontine->id }})" class="btn btn-primary mt-2 text-white">Envoyer</button>
            </div>
       </form>
      </div>
    </div>
  </div>


@endforeach

   <!-- Modal -->
@endsection

@section('script')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        function form_submit(id) {
          document.getElementById(id).submit();
         }
    </script>
    <script>
        $('body').on('click', '.delete', function (e) {

            e.preventDefault()
            var id = $(this).data("id");

            Swal.fire({
                title: 'Confirmation !',
                text: "Voulez-vous vraiment supprimer cet élément ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Oui, supprimer!',
                cancelButtonText: "Annuler",
                customClass: {
                confirmButton: 'btn btn-primary',
                cancelButton: 'btn btn-outline-danger ml-1',
                closeOnConfirm: false
                },
                buttonsStyling: false
            }).then(function (result) {
                if (result.value) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: "{{route('tontine.delete','')}}/"+id,
                        type: 'DELETE',
                        success: function(result) {
                            if(result == 'done'){
                                location.reload();
                            }else{

                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Problème de suppression !'
                                });
                            }

                        },
                        error: function (error) {
                            location.reload();
                        }
                    });
                }
            });
        });

    </script>
@endsection
