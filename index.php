<?php
        /*
        ********************************************************************************************
        CONFIGURATION
        ********************************************************************************************
        */
        // destinataire est votre adresse mail. Pour envoyer Ã  plusieurs Ã  la fois, sÃ©parez-les par une virgule
        $destinataire = 'benjent@hotmail.fr';

        // copie ? (envoie une copie au visiteur)
        $copie = true;

        // Action du formulaire (si votre page a des paramÃ¨tres dans l'URL)
        // si cette page est index.php?page=contact alors mettez index.php?page=contact
        // sinon, laissez vide
        $form_action = '';

        // Messages de confirmation du mail
        $message_envoye = "<div class=\"box-404\">Votre message m'est bien parvenu !</div>";
        $message_non_envoye = "<div class=\"box-404\">L'envoi du mail a échoué, veuillez réessayer.</div>";

        // Message d'erreur du formulaire
        $message_formulaire_invalide = "<div class=\"box-404\">Erreur, l'envoi du mail a échoué. Vérifiez que tous les champs soient bien remplis et que l'email soit sans erreurs.</div>";

        /*
        ********************************************************************************************
        FIN DE LA CONFIGURATION
        ********************************************************************************************
        */

        /*
        * cette fonction sert Ã  nettoyer et enregistrer un texte
        */
        function Rec($text)
        {
                return htmlspecialchars($text);
        };

        /*
        * Cette fonction sert Ã  vÃ©rifier la syntaxe d'un email
        */
        function IsEmail($email)
        {
                $value = preg_match('/^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!\.)){0,61}[a-zA-Z0-9_-]?\.)+[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!$)){0,61}[a-zA-Z0-9_]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/', $email);
                return (($value === 0) || ($value === false)) ? false : true;
        }

        // formulaire envoyÃ©, on rÃ©cupÃ¨re tous les champs.
        $nom = (isset($_POST['nom'])) ? Rec($_POST['nom']) : '';
        $email = (isset($_POST['email'])) ? Rec($_POST['email']) : '';
        $objet = (isset($_POST['objet'])) ? Rec($_POST['objet']) : '';
        $message = (isset($_POST['message'])) ? Rec($_POST['message']) : '';

        // On va vÃ©rifier les variables et l'email ...
        $email = (IsEmail($email)) ? $email : ''; // soit l'email est vide si erronÃ©, soit il vaut l'email entrÃ©
        $err_formulaire = false; // sert pour remplir le formulaire en cas d'erreur si besoin

        if (isset($_POST['envoi']))
        {
                if (($nom != '') && ($email != '') && ($objet != '') && ($message != ''))
                {
                        // les 4 variables sont remplies, on gÃ©nÃ¨re puis envoie le mail
                        $headers = 'From:'.$nom.' <'.$email.'>' . "\r\n";
                        //$headers .= 'Reply-To: '.$email. "\r\n" ;
                        //$headers .= 'X-Mailer:PHP/'.phpversion();

                        // envoyer une copie au visiteur ?
                        if ($copie)
                        {
                                $cible = $destinataire.','.$email;
                        }
                        else
                        {
                                $cible = $destinataire;
                        };



                        // Remplacement de certains caractÃ¨res spÃ©ciaux
                        $message = str_replace("&#039;","'",$message);
                        $message = str_replace("&#8217;","'",$message);
                        $message = str_replace("&quot;",'"',$message);
                        $message = str_replace('&lt;br&gt;','',$message);
                        $message = str_replace('&lt;br /&gt;','',$message);
                        $message = str_replace("&lt;","&lt;",$message);
                        $message = str_replace("&gt;","&gt;",$message);
                        $message = str_replace("&amp;","&",$message);

                        // Envoi du mail
                        if (mail($cible, $objet, $message, $headers))
                        {
                        		$mail_ok = true;
                        }
                        else
                        {
                        		$mail_ok = false;
                        };
                }
                else
                {
                // une des 3 variables (ou plus) est vide ...
                        $err_formulaire = true;
                };
        }; // fin du if (!isset($_POST['envoi']))

?>

