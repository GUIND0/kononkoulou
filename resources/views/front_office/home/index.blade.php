<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>{{ config('app.name') }}</title>
		<link rel="stylesheet" href="{{ asset('template1/vendors/mdi/css/materialdesignicons.min.css') }}">
		<link rel="stylesheet" href="{{ asset('template1/vendors/owl.carousel/css/owl.carousel.css') }}">
		<link rel="stylesheet" href="{{ asset('template1/vendors/owl.carousel/css/owl.theme.default.min.css') }}">
		<link rel="stylesheet" href="{{ asset('template1/vendors/aos/css/aos.css') }}">
		<link rel="stylesheet" href="{{ asset('template1/vendors/jquery-flipster/css/jquery.flipster.css') }}">
		<link rel="stylesheet" href="{{ asset('template1/css/style.css') }}">
		<link rel="shortcut icon" href="{{ asset('template1/images/favicon.png') }}" />
	</head>
	<body data-spy="scroll" data-target=".navbar" data-offset="50">

		<div id="mobile-menu-overlay"></div>
		<nav class="navbar navbar-expand-lg fixed-top">
			<div class="container">
				<a class="navbar-brand" href="#">{{ config('app.name') }}</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"><i class="mdi mdi-menu"> </i></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarTogglerDemo01">
					<div class="d-lg-none d-flex justify-content-between px-4 py-3 align-items-center">
						<img src="{{ asset('template1/images/logo-dark.svg') }}" class="logo-mobile-menu" alt="logo">
						<a href="javascript:;" class="close-menu"><i class="mdi mdi-close"></i></a>
					</div>
					<ul class="navbar-nav ml-auto align-items-center">
						<li class="nav-item active">
							<a class="nav-link" href="#home">Accueil <span class="sr-only">(current)</span></a>
						</li>

						<li class="nav-item">
							<a class="nav-link" href="#about">A propos</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#projects">Les Projets</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#testimonial">Témoignages</a>
						</li>

						<li class="nav-item">
							<a class="nav-link btn btn-success" href="{{ route('login') }}">Se connecter</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>


		<div class="page-body-wrapper">
			<section id="home" class="home">
				<div class="container">
					<div class="row">
						<div class="col-sm-12">
							<div class="main-banner">
								<div class="d-sm-flex justify-content-between">
									<div data-aos="zoom-in-up">
										<div class="banner-title">
												<h3 class="font-weight-medium">Nous aidons des
												Milliers de Start Up
												dans toutes l'Afrique à trouver un financement.
											</h3>
										</div>

										<a href="{{ route('back_office.index') }}" class="btn btn-secondary mt-3">En savoir plus</a>
									</div>
									<div class="mt-5 mt-lg-0">
										<img src="{{ asset('template1/images/stp.png') }}" alt="marsmello" class="img-fluid" data-aos="zoom-in-up">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>

			<section class="our-process" id="about">
				<div class="container">
                    <div class="row">
						<div class="col-sm-6" data-aos="fade-up">

							<h3 class="font-weight-medium text-dark">Porteur de Projet !</h3>
                            <p class="font-weight-medium mb-4">En tant que porteur de projet, peut importe la nature de votre projet, la plateforme vous permet de : </p>

							<div class="d-flex justify-content-start mb-3">
								<img src="{{ asset('template1/images/tick.png') }}" alt="tick" class="mr-3 tick-icon"  >
								<p class="mb-0">Rédiger votre projet de A à Z</p>
							</div>
							<div class="d-flex justify-content-start mb-3">
								<img src="{{ asset('template1/images/tick.png') }}" alt="tick" class="mr-3 tick-icon"  >
								<p class="mb-0">Lancer une campagne de financement pour votre projet</p>
							</div>

							<div class="d-flex justify-content-start">
								<img src="{{ asset('template1/images/tick.png') }}" alt="tick" class="mr-3 tick-icon"  >
								<p class="mb-0">Faire la promotion de votre projet au Monde entier</p>
							</div>

						</div>
						<div class="col-sm-6 text-right" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="2000">
							<img src="{{ asset('template1/images/old1.png') }}" alt="idea" class="img-fluid">
						</div>
					</div>

					<div class="row">
						<div class="col-sm-6" data-aos="fade-up">

							<h3 class="font-weight-medium text-dark">Donateur ou Investisseur !</h3>
							<p class="font-weight-medium mb-4">Pour les investisseurs, la plateforme vous offres la posibilité de : </p>
							<div class="d-flex justify-content-start mb-3">
								<img src="{{ asset('template1/images/tick.png') }}" alt="tick" class="mr-3 tick-icon"  >
								<p class="mb-0">Consulter un catalogue de projet en quête de financement.</p>
							</div>
                            <div class="d-flex justify-content-start mb-3">
								<img src="{{ asset('template1/images/tick.png') }}" alt="tick" class="mr-3 tick-icon"  >
								<p class="mb-0">Faire un don avec ou sans contrepartie</p>
							</div>
							<div class="d-flex justify-content-start mb-3">
								<img src="{{ asset('template1/images/tick.png') }}" alt="tick" class="mr-3 tick-icon"  >
								<p class="mb-0">Un investissement du projet de votre choix</p>
							</div>
							<div class="d-flex justify-content-start">
								<img src="{{ asset('template1/images/tick.png') }}" alt="tick" class="mr-3 tick-icon"  >
								<p class="mb-0">Prêter des fonds à des porteurs de projet </p>
							</div>



						</div>
						<div class="col-sm-6 text-right" data-aos="flip-left" data-aos-easing="ease-out-cubic" data-aos-duration="2000">
							<img src="{{ asset('template1/images/old2.png') }}" alt="idea" class="img-fluid">
						</div>
					</div>
				</div>
			</section>
			<section class="our-projects" id="projects">
				<div class="container">
					<div class="row mb-5">
						<div class="col-sm-12">
							<div class="d-sm-flex justify-content-between align-items-center mb-2">
								<h3 class="font-weight-medium text-dark ">Les campagnes de financement en cours : </h3>
								<div><a href="{{ route('back_office.index') }}" class="btn btn-outline-primary">Voir plus</a></div>
							</div>
						</div>
					</div>
				</div>
				<div class="row mb-5">
                    @forelse($query as $key => $value)
                        <div class="col-sm-4 ">
                            <div class="item">
                                <div class="card" style="width: 20rem;">
                                    @if ($value->projects_logo)
                                        <img src="{{ $value->projects_logo }}" width="100" height="200" class="card-img-top" alt="slider">
                                    @endif
                                    <div class="card-body">
                                    <h5 class="card-title">{{ $value->projects_nom }}</h5>
                                    <p class="card-text">{{ Str::limit($value->projects_resume, 100) }}</p>
                                    <a href="{{ route('projet.overview',$value->projects_ids) }}" class="btn btn-primary">Voir plus</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @empty
                    @endforelse

                </div>
			</section>
			<section class="testimonial" id="testimonial">
				<div class="container">
					<div class="row  mt-md-0 mt-lg-4">
						<div class="col-sm-6 text-white" data-aos="fade-up">
							<p class="font-weight-bold mb-3">Quelques témognages : </p>
							<h3 class="font-weight-medium">Ils sont fans de la plateforme </h3>
							<ul class="flipster-custom-nav">
								<li class="flipster-custom-nav-item">
									<a href="javascript:;" class="flipster-custom-nav-link" title="0"></a>
								</li>
								<li class="flipster-custom-nav-item">
									<a href="javascript:;" class="flipster-custom-nav-link"  title="1"></a>
								</li>
								<li class="flipster-custom-nav-item">
									<a href="javascript:;" class="flipster-custom-nav-link active" title="2"></a>
								</li>
								<li class="flipster-custom-nav-item">
									<a href="javascript:;" class="flipster-custom-nav-link"  title="3"></a>
								</li>
							</ul>
						</div>
						<div class="col-sm-6" data-aos="fade-up">
							<div id="testimonial-flipster">
								<ul>
                                    <li>
										<div class="testimonial-item">
											<img src="{{ asset('template1/images/testimonial/testimonial3.jpg') }}" alt="icon" class="testimonial-icons">
											<p>Lorem ipsum dolor sit amet, consectetur
												pretium pretium tempor.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut pretium
											</p>
											<h6 class="testimonial-author">Mohamed Soumah</h6>
											<p class="testimonial-destination">CEO MHM Digital</p>
										</div>
									</li>
									<li>
										<div class="testimonial-item">
											<img src="{{ asset('template1/images/testimonial/testimonial1.jpg') }}" alt="icon" class="testimonial-icons">
											<p>Lorem ipsum dolor sit amet, consectetur
												pretium pretium tempor.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut pretium
											</p>
											<h6 class="testimonial-author">Aboubacar A Maiga</h6>
											<p class="testimonial-destination">Data Analyst</p>
										</div>
									</li>
									<li>
										<div class="testimonial-item">
											<img src="{{ asset('template1/images/testimonial/testimonial2.jpg') }}" alt="icon" class="testimonial-icons">
											<p>Lorem ipsum dolor sit amet, consectetur
												pretium pretium tempor.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut pretium
											</p>
											<h6 class="testimonial-author">Alpha K Koné</h6>
											<p class="testimonial-destination">Développeur junior</p>
										</div>
									</li>

									<li>
										<div class="testimonial-item">
											<img src="{{ asset('template1/images/testimonial/testimonial4.jpg') }}" alt="icon" class="testimonial-icons">
											<p>Lorem ipsum dolor sit amet, consectetur
												pretium pretium tempor.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut pretium
											</p>
											<h6 class="testimonial-author">Moussa Konaté</h6>
											<p class="testimonial-destination">DG  Maint Mali</p>
										</div>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</section>
			<section class="clients pt-5 mt-5"  data-aos="fade-up" data-aos-offset="-400">
				<div class="container">
					<div class="row">
						<div class="col-sm-12">
							<div class="d-sm-flex justify-content-between align-items-center">
								<img src="{{ asset('template1/images/deloit.svg') }}" alt="deloit" class="p-2 p-lg-0" data-aos="fade-down"  data-aos-offset="-400">
								<img src="{{ asset('template1/images/erricson.svg') }}" alt="erricson" class="p-2 p-lg-0" data-aos="fade-up"  data-aos-offset="-400">
								<img src="{{ asset('template1/images/netflix.svg') }}" alt="netflix" class="p-2 p-lg-0" data-aos="fade-down"  data-aos-offset="-400">
								<img src="{{ asset('template1/images/instagram.svg') }}" alt="instagram" class="p-2 p-lg-0" data-aos="fade-up"  data-aos-offset="-400">
								<img src="{{ asset('template1/images/coinbase.svg') }}" alt="coinbase" class="p-2 p-lg-0" data-aos="fade-down"  data-aos-offset="-400">
							</div>
						</div>
					</div>
				</div>
			</section>

			<section class="contactus" id="contact">
				<div class="container">
					<div class="row mb-5 pb-5">
						<div class="col-sm-5" data-aos="fade-up" data-aos-offset="-500">
							<img src="{{ asset('template1/images/contact.jpg') }}" alt="contact" class="img-fluid">
						</div>
						<div class="col-sm-7" data-aos="fade-up" data-aos-offset="-500">
							<h3 class="font-weight-medium text-dark mt-5 mt-lg-0">Contact</h3>
                            @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>{{ $message }}</strong>
                            </div>
                        @endif


                        @if ($message = Session::get('error'))
                            <div class="alert alert-danger alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>{{ $message }}</strong>
                            </div>
                        @endif


                        @if ($message = Session::get('warning'))
                            <div class="alert alert-warning alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif


                        @if ($message = Session::get('info'))
                            <div class="alert alert-info alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif


                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                Une error s'est produite !
                            </div>
                        @endif
							<form action="#" method="POST">
                                @csrf
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<input type="text" class="form-control" name="name" placeholder="Nom*" required>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<input type="email" class="form-control" name="email" placeholder="Email*" required>
										</div>
									</div>
									<div class="col-sm-12">
										<div class="form-group">
											<textarea required name="message" id="message" class="form-control" placeholder="Message*" rows="5"></textarea>
										</div>
									</div>
									<div class="col-sm-12">
										<button type="submit" class="btn btn-secondary">Envoyer</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</section>
		</div>
		<footer class="footer">
			<div class="footer-top">
				<div class="container">
					<div class="row">
						<div class="col-sm-6">
							<address>
								<p>Mali, Bamako</p>
								<p class="mb-0">Hamdallaye ACI rue 12 p 600</p>
                                <p class="mb-0">+223 94 19 88 30</p>
                                <p class="mb-0">kononkoulou@gmail.com</p>

							</address>
							<div class="social-icons">
								<h6 class="footer-title font-weight-bold">
									Retrouvez nous sur :
								</h6>
								<div class="d-flex">
									<a href="#"><i class="mdi mdi-facebook-box"></i></a>
									<a href="#"><i class="mdi mdi-twitter"></i></a>
                                    <a href="#"><i class="mdi mdi-instagram"></i></a>
                                    <a href="#"><i class="mdi mdi-linkedin"></i></a>

								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="row">

								<div class="col-sm-4">
									<h6 class="footer-title">Nos Produits</h6>
									<ul class="list-footer">
										<li><a href="#" class="footer-link">Application Android</a></li>
										<li><a href="#" class="footer-link">Application IOS</a></li>
									</ul>
								</div>
								<div class="col-sm-4">
									<h6 class="footer-title">{{ config('app.name')}}</h6>
									<ul class="list-footer">
                                        <li><a href="#" class="footer-link">Qui sommes-nous ?</a></li>
										<li><a href="#" class="footer-link">Nos Partenaires</a></li>
										<li><a href="#" class="footer-link">FAQ</a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="footer-bottom">
				<div class="container">
					<div class="d-flex justify-content-between align-items-center">
						<div class="d-flex align-items-center">

							<p class="mb-0 text-small pt-1">© 2022-2023 Kononkoulou.Tous droits réservés.</p>

							<p class="mb-0 text-small pt-1 pl-4">Distributed By: Kononkoulou</p>
						</div>

						<div>
							<div class="d-flex">
								<a href="#" class="text-small text-white mx-2 footer-link">Politique de confidentialité</a>
								<a href="#" class="text-small text-white mx-2 footer-link">Service Client </a>
								<a href="#" class="text-small text-white mx-2 footer-link">Faire carrière</a>
							</div>
						</div>
					</div>

				</div>
			</div>
		</footer>
		<script src="{{ asset('template1/vendors/base/vendor.bundle.base.js') }}"></script>
		<script src="{{ asset('template1/vendors/owl.carousel/js/owl.carousel.js') }}"></script>
		<script src="{{ asset('template1/vendors/aos/js/aos.js') }}"></script>
		<script src="{{ asset('template1/vendors/jquery-flipster/js/jquery.flipster.min.js') }}"></script>
		<script src="{{ asset('template1/js/template.js') }}"></script>
	</body>
</html>
