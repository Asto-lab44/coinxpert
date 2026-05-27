<?php defined( '_JEXEC' ) or die( 'Restricted access' );?>
<?php 
	$url = $this->baseurl ? $this->baseurl : $this->base;
	$lang = $this->language ? $this->language : 'fr-FR';
	$template = $this->template ? $this->template : 'default';
	$template_uri = JURI::base() . '/templates/' . $template;
	$app = JFactory::getApplication();
	$menu = $app->getMenu();
	$active = $menu->getActive();
	$doc = JFactory::getDocument();
	$config = JFactory::getConfig();

	$doc->addScript('templates/' . $template . '/js/jquery.js');

	$isHome = ($menu->getActive() == $menu->getDefault());
	$bodyClass = $isHome ? 'home' : 'page';

	$Contact = $menu->getActive()->alias == 'contactez-nous';

	if (is_null($doc->getMetaData('description'))) {
	    $metaDesc = $config->get('MetaDesc');
	}else{
	    $metaDesc = $doc->getMetaData('description');
	}
	if (is_null($doc->getMetaData('keywords'))) {
	    $metaKeys = $config->get('MetaKeys');
	}else{
	}

?>
<!DOCTYPE html>
 
	<html lang="<?php echo $lang; ?>">
	<head>
		<meta charset="utf-8">
		<meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title><?php echo $doc->getTitle().' - '.$config->get('sitename'); ?></title>
		<meta name="description" content="<?php echo $metaDesc ?>" />
		<meta name="author" content="Coinxpert" />
    <meta name="robots" content="index, follow" />

    <link rel="canonical" href="<?php echo JUri::current(); ?>" />

		<!-- Favicons -->
		<link href="<?php echo $template_uri ?>/img/favicon.png" rel="icon">
		<link href="<?php echo $template_uri ?>/img/apple-touch-icon.png" rel="apple-touch-icon">

		<!-- Google Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,800,900,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

		<!-- Vendor CSS Files -->
		<link href="<?php echo $template_uri ?>/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="<?php echo $template_uri ?>/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
		<link href="<?php echo $template_uri ?>/vendor/aos/aos.css" rel="stylesheet">
		<link href="<?php echo $template_uri ?>/vendor/remixicon/remixicon.css" rel="stylesheet">
		<link href="<?php echo $template_uri ?>/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
		<link href="<?php echo $template_uri ?>/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
		
		<link href="<?php echo $template_uri ?>/css/style.css" rel="stylesheet">
		<link href="<?php echo $template_uri ?>/css/purecookie.css" rel="stylesheet">
	    
	    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

		<script src="<?php echo $template_uri ?>/js/jquery.validate.min.js"></script>
        <script src="https://www.google.com/recaptcha/api.js?onload=onCatpchaLoaded&render=explicit"></script>
        
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-EQWLXY6C91"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'G-EQWLXY6C91');
        </script>
	</head>
	<body class="<?php echo $bodyClass ?>">

		<!-- ======= Header ======= -->
		<header id="header" class="header fixed-top">
		  <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

		    <a href="index.php" class="logo d-flex align-items-center">
				<!-- <span>coin<strong>x</strong>pert</span> -->
				<?php if ($isHome){ ?>
					<img src="<?php echo $template_uri ?>/img/logo_home_v2.png" class="white">
					<img src="<?php echo $template_uri ?>/img/logo_v1.png" class="colors">
				<?php }else{ ?>
					<img src="<?php echo $template_uri ?>/img/logo_v1.png">
				<?php } ?>
		    </a>

		    <nav id="navbar" class="navbar">
	    		<jdoc:include type="modules" name="main_nav" />
        		<i class="bi bi-list mobile-nav-toggle"></i>
	    	</nav>

		  </div>
          <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6998578530007202"
    		 crossorigin="anonymous"></script>
		</header><!-- End Header -->


		<?php if ($isHome){ ?>

			<section id="hero" class="hero d-flex align-items-center">

			  <div class="container">
			    <div class="row">
			      <div class="col-lg-6 d-flex flex-column justify-content-center">
			        <h2 data-aos="fade-up"><strong>Coinxpert</strong> expert-comptable</h2>
			        <h1 data-aos="fade-up" data-aos-delay="400"><strong>Cabinet indépendant d’expertise comptable spécialisé dans les cryptomonnaies basé à Nantes</strong> vous accompagne dans tous les domaines de votre entreprise.</h1>
			        <h3 data-aos="fade-up" data-aos-delay="600">Avec la société Coinxpert, vous faite le choix d’un cabinet d’expertise comptable spécialisé dans les cryptomonnaies indépendant, à taille humaine, capable de construire avec vous une relation de confiance sur le long-terme.</h3>
			        <div data-aos="fade-up" data-aos-delay="600">
			          <div class="text-center text-lg-start">
			            <a href="#" class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
			              <span>Découvrez nos solutions</span>
			              <i class="bi bi-arrow-right"></i>
			            </a> 
			          </div>
			        </div>
			      </div>
			      <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
			        <img src="<?php echo $template_uri ?>/img/hero-img.png" class="img-fluid" alt="">
			      </div>
			    </div>
			  </div>

			</section><!-- End Hero -->

			<main id="main">

				<!-- ======= About Section ======= -->
				<section id="about" class="about">

					<div class="container" data-aos="fade-up">

					<header class="section-header">
					  <h2>Coinxpert</h2>
					  <p>Qui sommes-nous ?</p>
					</header>

					  <div class="row gx-0">

					    <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
					      <div class="content">
					        <h2>Que vous soyez particulier ou professionnel et quel que soit la taille de votre entreprise : TPE, PME/PMI, ETI, association ou fondation, groupe, le recours à Un conseil expert comptable comme Coinxpert expert en cryptomonnaies vous aide <strong>à atteindre vos objectifs et vous accompagne dans votre développement et d’investissements de cryptomonnaies sur Nantes.</strong></h2>
					        <div class="text-center text-lg-start">
					          <a href="#" class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center">
					            <span>Le cabinet</span>
					            <i class="bi bi-arrow-right"></i>
					          </a>
					        </div>
					      </div>
					    </div>

					    <div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
					      <img src="<?php echo $template_uri ?>/img/about.jpg" class="img-fluid" alt="">
					    </div>

					  </div>
					</div>

				</section>

				<section id="features" class="features">

				  <div class="container" data-aos="fade-up">


				  	<header class="section-header">
				  	  <h2>Nos compétences</h2>
				  	  <p>Nos métiers et expertises globales</p>
				  	</header>
				  	
				    <!-- Feature Icons -->
				    <div class="row feature-icons" data-aos="fade-up">

				      <div class="row">

				        <div class="col-xl-4 text-center" data-aos="fade-right" data-aos-delay="100">
				          <img src="<?php echo $template_uri ?>/img/features-3.png" class="img-fluid p-4" alt="">
				        </div>

				        <div class="col-xl-8 d-flex content">
				          <div class="row align-self-center gy-4">

				            <div class="col-md-6 icon-box" data-aos="fade-up">
				              <i class="ri-add-circle-line"></i>
				              <div>
				                <h4>Création d’entreprise</h4>
				                <p>La création d'entreprise regroupe l'ensemble des démarches et des étapes indispensables et obligatoires pour démarrer une activité indépendante.</p>
				              </div>
				            </div>

				            <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="100">
				              <i class="ri-line-chart-line"></i>
				              <div>
				                <h4>Expertise comptable</h4>
				                <p>La mission de base de l’expert-comptable est la tenue et la surveillance de la comptabilité.</p>
				              </div>
				            </div>

				            <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="200">
				              <i class="ri-stack-line"></i>
				              <div>
				                <h4>Transmission et cession</h4>
				                <p>Lorsqu'un entrepreneur veut transmettre son entreprise ou en reprendre une, il doit effectuer plusieurs formalités.</p>
				              </div>
				            </div>

				            <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="300">
				              <i class="ri-pie-chart-2-fill"></i>
				              <div>
				                <h4>Accompagnement</h4>
				                <p>Nous accompagnons nos clients dans les domaines juridiques, création de société, conseil et recherche en financement.</p>
				              </div>
				            </div>

				            <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="400">
				              <i class="ri-hand-coin-line"></i>
				              <div>
				                <h4>Juridiques</h4>
				                <p>Rédaction d’actes, suivi des obligations juridiques de l’entreprise, réunions et assemblées, tenue du secrétariat juridique et des formalités en découlant.</p>
				              </div>
				            </div>

				            <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="500">
				              <i class="ri-bit-coin-line"></i>
				              <div>
				                <h4>Crypto-actifs</h4>
				                <p>Information, déclaration, enregistrement comptable, investissement.</p>
				              </div>
				            </div>

				          </div>
				        </div>

				      </div>

				    </div><!-- End Feature Icons -->

				  </div>

				</section>

				<section id="faq" class="faq">

				  <div class="container" data-aos="fade-up">

				    <header class="section-header">
				      <h2>F.A.Q</h2>
				      <p>Questions fréquemment posées</p>
				    </header>

				    <div class="row">
				      <div class="col-lg-6">
				        <!-- F.A.Q List 1-->
				        <div class="accordion accordion-flush" id="faqlist1">
				          <div class="accordion-item">
				            <h2 class="accordion-header">
				              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-1">
				                Comment acquérir des bitcoins ?
				              </button>
				            </h2>
				            <div id="faq-content-1" class="accordion-collapse collapse" data-bs-parent="#faqlist1">
				              <div class="accordion-body">
				                Pour convertir vos euros en monnaie virtuel, vous devrez obligatoirement <strong>vous enregistrer sur une plateforme</strong> comme Kraken, Binance, Coinbase, ou encore Coinhouse.<br>
				                C’est plateforme <strong>s’appelle un exchange</strong> elle vous permettra de faire de <strong>l’achat et/ou l’échange de crypto-monnaies.</strong>
				              </div>
				            </div>
				          </div>

				          <div class="accordion-item">
				            <h2 class="accordion-header">
				              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-2">
				                Quels sont les avantages des solutions Coinxpert
				              </button>
				            </h2>
				            <div id="faq-content-2" class="accordion-collapse collapse" data-bs-parent="#faqlist1">
				              <div class="accordion-body">
				                Nous sommes une société d’expertise comptable spécialisée dans les crypto-monnaies CoinXpert possède une équipe de spécialistes et est là pour vous conseiller sur vos projets.
				              </div>
				            </div>
				          </div>

				          <div class="accordion-item">
				            <h2 class="accordion-header">
				              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-3">
				                Qu'en est-il de Bitcoin et de l'impôt ?
				              </button>
				            </h2>
				            <div id="faq-content-3" class="accordion-collapse collapse" data-bs-parent="#faqlist1">
				              <div class="accordion-body">
				                La seule détention de crypto-monnaies n'est pas imposable. Elles entrent dans l'assiette du <strong>calcul de l'impôt</strong> dès que <strong>vous changez de devise</strong> : les transactions sont imposables lors de leur passage à l'euro, le dollar, le franc suisse ou autre monnaie nationale.
				              </div>
				            </div>
				          </div>

				        </div>
				      </div>

				      <div class="col-lg-6">

				        <!-- F.A.Q List 2-->
				        <div class="accordion accordion-flush" id="faqlist2">

				          <div class="accordion-item">
				            <h2 class="accordion-header">
				              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2-content-1">
				                Qu'est-ce qui détermine le prix du bitcoin ?
				              </button>
				            </h2>
				            <div id="faq2-content-1" class="accordion-collapse collapse" data-bs-parent="#faqlist2">
				              <div class="accordion-body">
				                Le cours d’une monnaie varie et est lié à plusieurs facteurs comme la confiance, la technologie, les créateurs, l’actualité et les évolutions futurs du token.
				              </div>
				            </div>
				          </div>

				          <div class="accordion-item">
				            <h2 class="accordion-header">
				              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2-content-2">
				                Comment déclarer mes crypto-actifs ?
				              </button>
				            </h2>
				            <div id="faq2-content-2" class="accordion-collapse collapse" data-bs-parent="#faqlist2">
				              <div class="accordion-body">
				               La déclaration des crypto-actifs s'indique sur <strong>des formulaires spécifiques</strong> liés à votre déclarations annuelle de revenus.
				              </div>
				            </div>
				          </div>

				          <div class="accordion-item">
				            <h2 class="accordion-header">
				              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2-content-3">
				                Quel enregistrement comptable pour le Bitcoin ?
				              </button>
				            </h2>
				            <div id="faq2-content-3" class="accordion-collapse collapse" data-bs-parent="#faqlist2">
				              <div class="accordion-body">
				                L'enregistrement comptable pour une crypto-monnaies n'est pas simple car il faut tenir compte de plusieurs facteurs d'achat, de vente et du cours de la monnaie à un temps précis.
				              </div>
				            </div>
				          </div>

				        </div>
				      </div>

				    </div>

				  </div>

				</section>

				<section id="recent-blog-posts" class="recent-blog-posts">

				  <div class="container" data-aos="fade-up">

	              	<jdoc:include type="modules" name="blog_home" />

				  </div>

				</section>

			</main>

		<?php }else{ ?>

			<main id="main">

			  <!-- ======= Breadcrumbs ======= -->
			  <section class="breadcrumbs" data-aos="fade-up">
			    <div class="container">
			      <jdoc:include type="modules" name="breadcrumb" />
			      <h1><?php echo $this->title; ?></h1>
			    </div>
			  </section><!-- End Breadcrumbs -->

			  <!-- ======= Blog Single Section ======= -->
			  <section id="blog" class="blog">

			    <div class="container" data-aos="fade-up">

			      <?php if($this->countModules('side_nav')){ ?>
			          <div class="row">
			            <div class="col-lg-8 entries">
			              	<jdoc:include type="component" />
			              	<?php if ($Contact){ ?>
			              		<!-- <form>
			              		  <div class="form-group row">
			              		     <div class="col-12">
			              		       <label for="select" class="col-2 col-form-label">Je suis un</label> 
			              		       <select id="select" name="select" class="custom-select form-control">
			              		         <option value="particulier">Particulier</option>
			              		         <option value="professionnel">Professionnel</option>
			              		       </select>
			              		     </div>
			              		   </div> 
			              		  <div class="form-group row">
			              		    <div class="col-6">
			              		      <label for="name" class="col-2 col-form-label">Nom</label> 
			              		      <input id="name" name="name" type="text" class="form-control" required="required">
			              		    </div>
			              		    <div class="col-6">
	              		    		  <label for="surname" class="col-2 col-form-label">Prénom</label> 
			              		      <input id="surname" name="surname" type="text" class="form-control">
			              		    </div>
			              		  </div>
			              		  <div class="form-group row">
			              		    <div class="col-6">
			              		      <label for="email" class="col-2 col-form-label">Email</label> 
			              		      <input id="email" name="email" type="text" class="form-control" required="required">
			              		    </div>
			              		    <div class="col-6">
			              		      <label for="sujet" class="col-2 col-form-label">Sujet</label> 
			              		      <input id="sujet" name="sujet" type="text" class="form-control">
			              		    </div>
			              		  </div>
			              		  <div class="form-group row">
			              		     <div class="col-12">
			              		      <label for="comment" class="col-2 col-form-label">Commentaire</label> 
			              		      <textarea id="comment" name="comment" cols="40" rows="5" class="form-control"></textarea>
			              		  	 </div> 
			              		  </div> 
			              		  <div class="form-group row">
			              		    <div class="col-12">
			              		      <button name="submit" type="submit" class="btn btn-primary pull-right">Envoyer</button>
			              		    </div>
			              		  </div>
			              		</form> -->
			              	<?php } ?>
			              	<jdoc:include type="modules" name="content_bottom" />
			              	
			            </div><!-- End blog entries list -->
			            <div class="col-lg-4">
			              <div class="sidebar">
			              	<jdoc:include type="modules" name="side_nav" />
			              </div><!-- End sidebar -->
			            </div><!-- End blog sidebar -->
			          </div>
			      <?php } else { ?>
			          <div class="row">
			            <div class="col-lg-12 entries">
			              	<jdoc:include type="component" />
			              	<jdoc:include type="modules" name="content_bottom" />
			            </div><!-- End blog entries list -->
			          </div>
			      <?php } ?>

			    </div>
			  </section><!-- End Blog Single Section -->

			</main><!-- End #main -->

		<?php } ?>

		<!-- ======= Footer ======= -->
		<footer id="footer" class="footer">

		  <div class="footer-top">
		    <div class="container">
		      <div class="row gy-4">
		        <div class="col-lg-4 col-md-12 footer-info">
         		  <jdoc:include type="modules" name="footer_presentation" />
		          <div class="social-links mt-3">
		            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
		            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
		            <a href="#" class="linkedin"><i class="bi bi-linkedin bx bxl-linkedin"></i></a>
		          </div>
		        </div>

		        <div class="col-lg-2 offset-lg-1 col-6 footer-links">
		          <h4>Le Cabinet</h4>
		          <jdoc:include type="modules" name="nav_footer_cabinet" />
		        </div>

		        <div class="col-lg-2 col-6 footer-links">
		          <h4>Nos solutions</h4>
		          <ul>
		         	<jdoc:include type="modules" name="nav_footer_solutions" />
		          </ul>
		        </div>

		        <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
		         	<jdoc:include type="modules" name="footer_contact" />
		        </div>

		      </div>
		    </div>
		  </div>

		  <div class="container">
		    <div class="copyright">
		      <ul>
		      	<li>
		      		<a href="/mentions-legales">Mentions légales</a> - <a href="/politique-de-gestion-des-donnees">Politique de gestion des données</a> 
		      	</li>
		      	<li>
		      		<a href="https://nezumi.fr" target="_blank">Conception Agence Nezumi</a> - &copy; Tous droits réservés - <strong>Coinxpert</strong> - 2021
		      	</li>
		      </ul>
		    </div>
		  </div>
		</footer>

		<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

		<!-- Vendor JS Files -->
		<script src="<?php echo $template_uri ?>/vendor/bootstrap/js/bootstrap.bundle.js"></script>
		<script src="<?php echo $template_uri ?>/vendor/aos/aos.js"></script>
		<script src="<?php echo $template_uri ?>/vendor/php-email-form/validate.js"></script>
		<script src="<?php echo $template_uri ?>/vendor/swiper/swiper-bundle.min.js"></script>
		<script src="<?php echo $template_uri ?>/vendor/purecounter/purecounter.js"></script>
		<script src="<?php echo $template_uri ?>/vendor/isotope-layout/isotope.pkgd.min.js"></script>
		<script src="<?php echo $template_uri ?>/vendor/glightbox/js/glightbox.min.js"></script>

		<script src="<?php echo $template_uri ?>/js/main.js"></script>
		<script src="<?php echo $template_uri ?>/js/purecookie.js"></script>

	</body>

</html>