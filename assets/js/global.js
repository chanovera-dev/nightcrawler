const body = document.body;

// IIFE para encapsular la funcionalidad y evitar variables globales
(() => {
  let lastScroll = 0;
  let ticking = false;
  
  // Usar RAF para optimizar performance
  window.addEventListener('scroll', () => {
    if (!ticking) {
      requestAnimationFrame(() => {
        const currentScroll = window.scrollY; // más eficiente que pageYOffset
        
        closeMenuMobile();

        if (currentScroll <= 0) {
          body.classList.remove('scroll-up', 'scroll-down');
        } else {
          const scrollingDown = currentScroll > lastScroll;
          // Actualizar clases solo si cambia la dirección
          if (scrollingDown !== body.classList.contains('scroll-down')) {
            body.classList.toggle('scroll-down', scrollingDown);
            body.classList.toggle('scroll-up', !scrollingDown);
          }
        }

        lastScroll = currentScroll;
        ticking = false;
      });
      
      ticking = true;
    }
  }, { passive: true }); // Optimización para eventos táctiles
})();

function toggleMenuMobile() {
  const button = document.querySelector('.menu-mobile__button');
  const menu = document.querySelector('.support-navigation__wrapper');
  const menuItems = document.querySelectorAll('.support-navigation__wrapper .menu > *');

  if (!button || !menu ) return;

  const duration = (menuItems.length * 0.1).toFixed(2);
  menu.style.transition = `transform ${duration}s ease-in-out, padding ${duration}s ease-in-out`;

  const isOpen = menu.classList.toggle('open');
  button.classList.toggle('active', isOpen);

  const handleClickOutside = (e) => {
    if (!menu.contains(e.target) && !button.contains(e.target)) {
      menu.classList.remove('open');
      button.classList.remove('active');
      document.removeEventListener('click', handleClickOutside);
    }
  };

  document.removeEventListener('click', handleClickOutside);
  if (isOpen) document.addEventListener('click', handleClickOutside);
}

function closeMenuMobile() {
  const button = document.querySelector('.menu-mobile__button');
  const menu = document.querySelector('.support-navigation__wrapper');

  if (button.classList.contains('active')) {
    button.classList.remove('active');
    menu.classList.remove('open');
  }
}