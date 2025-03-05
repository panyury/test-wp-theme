document.addEventListener("DOMContentLoaded", function () {
    // Инициализация слайдера заголовков
    const titleSlider = new Swiper(".title-slider .swiper", {
        slidesPerView: 1,
        loop: true,
        allowTouchMove: false, // Запрещаем ручное листание
    });

    // Инициализация основного слайдера
    const mainSlider = new Swiper(".main-slader .swiper", {
        loop: true,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
			pauseOnMouseEnter: true,
        },
		breakpoints: {
            375: {
                slidesPerView: "auto", // На маленьких экранах показываем 1 слайд
				spaceBetween: 16,
                centeredSlides: true, // Центрируем слайд
				navigation: false, // убираем стрелки
            },
            1200: {
                slidesPerView: 4, // На больших экранах показываем 4 слайда
				spaceBetween: 37.33,
            }
        }
    });

    // Связываем заголовки с основным слайдером
    mainSlider.on("slideChange", function () {
        titleSlider.slideTo(mainSlider.realIndex);
    });

    // Popup логика
    const popupModal = document.getElementById("popup-modal");
    const popupText = document.querySelector(".popup-text");
    const closeModal = document.querySelector(".close-modal");
    const overlay = document.createElement("div");
    overlay.classList.add("popup-overlay");
    document.body.appendChild(overlay);

    document.querySelectorAll(".main-slader .swiper-slide").forEach(slide => {
        slide.addEventListener("click", function () {
            let postId = this.getAttribute("data-id");

            fetch(ajax_object.ajax_url, {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: `action=get_slide_content&post_id=${postId}`
            })
            .then(response => response.text())
            .then(data => {
                popupText.innerHTML = data;
                popupModal.classList.add("active");
                overlay.classList.add("active");
            });
        });
    });

    // Закрытие popup
    closeModal.addEventListener("click", function () {
        popupModal.classList.remove("active");
        overlay.classList.remove("active");
    });

    overlay.addEventListener("click", function () {
        popupModal.classList.remove("active");
        overlay.classList.remove("active");
    });
});
