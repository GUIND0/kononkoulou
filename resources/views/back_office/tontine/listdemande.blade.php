@extends('back_office.partials.main')
@section('content')


<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">

        <div class="card-body">
          <p class="card-title mb-3 mt-3">Liste Demandes</p>


              @if ($tontines != '[]')
                    <div class="table-responsive">
                        <table class="table text-center table-striped table-borderless">
                            <thead>
                            <tr>
                                <th>Tontine</th>
                                <th>Demandeur</th>
                                <th>Cotisation</th>
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
                                    <td><b>{{ $tontine->tontines_nom }}</b></td>
                                    <td><b>{{ $tontine->users_username}}</b></td>
                                    <td><b>{{ number_format($tontine->tontines_cotisation,0,',',' ')  }}</b></td>
                                    <td>{{ $tontine->tontines_nombre_main }}</td>
                                    <td>{{ $tontine->tontines_nombre_main }}</td>
                                    <td>{{ $tontine->tontines_debut }}</td>
                                    <td>{{ $tontine->tontines_fin }}</td>
                                    <td>
                                        <a class="btn btn-primary" href="{{ route('tontine.acceptedemande',$tontine->id) }}">Accepter</a>
                                        <a class="btn btn-danger" href="{{ route('tontine.rejeterdemande',$tontine->id) }}">Rejeter</a>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>

              @else
                    <h3 class="alert alert-info alert-block text-center">Aucune demande enregistrée</h3>
              @endif


        </div>
      </div>
    </div>

  </div>
@endsection

@section('script')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
