// Lấy các phần tử form và button
const emailInput = document.getElementById('email');
const passwordInput = document.getElementById('password');
const submitButton = document.getElementById('submitButton');
const arrow = document.getElementById('arrow');

// Hàm kiểm tra xem các trường có được điền đầy đủ chưa
function validateInputs() {
    if (emailInput.value !== '' && passwordInput.value !== '') {
        submitButton.disabled = false;
        submitButton.classList.add('enabled');
        arrow.classList.add('enabled');  // Thêm class để thay đổi màu nền
    } else {
        submitButton.disabled = true;
        submitButton.classList.remove('enabled');
        arrow.classList.remove('enabled'); // Xóa class nếu không đủ điều kiện
    }
}

// Lắng nghe sự kiện khi người dùng nhập dữ liệu
emailInput.addEventListener('input', validateInputs);
passwordInput.addEventListener('input', validateInputs);

/*------------------------------------------------CART-MENU---------------------------------------*/

document.querySelector('.cart__container__menu').addEventListener('click', function() {
    // Toggle class 'active' khi nhấn vào giỏ hàng
    document.querySelector('.cart__container').classList.toggle('active');
});
