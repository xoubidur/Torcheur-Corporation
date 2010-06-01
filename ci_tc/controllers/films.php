<?php

class Films extends Controller {
	
	function index() {
		$this->liste();
	}
	
	function liste() {
		$this->load->model('films_model');
		$liste['lesFilms'] = $this->films_model->getFilms();
		$data['maliste'] = $liste;
		//$this->load->view('films/liste',$liste);		
		
		$data['main_navigation'] = 'navigation';
		$data['main_content'] = 'films/liste';
		$this->load->view('includes/template', $data);
	}	
	
	function covers() {
		$this->load->model('films_model');
		$liste['lesFilms'] = $this->films_model->getFilms();
		$data['maliste'] = $liste;
		//$this->load->view('films/liste',$liste);		
		
		$data['main_navigation'] = 'navigation';
		$data['main_content'] = 'films/covers';
		$this->load->view('includes/template', $data);
	}	
	
	function add() {
		if ($this->input->post('submit')) {
			$this->load->model('films_model');
			$data = array(
				'titre' => $this->input->post('titre'),
				'title' => $this->input->post('title'),
				'url' => $this->input->post('url') ,
				'annee' => $this->input->post('annee') ,
				'image' => $this->input->post('image') ,
				'acteur' => $this->input->post('acteur') ,
				'realisateur' => $this->input->post('realisateur') ,
				'duree' => $this->input->post('duree') ,
				'genre' => $this->input->post('genre') ,
				'nationalite' => $this->input->post('nationalite') ,
				'synopsis' => $this->input->post('synopsis') ,
				'vu' => $this->input->post('vu') ,
				'etat' => $this->input->post('etat') ,
				'commentaire' => $this->input->post('commentaire') ,
				'avis' => $this->input->post('avis') ,
				'quand' => $this->input->post('quand')
				/*,
				'dateAjout' => $this->input->post('dateAjout'),
				'dateVu' => $this->input->post('dateVu')
				*/
			);
			
			$this->films_model->add($data);
			
			$id = $this->db->insert_id();
			$this->show($id);
			/*
			$data['main_navigation'] = 'navigation';
			$data['main_content'] = 'films/add';
			$this->load->view('includes/template', $data);
			*/
			
		} else {
			$data['main_navigation'] = 'navigation';
			$data['main_content'] = 'films/add';
			$this->load->view('includes/template', $data);
		}
	}
	
	function edit($idFilm) {
		$this->load->model('films_model');
		if ($this->input->post('submit')) {
			$titre = $this->input->xss_clean($this->input->post('titre'));
			$title = $this->input->xss_clean($this->input->post('title'));
			$url = $this->input->xss_clean($this->input->post('url'));
			$annee = $this->input->xss_clean($this->input->post('annee'));
			$image = $this->input->xss_clean($this->input->post('image'));
			$acteur = $this->input->xss_clean($this->input->post('acteur'));
			$realisateur = $this->input->xss_clean($this->input->post('realisateur'));
			$duree = $this->input->xss_clean($this->input->post('duree'));
			$genre = $this->input->xss_clean($this->input->post('genre'));
			$nationalite = $this->input->xss_clean($this->input->post('nationalite'));
			$synopsis = $this->input->xss_clean($this->input->post('synopsis'));
			$vu = $this->input->xss_clean($this->input->post('vu'));
			$etat = $this->input->xss_clean($this->input->post('etat'));
			$commentaire = $this->input->xss_clean($this->input->post('commentaire'));
			$avis = $this->input->xss_clean($this->input->post('avis'));
			$quand = $this->input->xss_clean($this->input->post('quand'));
	 
			$this->films_model->edit($idFilm, $titre, $title, $url, $annee, 
				$image, $acteur, $realisateur, $duree, $genre, $nationalite,
				$synopsis, $vu, $etat, $commentaire, $avis, $quand);
			$this->show($idFilm);
		} else {
			
			$data['leFilm'] = $this->films_model->getFilm($idFilm);
			$data['main_navigation'] = 'navigation';
			$data['main_content'] = 'films/edit';
			$this->load->view('includes/template', $data);
		}
	}
	
	
	function delete($idFilm) {
		$this->load->model('films_model');
		$this->films_model->delete($idFilm);
		// TODO : confirmation
		$this->index();
	}

	function show($idFilm) {
		$this->load->model('films_model');
		$data['leFilm'] = $this->films_model->getFilm($idFilm);
		/*
		$liste['leFilm'] = $this->films_model->getFilm($idFilm);
		$data['maliste'] = $liste;
		*/
		$data['main_navigation'] = 'navigation';
		$data['main_content'] = 'films/show';
		$this->load->view('includes/template', $data);
	}
	
