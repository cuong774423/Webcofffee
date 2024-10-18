
/*----------------------------------------------SCROLL----------------------------------------------------------*/

window.addEventListener('beforeunload', function () {
    // Lưu vị trí cuộn hiện tại của trang vào sessionStorage
    sessionStorage.setItem('scrollPosition', window.scrollY);
});

window.addEventListener('load', function () {
    // Lấy vị trí cuộn từ sessionStorage và cuộn lại đúng vị trí đó nếu có
    const scrollPosition = sessionStorage.getItem('scrollPosition');
    if (scrollPosition !== null) {
        window.scrollTo(0, scrollPosition);
    }
});

/*-------------------------------------------------CART-----------------------------------------------------------*/

document.addEventListener('DOMContentLoaded', function () {
    const cartMenu = document.querySelector('.cart__container__menu');
    const cartBody = document.querySelector('.cart__container__body');

    // Kiểm tra trạng thái giỏ hàng từ localStorage
    if (localStorage.getItem('cartOpen') === 'true') {
        cartBody.style.display = 'block';
    }

    cartMenu.addEventListener('click', function () {
        if (cartBody.style.display === 'none' || cartBody.style.display === '') {
            cartBody.style.display = 'block';
            localStorage.setItem('cartOpen', 'true');
        } else {
            cartBody.style.display = 'none';
            localStorage.setItem('cartOpen', 'false');
        }
    });
});
