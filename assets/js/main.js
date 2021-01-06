import {deck} from './constants/deck.js';
import {phrase} from './constants/phrase.js';

var scoreWinToi = 0;
var scoreWinEnnemi = 0;
var replay = 0;
var win = 0;

// Sons
var audio = document.getElementById("audio");
const audiowin = `<audio autoplay><source src="assets/audiowin.ogg" type="audio/ogg"></audio>`;
const audioloose = `<audio autoplay><source src="assets/audioloose.ogg" type="audio/ogg"></audio>`;
const audiocarte = `<audio autoplay><source src="assets/swoosh.ogg" type="audio/ogg"></audio>`;

  // Appuie sur le bouton
  document.getElementById("bouton").onclick = function() {jeu()};

let afficheCarte = ({ categorie, groupe, force, nom, perso, info, effet }, DOM_Joueur) => {

  // On efface l'ancienne carte contenue dans DOM_Joueur
  DOM_Joueur.innerHTML = "";

  // On fait une copie du noeud DOM du modèle de la carte
  const DOM_Carte = document.getElementById("carte").cloneNode(true);
  DOM_Carte.id = `carte-${DOM_Joueur.id}`;
  DOM_Carte.style.display = "block"; // change le style pour que le html devienne visible (display: none; dans css)

  // On peuple les données de la carte dans le html
  DOM_Carte.querySelector('.perso').innerHTML = perso;
  DOM_Carte.querySelector('.force').innerHTML = force;
  DOM_Carte.querySelector('.image').style.backgroundImage = `url('assets/img/carte/${nom}.jpeg')`;
  DOM_Carte.querySelector('.bandeau').innerHTML = `${categorie} / ${groupe}`;
  DOM_Carte.querySelector('.info').innerHTML = info;
  DOM_Carte.querySelector('.effet').innerHTML = effet;

  // Ajoute la classe de force pour le mettre dans la couleur du niveau de force
  DOM_Carte.querySelector('.force').classList.add(`force-${force}`);

  // On rempli le noeud html du joueur par la carte nouvellement créée
  DOM_Joueur.appendChild(DOM_Carte);
}

// Déclaration de la fonction jeu
function jeu(tour) {

  audio.innerHTML = `${audiocarte}`;

  if (replay == 0) {

  // Effet retournement des cartes
  document.getElementById('flip-card').classList.toggle('do-flip');
  document.getElementById('flip-card2').classList.toggle('do-flip2');

  // Tirage aléatoire des cartes
  let [carteToi, carteEnnemi] = [
    deck[Math.floor(Math.random() * deck.length)],
    deck[Math.floor(Math.random() * deck.length)]
  ];

  //pause pour retarder l'affichage des cartes
  setTimeout(() => {  
    afficheCarte(carteToi, document.getElementById("img-toi"));
    afficheCarte(carteEnnemi, document.getElementById("img-ennemi"));
  }, 700);

  let gagne = phrase.motVainqueur[Math.floor(Math.random() * phrase.motVainqueur.length)];
  let perd = phrase.motPerdant[Math.floor(Math.random() * phrase.motPerdant.length)];
  let action = phrase.verbe[Math.floor(Math.random() * phrase.verbe.length)];

  // Affichage du résultats en fonction des cas
  if (carteToi.force > carteEnnemi.force && carteToi.categorie == 'Comploteurs' && carteEnnemi.categorie == 'Complotistes') {
    var result = `${gagne} ${carteToi.perso} ${action} ${carteEnnemi.perso}`;
    win = 1;
    scoreWinToi ++;
  }
  else if (carteToi.force > carteEnnemi.force && carteToi.categorie == 'Comploteurs' && carteEnnemi.categorie == 'Comploteurs') {
    result = `${gagne} Entre comploteurs, ${carteToi.perso} ${action} ${carteEnnemi.perso}`;
    win = 2;
    scoreWinToi ++;
  }
  else if (carteToi.force > carteEnnemi.force && carteToi.categorie == 'Complotistes' && carteEnnemi.categorie == 'Comploteurs'){
    result = `${gagne} Tu as vaincu l'élite pédophile satanique avec ${carteToi.perso}`;
    win = 1;
    scoreWinToi ++;
  }
  else if (carteToi.force > carteEnnemi.force && carteToi.categorie == 'Complotistes' && carteEnnemi.categorie == 'Complotistes'){
    result = `${gagne} ${carteEnnemi.perso} a succombé ! Tu es le survivant de ta guilde`;
    win = 2;
    scoreWinToi ++;
  }
  else if (carteToi.force < carteEnnemi.force && carteToi.categorie == 'Complotistes' && carteEnnemi.categorie == 'Comploteurs'){
    result = `${perd} Le complot mondial t'${action} en utilisant ${carteEnnemi.perso}`;
    win = 0;
    scoreWinEnnemi ++;
  }
  else if (carteToi.force < carteEnnemi.force && carteToi.categorie == 'Comploteurs' && carteEnnemi.categorie == 'Comploteurs'){
    result = `${perd} ${carteEnnemi.perso} t'${action}! Trop de complot tue le complot`;
    win = 2;
    scoreWinEnnemi ++;
  }
  else if (carteToi.force < carteEnnemi.force && carteToi.categorie == 'Comploteurs' && carteEnnemi.categorie == 'Complotistes'){
    result = `${perd} ${carteEnnemi.perso} ${action} ${carteToi.perso}`;
    win = 0;
    scoreWinEnnemi ++;
  }
  else if (carteToi.force < carteEnnemi.force && carteToi.categorie == 'Complotistes' && carteEnnemi.categorie == 'Complotistes'){
    result = `${perd} Entre complotistes, ${carteEnnemi.perso} ${action} ${carteToi.perso}`;
    win = 2;
    scoreWinEnnemi ++;
  }
  else{
    result = `Match nul: Personne n'est sorti vivant de ce duel`;
    win = 2;
  }

  setTimeout(() => {  
  // Affichage des résultats
  document.getElementById("resultat").innerHTML = `${result}`;

  // Affichage des scores
  document.getElementById("scoreWinToi").innerHTML = `Score: ${scoreWinToi}`;
  document.getElementById("scoreWinEnnemi").innerHTML = `Score: ${scoreWinEnnemi}`;

  // Son en fonction
  if (win == 0) {audio.innerHTML = `${audioloose}`;}
  else if (win == 1) {audio.innerHTML = `${audiowin}`;}
  else {}
  }, 710);

  // transformation du bouton en REJOUER
  document.getElementById("bouton").innerHTML = `REJOUER`;
  replay ++;
  }

  else {
  setTimeout(() => {
  document.getElementById("img-toi").innerHTML = `<img src="assets/img/back.png"></img>`;
  document.getElementById("img-ennemi").innerHTML = `<img src="assets/img/back.png"></img>`;
  }, 345);
  replay = 0;
  jeu(0);
  }
}  