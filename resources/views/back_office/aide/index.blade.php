@extends('back_office.partials.main')
@section('content')
<div class="row">
    <div class="col-md-12 mb-4 mb-md-0">
      <h3 class="text-light fw-semibold">Les questions fréquemment posées</h3>
      <div class="accordion mt-3" id="accordionExample">
        <div class="card accordion-item">
          <h2 class="accordion-header" id="headingOne">
            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionOne" aria-expanded="false" aria-controls="accordionOne">
              Comment récuperer la somme collecter ?
            </button>
          </h2>

          <div id="accordionOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample" style="">
            <div class="accordion-body">
              Contactez kononkoulou par mail via kononkoulou@gmail.com, On vous fixera un rendez-vous ou vous pourrez recuperer votre somme après vous etre identifier.
            </div>
          </div>
        </div>
        <div class="card accordion-item">
          <h2 class="accordion-header" id="headingTwo">
            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionTwo" aria-expanded="false" aria-controls="accordionTwo">
              Aurai-je la somme récoltée en cas d'echec ?
            </button>
          </h2>
          <div id="accordionTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              Oui.
            </div>
          </div>
        </div>
        <div class="card accordion-item">
          <h2 class="accordion-header" id="headingThree">
            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionThree" aria-expanded="false" aria-controls="accordionThree">
              Peut-on soumettre le même projet deux fois ?
            </button>
          </h2>
          <div id="accordionThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              Non.
            </div>
          </div>
        </div>


        <div class="card accordion-item">
            <h2 class="accordion-header" id="headingThree">
              <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionThree" aria-expanded="false" aria-controls="accordionThree">
                Peut-on quitter une tontine avant la fin ?
              </button>
            </h2>
            <div id="accordionThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                oui, Mais faudrait trouver un arrangement à l'amiable.
              </div>
            </div>
          </div>


          <div class="card accordion-item">
            <h2 class="accordion-header" id="headingThree">
              <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionThree" aria-expanded="false" aria-controls="accordionThree">
                C'est possible de faire des dons anonymes ?
              </button>
            </h2>
            <div id="accordionThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                Oui.
              </div>
            </div>
          </div>


      </div>
    </div>

  </div>
@endsection
