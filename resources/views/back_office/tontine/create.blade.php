@extends('back_office.partials.main')
@section('content')
<div class="row justify-content-end mb-3 px-3">
    <a class="btn btn-primary" href="{{ route('projet.list')}}"><i class="ti-home mr-2"></i>Retour</a>
</div>
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Créer une Tontine</h4>
            <form action="{{ route('tontine.store') }}" enctype="multipart/form-data"  method="POST" class="forms-sample" >
                @csrf
                <input type="hidden" name="id" value="{{ $tontine->id ?? '' }}">

              <div class="form-group">
                <label for="exampleInputName1">Nom Tontine</label>
                <input type="text" name="nom" value="{{ $tontine->nom ?? old('nom') }}" class="form-control" >
                @if($errors->has('nom'))
                    <span class="help-block text-danger">
                        <li>{{ $errors->first('nom') }}</li>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="exampleInputName1">Cotisation Mensuelle</label>
                <input type="text" name="cotisation" id="toFormat1" value="{{ $tontine->cotisation ?? old('cotisation') }}" class="form-control">
                @if($errors->has('cotisation'))
                    <span class="help-block text-danger">
                        <li>{{ $errors->first('cotisation') }}</li>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="exampleInputName1">Nombre Main</label>
                <input type="number" name="nombre_main" value="{{ $tontine->nombre_main ?? old('nombre_main') }}" class="form-control">
                @if($errors->has('nombre_main'))
                    <span class="help-block text-danger">
                        <li>{{ $errors->first('nombre_main') }}</li>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="exampleInputName1">Date de debut</label>
                <input type="date" name="debut" value="{{ $tontine->debut ?? old('debut') }}" class="form-control">
                @if($errors->has('debut'))
                    <span class="help-block text-danger">
                        <li>{{ $errors->first('debut') }}</li>
                    </span>
                @endif
            </div>


            <div class="form-group">
                <label for="exampleInputName1">Date Fin</label>
                <input type="date" name="fin" value="{{ $tontine->fin ?? old('fin') }}" class="form-control">
                @if($errors->has('fin'))
                    <span class="help-block text-danger">
                        <li>{{ $errors->first('fin') }}</li>
                    </span>
                @endif
            </div>



              <button type="submit" class="btn btn-primary mr-2">Enregistrer</button>
              <button class="btn btn-light">Annuler</button>
            </form>
          </div>
        </div>
      </div>
</div>
@endsection

@section("script")
<script src="{{ asset('template2/js/file-upload.js') }}"></script>
<script>
    $(document).ready(function(){
        $('#toFormat1').maskMoney({thousands:' ', decimal:'', allowZero:true});
    });
</script>
@endsection
