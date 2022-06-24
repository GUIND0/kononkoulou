@extends('back_office.partials.main')
@section('content')
<div class="justify-content-end mb-3 px-3">
    <a class="btn btn-primary" href="{{ route('campagne.list')}}"><i class="ti-home mr-2"></i>Retour à la liste</a>
</div>
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Demande de campagne</h4>
            <form action="{{ route('campagne.store') }}" enctype="multipart/form-data"  method="POST" class="forms-sample" >
                @csrf
                <div class="form-group">
                    <label for="exampleInputName1">Projet</label>
                    <select class="form-control" name="projet">
                        <option value="none">Veuillez Selectionner un projet</option>
                        @foreach ($projects as $project)
                            <option value="{{ $project->id }}">{{ $project->nom }}</option>
                        @endforeach
                    </select>
                </div>

              <div class="form-group mt-1">
                <label for="exampleInputName1">Type de Financemnt</label>
                <select class="form-control" id="type" name="type">
                    <option value="none">Veuillez Selectionner un type</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
              </div>

              <div class="form-group mt-1" id="recompense_block" style="display: none;">
                    <label for="">Recompense</label>
                   <textarea class="form-control" name="recompense" cols="30" rows="10"></textarea>
              </div>

              <div class="form-group mt-2" id="photo_block" style="display: none;">
                <label>Photo Récompense</label>
                <input type="file" name="photo_recompense" class="form-control">

                @if($errors->has('logo'))
                    <span class="help-block text-danger">
                        <li>{{ $errors->first('logo') }}</li>
                    </span>
                @endif
              </div>

              <div class="mt-3">
                <button type="submit" class="btn btn-primary mr-2">Enregistrer</button>
                <button class="btn btn-danger">Annuler</button>
              </div>
            </form>
          </div>
        </div>
      </div>
</div>
@endsection

@section("script")
<script>
    $(document).ready(function(){
        $('#type').on('change', function() {
            if(this.value == 1){
                $('#recompense_block').show();
                $('#photo_block').show();
            }

            if(this.value == 3 || this.value == 4){
                $('#recompense_block').show();
                $('#photo_block').hide();
            }

            if(this.value == 'none' || this.value == 2){
                $('#recompense_block').hide();
                $('#photo_block').hide();
            }
        });
    });
</script>

<script src="{{ asset('template2/js/file-upload.js') }}"></script>
@endsection
