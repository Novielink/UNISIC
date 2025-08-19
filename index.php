<?php
// configuration de chemin de la page
session_start();
require_once('INCLUDE/connexion.php');
$logo = 'SRC/IMAGE/PARAMETRE/logo.png';
$accueil='index.php';
$universite='VIEW/universite.php';
$faculte='VIEW/faculte.php';
$actualite='VIEW/actualite.php';
$admission='VIEW/admission.php';
$inscripion='VIEW/inscription.php'; 
$novielink='SRC/IMAGE/PARAMETRE/novielink_reporter.jpg';
?>

<?php

/* recuperation des image pour le carousel */
$requete = 'SELECT * FROM `12parametre`';
$_SESSION['query'] = $requete;
$traitement = $lien->prepare($requete);
$traitement->execute();
$recup = $traitement->get_result();
$sortie = $recup->fetch_all(MYSQLI_ASSOC);

$requete0 = 'SELECT COUNT(chemin) AS nbrCarousel FROM `12parametre`';
$traitement0 = $lien->prepare($requete0);
$traitement0->execute();
$recup0 = $traitement0->get_result();
$sortie0 = $recup0->fetch_all(MYSQLI_ASSOC);
$nbrCarousel = $sortie0[0]['nbrCarousel'];

/**
 * nombre de faculter
 */
$requete1 = 'SELECT DISTINCT COUNT(id) AS nombre_de_facultes FROM 5facultes ';
$traitement1 = $lien->prepare($requete1);
$traitement1->execute();
$recup1 = $traitement1->get_result();
$sortie1 = $recup1->fetch_all(MYSQLI_ASSOC);
$facultes = $sortie1[0]['nombre_de_facultes'];

/**
 * nombre du personnel
 */
$requete2 = 'SELECT DISTINCT COUNT(id) AS nombre_du_personnel FROM `9personnel`';
$traitement2 = $lien->prepare($requete2);
$traitement2->execute();
$recup2 = $traitement2->get_result();
$sortie2 = $recup2->fetch_all(MYSQLI_ASSOC);
$membre_du_personnel = $sortie2[0]['nombre_du_personnel'];

/**
 * nombre d'etudiant
 */
$requete3 = 'SELECT DISTINCT COUNT(id) AS nombre_d_etudiant FROM 8etudiant ';
$traitement3 = $lien->prepare($requete3);
$traitement3->execute();
$recup3 = $traitement3->get_result();
$sortie3 = $recup3->fetch_all(MYSQLI_ASSOC);
$etudiants = $sortie3[0]['nombre_d_etudiant'];

/**
 * section actualité
 */
$requete4 = 'SELECT * FROM 10actualites ORDER BY id DESC LIMIT 10';
$traitement4 = $lien->prepare($requete4);
$traitement4->execute();
$recup4 = $traitement4->get_result();
$sortie4 = $recup4->fetch_all(MYSQLI_ASSOC);
$actualites_recents = $sortie4;

$bouton1Texte = $sortie[0]['bouton'];
$bouton2Texte = $sortie[1]['bouton'];

$bouton1Url = $sortie[0]['page'];
$bouton2Url = $sortie[1]['page'];

