$(document).ready(function() {
    var cartCount = 0;

    $('.add-to-cart').click(function() {
        cartCount++;
        $('.cart-count').text(cartCount);

        var productId = $(this).closest('.inner-cake-col').data('product-id');
        var productName = $(this).siblings('h2').text();
        var productPrice = $(this).siblings('.cake-price').find('p').text();
        var productInfo = {
            id: productId,
            name: productName,
            price: productPrice
        };
        sessionStorage.setItem('cartProduct_' + cartCount, JSON.stringify(productInfo));
        alert('Đã thêm vào giỏ hàng thành công!');
    });
});