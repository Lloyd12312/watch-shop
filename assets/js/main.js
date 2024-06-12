/*=============== SHOW MENU ===============*/
const navMenu = document.getElementById('nav-menu'),
      navToggle = document.getElementById('nav-toggle'),
      navClose = document.getElementById('nav-close')

/* Menu show */
if(navToggle){
    navToggle.addEventListener('click', () =>{
        navMenu.classList.add('show-menu')
    })
}

/* Menu hidden */
if(navClose){
    navClose.addEventListener('click', () =>{
        navMenu.classList.remove('show-menu')
    })
}

/*=============== REMOVE MENU MOBILE ===============*/
const navLink = document.querySelectorAll('.nav__link')

const linkAction = () =>{
    const navMenu = document.getElementById('nav-menu')
    // When we click on each nav__link, we remove the show-menu class
    navMenu.classList.remove('show-menu')
}
navLink.forEach(n => n.addEventListener('click', linkAction))

/*=============== CHANGE BACKGROUND HEADER ===============*/
const scrollHeader = () =>{
    const header = document.getElementById('header')
    // Add a class if the bottom offset is greater than 50 of the viewport
    this.scrollY >= 50 ? header.classList.add('scroll-header') 
                       : header.classList.remove('scroll-header')
}
window.addEventListener('scroll', scrollHeader)

/*=============== TESTIMONIAL SWIPER ===============*/
let testimonialSwiper = new Swiper(".testimonial-swiper", {
    spaceBetween: 30,
    loop: 'true',

    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
});

/*=============== NEW SWIPER ===============*/
let newSwiper = new Swiper(".new-swiper", {
    spaceBetween: 24,
    loop: 'true',

    breakpoints: {
        576: {
          slidesPerView: 2,
        },
        768: {
          slidesPerView: 3,
        },
        1024: {
          slidesPerView: 4,
        },
    },
});

/*=============== SCROLL SECTIONS ACTIVE LINK ===============*/
const sections = document.querySelectorAll('section[id]')
    
const scrollActive = () =>{
  	const scrollDown = window.scrollY

	sections.forEach(current =>{
		const sectionHeight = current.offsetHeight,
			  sectionTop = current.offsetTop - 58,
			  sectionId = current.getAttribute('id'),
			  sectionsClass = document.querySelector('.nav__menu a[href*=' + sectionId + ']')

		if(scrollDown > sectionTop && scrollDown <= sectionTop + sectionHeight){
			sectionsClass.classList.add('active-link')
		}else{
			sectionsClass.classList.remove('active-link')
		}                                                    
	})
}
window.addEventListener('scroll', scrollActive)

/*=============== SHOW SCROLL UP ===============*/ 
const scrollUp = () =>{
	const scrollUp = document.getElementById('scroll-up')
    // When the scroll is higher than 350 viewport height, add the show-scroll class to the a tag with the scrollup class
	this.scrollY >= 350 ? scrollUp.classList.add('show-scroll')
						: scrollUp.classList.remove('show-scroll')
}
window.addEventListener('scroll', scrollUp)

/*=============== SHOW CART ===============*/
const cart = document.getElementById('cart'),
      cartShop = document.getElementById('cart-shop'),
      cartClose = document.getElementById('cart-close')

/*===== CART SHOW =====*/
/* Validate if constant exists */
if(cartShop){
    cartShop.addEventListener('click', () =>{
        cart.classList.add('show-cart')
    })
}

/*===== CART HIDDEN =====*/
/* Validate if constant exists */
if(cartClose){
    cartClose.addEventListener('click', () =>{
        cart.classList.remove('show-cart')
    })
}

/*=============== ADD PRODUCT TO CART ===============*/
document.addEventListener('DOMContentLoaded', function() {
    const addToCartButtons = document.querySelectorAll('.products__button');
    addToCartButtons.forEach(button => {
        button.addEventListener('click', function() {
            const product_id = this.getAttribute('data-product-id');
            const xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        window.location.reload();
                    } else {
                        console.error('Failed to add product to cart');
                    }
                }
            };
            xhr.open('POST', 'addToCart.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send('product_id=' + encodeURIComponent(product_id));
        });
    });
});

/*=============== OPEN CART WHEN CLICKING ON SHOPPING BAG ICON ===============*/
document.addEventListener('DOMContentLoaded', function() {
    // Находим кнопку корзины
    const cartShopIcon = document.getElementById('cart-shop');

    // Добавляем обработчик клика на кнопку корзины
    cartShopIcon.addEventListener('click', function() {
        // Открываем корзину
        const cart = document.getElementById('cart');
        cart.classList.add('show');
    });
});

/*=============== ADD EVENT HANDLERS TO INCREASE/DECREASE QUANTITY ===============*/
document.addEventListener('DOMContentLoaded', function() {
    // Находим все кнопки cart__amount-box
    const quantityButtons = document.querySelectorAll('.cart__amount-box');

    // Добавляем обработчик клика на каждую кнопку
    quantityButtons.forEach(button => {
        button.addEventListener('click', function() {
            const action = this.getAttribute('data-action');
            const product_id = this.getAttribute('data-product-id');

            // Отправляем AJAX-запрос на сервер
            const xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Обновляем содержимое корзины на странице
                        window.location.reload();
                    } else {
                        console.error('Failed to update product quantity');
                    }
                }
            };

            xhr.open('POST', 'updateCart.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send('product_id=' + encodeURIComponent(product_id) + '&action=' + encodeURIComponent(action));
        });
    });
});

/*=============== DELETE PRODUCT FROM CART ===============*/
document.addEventListener('DOMContentLoaded', function() {
    const trashButtons = document.querySelectorAll('.cart__amount-trash');
    trashButtons.forEach(button => {
        button.addEventListener('click', function() {
            const product_id = this.getAttribute('data-product-id');
            const xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        window.location.reload();
                    } else {
                        console.error('Failed to delete product from cart');
                    }
                }
            };

            xhr.open('POST', 'deleteFromCart.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send('product_id=' + encodeURIComponent(product_id));
        });
    });
});

/*=============== ADMINISTRATION ===============*/
document.addEventListener('DOMContentLoaded', () => {
    const editButtons = document.querySelectorAll('.products__edit-button');
    const deleteButtons = document.querySelectorAll('.products__delete-button');
    
    editButtons.forEach(button => {
        button.addEventListener('click', () => {
            const productId = button.getAttribute('data-product-id');
            window.location.href = `editProduct.php?id=${productId}`;
        });
    });
    
    deleteButtons.forEach(button => {
        button.addEventListener('click', () => {
            const productId = button.getAttribute('data-product-id');
            if (confirm('Are you sure you want to delete this product?')) {
                window.location.href = `deleteProduct.php?id=${productId}`;
            }
        });
    });
});