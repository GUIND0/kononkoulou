@extends('back_office.partials.main')
@section('content')

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">

        <div class="card-body">
          <p class="card-title mb-3 mt-3">Liste Campagnes</p>
          <div class="table-responsive">
            <table class="table table-striped table-borderless text-center">
              <thead>
                <tr>
                  <th>Projet</th>
                  <th>Budget(FCFA)</th>
                  <th>Début</th>
                  <th>Fin</th>
                  <th>Type Campagne</th>
                  <th>Status</th>
                  <th>Détails</th>
                </tr>
              </thead>
              <tbody>

                @forelse ($campagnes as $campagne)
                 <tr>
                    <td>{{ $campagne->project->nom }}</td>
                    <td>{{ number_format($campagne->project->budget_demande,0,',',' ')  }}</td>
                    <td>{{ $campagne->startdate }}</td>
                    <td>{{ $campagne->enddate }}</td>
                    <td>{{ $campagne->type->name }}</td>
                    <td>
                        @if ($campagne->status == 'en_cours')
                            <span class="badge bg-info">En cours de traitement</span>
                        @endif
                        @if ($campagne->status == 'valider')
                            <span class="badge bg-primary">Valider</span>
                        @endif
                        @if ($campagne->status == 'rejeter')
                            <span class="badge bg-danger">Rejeter</span>
                        @endif
                        @if ($campagne->status == 'success')
                            <span class="badge bg-success">Objectif Atteint</span>
                        @endif
                        @if ($campagne->status == 'echec')
                            <span class="badge bg-success">Echec</span>
                        @endif
                     </td>
                     <td><a href="{{ route('projet.overview',$campagne->projects_id) }}" class="btn btn-success">Voir plus</a></td>

                </tr>
                @empty
                    <td>
                        Aucune campagne en cours de validation.
                    </td>
                @endforelse

              </tbody>
            </table>
          </div>
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
                        url: "{{route('projet.delete','')}}/"+id,
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
