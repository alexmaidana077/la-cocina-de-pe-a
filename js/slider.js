document.querySelectorAll('.slider').forEach(slider => {
    const sliderItems = slider.querySelector('.slider-items');
    const prevButton = slider.querySelector('.prev');
    const nextButton = slider.querySelector('.next');

    let index = 0;
    const items = slider.querySelectorAll('.slider-item');
    const itemCount = items.length;
    const itemsToShow = Math.floor(slider.offsetWidth / items[0].offsetWidth); // Cantidad de tarjetas visibles

    const updateSlider = () => {
        const itemWidth = items[0].offsetWidth;
        sliderItems.style.transform = `translateX(${-index * itemWidth}px)`;
        if (index === items.length - itemsToShow) {
            setTimeout(() => {
                sliderItems.style.transition = 'none';
                index = 0;
                sliderItems.style.transform = `translateX(${-index * itemWidth}px)`;
                setTimeout(() => {
                    sliderItems.style.transition = 'transform 0.8s ease';
                });
            }, 500);
        }
    };

    const autoSlide = () => {
        index++;
        if (index >= itemCount - itemsToShow + 1) { // Cambiar aquí para reiniciar el índice
            index = 0;
        }
        updateSlider();
    };

    let slideInterval = setInterval(autoSlide, 3000); // Cambiar cada 3 segundos

    prevButton.addEventListener('click', () => {
        clearInterval(slideInterval); // Detener el auto-slide al hacer clic
        if (index <= 0) {
            index = items.length - itemsToShow;
            sliderItems.style.transition = 'none';
            sliderItems.style.transform = `translateX(${-index * items[0].offsetWidth}px)`;
            setTimeout(() => {
                sliderItems.style.transition = 'transform 0.8s ease';
                index--;
                updateSlider();
            }, 20);
        } else {
            index--;
            updateSlider();
        }
    });

    nextButton.addEventListener('click', () => {
        clearInterval(slideInterval); // Detener el auto-slide al hacer clic
        if (index >= items.length - itemsToShow) {
            index = 0;
            sliderItems.style.transition = 'none';
            sliderItems.style.transform = `translateX(${-index * items[0].offsetWidth}px)`;
            setTimeout(() => {
                sliderItems.style.transition = 'transform 0.8s ease';
                index++;
                updateSlider();
            }, 20);
        } else {
            index++;
            updateSlider();
        }
    });

    window.addEventListener('resize', updateSlider);

    // Inicializar el slider
    updateSlider();
});

let inputSequence = [];
        const correctSequence = ['p', 'e', 'ñ', 'a'];

        document.addEventListener('keydown', function(event) {
            inputSequence.push(event.key.toLowerCase());

            // Verifica si la secuencia es correcta
            if (inputSequence.length > correctSequence.length) {
                inputSequence.shift();
            }

            if (JSON.stringify(inputSequence) === JSON.stringify(correctSequence)) {
                window.location.href = 'img/iconos/secreto.html';
            }
        });