document.addEventListener("DOMContentLoaded", function () {
    const radios = document.querySelectorAll('.tabs input[name="tab-control"]');
    const prevBtn = document.querySelector('.card-nav__btn.prev');
    const nextBtn = document.querySelector('.card-nav__btn.next');

    function getCurrentIndex() {
        return Array.from(radios).findIndex(radio => radio.checked);
    }

    function setChecked(index) {
        if (radios[index]) {
            radios[index].checked = true;
        }
    }

    function goToNext() {
        const currentIndex = getCurrentIndex();
        const nextIndex = (currentIndex + 1) % radios.length;
        setChecked(nextIndex);
    }

    function goToPrev() {
        const currentIndex = getCurrentIndex();
        const prevIndex = (currentIndex - 1 + radios.length) % radios.length;
        setChecked(prevIndex);
    }

    prevBtn?.addEventListener('click', () => {
        goToPrev();
        resetAutoSlide();
    });

    nextBtn?.addEventListener('click', () => {
        goToNext();
        resetAutoSlide();
    });

    let autoSlide = setInterval(goToNext, 14000);

    function resetAutoSlide() {
        clearInterval(autoSlide);
        autoSlide = setInterval(goToNext, 14000);
    }
});