<!DOCTYPE html>
<html>

	<head>

		<title>Benjamin Morvan</title>

		<meta charset="utf-8" />
		<meta name="description" content="Benjamin Morvan" />
		<meta content="width=device-width" name="viewport" />

		<link rel="icon" href="img/favicon.png" />
		<link rel="stylesheet" href="css/style.css" />

		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript">

			$(document).ready(function(){

				// NAVIGATION

				var scroll = 100;
				
				$('#top').click(function(){
					$('html, body').animate({scrollTop : 0},800);
					return false;
				});

				$('#nav-profil').click(function(){
					$('html, body').animate({scrollTop : $('#profil').position().top - scroll},800);
					return false;
				});

				$('#nav-formation').click(function(){
					$('html, body').animate({scrollTop : $('#formation').position().top - scroll},800);
					return false;
				});

				$('#nav-exp').click(function(){
					$('html, body').animate({scrollTop : $('#exp').position().top - scroll},800);
					return false;
				});

				$('#nav-skill').click(function(){
					$('html, body').animate({scrollTop : $('#skill').position().top - scroll},800);
					return false;
				});

				$('#nav-real').click(function(){
					$('html, body').animate({scrollTop : $('#real').position().top - scroll},800);
					return false;
				});

				$('#nav-contact').click(function(){
					$('html, body').animate({scrollTop : $('#contact').position().top - scroll},800);
					return false;
				});

				// ANIMATION

				$(".fade").hide(0.1).fadeIn(2500);

				$(".move").delay(1500).animate({top: '0px'}, 'slow');

				$("header").hover(
					function(){
						$(".move-right").animate({opacity: 1, left: '32.5%'}, 300);
						$(".move-left").animate({opacity: 1, right: '32.5%'}, 300);
					},
					function(){
						$(".move-right").animate({opacity: 0, left: '0'}, 300);
						$(".move-left").animate({opacity: 0, right: '0'}, 300);
					}
				);

				// CONTACT

				$("#eye").hover(
					function(){
						$(this).attr('src', 'img/eye.jpg');
					},
					function(){
						$(this).attr('src', 'img/eyel.jpg');
					}
				);

				// REALISATIONS

				$(".alt-caroufredsel").click(function(){

					var src = $(this).attr('src');

					$(".wide").attr('src', src);

					$(".current").removeClass("current");
					$(this).addClass('current');

					$("#real h4").text($(this).attr('title'));

				});

			});

		</script>

	</head>

	<body>		

		<nav id="main-nav" class="move">			
			<ul>
				<a id="top" href="#accueil"><li>Accueil</li></a>
				<a id="nav-profil" href="#profil"><li>Profil</li></a>
				<a id="nav-formation" href="#formation"><li>Formation</li></a>
				<a id="nav-exp" href="#exp"><li>Expérience</li></a>
				<a id="nav-skill" href="#skill"><li>Compétences</li></a>
				<a id="nav-real" href="#real"><li>Réalisations</li></a>
				<a id="nav-contact" href="#contact"><li>Contact</li></a>
			</ul>
		</nav>

		<nav class="nav-mobile">			
			<ul>
				<a id="top" href="#accueil"><li>Accueil</li></a>
				<a id="nav-profil" href="#profil"><li>Profil</li></a>
				<a id="nav-formation" href="#formation"><li>Formation</li></a>
				<a id="nav-exp" href="#exp"><li>Expérience</li></a>
				<a id="nav-skill" href="#skill"><li>Compétences</li></a>
				<a id="nav-real" href="#real"><li>Réalisations</li></a>
				<a id="nav-contact" href="#contact"><li>Contact</li></a>
			</ul>
		</nav>

		<div id="page-width">
			<!-- <h6 id="accueil"></h6> -->

			<!-- HEADER -->

			<header>
				<div class="move-right red-bar-top"></div>
				<h1 class="fade">Benjamin Morvan</h1>
				<h2 class="fade">Intégrateur web</h2>
				<div class="move-left red-bar-bottom"></div>
			</header>

			<!-- PROFIL -->

			<div class="arrow-wrap-red">
				<div class="arrow-red"></div>
			</div>

			<section id="profil" class="red">
				<h3>Profil</h3>
				<p>
					Le développement web est un domaine qui me passionne et je serais ravi de pouvoir
					travailler et me perfectionner au sein d'une équipe expérimentée. J'aimerais ici
					vous convaincre des atouts que je peux apporter à une entreprise.
				</p>
				<p>
					Je suis étudiant en IUT Métiers du Multimédia et de l'Internet (anciennement
					Services et Réseaux de Communication) à la recherche d'un stage dans le
					développement web au cours duquel je pourrai mettre en œuvre mes compétences et
					les développer grâce aux conseils d'une équipe de professionnels. Durant ma
					première année d'études, j'ai acquis des compétences pouvant répondre aux besoins
					d'une équipe. De l'infographie à l'intégration web en passant par la communication
					et le marketing, j'ai étudié les différents éléments permettant de réaliser un
					site web respectant les codes d'une charte graphique. J'ai suivi des cours de
					documentation numérique ainsi que de gestion de CMS et une entreprise m'offrirait
					la possibilité de mettre en commun toutes ces compétences en un projet concret.
				</p>
				<p>
					Mes activités extrascolaires m'ont aussi appris à gérer des projets d'équipe.
					Passionné de musiques en tout genre, j'ai appris à m'occuper de l'organisation de
					concerts ainsi que de la planification de répétitions tout en prenant en compte
					la gestion de musiciens de niveaux hétérogènes. Le travail en autonomie ne m'est
					pour autant pas étranger, comme le montre ma capacité à apprendre la musique en
					autodidacte et mes reprises acoustiques d'albums disponibles dans la rubrique
					Réalisations. En outre, mon niveau d'anglais peut être un atout dans le
					développement d'entreprise.
				</p>
				<p>
					Pour vous convaincre de ma motivation, je souhaite rencontrer un recruteur afin
					d'échanger notamment sur ce qu'un stage pourrait apporter d'abord à une équipe,
					mais aussi à mon cursus professionnel. Il est également possible de dialoguer au
					préalable par mail dans la rubrique Contact.
				</p>
				<p>
					Que vous soyez recruteur ou simple visiteur, je vous souhaite une agréable visite
					sur mon site.
				</p>
			</section>

			<!-- FORMATION -->

			<div class="arrow-wrap-white">
				<div class="arrow-white"></div>
			</div>

			<section id="formation" class="white">
				<h3>Formation</h3>
				<ul id="timeline">
					<li>2010 - 2013</li>
					<li>2013 - 2015</li>
					<li>2015 - ...</li>
					<li></li>
				</ul>

				<ul id="timeline-descr">
					<li>
						<div class="title">
							Lycée Européen Charles de Gaulle <br />
							Dijon <br />
						</div>
						<div class="descr">
							<span>Baccalauréat:</span> général scientifique <br />
							<span>Spécialité:</span> informatique et sciences du numérique <br />
							<span>Options:</span> anglais européen, musique <br />
							<span>Mention:</span> assez bien
						</div>
					</li>
					<li>
						<div class="title">
							IUT MMI <br />
							Dijon <br />
						</div>
						<div class="descr">
							<span>Option:</span> études longues
						</div>
					</li>
					<li>
						<div class="title">
							Peut-être votre formation !
						</div>						
					</li>
				</ul>

				<ul class="timeline-mobile">
					<li>
						2010 - 2013 - Lycée Européen Charles de Gaulle - Dijon
						<div class="descr">
							<span>Baccalauréat:</span> général scientifique <br />
							<span>Spécialité:</span> informatique et sciences du numérique <br />
							<span>Options:</span> anglais européen, musique <br />
							<span>Mention:</span> assez bien
						</div>
					</li>
					<li>
						2013 - 2015 - IUT MMI - Dijon
						<div class="descr">
							<span>Option:</span> études longues
						</div>
					</li>
					<li>
						2015 - ... - Peut-être votre formation !
					</li>
				</ul>			
			</section>

			<!-- EXPERIENCE -->

			<div class="arrow-wrap-red">
				<div class="arrow-red"></div>
			</div>

			<section id="exp" class="red">
				<h3>Expérience</h3>
				<ul>
					<li>
						2015 - Entreprise Parachute - Glasgow <br />
						<div class="descr">
							<span>Intégrateur web:</span> manipulation de WordPress, intégration de design et de contenu.
						</div>
					</li>
					<li>
						2010 - 2013 - Association Music Act Fontaine - Fontaine-lès-Dijon <br />
						<div class="descr">
							Co-responsable de l'organisation de concerts et de répétitions.
						</div>
					</li>
					<li>
						2010 - Magasin La Clé de Sol - Dijon <br />
						<div class="descr">
							<span>Assistant vente:</span> conseil aux clients, entretien des instruments, disposition en vitrine.
						</div>
					</li>
				</ul>
			</section>

			<!-- COMPETENCES -->

			<div class="arrow-wrap-white">
				<div class="arrow-white"></div>
			</div>

			<section id="skill" class="white">
				<h3>Compétences</h3>
				<div class="skill">
					<h4>Intégration web</h4>
					<ul>
						<li><img src="img/html.png"><br />HTML</li>
						<li><img src="img/css.png"><br />CSS</li>
						<li><img src="img/sass.png"><br />Sass</li>
						<li><img src="img/rwd.png"><br />RWD</li>
						<li><img src="img/js.png"><br />JavaScript</li>
						<li><img src="img/jq.png"><br />jQuery</li>
						<li><img src="img/grunt.png"><br />Grunt</li>
						<li><img src="img/php.png"><br />PHP</li>
						<li><img src="img/mysql.png"><br />MySQL</li>
						<li><img src="img/wordpress.jpg"><br />WordPress</li>
						<li><img src="img/git.jpg"><br />Git</li>
					</ul>
				</div>
				<div class="skill">
					<h4>Programmation</h4>
					<ul>
						<li><img src="img/java.png"><br />Java</li>
						<li><img src="img/flash.jpg"><br />Flash</li>
					</ul>
				</div>
				<div class="skill">
					<h4>Infographie</h4>
					<ul>
						<li><img src="img/psd.png"><br />Photoshop</li>
						<li><img src="img/ai.jpg"><br />Illustrator</li>
						<li><img src="img/id.png"><br />InDesign</li>
					</ul>
				</div>
				<div class="skill">
					<h4>Montage audiovisuel</h4>
					<ul>
						<li><img src="img/audacity.png"><br />Audacity</li>
						<li><img src="img/ae.png"><br />After Effects</li>
						<li><img src="img/premiere.jpg"><br />Premiere</li>
					</ul>
				</div>
				<div class="skill">
					<h4>Bureautique</h4>
					<ul>
						<li><img src="img/word.jpg"><br />Word</li>
						<li><img src="img/pp.jpg"><br />Power Point</li>
					</ul>
				</div>				
			</section>

			<!-- REALISATIONS -->

			<div class="arrow-wrap-red">
				<div class="arrow-red"></div>
			</div>

			<section id="real" class="red">
				<h3>Réalisations</h3>
				<!--
				<div id="carousel-site">
					<img src="img/sites/tom.jpg" />
					<img src="img/sites/twm.jpg" />
					<img src="img/sites/if.jpg" />
					<img src="img/sites/wcc.jpg" />
					<img src="img/sites/kandinsky.jpg" />
					<img src="img/sites/ben.jpg" />
				    <img src="img/sites/pf.jpg" />
				    <img src="img/sites/nnbs.jpg" />				    
				</div>
				<div id="pagination"></div>
				-->
					<img class="wide" src="img/sites/tom.jpg" title="The Off Market" />

					<h4 class="caption">The Off Market</h4>

					<a href="#real"><img class="alt-caroufredsel" src="img/sites/tom.jpg" title="The Off Market" /></a>
					<a href="#real"><img class="alt-caroufredsel" src="img/sites/twm.jpg" title="Tummy With Mummy" /></a>
					<a href="#real"><img class="alt-caroufredsel" src="img/sites/if.jpg" title="Ice Factor" /></a>
					<a href="#real"><img class="alt-caroufredsel" src="img/sites/wcc.jpg" title="West Coast Capital" /></a>
					<a href="#real"><img class="alt-caroufredsel" src="img/sites/kandinsky.jpg" title="Kandisnky" /></a>
					<a href="#real"><img class="alt-caroufredsel" src="img/sites/ben.jpg" title="Précédent Portfolio" /></a>
				    <a href="#real"><img class="alt-caroufredsel" src="img/sites/pf.jpg" title="Tout Premier Portfolio" /></a>
				    <a href="#real"><img class="alt-caroufredsel" src="img/sites/nnbs.jpg" title="NNBS" /></a>

				    <img class="alt-mobile" src="img/sites/tom.jpg" title="The Off Market" />
				    <h4 class="alt-mobile-title">The Off Market</h4>
					<img class="alt-mobile" src="img/sites/twm.jpg" title="Tummy With Mummy" />
					<h4 class="alt-mobile-title">Tummy With Mummy</h4>
					<img class="alt-mobile" src="img/sites/if.jpg" title="Ice Factor" />
					<h4 class="alt-mobile-title">Ice Factor</h4>
					<img class="alt-mobile" src="img/sites/wcc.jpg" title="West Coast Capital" />
					<h4 class="alt-mobile-title">West Coast Capital</h4>
					<img class="alt-mobile" src="img/sites/kandinsky.jpg" title="Kandisnky" />
					<h4 class="alt-mobile-title">Kandinsky</h4>
					<img class="alt-mobile" src="img/sites/ben.jpg" title="Précédent Portfolio" />
					<h4 class="alt-mobile-title">Précédent Portfolio</h4>
				    <img class="alt-mobile" src="img/sites/pf.jpg" title="Tout Premier Portfolio" />
				    <h4 class="alt-mobile-title">Tout Premier Portfolio</h4>
				    <img class="alt-mobile" src="img/sites/nnbs.jpg" title="NNBS" />
				    <h4 class="alt-mobile-title">NNBS</h4>
			</section>

			<!-- CONTACT -->

			<div class="arrow-wrap-white">
				<div class="arrow-white"></div>
			</div>

			<section id="contact" class="white">
				<div id="details">					
					<h3>Contact</h3>
					<img id="eye" src="img/eyel.jpg" />
					
					<p>Benjamin MORVAN</p>
					<p>4 rue André Fleury</p>
					<p>21000 Dijon - France</p>
					<p>benjaminjeanmorvan@gmail.com</p>
					<p>06 43 41 40 65</p>
					<?php

						if(isset($mail_ok))
                        {
                            if($mail_ok)
                                    echo $message_envoye;
                                	
                            else
                                    echo $message_envoye;
                                	
                        }
                        if(isset($err_formulaire) && ($err_formulaire))
							echo $message_formulaire_invalide;
						/*echo '<script language="JavaScript" type="text/javascript">
								var message_formulaire_invalide = ' . $message_formulaire_invalide . ';
								alert(message_formulaire_invalide);							
							</script>';*/

					?>
				</div>
				<div id="form">
					<form action="index.php#contact" method="post" id="form_mail">
                        <label for="nom">Nom</label><br />
                        <input id="nom" name="nom" type="text" value=""/><br />
                        <label for="email">Email</label><br />
                        <input id="email" name="email" type="text" value=""/><br />
                        <label for="objet">Objet</label><br />
                        <input id="objet" name="objet" type="text" value=""/><br />
                        <label for="message">Message</label><br />
                        <textarea id="message" name="message"></textarea>
                        <input type="hidden" name="envoi" value="true">
                        <a id="submit" href="javascript:{}" type="submit" onclick="document.getElementById('form_mail').submit();">Envoyer</a>
					</form>

				</div>				
			</section>

			<!-- FOOTER -->

			<div class="arrow-wrap-red">
				<div class="arrow-red"></div>
			</div>

			<footer>
				<p>Benjamin Morvan &reg; - 2015 - <a href="http://fr.linkedin.com/pub/benjamin-morvan/b5/3b7/353" target="_blank"><img src="img/li.png" /></a></p>
				<nav class="nav-mobile">			
					<ul>
						<a id="top" href="#accueil"><li>Accueil</li></a>
						<a id="nav-profil" href="#profil"><li>Profil</li></a>
						<a id="nav-formation" href="#formation"><li>Formation</li></a>
						<a id="nav-exp" href="#exp"><li>Expérience</li></a>
						<a id="nav-skill" href="#skill"><li>Compétences</li></a>
						<a id="nav-real" href="#real"><li>Réalisations</li></a>
						<a id="nav-contact" href="#contact"><li>Contact</li></a>
					</ul>
				</nav>
			</footer>			

		</div>

	</body>
	<!--
	<script type="text/javascript" src="js/jquery.carouFredSel.js"></script>
		<script type="text/javascript">

		    $('#carousel-site').carouFredSel({
				scroll: {
				    duration: 1000,
				    pauseOnHover: true
				},
				auto: 5000,
				pagination: "#pagination"
			});

		</script>
	-->

</html>