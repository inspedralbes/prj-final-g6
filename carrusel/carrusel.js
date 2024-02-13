const carrusel = document.querySelector('.carrusel');

function activar(e) {
  const elementos = document.querySelectorAll('.elemento');
  e.target.matches('.siguiente') && carrusel.append(elementos[0])
  e.target.matches('.anterior') && carrusel.prepend(elementos[elementos.length - 1]);
}

document.addEventListener('click', activar, false);