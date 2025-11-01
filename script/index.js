$(document).ready(function () {
    $('#menu').click(function () {
        $(this).toggleClass('fas fa-times');
        $('.navigate').toggleClass('nav-toggle');
    });

    $(window).on('scroll load',function()
    {
        $('#menu').removeClass('fas fa-times');
        $('.navigate').removeClass('nav-toggle');
    });

    $('.service .cake-list .btn1').click(function () {
        $(this).addClass('active').siblings().removeClass('active');

        let src = $(this).attr('data-src');
        $('#cake-img').attr('src', src);
    });

});
// Trong script/index.js hoặc script/products.js
function redirectToCart() {
    if (cart.length > 0) {
        console.log("Redirecting to cart.html. Cart has items.");
        window.location.href = "cart.html"; // Chuyển hướng đến trang giỏ hàng
    } else {
        console.log("Cart is empty. Add some products first.");
        // Hiển thị thông báo hoặc thực hiện các xử lý khác nếu giỏ hàng trống
    }
}

/*------------------------------------------------------------------------------------*/
