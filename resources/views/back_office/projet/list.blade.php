@extends('back_office.partials.main')
@section('content')
<div class="justify-content-end px-3 mb-4">
    <a  href="{{ route('projet.add')}}" class="btn btn-primary">
        <i class="ti-plus"></i>
        Ajouter un projet
      </a>
</div>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">

        <div class="card-body">
          <p class="card-title mb-3 mt-3">Liste projets</p>


              @if ($projects != '[]')
                    <div class="table-responsive">
                        <table class="table text-center table-striped table-borderless">
                            <thead>
                            <tr>
                                <th>Nom du Projet</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($projects as $projet)
                                <tr>
                                    <td><b>{{ $projet->nom }}</b></td>
                                    <td>{{ $projet->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <span class="badge bg-info">{{ $projet->statut }}</span>
                                    </td>
                                    <td>
                                        <a class="btn btn-primary" href="{{ route('projet.add',$projet->id) }}">Modifier</a>
                                        <a data-id="{{ $projet->id }}"  class="btn btn-danger delete text-white" onclick="" >Supprimer</a>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>

              @else
                    <h3 class="alert alert-info alert-block text-center">Aucun projet enregistré</h3>
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
