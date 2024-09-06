document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.querySelector('.search-input');
    const searchContainer = document.querySelector('.search-container');

    searchInput.addEventListener('focus', function () {
        searchContainer.classList.add('active');
    });

    searchInput.addEventListener('blur', function () {
        setTimeout(() => {
            searchContainer.classList.remove('active');
        }, 10);
    });
});

