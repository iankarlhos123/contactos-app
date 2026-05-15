const slides = Array.from(document.querySelectorAll('.slide'));
const prevBtn = document.querySelector('#prevBtn');
const nextBtn = document.querySelector('#nextBtn');
const overviewBtn = document.querySelector('#overviewBtn');
const progressBar = document.querySelector('#progressBar');
const slideCounter = document.querySelector('#slideCounter');

let current = 0;

function clampSlide(index) {
  return Math.max(0, Math.min(slides.length - 1, index));
}

function render() {
  slides.forEach((slide, index) => {
    slide.classList.toggle('active', index === current);
  });

  const progress = ((current + 1) / slides.length) * 100;
  progressBar.style.width = `${progress}%`;
  slideCounter.textContent = `${current + 1} / ${slides.length}`;
  prevBtn.disabled = current === 0;
  nextBtn.disabled = current === slides.length - 1;
}

function goTo(index) {
  current = clampSlide(index);
  render();
}

function next() {
  goTo(current + 1);
}

function previous() {
  goTo(current - 1);
}

prevBtn.addEventListener('click', previous);
nextBtn.addEventListener('click', next);

overviewBtn.addEventListener('click', () => {
  document.body.classList.toggle('overview');
});

slides.forEach((slide, index) => {
  slide.addEventListener('click', () => {
    if (!document.body.classList.contains('overview')) {
      return;
    }

    document.body.classList.remove('overview');
    goTo(index);
  });
});

document.addEventListener('keydown', (event) => {
  if (event.key === 'ArrowRight' || event.key === 'PageDown' || event.key === ' ') {
    event.preventDefault();
    next();
  }

  if (event.key === 'ArrowLeft' || event.key === 'PageUp') {
    event.preventDefault();
    previous();
  }

  if (event.key === 'Home') {
    event.preventDefault();
    goTo(0);
  }

  if (event.key === 'End') {
    event.preventDefault();
    goTo(slides.length - 1);
  }

  if (event.key.toLowerCase() === 'o') {
    document.body.classList.toggle('overview');
  }

  if (event.key === 'Escape') {
    document.body.classList.remove('overview');
  }
});

render();
