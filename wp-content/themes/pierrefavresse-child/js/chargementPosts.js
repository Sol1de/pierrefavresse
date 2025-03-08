document.addEventListener('DOMContentLoaded', function() {
    const menuLinks = document.querySelectorAll('.header-content-nav ul li a');
    const burgerLinks = document.querySelectorAll('.header-content-burger ul li a');
    const projectsContainer = document.querySelector('.landing-projects');

    function addLinkEventListeners(links) {
        links.forEach(function(link) {
            link.addEventListener('click', function(event) {
                if (link.href.startsWith('mailto:')) {
                    return;
                }

                event.preventDefault();

                var url = link.getAttribute('href');
                projectsContainer.classList.add('fade-out');

                setTimeout(function() {
                    fetch(url)
                        .then(response => response.text())
                        .then(html => {
                            var temp = document.createElement('div');
                            temp.innerHTML = html;
                            var newProjects = temp.querySelector('.landing-projects').innerHTML;

                            projectsContainer.innerHTML = newProjects;
                            projectsContainer.classList.remove('fade-out');
                            projectsContainer.classList.add('fade-in');
                        })
                        .catch(error => console.error('Erreur lors du chargement des posts', error))
                        .finally(() => {
                            setTimeout(function() {
                                projectsContainer.classList.remove('fade-in');
                            }, 300);
                        });
                }, 300);
            });
        });
    }

    if (window.innerWidth > 800) {
        addLinkEventListeners(menuLinks);
    } else {
        addLinkEventListeners(burgerLinks);
    }
});
