@extends('back_office.partials.main')
@section('content')
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<div class="row justify-content-center">
    <div class="col-sm-6">
        <div id="accordion">
            <div class="card">
              <div class="card-header" id="headingOne">
                <h5 class="mb-0">

                     <button class="btn" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Paypal & VISA <i  class="fa fa-paypal" aria-hidden="true"></i>
                    </button>

                </h5>
              </div>

              <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">

                        <div class="form-group">
                            <input type="number" id="amount" name="amount" class="form-control" placeholder="Montant" required>
                        </div>

                        <input type="hidden" name="campaigns_id" value="{{$id}}">
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        <div class="row justify-content-center mt-5">
                            <div class="col-sm-6" id="paypal-button-container">
                        </div>
                </div>
              </div>
            </div>

          </div>
        <!-- /#accordion -->
    </div>
</div>
@endsection
@section('script')

<script src="https://www.paypal.com/sdk/js?client-id={{ config('app.PAYPAL_SANDBOX_CLIENT_ID')}}&currency=USD"></script>
    <script>
        $(function(){
            $('.panel-heading').click(function(e) {
                $('.panel-heading').removeClass('tab-collapsed');
                var collapsCrnt = $(this).find('.collapse-controle').attr('aria-expanded');
                if (collapsCrnt != 'true') {
                    $(this).addClass('tab-collapsed');
                }
            });
        });
    </script>
    <script>
        paypal.Buttons({
            createOrder: function(data, actions){
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: document.getElementById('amount').value.toString()
                        }
                    }]
                });
            },
            onApprove: function(data,actions){
                return actions.order.capture().then(function(details){
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: "{{route('paypal.tontine')}}",
                        type: 'POST',
                        data : { tontine_id : {{ $tontine->id }}, users_id : {{ auth()->user()->id }}, montant: document.getElementById('amount').value.toString()},
                        success: function(result) {
                            if(result == 'done'){
                                Swal.fire({
                                 icon: 'success',
                                 title: 'Merci d\'avoir contribuer à ce projet',
                                 confirmButtonText: 'OK',

                                }).then((result) => {
                                    window.location.href = 'tontine/my-tontines';
                                });

                            }else{

                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Echec !'
                                });
                            }

                        },
                        error: function (error) {
                            Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Un probleme est survenu !'
                                });
                            //location.reload();
                        }
                    });
                });
            }
        }).render('#paypal-button-container');
    </script>
@endsection
