// selection/créer élements necessaires
const phrase = document.querySelector(".landing-branding-title-texte")
const cursor = document.querySelector(".landing-branding-title-cursor")
const liste = [
    "ARE DESIGNERS.",
    "ARE CRAFTSMEN.",
    "ARE ARTISTS.",
    "ARE CREATIVES.",
    "DESIGN WITH LOVE.",
    "DESIGN WITH PASSION.",
    "CRAFT UNIQUENESS.",
    "DESIGN OBJECTS.",
    "CREATE DESIRE.",
    "DESIGN FURNITURE.",
    "CRAFT BEAUTY.",
    "CREATE LIGHTING.",
    "CRAFT INTERIORS.",
    "THINK AND DESIGN PRODUCTS.",
    "CAREFULLY CRAFT EXCELLENCE.",
    "FUSE PASSION AND DESIGN.",
    "FUSE TECH AND LIFESTYLE.",
    "PLAY WITH TRADITION.",
    "EMBRACE MODERNITY.",
    "CRAFT LUXURIOUS DREAMS.",
    "LOVE MAKING.",
    "CRAFT MATERIALS.",
    "HONOR CRAFTSMANSHIP.",
    "CREATE UNIQUE EXPERIENCES.",
    "ARE CURIOUS.",
    "LOVE ART.",
    "CRAFT DESIRABILITY.",
    "CRAFT INTERIOR MASTERPIECES.",
    "SHAPE UNIQUE ACCESSORIES.",
    "EMBRACE BRAND IDENTITY.",
    "DESIGN STORIES.",
]

//fonction retournant un element d'une liste a partir de son index
function getPhrase(index) {
    return liste[index]
}

//fonction retournant une lettre a partir d'une phrase 
function getLetter(phrase, index) {
    return phrase[index]
}

//fonction permettant de determiner l'index de la phrase suivante
function getRandomIndex() {
    return Math.floor(Math.random() * liste.length)
}

//fonction ajoutant la lettre au texte de la page
function addLetter(phraseIndex) {
    let texte = getPhrase(phraseIndex).split("");
    length = texte.length;
    let i = 0;
    cursor.classList.add('animation-blink');

    let interval = setInterval(() => {
        
        if (i < length) {
            let letterSpan = document.createElement('span');
            letterSpan.textContent = getLetter(texte, i);
            letterSpan.classList.add('appear-animation');
            phrase.appendChild(letterSpan);
            i++; // Incrémentation de i à chaque itération
        } 
        
        else {
            clearInterval(interval);
            

            setTimeout(() => {
                removeLetter(phraseIndex);
            }, 200);
        }
    }, 85);
}

//fonction retirant la lettre au texte de la page
function removeLetter(phraseIndex) {
    let texte = getPhrase(phraseIndex);
    let i = texte.length;

    let interval = setInterval(() => {
        if (i > 0) {
            let newTexte = texte.slice(0, -1);
            phrase.textContent = newTexte;
            texte = newTexte;
            i--; // Décrémentation de i à chaque itération
        } else {
            clearInterval(interval);
            changePhrase();
        }
    }, 85);
}

//fonction permettant de lancer les fonctions addLetter et removeLetter
function changePhrase() {
    let phraseIndex = getRandomIndex();
    if (phrase.textContent.length > 0) {
        setTimeout(() => {
            removeLetter(phraseIndex);
        }, 1000);
    } else {
        addLetter(phraseIndex);
    }
}

//on lance les fonction une fois que les éléments de la page sont chargés
document.addEventListener("DOMContentLoaded", function () {
    changePhrase();
});