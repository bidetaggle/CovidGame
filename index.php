<!DOCTYPE html>
<html>
  <head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-GNMWL78TM7"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-GNMWL78TM7');
    </script>
    <!---FIN DU SCRIPT GOOGLE ANALYTICS-->
    <title>Covid Game v3.1</title>
    <link rel="icon" href="favicon.ico" />
    <link rel="stylesheet" href="assets/main.css">
    <link rel="stylesheet" href="assets/carte.css">
    <meta property="og:image" content="https://covidgame.fun/assets/img/covid.jpg">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:title" content="CovidGame" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://covidgame.fun" />
    <meta property="og:description" content="Qui des comploteurs ou des complotistes vaincront ?" />
    <meta name="Content-Language" content="fr">
    <meta name="Description" content="Jeu en ligne pour rigoler autour du Covid19">
    <meta name="Keywords" content="jeu;france;fr;cartes;covid19;covid;complots;humour;nouvelordremondial;complistes;comploteurs;raoult;hydroxychloroquine;vaccin;masque;illuminatis;Qanon;Deepstate">
    <meta name="Subject" content="CovidGame">
    <meta name="Copyright" content="PodzIT 2020">
    <meta name="Author" content="PodzIT">
    <meta name="Identifier-Url" content="covidgame.fun">
    <meta name="Revisit-After" content="1 day">
    <meta name="Robots" content="all">
    <meta name="Rating" content="general">
    <meta name="Distribution" content="global">
    <meta name="Geography" content="France">
    <meta name="viewport" content="width=device-width, initial-scale=0.5">
    <meta charset="UTF-8">

  </head>
  <body>
    
    <!-- Balises audio -->
    <audio id="audiowin"><source src="assets/audiowin.ogg" type="audio/ogg"></audio>
    <audio id="audioloose"><source src="assets/audioloose.ogg" type="audio/ogg"></audio>
    <audio id="audiocarte"><source src="assets/swoosh.ogg" type="audio/ogg"></audio>
    <!-- Fin balises audio -->
    
    <main>
      <h1><span class="buttontitre" id="buttontitre">Covid Game</span></h1>
      <div id = "poche" class="poche">Ta poche: 50$</div>

    <!-- Boutons de mises -->
        <button id ="mise1">1$
        </button>
        <button id ="mise2">2$
        </button>
        <button id ="mise5">5$
        </button>
        <button id ="mise10">10$
        </button>
        <button class="stop" id ="stop">Stop
        </button>
    <!-- Fin boutons de mises -->

    <!-- Jeu  -->
      <div id="jeu" class="jeu">
        <div class="side-left">Toi</div>
        <div class="middle">VS</div>
        <div class="side-right">L'ennemi</div>
        <div class="flip-card-3D-wrapper">
          <div id="flip-card">
            <div id="img-toi" class="carte-back-left"><img src="assets/img/back.png"></img></div>
          </div>
        </div>
        <div class="flip-card-3D-wrapper2">
          <div id="flip-card2">
            <div id="img-ennemi" class="carte-back-right"><img src="assets/img/back.png"></img></div>
          </div>
        </div>
        <div id="resultat" class="resultat"></div>
        <div id="gain" class="gain"></div>
      </div>
    <!-- Fin jeu  -->

    <!-- Template carte -->
      <div id="carte" class="carte">
        <div class="perso"></div>
        <div class="image"></div>
        <div class="force"></div>
        <div class="bandeau"></div>
        <div class="info"></div>
        <div class="effet"></div>
      </div>
    <!-- Fin template carte -->

    <!-- Formulaire high score -->
      <form id="form" action="scores.php" method="post" class="form">
        <div class="label">
          <label for="record" id="score"></label>
          <input type="hidden" id="record" name="record">
      </div>
        <div class="label">
            <label for="name">Comment tu t'appelles champion ?</label>
            <br/>
            <input type="text" id="name" name="name" required="required" pattern="[A-Za-z0-9-éèÉÈ]{1,20}" maxlength="20">
        </div>
        <div class="button">
          <button type="submit">Enregistrer</button>
      </div>
      </form>
    <!-- Fin formulaire high score -->

    <!-- Game over -->
      <div class="gameover" id="gameover">
        <h2 style="text-align: center;">GAME OVER</h2>
        <div id="phraseover"></div><br/>
        Tu retentes ta chance ou tu abandonnes?<br/>
        <button id="rejouer">REJOUER</button>
      </div>
    <!-- Fin game over -->

    <!-- Popin high score -->
      <div id="scorespop" class="parentDisableScores">
        <div class="popinscores">
            <div class="scores">
                <h2 style="text-align: center;"> High Score </h2>
                <?php include 'scorespopin.php';?>
                <span id="closescores" class="buttonS3">Fermer</span>
            </div>
        </div>
      </div>
    <!-- Fin popin high score -->

    <!-- Popin règles du jeu -->
      <div id="pop1" class="parentDisable">
        <div class="popin">
          <div class="regles">
            <h2 style="text-align: center;">~ Règles du jeu ~</h2>
            <h3>Le départ</h3>
            Tu démarres avec 50$ en poche (ouais c'est radin et alors?) et dois miser pour lancer le jeu.<br/>
            Tu as le choix entre 1,2,5 ou 10$ de mise et ça peut vite rapporter gros.<br/>
            Si la force de ta carte dépasse la force de la carte ennemie, tu gagnes. Jusque là rien d'anormal.<br/>
            <h3>Les gains et pertes</h3>
            Ils sont en fonction de plusieurs cas alors lis bien ou prends des notes parceque y a des maths:<br/>
            - Même catégorie (exemple comploteur vs comploteur)<br/>
            <div class="indent">= mise x force de la carte vainqueure</div>
            - Catégorie différente (exemple complotiste vs comploteur)<br/>
            <div class="indent">= Double de la mise x force de la carte vainqueure</div>
            - match nul = perte de la mise<br/>
            <h3>La fin</h3>
            Si au cours du jeu, la poche atteint 500$ et plus, félicitations, grace au bouton "Stop", 
            tu peux enregistrer ton pseudo et ton score pour apparaitre dans le tableau "High Score" 
            qui affiche les 10 meilleurs et pas un de plus.<br/>
            La maison ne fait pas crédit donc le jeu s'arrête quand ta poche atteint 0$.<br/>
            <h2 style="text-align: center;">Bonne chance !</h2>
          </div>
          <span id="closepop" class="buttonS3">Fermer</span>
        </div>
      </div>
      <!-- Fin popin règles du jeu -->

      <!-- Formulaire proposition de carte -->
      <form id="propcarte" action="mail.php" method="post" class="propcarte">
        <br/>
          La proposition doit citer une personne connue, doit être drôle et sans insultes.<br/>
          Le bouton "Envoyer" la soumet à l'administrateur.<br/>
          Les champs avec une étoile sont obligatoires.<br/>
          <span id="buttonaide" class="buttonS2">aide</span>
          <br/>
        <div class="label">
          <label for="nomperso">Nom du personnage * </label>
          <input type="text" id="nomperso" name="nomperso" required="required" pattern="[A-Za-z0-9 éèà]{1,20}" maxlength="20"></input>
        </div>

        <div class="label">
          <label for="force">Force</label>
          <select class="select" id="force" name="force">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
          </select>
        </div>

        <div class="label">
          <label for="guilde">Guilde</label>
          <select class="select" id="guilde" name="guilde">
            <option value="comploteurs">Comploteurs</option>
            <option value="complotistes">Complotistes</option>
          </select>
        </div>

        <div class="label">
          <label for="groupe">Groupe</label>
          <select class="select" id="groupe" name="groupe">
            <option value="inutiles">Inutiles</option>
            <option value="tueurs">Tueurs</option>
            <option value="lobbies">Lobbies</option>
            <option value="milliardaires">Milliardaires</option>
            <option value="médias">Médias</option>
            <option value="sociétés secrètes">Sociétés secrètes</option>
            <option value="religieux">Religieux</option>
            <option value="patrons de pmu">Patrons de PMU</option>
            <option value="lanceurs d'alerte">Lanceurs d'alerte</option>
            <option value="prophètes">Prophètes</option>
          </select>
        </div>

        <div class="label">
          <label for="infos">Infos du personnage</label>
          <textarea id="infos" name="infos" pattern="[A-Za-z0-9]{1,100}" maxlength="100" rows="4" cols="50"></textarea>
        </div>

        <div class="label">
          <label for="effets">Effet du personnage</label>
          <textarea id="effet" name="effet" pattern="[A-Za-z0-9]{1,100}" maxlength="100" rows="4" cols="50"></textarea>
        </div> 
        
        <div class="label">
          <label for="email">Ton e-mail * </label>
          <input type="text" id="email" name="email" required="required" pattern="[A-Za-z0-9.+@]{1,30}" maxlength="30"></input>
        </div>

        <div class="label">
          <label for="captcha"><img src="assets/img/captcha.png">* </label>
        <input type="text" id="captcha" name="captcha" required="required" maxlength="2"></input>
        </div>

        <button type="submit">Envoyer</button>

    </form>
    <!-- Fin de formulaire proposition de carte -->

    <!-- Popin aide -->
    <div id="aide" class="parentDisableaide">
      <div class="popinaide">
        <div class="aide">
          <h2 style="text-align: center;">~ Détail des cartes ~</h2>
          <img src="assets/img/aide.png">
        </div>
        <span id="closeaide" class="buttonS3">Fermer</span>
      </div>
    </div>
    <!-- Fin popin aide -->

    </main>

    <!-- FOOTER -->
    <footer>
        <a href="https://github.com/podzit/CovidGame" class="buttonS2" target="_blank">Contribuer à ce site</a> | 
        <span id="buttonscores" class="buttonS2">High Score</span> | 
        <!--<a href="scorespop.php" class="buttonS2" target="popup" onclick="window.open('scorespop.php','popup','width=400,height=550px'); return false;">High Score</a> | -->
        <span id="popin" class="buttonS2">Règles du jeu</span> | 
        <span id="buttonpropcarte" class="buttonS2">Proposer une carte</span>
    </footer>
    <!-- FOOTER'S END -->
    <!-- Javascript -->
    <script type="module" src="assets/js/main.js"></script>
  </body>
</html>

