@extends('back_office.partials.main')
@section('content')
@if (auth()->user()->validate)
<div class="justify-content-end px-3 mb-4">
    <a  href="{{ route('campagne.add')}}" class="btn btn-primary">
        <i class="ti-plus"></i>
         Faire une demande campagne
    </a>
</div>
@endif
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">

        <div class="card-body">
          <p class="card-title mb-3 mt-3">Liste Campagnes</p>
          @if($campagnes == '[]')
          <h3 class="alert alert-info alert-block text-center">Aucune campagne de financement enregistrée</h3>
          @else

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
                        @foreach ($campagnes as $campagne)
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
                                <td>

                                        <button href="{{ route('projet.overview',$campagne->project->id) }}" class="btn btn-success">Voir plus</button>
                                        @if($campagne->status == "en_cours" || $campagne->status == "rejeter")
                                           <button data-id="{{ $campagne->id }}" class="delete btn btn-danger mt-1" data-toggle="tooltip" title="Supprimer">
                                                Supprimer
                                            </button>
                                        @endif


                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div>
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
                        url: "{{route('campagne.delete','')}}/"+id,
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
