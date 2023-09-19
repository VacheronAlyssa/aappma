// JavaScript pour les fonctionnalités dynamiques (si nécessaire)

// Exemple de code pour afficher les dernières actualités
const actualites = [
    "Nouveau concours de pêche ce week-end!",
    "Assemblée générale le 15 octobre",
    "Nettoyage des sites prévu le mois prochain",
];

const actualitesContainer = document.createElement("div");
actualitesContainer.id = "actualites-container";

actualites.forEach((actualite) => {
    const actualiteElement = document.createElement("p");
    actualiteElement.textContent = actualite;
    actualitesContainer.appendChild(actualiteElement);
});

document.body.insertBefore(actualitesContainer, document.getElementById("appma"));
// Simulez une liste de liens avec des références
const links = [
    { title: "Actualité 1", url: "#actualite1" },
    { title: "Actualité 2", url: "#actualite2" },
    { title: "Activité Alevinage", url: "#alevinage" },
    { title: "Activité Nettoyage des Sites", url: "#nettoyage-sites" },
    // Ajoutez d'autres liens ici
];

// Fonction pour effectuer la recherche
function search(query) {
    const results = links.filter(link => link.title.toLowerCase().includes(query.toLowerCase()));
    return results;
}

// Fonction pour afficher les résultats de la recherche
function displayResults(results) {
    const resultsContainer = document.getElementById("search-results");
    resultsContainer.innerHTML = "";

    if (results.length === 0) {
        resultsContainer.innerHTML = "Aucun résultat trouvé.";
    } else {
        const ul = document.createElement("ul");
        results.forEach(result => {
            const li = document.createElement("li");
            const a = document.createElement("a");
            a.href = result.url;
            a.textContent = result.title;
            li.appendChild(a);
            ul.appendChild(li);
        });
        resultsContainer.appendChild(ul);
    }
}

// Écouteur d'événement pour le bouton de recherche
document.getElementById("search-button").addEventListener("click", function () {
    const query = document.getElementById("search-input").value;
    const searchResults = search(query);
    displayResults(searchResults);
});
$(document).ready(function() {
    // Activer manuellement le diaporama au chargement de la page
    $('#slideshow').carousel();
});

// Activer le défilement automatique après le chargement de la page
$(window).on('load', function() {
    setTimeout(function() {
        $('#slideshow').carousel('cycle');
    }, 1000); // Démarrer après un délai d'1 seconde (ajustez si nécessaire)
});

