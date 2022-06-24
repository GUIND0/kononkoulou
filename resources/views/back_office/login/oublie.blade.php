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

    <title>Kononkoulou - Mot de passe oublié</title>

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

              <p class="mb-4">Un lien réinitialisation vous sera envoyer paqr mail.</p>

              <form id="formAuthentication" class="mb-3" action="#" method="POST">
                @csrf
                    @if($errors->has('login'))
                        <span class="help-block text-danger">
                            <li>{{ $errors->first('login') }}</li>
                        </span>
                    @endif
                <div class="mb-3">
                  <label for="email" class="form-label">Identifiant</label>
                  <input
                    type="text"
                    class="form-control"
                    value="{{ old('email') }}" name="email" id="email"
                    placeholder="Email"
                    autofocus
                  />
                  @if($errors->has('email'))
                    <span class="help-block text-danger">
                        <li>{{ $errors->first('email') }}</li>
                    </span>
                  @endif
                </div>


                <div class="mt-2 mb-3">
                  <button class="btn btn-primary d-grid w-100" type="submit">Envoyer</button>
                </div>
              </form>

              <p class="text-center">
                <span>Pas de compte ?</span>
                <a href="{{ route('register') }}">
                  <span>Créer un compte</span>
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
