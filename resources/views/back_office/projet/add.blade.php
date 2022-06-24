@extends('back_office.partials.main')
@section('content')
<div class="justify-content-end mb-3 px-3">
    <a class="btn btn-primary" href="{{ route('projet.list')}}"><i class="menu-icon tf-icons bx bx-arrow-back"></i>Retour</a>
</div>
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Rédaction du Projet</h4>
            <form action="{{ route('projet.store') }}" enctype="multipart/form-data"  method="POST" class="forms-sample" >
                @csrf
                <input type="hidden" name="id" value="{{ $projet->id ?? '' }}">
              <div class="form-group">
                <label for="exampleInputName1">Nom du projet</label>
                <input type="text" name="name" value="{{ $projet->nom ?? old('name') }}" class="form-control" >
                @if($errors->has('name'))
                    <span class="help-block text-danger">
                        <li>{{ $errors->first('name') }}</li>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <label for="exampleInputName1">Budget demandé</label>
                <input type="text" name="budget" id="toFormat1" value="{{ $projet->budget_demande ?? old('budget') }}" class="form-control" >
                @if($errors->has('budget'))
                    <span class="help-block text-danger">
                        <li>{{ $errors->first('budget') }}</li>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="destinataire" class="mt-1">Category</label>
                <select class="form-control" id="stuff" name="categories[]">
                    @foreach ($sectors as $sector)
                        <option value="{{ $sector->id }}">{{ $sector->name }}</option>
                    @endforeach
                </select>
            </div>


              <div class="form-group mb-3">
                    <label for="exampleInputEmail3">Resume du projet</label>
                    <textarea name="resume"  class="form-control" id="exampleTextarea1" rows="6">{{  $projet->resume ?? old('resume') }}</textarea>
                    @if($errors->has('resume'))
                        <span class="help-block text-danger">
                            <li>{{ $errors->first('resume') }}</li>
                        </span>
                    @endif
                </div>

                <div class="form-group mt-1">
                    <label>Description complète</label>
                    <input type="file" value="{{ old('description') }}" name="description" accept="application/pdf" class="form-control" >
                    @if($errors->has('description'))
                        <span class="help-block text-danger">
                            <li>{{ $errors->first('description') }}</li>
                        </span>
                    @endif
              </div>



              <div class="form-group mt-1">
                    <label>Logo</label>

                    <input type="file" name="logo" accept="image/png, image/gif, image/jpeg" class="form-control" >

                    @if($errors->has('logo'))
                        <span class="help-block text-danger">
                            <li>{{ $errors->first('logo') }}</li>
                        </span>
                    @endif
              </div>

              @if ($projet != null)
              <div class="form-group">
                <label for="exampleInputEmail3">Status</label>
                <select class="form-control" name="statut">
                    <option {{ $projet->statut == 'en redaction' ? 'selected' : '' }}  value="en redaction">En cours de redaction</option>
                    <option {{ $projet->statut == 'mature' ? 'selected' : '' }}  value="mature">Mature</option>
                </select>
                @if($errors->has('statut'))
                    <span class="help-block text-danger">
                        <li>{{ $errors->first('statut') }}</li>
                    </span>
                @endif
             </div>
              @endif

              <div class="mt-5">
                <button type="submit" class="btn btn-primary mr-2">Enregistrer</button>
                <button type="reset" class="btn btn-warning">Annuler</button>
              </div>
            </form>
          </div>
        </div>
      </div>
</div>
@endsection

@section("script")

<script>
    $(document).ready(function() {
         $('#stuff').select2();
    });
    $(document).ready(function(){
        $('#toFormat1').maskMoney({thousands:' ', decimal:'', allowZero:true});
    });
</script>
@endsection
