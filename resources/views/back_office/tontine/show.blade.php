@extends('back_office.partials.main')
@section('content')

<div class="justify-content-end px-3 mb-4">
    <a  href="{{ route('tontine.paiement', $tontine->id)}}" class="btn btn-primary">
        <i class="ti-plus"></i>
            Faire un versement
      </a>
</div>


<div class="row">
    <div class="col-md-6 mb-4 stretch-card transparent">
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
                </div>
                <span class="fw-semibold d-block mb-1">Ma Cotisation Mensuelle</span>
                <h3 class="card-title mb-2">{{ number_format($tontine->cotisation * $participation->main,0,',',' ')  }}</h3>
            </div>
        </div>
    </div>


    <div class="col-md-6 mb-4 stretch-card transparent">
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
                </div>
                <span class="fw-semibold d-block mb-1">Montant à encaisser</span>
                <h3 class="card-title mb-2">{{ number_format(($tontine->cotisation * $tontine->nombre_main) * $participation->main,0,',',' ')  }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-4 stretch-card transparent">
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
                </div>
                <span class="fw-semibold d-block mb-1">Nombre de Tour</span>
                <h3 class="card-title mb-2">{{ number_format($tontine->nombre_main,0,',',' ')  }}</h3>
            </div>
        </div>
    </div>

</div>


<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <p class="card-title mb-3 mt-3">Mes versements</p>

                @if ($participants != '[]')
                      <div class="table-responsive text-nowrap">
                          <table class="table table-bordered">
                              <thead>
                              <tr>
                                  <th>Date</th>
                                  <th>Montant</th>

                              </tr>
                              </thead>
                              <tbody>

                              @foreach ($versements as $versement)
                                  <tr>
                                      <td>{{ $versement->created_at->format('d-m-Y') }}</td>
                                      <td>{{ number_format($versement->montant,0,',',' ')}}</td>

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


<div class="row mt-5">
    <!---------------->
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <p class="card-title mb-3 mt-3">Participants</p>

              @if ($participants != '[]')
                    <div class="table-responsive text-nowrap">
                        <table class="table table-bordered">
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
