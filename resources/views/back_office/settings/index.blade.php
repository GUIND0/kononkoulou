@extends('back_office.partials.main')
@section('content')
    @if (auth()->user() != null && !auth()->user()->validate  && auth()->user()->photo_identite == '')
    <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>Veuillez importer votre pièce d'identité afin de compléter votre inscription.</strong>
    </div>
    @endif
<div class="container light-style flex-grow-1 container-p-y">

    <h4 class="font-weight-bold py-3 mb-4">
      Paramètres
    </h4>

    <div class="card overflow-hidden">
      <div class="row no-gutters row-bordered row-border-light">
        <div class="col-md-3 pt-0">
          <div class="list-group list-group-flush account-settings-links">
            <a class="list-group-item list-group-item-action active" data-toggle="list" href="#account-general">Information générale</a>
            <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-change-password">Changer de mot de passe</a>
            <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-info">Information complémentaire</a>
            <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-social-links">Réseaux sociaux</a>
          </div>
        </div>
        <div class="col-md-9">
          <div class="tab-content">
            <div class="tab-pane fade active show" id="account-general">
                <form action="{{ route('user.update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body media align-items-center">
                        <img id="preview-image-before-upload" class="img-fluid" src="{{ auth()->user()->photo != '' ? auth()->user()->photo : 'https://cdn.pixabay.com/photo/2016/08/08/09/17/avatar-1577909_960_720.png' }}"
                                alt="preview image" style="max-height: 150px;">
                      </div>

                      <hr class="border-light m-0">

                      <div class="card-body">
                                <div class="form-group">
                                    <label>Photo de profil</label>

                                    <input type="file" id="image" name="photo"  accept="image/png, image/gif, image/jpeg"  class="form-control file-upload-info">

                                    @if($errors->has('logo'))
                                        <span class="help-block text-danger">
                                            <li>{{ $errors->first('logo') }}</li>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Prénom</label>
                                    <input type="text" name="firstname" class="form-control mb-1" value="{{ auth()->user()->firstname ?? old('firstname') }}">
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Nom</label>
                                    <input type="text" name="lastname" class="form-control" value="{{ auth()->user()->lastname ?? old('lastname') }}">
                                </div>


                                @if (!auth()->user()->validate)
                                    <div class="form-group">
                                        <label>Photo de carte d'identité</label>

                                        <input type="file" name="carte"  accept="image/png, image/gif, image/jpeg" class="form-control">

                                        @if($errors->has('carte'))
                                            <span class="help-block text-danger">
                                                <li>{{ $errors->first('carte') }}</li>
                                            </span>
                                        @endif
                                    </div>
                                @endif

                                <div class="text-right mt-3">
                                    <button type="submit" class="btn btn-primary">Enregistrer</button>&nbsp;
                                    <button type="reset" class="btn btn-warning">Réinitialiser</button>
                                  </div>

                            </div>
                </form>
            </div>
            <div class="tab-pane fade" id="account-change-password">
              <div class="card-body pb-2">

                <form action="{{ route('user.password') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Actuel mot de passe</label>
                        <input type="password" value="{{ old('password') }}" name="password" class="form-control">
                        @if($errors->has('password'))
                            <span class="help-block text-danger">
                                <li>{{ $errors->first('password') }}</li>
                            </span>
                        @endif
                      </div>

                      <div class="form-group">
                        <label class="form-label">Nouveau mot de passe</label>
                        <input type="password" name="newpassword" class="form-control">
                        @if($errors->has('newpassword'))
                            <span class="help-block text-danger">
                                <li>{{ $errors->first('newpassword') }}</li>
                            </span>
                        @endif
                      </div>

                      <div class="form-group">
                        <label class="form-label">Répéter le nouveau mot de passe</label>
                        <input type="password" value="{{ old('newpassword_confirmation')}}" name="newpassword_confirmation" class="form-control">
                        @if($errors->has('newpassword_confirmation'))
                            <span class="help-block text-danger">
                                <li>{{ $errors->first('newpassword_confirmation') }}</li>
                            </span>
                        @endif
                      </div>

                      <div class="text-right mt-3">
                        <button type="submit" class="btn btn-primary">Enregistrer</button>&nbsp;
                        <button type="reset" class="btn btn-warning">Réinitialiser</button>
                      </div>
                </form>

              </div>
            </div>
                <div class="tab-pane fade" id="account-info">
                    <div class="card-body pb-2">

                        <form action="{{ route('user.update') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label class="form-label">Bio</label>
                                <textarea class="form-control" name="bio" rows="5">{{ auth()->user()->bio ?? old('bio') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Date naissance</label>
                                <input type="date" name="date_naissance" class="form-control" value="{{ auth()->user()->date_naissance ?? old('date_naissance') }}">
                            </div>

                            <div class="form-group">
                                <label class="form-label">Pays</label>
                                <select class="form-control">
                                    @foreach ($pays as $value)
                                        <option {{ auth()->user()->pays_id == $value->id ? 'selected' : '' }}  value="{{ $value->id }}">{{ $value->libelle }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Téléphone</label>
                                <input type="tel" name="telephone" class="form-control" value="{{ auth()->user()->telephone ?? old('telephone') }}">
                            </div>

                            <div class="text-right mt-3">
                                <button type="submit" class="btn btn-primary">Enregistrer</button>&nbsp;
                                <button type="reset" class="btn btn-warning">Réinitialiser</button>
                            </div>

                        </form>

                    </div>

                </div>

            <div class="tab-pane fade" id="account-social-links">
              <div class="card-body pb-2">
                    <form action="{{ route('user.update') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">Twitter</label>
                            <input type="text" name="twitter" class="form-control" value="{{ auth()->user()->twitter ?? old('twitter') }}">
                          </div>
                          <div class="form-group">
                            <label class="form-label">Facebook</label>
                            <input type="text" name="facebook" class="form-control" value="{{ auth()->user()->facebook ?? old('facebook') }}">
                          </div>

                          <div class="form-group">
                            <label class="form-label">LinkedIn</label>
                            <input type="text" name="linkedin" class="form-control" value="{{ auth()->user()->linkedin ?? old('linkedin') }}">
                          </div>
                          <div class="form-group">
                            <label class="form-label">Instagram</label>
                            <input type="text" name="instagram" class="form-control" value="{{ auth()->user()->instagram ?? old('instagram') }}">
                          </div>

                          <div class="text-right mt-3">
                            <button type="submit" class="btn btn-primary">Enregistrer</button>&nbsp;
                            <button type="reset" class="btn btn-warning">Réinitialiser</button>
                        </div>
                    </form>
              </div>
            </div>


          </div>
        </div>
      </div>
    </div>



  </div>
@endsection

@section("script")
<script src="{{ asset('template2/js/file-upload.js') }}"></script>
<script>
    $(document).ready(function (e) {


        $('#image').change(function(){

        let reader = new FileReader();

        reader.onload = (e) => {

        $('#preview-image-before-upload').attr('src', e.target.result);
        }

        reader.readAsDataURL(this.files[0]);

        });

    });
</script>

@endsection
