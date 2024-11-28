function toggleFavorito(button, recetaId) {
    // Alternar estado de favorito
    const esFavorito = button.getAttribute('data-favorito') === 'true';
    button.setAttribute('data-favorito', !esFavorito);
    button.querySelector('.icono-favorito').textContent = esFavorito ? '☆' : '★';

    // Aquí podrías agregar una llamada AJAX si necesitas guardar el estado en el servidor
    console.log(`Receta ID ${recetaId}: ${!esFavorito ? 'Añadida a favoritos' : 'Eliminada de favoritos'}`);
}
