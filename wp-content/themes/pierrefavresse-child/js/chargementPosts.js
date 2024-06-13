//chargement des posts en arrière plan (evite un chargement de la page complet)
document.addEventListener('DOMContentLoaded', function() {
    var menuLinks = document.querySelectorAll('.header-nav a');
    
    menuLinks.forEach(function(link) {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            
            var url = link.getAttribute('href');
            var projectsContainer = document.querySelector('.landing-projects');
            
            // Charge les nouveaux posts
            fetch(url)
                .then(response => response.text())
                .then(html => {
                    var temp = document.createElement('div');
                    temp.innerHTML = html;
                    var newProjects = temp.querySelector('.landing-projects').innerHTML;
                    projectsContainer.innerHTML = newProjects;
                })
                .catch(error => console.error('Erreur lors du chargement des posts', error));
        });
    });
});