	function previous($idFilm) {
		$this->load->model('films_model');
		$min = $this->films_model->getMin();
		if ($idFilm > $min) {
			$leFilm = $this->films_model->getPrevious($idFilm);
			$this->show($leFilm->id);
		} else {
			$max = $this->films_model->getMax();
			$this->show($max);
		}
	}
	
	function next($idFilm) {
		$this->load->model('films_model');
		$max = $this->films_model->getMax();
		if ($idFilm < $max) {
			$leFilm = $this->films_model->getNext($idFilm);
			$this->show($leFilm->id);
		} else {
			$min = $this->films_model->getMin();
			$this->show($min);
		}
	}
	
	function allocine() {
		if ($this->input->post('submit')) {
			$data = array(
				'titre' => $this->input->post('titre')
			);
			
			$titre_tmp = $data['titre'];
			$titre_tmp = preg_replace('# #', '+', $titre_tmp);
			$url_recherche="http://www.allocine.fr/recherche/1/?q=$titre_tmp";
			//print_r($url_recherche);
			//echo '<br/>';
			$result_recherche = @file_get_contents($url_recherche);
			$expreg_1='#<table class="totalwidth noborder purehtml">(.*?)<div class="filterbar    navbypagefull -navbypage -navbydate -navbyyear">#is';
			if (preg_match_all($expreg_1,$result_recherche, $resultats_1)) {
				$resultats_1a = $resultats_1[0];
				//print_r($resultats_1a );
				
					$expreg_2='#<td style=" vertical-align:middle;">(.*?)</span>#is';
					if (preg_match_all($expreg_2,$resultats_1a[0], $resultats_2)) {
						$resultats_2a = $resultats_2[0];
						$lesFilms = array();
						foreach($resultats_2[0] as $unResultat)
						{
							$pattern01 = '~<td style=" vertical-align:middle;">~';
							$replacement01 = '<div class="film"><div class="image">';
							$pattern02 = '~ </span>~';
							$replacement02 = '</div></div>';
							$pattern03 = '~<td style=" vertical-align:top;" class="totalwidth">~';
							$replacement03 = '</div>';
							$pattern04 = '~<div>~';
							$pattern05 = '~<div style="margin-top:-5px;"> ~';
							$replacement05 = '<div class="titre">';
							$pattern06 = '~<span class="fs11">~';
							$replacement06 = '</div><div class="details">';
							$pattern07 = '~</td>~';
							$pattern08 = '~/film/fichefilm_gen_cfilm=~';
							$replacement08 = 'http://www.allocine.fr/film/fichefilm_gen_cfilm=';
							$replacement = '';
							$unResultat01 = preg_replace($pattern01, $replacement01, $unResultat);
							$unResultat02 = preg_replace($pattern02, $replacement02, $unResultat01);
							$unResultat03 = preg_replace($pattern03, $replacement03, $unResultat02);
							$unResultat04 = preg_replace($pattern04, $replacement, $unResultat03);
							$unResultat05 = preg_replace($pattern05, $replacement05, $unResultat04);
							$unResultat06 = preg_replace($pattern06, $replacement06, $unResultat05);
							$unResultat07 = preg_replace($pattern07, $replacement, $unResultat06);
							$unResultat08 = preg_replace($pattern08, $replacement08, $unResultat07);
							$lesFilms[] = $unResultat08;
						}
					}
			
			$data['leFilm'] = $lesFilms;
			$data['main_navigation'] = 'navigation';
			$data['main_content'] = 'films/allocine2';
			$this->load->view('includes/template', $data);
			
			}
			else {
				echo "Rien trouv&eacute; 1";
				echo '<br/>';
				echo $result_recherche;
				echo '<br/>';
				echo $expreg_1;
			
			}
		}
		else {
			$data['main_navigation'] = 'navigation';
			$data['main_content'] = 'films/allocine';
			$this->load->view('includes/template', $data);
		}
	}
	
