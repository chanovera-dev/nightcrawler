// === Inicializar variables principales ===
const sourceContainer = document.querySelector('.gallery-slideshow');
const images = Array.from(sourceContainer.querySelectorAll('img'));

const track = document.getElementById('slider-track');
const pagination = document.getElementById('pagination');
const container = document.getElementById('slider-container');
const lightbox = document.getElementById('lightbox');
const lightboxImg = document.getElementById('lightbox-img');
const closeLightboxBtn = document.getElementById('close-lightbox');

let currentIndex = 0;
let startX = 0;
let endX = 0;
let autoplayInterval;
let isAnimating = false;
let slidesPerView = getSlidesPerView();

// === Función para renderizar los slides ===
function renderSlides() {
  track.innerHTML = '';

  images.forEach((img) => {
    const slide = document.createElement('div');
    slide.className = 'slide';

    const slideWrapper = document.createElement('div');
    slideWrapper.className = 'img-wrapper';

    const cloneImg = img.cloneNode();
    cloneImg.addEventListener('click', () => openLightbox(cloneImg.src));

    slideWrapper.appendChild(cloneImg);
    slide.appendChild(slideWrapper);
    track.appendChild(slide);
  });

  updateSlideWidths();
}

// === Función para actualizar el ancho de cada slide dinámicamente ===
function updateSlideWidths() {
  slidesPerView = getSlidesPerView();
  const slides = track.querySelectorAll('.slide');
  slides.forEach(slide => {
    slide.style.flex = `0 0 ${100 / slidesPerView}%`;
  });
}

// === Función para renderizar la paginación ===
function renderPagination() {
  pagination.innerHTML = '';
  images.forEach((_, index) => {
    const button = document.createElement('div');
    if (index === 0) button.classList.add('active');
    button.addEventListener('click', () => moveToSlide(index));
    pagination.appendChild(button);
  });
}

// === Función para mostrar u ocultar paginación según el ancho ===
function checkPaginationVisibility() {
  const paginationButtons = pagination.children.length;
  const totalPaginationWidth = (paginationButtons * 36) + (2 * 50); // 36px por botón de paginación + 2 botones de navegación de 50px

  const screenWidth = Math.min(window.innerWidth, 1200); // Limitar máximo a 1200px

  if (totalPaginationWidth > screenWidth) {
    pagination.style.display = "none";
  } else {
    pagination.style.display = "flex"; // O "block" según tu CSS
  }
}

// === Función para actualizar la paginación activa ===
function updatePagination() {
  [...pagination.children].forEach((btn, index) => {
    btn.classList.toggle('active', index === currentIndex);
  });
}

// === Función para mover hacia un slide específico ===
function moveToSlide(index) {
  slidesPerView = getSlidesPerView();
  const move = (100 / slidesPerView) * index;
  track.style.transform = `translateX(-${move}%)`;
  currentIndex = index;
  updatePagination();
}

// === Función para mover al siguiente slide ===
function nextSlide() {
  if (isAnimating) return;
  isAnimating = true;

  currentIndex = (currentIndex + 1 + images.length) % images.length;
  updatePagination();

  const slidesPerView = getSlidesPerView();
  const move = (100 / slidesPerView);
  const firstSlide = track.querySelector('.slide');
  const clone = firstSlide.cloneNode(true);

  const cloneImg = clone.querySelector('img');
  cloneImg.addEventListener('click', () => openLightbox(cloneImg.src));

  track.style.transition = "transform .5s ease";
  track.style.transform = `translateX(-${move}%)`;

  setTimeout(() => {
    track.style.transition = "none";
    track.style.transform = "translateX(0)";
    track.appendChild(clone);
    firstSlide.remove();

    isAnimating = false;
  }, 500);
}

// === Función para mover al slide anterior ===
function prevSlide() {
  if (isAnimating) return;
  isAnimating = true;

  currentIndex = (currentIndex - 1 + images.length) % images.length;
  updatePagination();

  const slides = track.querySelectorAll('.slide');
  const lastSlide = slides[slides.length - 1];
  const slidesPerView = getSlidesPerView();
  const move = (100 / slidesPerView);
  const clone = lastSlide.cloneNode(true);

  const cloneImg = clone.querySelector('img');
  cloneImg.addEventListener('click', () => openLightbox(cloneImg.src));

  track.style.transition = "none";
  track.insertAdjacentElement('afterbegin', clone);
  track.style.transform = `translateX(-${move}%)`;

  requestAnimationFrame(() => {
    track.style.transition = "all .5s ease";
    track.style.transform = "translateX(0)";
  });

  lastSlide.remove();

  setTimeout(() => {
    isAnimating = false;
  }, 500);
}

// === Función para definir cuántos slides mostrar según tamaño de pantalla ===
function getSlidesPerView() {
  if (window.innerWidth >= 1024) return 5;
  if (window.innerWidth >= 768) return 3;
  return 1;
}

// === Funciones para iniciar y detener autoplay ===
function startAutoplay() {
  autoplayInterval = setInterval(nextSlide, 3000);
}

function stopAutoplay() {
  clearInterval(autoplayInterval);
}

// === Funciones para abrir y cerrar el lightbox ===
function openLightbox(src) {
  document.body.style.overflow = "hidden";
  lightboxImg.src = src;
  lightbox.classList.add('show');
}

function closeLightbox() {
  document.body.style.overflow = "inherit";
  lightbox.classList.remove('show');
}

// === Eventos para cerrar lightbox ===
closeLightboxBtn.addEventListener('click', closeLightbox);
lightbox.addEventListener('click', (e) => {
    if (e.target === lightbox) closeLightbox();
});

document.addEventListener('keydown', function(event) {
  if (event.key === 'Escape' || event.keyCode === 27) {
    closeLightbox();
  }
});


// Abre el lightBox
function openLightbox(src) {
  const body = document.body;

  body.style.overflow = "hidden";
  lightboxImg.src = src;
  lightbox.classList.add('show');

  const meetingsContent = document.querySelector('.meetings-content');
  if (meetingsContent) {
      meetingsContent.scrollIntoView({ behavior: 'smooth', block: 'start' });
  }
}

// === Eventos de navegación manual (click en prev/next) ===
document.getElementById('next').addEventListener('click', () => {
  nextSlide();
  stopAutoplay();
  startAutoplay();
});

document.getElementById('prev').addEventListener('click', () => {
  prevSlide();
  stopAutoplay();
  startAutoplay();
});

// === Eventos para navegación táctil (swipe) ===
container.addEventListener('touchstart', (e) => {
  startX = e.touches[0].clientX;
});

container.addEventListener('touchmove', (e) => {
  endX = e.touches[0].clientX;
});

container.addEventListener('touchend', () => {
  const deltaX = startX - endX;
  if (Math.abs(deltaX) > 50) {
    if (deltaX > 0) {
      nextSlide();
    } else {
      prevSlide();
    }
    stopAutoplay();
    startAutoplay();
  }
});

// === Evento de redimensionar ventana ===
window.addEventListener('resize', () => {
  updateSlideWidths();
  moveToSlide(currentIndex);
  checkPaginationVisibility();
});

// === Inicialización del slideshow ===
renderSlides();
renderPagination();
checkPaginationVisibility();
moveToSlide(0);
startAutoplay();