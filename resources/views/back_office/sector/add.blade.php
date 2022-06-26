@extends('back_office.partials.main')
@section('content')
<div class="justify-content-end mb-3 px-3">
    <a class="btn btn-primary" href="{{ route('sector.list')}}"><i class="ti-home mr-2"></i>Retour</a>
</div>
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Ajouter un secteur</h4>
            <form action="{{ route('sector.store') }}" enctype="multipart/form-data"  method="POST" class="forms-sample" >
                @csrf
                <input type="hidden" name="id" value="{{ $sector->id ?? '' }}">
                <div class="form-group">
                    <label for="exampleInputName1">Libelle</label>
                    <input type="text" name="name" value="{{ $sector->name ?? old('name') }}" class="form-control" >
                    @if($errors->has('name'))
                        <span class="help-block text-danger">
                            <li>{{ $errors->first('name') }}</li>
                        </span>
                    @endif
                </div>

              <button type="submit" class="btn btn-primary mr-2 mt-2">Enregistrer</button>

            </form>
          </div>
        </div>
      </div>
</div>
@endsection

@section("script")
<script src="{{ asset('template2/js/file-upload.js') }}"></script>
@endsection
