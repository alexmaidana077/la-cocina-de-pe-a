function toggleFavorito(button, recetaId) {
    // Alternar estado de favorito en la interfaz
    const esFavorito = button.getAttribute('data-favorito') === 'true';
    button.setAttribute('data-favorito', !esFavorito);
    button.querySelector('.icono-favorito').textContent = esFavorito ? '☆' : '★';

    fetch('http://localhost/peña/paginas%20php/php/favoritos.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `receta_id=${recetaId}`
    })
    
    .then(response => response.json())
    .then(data => {
        if (data.status === 'error') {
            button.setAttribute('data-favorito', esFavorito);
            button.querySelector('.icono-favorito').textContent = esFavorito ? '★' : '☆';
            alert(data.message);
        } else {
            console.log(data.message);
        }
    })
    .catch(error => {
        console.error('Error en la solicitud:', error);
        // Revertir el estado visual en caso de error
        button.setAttribute('data-favorito', esFavorito);
        button.querySelector('.icono-favorito').textContent = esFavorito ? '★' : '☆';
        alert('Hubo un problema al procesar tu solicitud.');
    });

    // Mensaje en consola (opcional para depuración)
    console.log(`Receta ID ${recetaId}: ${!esFavorito ? 'Añadida a favoritos' : 'Eliminada de favoritos'}`);
}