	function allocine3($titre) {
		$url = 'http://www.allocine.fr/film/fichefilm_gen_cfilm=';
		$extension = '.html';
		$film_url = $url.$titre.$extension;
		$recup_page = @file_get_contents($film_url);
		$idFilm = $titre;
		
		
		$expreg_page = '#<h1>(.*?)<div class="morezone">#is' ;
		if(preg_match_all($expreg_page, $recup_page,$page_tmp))
		{
			$page_tmp = $page_tmp[0][0];
			
			/*	
			 *	TITRE
			 */
			$expreg_titre = '#<h1>(.*?)</h1>#is' ;
			if(preg_match_all($expreg_titre, $page_tmp,$titre_tmp))
			{
				$titre = $titre_tmp[0];
				$titre = trim(strip_tags($titre[0]));
			}
			else {$titre = "benoit";}

			
			/*
			 *	NATIONALITE
			 */
			$expreg_nationalite = "#<a href='/film/tous(.*?)<span>#is" ;
			if(preg_match_all($expreg_nationalite, $page_tmp,$nat_tmp))
			{
				$nationalite = $nat_tmp[0];
				$nationalite = trim(strip_tags($nationalite[0]));
			}
			else {$nationalite = "benoit";}
			
			/*
			 *	REALISATEUR
			 */
			$expreg_rea = '#Réalisé par(.*?)</span>#is' ;
			if(preg_match_all($expreg_rea, $page_tmp,$rea_tmp))
			{
				$realisateur = $rea_tmp[0];
				$realisateur = trim(strip_tags($realisateur[0]));
				$realisateur = preg_replace('#Réalisé par#', '', $realisateur);
			}
			else {$realisateur = "benoit";}
			
			/*
			 *	ACTEURS
			 */
			$expreg_acteurs = '#Avec <a href(.*?)/film/casting#is' ;
			if($titreTmp93 = preg_match_all($expreg_acteurs, $page_tmp,$act_tmp))
			{
				$acteurs = $act_tmp[0];
				$acteurs = trim(strip_tags($acteurs[0]));
				$acteurs = preg_replace('#Avec#', '', $acteurs);
			}
			else {$acteurs = "benoit";}
			
			/*
			 *	GENRE
			 */
			$expreg_genre = '#Genre :(.*?)<br />#is' ;
			if(preg_match_all($expreg_genre, $page_tmp,$genre_tmp))
			{
				$genre = $genre_tmp[0];
				$genre = trim(strip_tags($genre[0]));
				$genre = preg_replace('#Genre :#', '', $genre);
			}
			else {$genre = "benoit";}
			
			/*
			 *	DUREE
			 */
			$expreg_duree = '#Durée :(.*?)Année de production :#is' ;
			if(preg_match_all($expreg_duree, $page_tmp,$duree_tmp))
			{
				$duree = $duree_tmp[0];
				$duree = trim(strip_tags($duree[0]));
				$duree = preg_replace('#Durée : #', '', $duree);
				$duree = preg_replace('#Année de production :#', '', $duree);
			}
			else {$duree = "";}
			
			/*
			 *	ANNEE de production
			 */
			$expreg_annee = '#Année de production :(.*?)</a>#is' ;
			if(preg_match_all($expreg_annee, $page_tmp, $annee_tmp))
			{
				$anneeProd = $annee_tmp[0];
				$anneeProd = trim(strip_tags($anneeProd[0]));
				$anneeProd = preg_replace('#Année de production :#', '', $anneeProd);
			}
			else {$anneeProd = "benoit";}
			
			/*
			 *	DATE de sortie
			 */
			$expreg_sortie = '#Date de sortie(.*?)</span>#is' ;
			if( $titreTmp = preg_match_all($expreg_sortie, $page_tmp, $sortie_tmp))
			{
				$anneeSortie = $sortie_tmp[0];
				$anneeSortie = trim(strip_tags($anneeSortie[0]));
				$anneeSortie = preg_replace('#Date de sortie cinéma :#', '', $anneeSortie);
			}
			else {$anneeSortie = "benoit";}
			
			/*
			 *	SYNOPSIS
			 */
			$expreg_synopsis = '#Synopsis :(.*?)</div>#is' ;
			if(preg_match_all($expreg_synopsis, $page_tmp, $synopsis_tmp))
			{
				$synopsis = $synopsis_tmp[0];
				$synopsis = trim(strip_tags($synopsis[0]));
				$synopsis = preg_replace('#Synopsis :#', '', $synopsis);
			}
			else {$synopsis = "benoit";}
			
			/*
			 *	TYPE
			 */
			$expreg_type = "#<!-- end paragraph for second block -->(.*?)<a href='/film/tous#is" ;
			if(preg_match_all($expreg_type, $page_tmp, $type_tmp))
			{
				$type = $type_tmp[0];
				$type = trim(strip_tags($type[0]));
			}
			else {$type = "benoit";}
			
			/*
			 *	IMAGE
			 */
			$recup_page2 = @file_get_contents($film_url);
			$expreg_ima = '#<div class="poster">(.*?).jpg#is' ;
			if(preg_match_all($expreg_ima, $recup_page2,$page_tmpima))
			{
				$image = $page_tmpima[0][0];
				$expreg_ima = '#http://images.allocine.fr(.*?).jpg#is' ;
				if(preg_match_all($expreg_ima, $image,$page_tmpima))
				{
					$image = $page_tmpima[0][0];
				}
			}
			else {$image = "http://images.allocine.fr/r_160_214/b_1_cfd7e1/commons/emptymedia/AffichetteAllocine.gif";}
			
			/*
			 *	NOTATION PRESSE
			 */
			/*
			$e97 = "#<!-- end paragraph for second block -->(.*?)<a href='/film/tous#is" ;
			if( $t97 = preg_match_all($e97, $page_tmp,$r97))
			{
				$type = $r97[0];
			}
			else {$type = "benoit";}
			echo trim(strip_tags($type[0]));
			echo '<br/>';
			*/
			
			/*
			 *	NOTATION SPECTATEURS
			 */
			/*
			$e97 = "#<!-- end paragraph for second block -->(.*?)<a href='/film/tous#is" ;
			if( $t97 = preg_match_all($e97, $page_tmp,$r97))
			{
				$type = $r97[0];
			}
			else {$type = "benoit";}
			echo trim(strip_tags($type[0]));
			echo '<br/>';
			*/
			
			/*
		
			<div class="notationbar">
			<div class="notezone">
			<p><a href='/film/revuedepresse_gen_cfilm=61282.html'>
			Presse</a></p><p class="withstars">
			<a href='/film/revuedepresse_gen_cfilm=61282.html'>
			<img class="stareval n35 on4" src='http://images.allocine.fr/commons/empty.gif' 
			width='0' height='0' alt='3,4' title='3,4' /></a>
			<span class="moreinfo">(3,4)</span></p>
			</div><div class="notezone vseparatorl">
			<p><a href='/film/critiquepublic_gen_cfilm=61282.html'>
			Spectateurs</a><span class="moreinfo">(22189 notes)
			</span></p><p class="withstars">
			<a href='/film/critiquepublic_gen_cfilm=61282.html'>
			<img class="stareval n35 on4" src='http://images.allocine.fr/commons/empty.gif' 
			width='0' height='0' alt='3,4' title='3,4' /></a><span class="moreinfo">(3,4)
			</span></p></div><div class="notezone vseparatorl"><div class="withreco">
			<ul class="functionsmenu"><li class="-vseparatorr"><em>
			<img class='-ico -icofavadd' src='http://images.allocine.fr/commons/empty.gif' 
			width='0' height='0' alt='' title='Ajouter' />Recommandation</em></li>
			<li class="-vseparatorr hide"><a href="/communitypage_noteshelp" target="_blank">
			<img class="ico icoquestion" src='http://images.allocine.fr/commons/empty.gif' 
			width='0' height='0' alt='' title='' /></a></li></ul><div class="spacer"></div>
			<div class='recobar' ParameterName='cmovie' ParameterValue='61282'>
			<img class='recopercent1' style='width: 0%;' src='http://images.allocine.fr/commons/empty.gif' 
			width='0' height='0' alt='' />
			<img class='recomask' src='http://images.allocine.fr/commons/empty.gif' 
			width='0' height='0' alt='' /></div><span class='moreinfo hide'>(0%)</span></div></div>
			<div class="spacer"></div></div>
            */

			$film_tmp = array();
			
			$film_tmp['idFilm'] = $idFilm;
			$film_tmp['type'] = $type;
			$film_tmp['nationalite'] = $nationalite;
			$film_tmp['titre'] = $titre;
			$film_tmp['realisateur'] = $realisateur;
			$film_tmp['acteurs'] = $acteurs;
			$film_tmp['genre'] = $genre;
			$film_tmp['duree'] = $duree;
			$film_tmp['anneeProd'] = $anneeProd;
			$film_tmp['anneeSortie'] = $anneeSortie;
			$film_tmp['synopsis'] = $synopsis;
			$film_tmp['image'] = $image;
			
			$data['leFilm'] = $film_tmp;
			$data['main_navigation'] = 'navigation';
			$data['main_content'] = 'films/allocine3';
			$this->load->view('includes/template', $data);
			
		}
	}

