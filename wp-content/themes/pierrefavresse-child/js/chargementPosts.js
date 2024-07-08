document.addEventListener('DOMContentLoaded', function() {
    var menuLinks = document.querySelectorAll('.header-content-nav a');

    menuLinks.forEach(function(link) {
        link.addEventListener('click', function(event) {
            event.preventDefault();

            var url = link.getAttribute('href');
            var projectsContainer = document.querySelector('.landing-projects');

            projectsContainer.classList.add('fade-out');

            // Attendre la fin de l'animation de disparition avant de charger les nouveaux posts
            setTimeout(function() {
                // Charger les nouveaux posts
                fetch(url)
                    .then(response => response.text())
                    .then(html => {
                        var temp = document.createElement('div');
                        temp.innerHTML = html;
                        var newProjects = temp.querySelector('.landing-projects').innerHTML;

                        // Mettre à jour le contenu avec les nouveaux projets
                        projectsContainer.innerHTML = newProjects;
                        projectsContainer.classList.remove('fade-out');
                        projectsContainer.classList.add('fade-in');
                    })
                    .catch(error => console.error('Erreur lors du chargement des posts', error))
                    .finally(() => {
                        setTimeout(function() {
                            projectsContainer.classList.remove('fade-in');
                        }, 300); // Correspond à la durée de l'animation fadeIn
                    });
            }, 300); // Correspond à la durée de l'animation fadeOut
        });
    });
});