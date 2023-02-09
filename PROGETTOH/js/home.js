const slider = document.getElementsByClassName('img-container');

let isDown = false;
let startX;
let scrollLeft;

for (let i = 0; i < slider.length; i++) {
  slider[i].addEventListener('mousedown', (e) => {
    isDown = true;
    slider[i].classList.add('active');
    startX = e.pageX - slider[i].offsetLeft;
    scrollLeft = slider[i].scrollLeft;
  });
  
  slider[i].addEventListener('mouseleave', () => {
    isDown = false;
    slider[i].classList.remove('active');
  });
  
  slider[i].addEventListener('mousemove', (e) => {
    if(!isDown) return;
    e.preventDefault();
    const x = e.pageX - slider[i].offsetLeft;
    const walk = (x - startX) * 3;
    slider[i].scrollLeft = scrollLeft - walk;
  });
  
  slider[i].addEventListener('mouseup', () => {
    isDown = false;
    slider[i].classList.remove('active');
  });
}