$titreAccueil = $sortie[0]['titreAccueil'];
$texteAccueil = $sortie[0]['texteAccueil'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil UNISIC - Université des Sciences de l'Information et de la Communication</title>
    <meta name="description" content="Découvrez l'UNISIC, l'Université des Sciences de l'Information et de la Communication à Kinshasa. Formations de qualité, actualités, facultés et conditions d'admission.">
    <meta name="keywords" content="UNISIC, Université Kinshasa, IFASIC, Sciences de l'Information, Communication, Kinshasa, Congo, RDC, enseignement supérieur">
    <link rel="shortcut icon" href="SRC/IMAGE/PARAMETRE/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="SRC/CSS/index.css">
    <link rel="stylesheet" href="SRC/CSS/header.css">
    <link rel="stylesheet" href="SRC/CSS/footer.css">
    <style>
        /*
        * Correction pour forcer l'affichage du bouton burger sur les petits écrans.
        * Cette règle garantit que le bouton est toujours un flexbox et qu'il est visible.
        */
        @media (max-width: 768px) {
            .bouton-burger {
                display: flex !important;
            }

            /* Styles pour le menu burger ouvert */
            .navigation.active {
                /* Met le fond en couleur primaire */
                background-color: var(--couleur-primaire);
                /* Assure que le menu est bien visible */
                transform: translateX(0);
            }

            /* Cible les liens de la navigation pour les colorer en blanc */
            .navigation.active .navigation__lien {
                color: var(--couleur-blanc) !important; /* Force la couleur du texte en blanc */
            }
        }
    </style>
</head>
<body>
    <?php include('INCLUDE/header.php'); ?>
    <main>
        <section class="hero-carrousel">
            <div class="paragraphe-conteneur">
                <div class="paragraphe">
                    <h2 class="hero__titre"><?php echo htmlentities($titreAccueil); ?></h2>
                    <p><?php echo htmlentities($texteAccueil); ?></p>
                    <a href="<?php echo htmlentities($bouton1Url); ?>" class="button1">
                        <?php echo htmlentities($bouton1Texte); ?>
                    </a>
                    <a href="<?php echo htmlentities($bouton2Url); ?>" class="button2">
                        <?php echo htmlentities($bouton2Texte); ?>
                    </a>
                </div>
            </div>
            <div class="carrousel-defilement__conteneur">
                <?php for ($i = 0; $i < $nbrCarousel; $i++): ?>
                    <div class="carrousel-defilement__image active" id='element-carrousel-<?= $i ?>'>
                    </div>
                <?php endfor ?>
            </div>
            <img src="SRC/IMAGE/CAROUSEL/fleche.webp" alt="bouton droit pour défiler vers la droite du carrousel" class="fleche-carrousel fleche-carrousel--droite" id='bouton-droit'>
            <img src="SRC/IMAGE/CAROUSEL/fleche.webp" alt="bouton gauche pour défiler vers la gauche du carrousel" class="fleche-carrousel fleche-carrousel--gauche" id='bouton-gauche'>
        </section>
        <section class="section-apropos">
            <h2 class="apropos__titre">À Propos de l'UNISIC</h2>
            <div class="apropos__contenu">
                <p>Anciennement connue sous le nom d'IFASIC, l'<strong>Université des Sciences de l'Information et de la Communication (UNISIC)</strong> a été officiellement renommée en novembre 2023. Fondée en 1973 sous le nom d'ISTI, notre institution s'est transformée en une université de plein droit, élargissant son offre académique pour répondre aux défis du XXIe siècle.</p>
                <p>Située à <strong>Kinshasa</strong>, sur l'Avenue Colonel Ebeya, notre mission est de former les futurs leaders des métiers de l'information et de la communication, avec un programme diversifié et une équipe pédagogique de haut niveau.</p>
            </div>
        </section>
        <section class="infos-cles">
            <h2 class="infos-cles__titre">UNISIC en Chiffres Clés</h2>
            <div class="infos-cles__grille">
                <div class="infos-cles__carte">
                    <i class="fas fa-users infos-cles__icone"></i>
                    <div class="infos-cles__valeur" data-valeur-finale="<?php echo htmlspecialchars($membre_du_personnel ?? 0); ?>">0</div>
                    <div class="infos-cles__description">Membres du personnel</div>
                </div>
                <div class="infos-cles__carte">
                    <i class="fas fa-user-graduate infos-cles__icone"></i>
                    <div class="infos-cles__valeur" data-valeur-finale="<?php echo htmlspecialchars($etudiants ?? 0); ?>">0</div>
                    <div class="infos-cles__description">Étudiants inscrits</div>
                </div>
                <div class="infos-cles__carte">
                    <i class="fas fa-building infos-cles__icone"></i>
                    <div class="infos-cles__valeur" data-valeur-finale="<?php echo htmlspecialchars($facultes ?? 0); ?>">0</div>
                    <div class="infos-cles__description">Facultés</div>
                </div>
        </section>
        <section class="section-actualites">
            <h2 class="section-actualites__titre">Dernières Actualités</h2>
            <div class="actualites__grille">
                <?php if (!empty($actualites_recents)): ?>
                    <?php foreach ($actualites_recents as $actualite): ?>
                        <div class="actualite__carte">
                            <img src="<?php echo htmlspecialchars($actualite['chemin']); ?>" alt="<?php echo htmlspecialchars($actualite['titre']); ?>" class="actualite__image">
                            <div class="actualite__contenu">
                                <p class="actualite__date"><?php echo htmlspecialchars((new DateTime($actualite['date_de_publication']))->format('d F Y')); ?></p>
                                <h3 class="actualite__titre"><?php echo htmlspecialchars($actualite['titre']); ?></h3>
                                <p class="actualite__description"><?php echo htmlspecialchars(substr($actualite['contenus'], 0, 100)) . '...'; ?></p>
                                <a href="VIEW/blog.php?id=<?php echo htmlspecialchars($actualite['id']); ?>" class="actualite__lien">Lire la suite</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Aucune actualité récente n'a été trouvée.</p>
                <?php endif; ?>
            </div>
        </section>
        <section class="section-facultes">
            <h2 class="facultes__titre" id="titre-facultes"></h2>
            <div class="facultes__grille">
                <div class="faculte__carte">
                    <i class="fas fa-newspaper faculte__icone"></i>
                    <h3 class="faculte__nom">Journalisme, Presse et Information</h3>
                    <p class="faculte__description">Journalisme, Presse Imprimée, Presse Audiovisuelle, Multimédia...</p>
                    <a href="#" class="faculte__lien">En savoir plus</a>
                </div>
                <div class="faculte__carte">
                    <i class="fas fa-book faculte__icone"></i>
                    <h3 class="faculte__nom">Sciences de l’Écrit, Informations Techniques et Documentaires</h3>
                    <p class="faculte__description">Bibliothéconomie, Éditologie, Documentation et Archivistique...</p>
                    <a href="#" class="faculte__lien">En savoir plus</a>
                </div>
                <div class="faculte__carte">
                    <i class="fas fa-theater-masks faculte__icone"></i>
                    <h3 class="faculte__nom">Arts du Spectacle, Cinéma, Médias et Culture</h3>
                    <p class="faculte__description">Arts du Spectacle Vivant, Cinéma, Médias et Cultures...</p>
                    <a href="#" class="faculte__lien">En savoir plus</a>
                </div>
                <div class="faculte__carte">
                    <i class="fas fa-bullhorn faculte__icone"></i>
                    <h3 class="faculte__nom">Communication des Organisations</h3>
                    <p class="faculte__description">Communication Politique, Financière, Économique et d'Entreprise.</p>
                    <a href="#" class="faculte__lien">En savoir plus</a>
                </div>
                <div class="faculte__carte">
                    <i class="fas fa-users faculte__icone"></i>
                    <h3 class="faculte__nom">Communication Publique et Développement</h3>
                    <p class="faculte__description">Communication Sociale, Culturelle, de la Santé, du Genre et des Droits Humains.</p>
                    <a href="#" class="faculte__lien">En savoir plus</a>
                </div>
            </div>
        </section>

        <section class="section-admission">
            <h2 class="admission__titre">Conditions d'Admission</h2>
            <div class="admission__conteneur">
                <div class="admission__colonne">
                    <h3><i class="fas fa-graduation-cap"></i> Diplôme requis</h3>
                    <ul>
                        <li>Être titulaire d’un <strong>Diplôme d’État</strong> ou d’une attestation de réussite.</li>
                    </ul>

                    <h3><i class="fas fa-folder-open"></i> Dossier à fournir</h3>
                    <ul class="admission__dossier-liste">
                        <li>Photocopies des bulletins de 5ème et 6ème humanités.</li>
                        <li>Attestation de naissance.</li>
                        <li>Relevé des cotes des années précédentes.</li>
                        <li>Certification de bonne vie et mœurs.</li>
                        <li>Lettre d’admission.</li>
                        <li>Photo passeport.</li>
                    </ul>

                    <h3><i class="fas fa-edit"></i> Test d'admission</h3>
                    <ul>
                        <li>Les candidats ayant obtenu <strong>moins de 60%</strong> au Diplôme d’État doivent passer un test d’admission.</li>
                    </ul>
                </div>
                
                <div class="admission__colonne">
                    <h3><i class="fas fa-map-marker-alt"></i> Procédure d'inscription</h3>
                    <ul>
                        <li>Les inscriptions se font <strong>sur place à l'UNISIC</strong>, située Avenue Colonel Ebeya, N° 101, commune de la Gombe, Kinshasa.</li>
                        <li>Les inscriptions sont ouvertes du <strong>lundi au samedi</strong>, de <strong>8h30 à 15h30</strong>.</li>
                    </ul>

                    <h3><i class="fas fa-money-bill-wave"></i> Frais d'inscription</h3>
                    <ul>
                        <li>Les frais s'élèvent à <strong>50 USD</strong>, à payer via la Rawbank.</li>
                    </ul>

                    <div class="admission__important">
                        <p><i class="fas fa-exclamation-triangle"></i> L'UNISIC n'organise aucun cours à distance ou en ligne.</p>
                        <p>Toutes les inscriptions doivent être effectuées en personne à l'apparitorat central de l'université.</p>
                    </div>
                </div>
            </div>
        </section>
        <?php include('INCLUDE/footer.php'); ?>
    </main>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // --- Gestion du menu burger ---
            const boutonBurger = document.querySelector('.bouton-burger');
            const navigation = document.querySelector('.navigation');
            const navigationLiens = document.querySelectorAll('.navigation__lien');

            boutonBurger.addEventListener('click', () => {
                const isExpanded = navigation.classList.toggle('active');
                boutonBurger.classList.toggle('active');
                boutonBurger.setAttribute('aria-expanded', isExpanded);
                document.body.style.overflow = isExpanded ? 'hidden' : '';
            });

            navigationLiens.forEach(lien => {
                lien.addEventListener('click', () => {
                    boutonBurger.classList.remove('active');
                    navigation.classList.remove('active');
                    boutonBurger.setAttribute('aria-expanded', 'false');
                    document.body.style.overflow = '';
                });
            });

            // Ferme le menu si on clique à l'extérieur
            document.addEventListener('click', (event) => {
                if (navigation.classList.contains('active') && !navigation.contains(event.target) && !boutonBurger.contains(event.target)) {
                    boutonBurger.classList.remove('active');
                    navigation.classList.remove('active');
                    boutonBurger.setAttribute('aria-expanded', 'false');
                    document.body.style.overflow = '';
                }
            });

            // --- Gestion du Carrousel Héro ---
            const elementsCarrousel = document.querySelectorAll('.carrousel-defilement__image');
            const flecheDroite = document.getElementById('bouton-droit');
            const flecheGauche = document.getElementById('bouton-gauche');
            let indexCarrousel = 0;

            const imagesCarrousel = [
                <?php foreach ($sortie as $sort) {
                    echo " '$sort[chemin]',";
                } ?>
            ];

            // Attribuer les images de fond
            elementsCarrousel.forEach((el, i) => {
                el.style.backgroundImage = `url('${imagesCarrousel[i]}')`;
            });

            function mettreAJourCarrousel(nouvelIndex) {
                elementsCarrousel.forEach(el => el.classList.remove('active'));
                elementsCarrousel[nouvelIndex].classList.add('active');
                indexCarrousel = nouvelIndex;
            }

            flecheDroite.addEventListener('click', () => {
                let nouvelIndex = (indexCarrousel + 1) % elementsCarrousel.length;
                mettreAJourCarrousel(nouvelIndex);
            });

            flecheGauche.addEventListener('click', () => {
                let nouvelIndex = (indexCarrousel - 1 + elementsCarrousel.length) % elementsCarrousel.length;
                mettreAJourCarrousel(nouvelIndex);
            });

            // Défilement automatique
            const intervalleDiaporamaAutomatique = 5000;
            setInterval(() => {
                mettreAJourCarrousel((indexCarrousel + 1) % elementsCarrousel.length);
            }, intervalleDiaporamaAutomatique);

            // Initialisation
            mettreAJourCarrousel(0);

            // --- Animation des nombres dans la section Infos Clés ---
            const optionsInfosCles = {
                root: null,
                threshold: 0.5
            };

            const observerInfosCles = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const nombresAAimer = entry.target.querySelectorAll('.infos-cles__valeur');
                        animerNombres(nombresAAimer);
                        observerInfosCles.unobserve(entry.target); // Arrête d'observer une fois l'animation déclenchée
                    }
                });
            }, optionsInfosCles);

            const sectionInfosCles = document.querySelector('.infos-cles');
            if (sectionInfosCles) {
                observerInfosCles.observe(sectionInfosCles);
            }

            function animerNombres(elements, duration = 2000) {
                elements.forEach(element => {
                    const valeurFinale = parseInt(element.getAttribute('data-valeur-finale'));
                    let compteur = 0;
                    const pas = valeurFinale / (duration / 16);
                    const interval = setInterval(() => {
                        compteur += pas;
                        if (compteur >= valeurFinale) {
                            clearInterval(interval);
                            element.textContent = valeurFinale;
                        } else {
                            element.textContent = Math.floor(compteur);
                        }
                    }, 16);
                });
            }

            // --- Animation du titre des Facultés (machine à écrire) ---
            const texteFacultes = "Nos Facultés";
            const titreFacultesElement = document.getElementById('titre-facultes');
            let indexTaper = 0;
            let effacer = false;
            let intervalTaper;

            function animerTitreFacultes() {
                if (!titreFacultesElement) return;

                if (!effacer) {
                    titreFacultesElement.textContent = texteFacultes.substring(0, indexTaper);
                    indexTaper++;
                    if (indexTaper > texteFacultes.length) {
                        effacer = true;
                    }
                } else {
                    titreFacultesElement.textContent = texteFacultes.substring(0, indexTaper);
                    indexTaper--;
                    if (indexTaper < 0) {
                        effacer = false;
                        indexTaper = 0;
                    }
                }
            }

            // Gérer l'observation pour déclencher l'animation du titre
            const optionsFacultes = {
                root: null,
                threshold: 0.8
            };
            const observerFacultes = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        if (!intervalTaper) {
                            intervalTaper = setInterval(animerTitreFacultes, 150);
                        }
                    } else {
                        if (intervalTaper) {
                            clearInterval(intervalTaper);
                            intervalTaper = null;
                            indexTaper = 0;
                            effacer = false;
                            titreFacultesElement.textContent = '';
                        }
                    }
                });
            }, optionsFacultes);

            if (titreFacultesElement) {
                observerFacultes.observe(titreFacultesElement);
            }
        });
    </script>
</body>
</html>