	function alapage() {
		if ($this->input->post('submit')) {
			$data = array(
				'titre' => $this->input->post('titre')
			);
			$titre_recherche = $data['titre'];
			$titre_recherche_url = urlencode($titre_recherche);
			$i=0;
			$url_recherche="http://alapage.allocine.fr/recherche/?rub=0&motcle=$titre_recherche_url";
			$recup_page = @file_get_contents($url_recherche);
			$expreg_1='#Films <h4>(.*?)(Voir les|Séries|Stars|Articles)#is';
			if ($resultat = preg_match_all($expreg_1,$recup_page,$resultat_1))
			{
				$resultats_1 = $resultat_1[0][0];
				echo "<hr/>";
				echo "resultats_1";
				echo "<pre>";
				print_r($resultats_1);
				echo "</pre>";
				echo "<hr/>";
				$expreg_2 = '#<tr>(.*?)</tr>#is' ;
				
				if ($resultats = preg_match_all($expreg_2, $resultats_1, $resultats_tmp_2))
				{
					$resultats_2 = $resultats_tmp_2[0];
					echo "<hr/>";
					echo "resultats_2";
					echo "<pre>";
					print_r($resultats_2);
					echo "</pre>";
					echo "<hr/>";
					$nb=0;
					$nb=count($resultats_2);
					
					foreach($resultats_2 as $unResultat)
					{
					echo "<hr/>";
					echo "unResultat";
					echo "<pre>";
					print_r($unResultat);
					echo "</pre>";
					echo "<hr/>";
						$expreg_3 = '#<h4><a href(.*?)</a></h4>#is' ;
						if($estUnFilm=preg_match_all($expreg_3, $unResultat ,$resultats_tmp_3))
						{
							echo "<hr/>";
							echo "resultats_tmp_3";
							echo "<pre>";
							print_r($resultats_tmp_3);
							echo "</pre>";
							echo "<hr/>";
						
							$expreg_4 = '#<a href=.+">(.*?)</a>#is' ;
							if( $titreTmp = preg_match_all($expreg_4, $unResultat,$titre_tmp))
							{
								$titre = strip_tags($titre_tmp[0][0]);
								if($titre!="Voir/?")
								{
									$expreg_id = '#/film/fichefilm_gen_cfilm=(.*?).html#is';
									$expreg_rea = '#<h5[^>]*>de (.*?)</h5>#is';
									$expreg_acteur = '#<h5[^>]*>avec (.*?)</h5>#is';
									$expreg_annee = '#<h4[^>]*>(\d{4})</h4>#is';
								
									if( $idTmp = preg_match_all($expreg_id, $unResultat,$id_tmp))
									{
										$url_de_base = "http://alapage.allocine.fr";
										$id = strip_tags($id_tmp[0][0]);
										$url = $url_de_base.$id;
									}
									if( $reaTmp = preg_match_all($expreg_rea, $unResultat,$rea_tmp))
									{
										$rea= strip_tags($rea_tmp[0][0]);
									}
									else {$rea = "";}
									if( $acteurTmp = preg_match_all($expreg_acteur, $unResultat,$acteur_tmp))
									{
										$acteur = strip_tags($acteur_tmp[0][0]);
									}
									else {$acteur = "";}
									if( $anneeTmp = preg_match_all($expreg_annee, $unResultat,$annee_tmp))
									{
										$annee = strip_tags($annee_tmp[0][0]);
									}
									else {$annee = "";}
									?>
									<dl>
									<dt>
									<?php
									$j=$i+1;
									echo $j.".";
									?>
									<input type="radio" name="film" id="film" value="<?php echo $url ; ?>" onClick="javascript:sendData('ajout_detail', 'film', '<?php echo $url ; ?>', 'ajout_detail.php', 'POST');afficheId('ajout_detail');" >
										<a href="<?php echo $url ; ?>" target="_new">
										<?php echo $titre ; ?>
									</a>

									</dt>
									<dd>
									<?php echo  $rea ; ?>
									</dd>
									<dd>
									<?php echo $annee ; ?>
									</dd>
									<dd>
									<?php echo $acteur ; ?>
									</dd>
									</dl>
									<?php
									$i++;
								}
							}
						}
					}
				}
				if (!($i == " ")||!($i == "")||!($i == "0")){
					echo $i." film(s) trouvés)";
				}
			}
			if (($i == " ")||($i == "")||($i == "0"))
			{
				echo "Désolé pas de résultat";
				echo "<br />";
				echo "Ajouter quand méme le film ? (conseillé)";
				echo "<br />";
				?>
				<input type="radio" name="film" id="film" value="<?php echo $titre_recherche ; ?>" onClick="javascript:sendData('ajout_detail', 'film', '<?php echo $titre_recherche ; ?>', 'ajout_sans_detail.php', 'POST');afficheId('ajout_detail');" >
				<?php echo $titre_recherche ;
			}
			?>
			</form>
			<?php
		}
		else {
			$data['main_navigation'] = 'navigation';
			$data['main_content'] = 'films/alapage';
			$this->load->view('includes/template', $data);
		}
	}
}
?>