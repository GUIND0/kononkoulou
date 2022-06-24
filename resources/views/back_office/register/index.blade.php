<!DOCTYPE html>

<html
  lang="en"
  class="light-style customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="/new/assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Kononkoulou - Page d'enregistrement</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/new/assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="/new/assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="/new/assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="/new/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="/new/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="/new/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="/new/assets/vendor/css/pages/page-auth.css" />
    <!-- Helpers -->
    <script src="/new/assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="/new/assets/js/config.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  </head>

  <body>
    <!-- Content -->

    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Register -->
          <div class="card">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center">
                <a href="index.html" class="app-brand-link gap-2">
                  <span class="app-brand-text demo text-body fw-bolder">Kononkoulou</span>
                </a>
              </div>
              <!-- /Logo -->
              <h4 class="mb-2">Bienvenue sur Kononkoulou</h4>
              <p class="mb-4">Créer un compte pour profiter d'une experience unique.</p>

              <form id="formAuthentication" class="mb-3" action="{{ route('register.store') }}" method="POST">
                @csrf
                    @if($errors->has('login'))
                        <span class="help-block text-danger">
                            <li>{{ $errors->first('login') }}</li>
                        </span>
                    @endif
                <div class="mb-3">
                  <label for="email" class="form-label">Prénom</label>
                  <input
                    type="text"
                    class="form-control"
                    name="firstname" value="{{ old('firstname') }}" id="firstname" placeholder="Prénom"
                    autofocus
                  />
                  @if($errors->has('firstname'))
                    <span class="help-block text-danger">
                        <li>{{ $errors->first('firstname') }}</li>
                    </span>
                  @endif
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Nom</label>
                    <input
                      type="text"
                      class="form-control"
                      name="lastname" value="{{ old('lastname') }}" id="lastname" placeholder="Prénom"
                      autofocus
                    />
                    @if($errors->has('lastname'))
                      <span class="help-block text-danger">
                          <li>{{ $errors->first('lastname') }}</li>
                      </span>
                    @endif
                </div>


                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input
                      type="text"
                      class="form-control"
                      name="email" value="{{ old('email') }}" id="email" placeholder="Email"
                      autofocus
                    />
                    @if($errors->has('email'))
                      <span class="help-block text-danger">
                          <li>{{ $errors->first('email') }}</li>
                      </span>
                    @endif
                </div>


                <div class="mb-3">
                    <label for="email" class="form-label">Téléphone</label>
                    <input
                      type="text"
                      class="form-control"
                      name="telephone" value="{{ old('telephone') }}" id="telephone" placeholder="Tel"
                      autofocus
                    />
                    @if($errors->has('telephone'))
                      <span class="help-block text-danger">
                          <li>{{ $errors->first('telephone') }}</li>
                      </span>
                    @endif
                </div>



                <div class="mb-3">
                    <label for="email" class="form-label">Adresse</label>
                    <input
                      type="text"
                      class="form-control"
                      name="adresse" value="{{ old('adresse') }}" id="adresse" placeholder="adresse"
                      autofocus
                    />
                    @if($errors->has('adresse'))
                      <span class="help-block text-danger">
                          <li>{{ $errors->first('adresse') }}</li>
                      </span>
                    @endif
                </div>


                <div class="mb-3">
                    <label for="email" class="form-label">Pays</label>
                    <select class="form-control" name="pays" id="pays">
                        <option value="">Veuillez selectionner un pays</option>
                          @foreach ($pays as $value)
                              <option value="{{ $value->id }}" {{ old('pays') == $value->id ? 'selected' : '' }} >{{ $value->libelle }}</option>
                          @endforeach
                    </select>
                    @if($errors->has('pays'))
                        <span class="help-block text-danger">
                            <li>{{ $errors->first('pays') }}</li>
                        </span>
                    @endif
                </div>


                <div class="mb-3">
                    <input type="checkbox" name="condition"  class="form-check-input">
                      Je confirme avoir plus de 18 ans et accepte les Conditions générales de service Kononkoulou
                    </label>
                    @if($errors->has('condition'))
                        <span class="help-block text-danger">
                            <li>{{ $errors->first('condition') }}</li>
                        </span>
                    @endif
                </div>




                <div class="g-recaptcha" data-sitekey="{{ config('app.reCAPTCHA') }}"></div>
                @if($errors->has('g-recaptcha-response'))
                    <span class="help-block text-danger">
                        <li>{{ $errors->first('g-recaptcha-response') }}</li>
                    </span>
                 @endif

                <div class="mt-2 mb-3">
                  <button class="btn btn-primary d-grid w-100" type="submit">Créer un compte</button>
                </div>
              </form>

              <p class="text-center">
                <span>Dejà un compte?</span>
                <a href="{{ route('login') }}">
                  <span>Se connecter</span>
                </a>
              </p>
            </div>
          </div>
          <!-- /Register -->
        </div>
      </div>
    </div>

    <!-- / Content -->


    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="/new/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="/new/assets/vendor/libs/popper/popper.js"></script>
    <script src="/new/assets/vendor/js/bootstrap.js"></script>
    <script src="/new/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="/new/assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="/new/assets/js/main.js"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
