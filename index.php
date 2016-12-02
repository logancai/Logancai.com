<?php include_once($_SERVER['DOCUMENT_ROOT']."/Udb.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Logan Cai</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="css/freelancer.css" rel="stylesheet">
    <link href="css/swiper.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <script src="https://use.typekit.net/slc3hlj.js"></script>
	<script>try{Typekit.load({ async: true });}catch(e){}</script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top" class="index">

    <!-- Navigation -->
    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top navbar-custom">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="#page-top"><img id="signature" src="img/LoganCaiSignature.svg" alt="Logan Cai"></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li class="page-scroll">
                        <a href="#portfolio">Portfolio</a>
                    </li>
                    <li class="page-scroll">
                        <a href="#about">About</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- Header -->
    <header>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <img class="img-responsive img-circle" id="portrait" src="img/LoganCaiPortrait.jpg" alt="Logan Cai">
                    <div class="intro-text">
                        <span class="name">Logan Cai</span>
                        <!--<hr class="star-light">-->
                        <span class="skills">Web Developer - IT Technical Support - Designer</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Portfolio Grid Section -->
    <section id="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="pink-text">Portfolio</h2>
                    <hr class="star-primary pink-text">
                </div>
            </div>
            <?php
				class porfolio_item{
					function __construct($title, $date, $body, $json, $id, $client, $client_website){
						$this->title = $title;
						$this->date = $date;
						$this->body = $body;
						$this->json = $json;
						$this->id = $id;
						$this->client = $client;
						$this->client_website = $client_website;
					}
					var $title;
					var $date;
					var $body;
					var $json;
					var $id;
					var $client;
					var $client_website;
					function get_title(){
						return $this->title;
					}
					function get_date(){
						return $this->date;
					}
					function get_formatted_date(){
						return date('M d, Y', strtotime($this->date));
					}
					function get_body(){
						return $this->body;
					}
					function get_first_image(){
						if(empty($this->json)){
							return "img/portfolio/cake.png";
						}
						$resultArray = array();
						$resultArray = json_decode($this->json);
						if(empty($resultArray)){
							return "img/portfolio/submarine.png";
						}
						return $resultArray[0];
					}
					function get_images(){
						if(empty($this->json)){
							return NULL;
						}
						$resultArray = array();
						$resultArray = json_decode($this->json);
						if(empty($resultArray)){
							return NULL;
						}
						return $resultArray;
					}
					function get_id(){
						return $this->id;
					}
					function get_client(){
						return $this->client;
					}
					function get_client_website(){
						return $this->client_website;
					}
				}
				$portfolio_array = array();
				$sql ="SELECT * FROM `projects` WHERE `visible` = 1 ORDER BY `projects`.`date` DESC;";
				$result = mysqli_query($con, $sql);
				if (!empty($result)){
					while($resultinfo = mysqli_fetch_array($result, MYSQLI_BOTH)) {
						$portfolio_array[] = new porfolio_item($resultinfo['title'],$resultinfo['date'], $resultinfo['body'], $resultinfo['jsonarea'], $resultinfo['id'], $resultinfo['client'], $resultinfo['client_website']);
					}
				}
			?>
            <div class="row">
               <?php foreach($portfolio_array as $porfolio) : ?>
                <div class="col-sm-4 portfolio-item">
                    <a href="#portfolioModal<?php echo $porfolio->get_id(); ?>" class="portfolio-link" data-toggle="modal">
                        <div class="caption">
                            <div class="caption-content">
								<h3><?php echo $porfolio->get_title(); ?></h3>
                            </div>
                        </div>
                        <img src="<?php echo $porfolio->get_first_image(); ?>" class="img-responsive porfolio-image" alt="">
                    </a>
                </div>
                <?php endforeach ?>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="blue" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>About</h2>
                    <hr class="star-light">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-lg-offset-2">
                    <p>Hi, my name is Logan Cai. I am a natively from San Francisco, CA. I graduated from the University of California - Los Angeles with a Bachelor of Arts in Asian American Studies. I also have a strong hobby in computers which lead to taking a few computer science courses at UCLA and developed my IT technical support and front end and back end web development. </p>
                </div>
                <div class="col-lg-4">
					<h4>Summary of Qualifications</h4>
                    <p><ul>
						<li>Web developer, IT technical support, designer and project lead</li>
						<li>4+ years of experience developing in HTML, CSS, JSON, JavaScript, jQuery, SQL, PHP, Ruby on Rails and Unix</li>
						<li>5+ years of IT technical support experience in one-to-one, remote and executive </li>
						<li>Familiar with Active Directory, enterprise networking and mobile</li>
						<li>Highly proficient in project implementation and management, along with team leading and collaboration</li>
						<li>Able to multitask and prioritize issues while aiming to keep everyone productive</li>
						<li>Worked tightly with my managers and users to develop features they want to use</li>
					</ul>
               		</p>
                </div>
                <div class="col-lg-8 col-lg-offset-2 text-center">
                   	<div class="row">
						<a href="Logan Cai Resume Minimal Web_Redacted.pdf" class="btn btn-lg btn-outline">
							<i class="fa fa-file-text-o"></i> Resume
						</a>
					</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-center">
        <div class="footer-above">
            <div class="container">
                <div class="row">
                    <div class="footer-col col-md-4">
                        <h3>Current Location</h3>
                        <p>San Francisco, CA</p>
                        <p>Willing to relocate within California</p>
                    </div>
                    <div class="footer-col col-md-4">
                        <h3>Around the Web</h3>
                        <ul class="list-inline">
                            <li>
                                <a href="https://www.linkedin.com/in/logancai" class="btn-social btn-outline"><i class="fa fa-fw fa-linkedin"></i></a>
                            </li>
                            <li>
                                <a href="mailto:logan.cai@gmail.com" class="btn-social btn-outline"><i class="fa fa-fw fa-envelope-o"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="footer-col col-md-4">
                        <h3>Legacy Pages</h3>
                        <p><a href="/designs">Design</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-below">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        Copyright &copy; Logan Cai 2016
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
    <div class="scroll-top page-scroll hidden-sm hidden-xs hidden-lg hidden-md">
        <a class="btn btn-primary" href="#page-top">
            <i class="fa fa-chevron-up"></i>
        </a>
    </div>

    <!-- Portfolio Modals -->
    <?php foreach($portfolio_array as $porfolio) : ?>
    <div class="portfolio-modal modal" id="portfolioModal<?php echo $porfolio->get_id(); ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content" id="modal-content-<?php echo $porfolio->get_id(); ?>">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h2 class="pink-text"><?php echo $porfolio->get_title(); ?></h2>
                            <hr class="star-primary">
                            <?php if(!empty($porfolio->get_images())): ?>
                            <div class="row">
							<div class="swiper-container swiper-container-<?php echo $porfolio->get_id(); ?>">
								<div class="swiper-wrapper">
									<?php foreach($porfolio->get_images() as $image) : ?>
									<div class="swiper-slide">
										<img src="<?php echo $image; ?>" class="swiper-lazy">
										<div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
									</div>
									<?php endforeach ?>
								</div>
								<!-- Add Pagination -->
								<div class="swiper-pagination swiper-pagination-<?php echo $porfolio->get_id(); ?>"></div>
								<!-- Navigation -->
								<div class="swiper-button-next swiper-button-white swiper-button-next-<?php echo $porfolio->get_id(); ?> "></div>
								<div class="swiper-button-prev swiper-button-white swiper-button-prev-<?php echo $porfolio->get_id(); ?> "></div>
							</div>
							<?php endif ?>
							</div>
							<p><?php echo $porfolio->get_body(); ?></p>
                           	<ul class="list-inline item-details">
                                <li>Client:
                                    <strong><?php echo $porfolio->get_client(); ?>
                                    </strong>
                                </li>
                                <li>Date:
                                    <strong><?php echo $porfolio->get_formatted_date(); ?>
                                    </strong>
                                </li>
                                <li>Website:
									<strong><a href="<?php echo $porfolio->get_client_website(); ?>"><?php echo $porfolio->get_client_website(); ?></a>
                                    </strong>
                                </li>
                            </ul>
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach ?>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

    <!-- Theme JavaScript -->
    <script src="js/freelancer.min.js"></script>
    <script src="js/swiper.jquery.min.js"></script>
    <script>
		/*$(function(){*/
			<?php foreach($portfolio_array as $porfolio): ?>
			$('#portfolioModal<?php echo $porfolio->get_id(); ?>').on('shown.bs.modal',function(e){
				var swiper<?php echo $porfolio->get_id(); ?> = new Swiper('.swiper-container-<?php echo $porfolio->get_id(); ?>', {
					pagination: '.swiper-pagination-<?php echo $porfolio->get_id(); ?>',
					paginationClickable: true,
					nextButton: '.swiper-button-next-<?php echo $porfolio->get_id(); ?>',
					prevButton: '.swiper-button-prev-<?php echo $porfolio->get_id(); ?>',
					spaceBetween: 30,
					// Disable preloading of all images
					preloadImages: false,
					// Enable lazy loading
					lazyLoading: true,
					autoHeight: true, //enable auto height
					loop: true,
					keyboardControl: true
				});
			});
			<?php endforeach ?>
		/*});*/
    
	</script>

</body>

</html>
