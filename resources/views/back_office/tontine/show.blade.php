@extends('back_office.partials.main')
@section('content')

<div class="justify-content-end px-3 mb-4">
    <a  href="{{ route('tontine.paiement', $tontine->id)}}" class="btn btn-primary">
        <i class="ti-plus"></i>
            Faire un versement
      </a>
</div>


<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
      <div class="card">

        <div class="card-body">
          <p class="card-title mb-3 mt-3">Participants</p>


              @if ($participants != '[]')
                    <div class="table-responsive">
                        <table class="table text-center table-striped table-borderless">
                            <thead>
                            <tr>
                                <th>Prénom</th>
                                <th>Nom</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($participants as $participant)
                                <tr>
                                    <td>{{ $participant->firstname }}</td>
                                    <td>{{ $participant->lastname }}</td>
                                    <td></td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>

              @else
                    <h3 class="alert alert-info alert-block text-center">Aucun Participant enregistré</h3>
              @endif


        </div>
      </div>
    </div>
  </div>

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
