<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>{{ config('app.name') }} - Se connecter</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('template2/vendors/feather/feather.css') }}">
  <link rel="stylesheet" href="{{ asset('template2/vendors/ti-icons/css/themify-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('template2/vendors/css/vendor.bundle.base.css') }}">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('template2/css/vertical-layout-light/style.css') }}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{ asset('template2/images/favicon.png') }}" />
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-3 px-4 px-sm-5">
              <div class="brand-logo">
                  {{ config('app.name') }}

              </div>
              <form action="#" method="POST" class="pt-3">
                    @if($errors->has('login'))
                        <span class="help-block text-danger">
                            <li>{{ $errors->first('login') }}</li>
                        </span>
                    @endif

                  @csrf

                <input type="hidden" name="user_id" value="{{ $userPassword->users_id }}">
                <input type="hidden" name="id" value="{{ $userPassword->id }}">

                <div class="form-group mb-1">
                    <div class="d-flex justify-content-between">
                        <label for="password">Nouveau mot de passe</label>
                    </div>
                    <div class="input-group input-group-merge form-password-toggle">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-lock"></i></span>
                        </div>
                        <input type="password" class="form-control form-control-merge" id="password" name="password" tabindex="2" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="Password" required/>
                        <div class="input-group-append">
                            <span class="input-group-text cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                            </span>
                        </div>
                    </div>
                    @if($errors->has('password'))
                        <span class="help-block text-danger">
                            <li>{{ $errors->first('password') }}</li>
                        </span>
                     @endif
                </div>
                <div class="form-group mb-1">
                    <div class="d-flex justify-content-between">
                        <label for="password_confirmation">Confirmation</label>
                    </div>
                    <div class="input-group input-group-merge form-password-toggle">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-lock"></i></span>
                        </div>
                        <input type="password" class="form-control form-control-merge" id="password_confirmation" name="password_confirmation" tabindex="2" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password_confirmation" required/>
                        <div class="input-group-append">
                            <span class="input-group-text cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                            </span>
                        </div>
                    </div>
                    @if($errors->has('password_confirmation'))
                        <span class="help-block text-danger">
                            <li>{{ $errors->first('password_confirmation') }}</li>
                        </span>
                    @endif


                </div>

                <button type="submit" class="btn btn-primary btn-block mb-1" tabindex="4">Valider</button>
                <p class="text-center mt-2">
                    <a href="{{ route('login') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left"><polyline points="15 18 9 12 15 6"></polyline></svg>
                        Retour à la page connexion
                    </a>
                </p>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="{{ asset('template2/vendors/js/vendor.bundle.base.js') }}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{ asset('template2/js/off-canvas.js') }}"></script>
  <script src="{{ asset('template2/js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('template2/js/template.js') }}"></script>
  <script src="{{ asset('template2/js/settings.js') }}"></script>
  <script src="{{ asset('template2/js/todolist.js') }}"></script>
  <!-- endinject -->
</body>

</html>
