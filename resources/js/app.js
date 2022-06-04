// const { head } = require("lodash");

// const { default: Swiper } = require("swiper");
document.addEventListener("DOMContentLoaded", () => {
    const swiper = new Swiper(".swiper", {
        speed: 400,
        breakpointsBase: "container",
        navigation: {
            nextEl: ".swiper-next",
            prevEl: ".swiper-prev",
            hiddenClass: "swiper-button-hidden",
            hideOnClick: true,
        },
        observer: true,
        observeParents: true,
        parallax: true,

        autoHeight: true,
        loop: false,
        // allowSlideNext:true,

        breakpoints: {
            // when window width is >= 320px
            320: {
                slidesPerView: 2,
                spaceBetween: 3,
            },

            // when window width is >= 640px
            767: {
                slidesPerView: 4,
                spaceBetween: 3,
            },
        },
    });

    $(window).scroll(function () {
        let wind = $(window).scrollTop();

        let nice = $("#nice-girl").offset().top;
        console.log(nice);
        console.log(wind);
        if (wind+250 >= nice) {
            console.log("hi");
            $(".nice-girl-image-contianer > img").css(
                "transform",
                "Scale(1.1)"
            );
            $(".after").css("left", "100%");
            $(".before").css("right", "100%");
        } else {
            $(".nice-girl-image-contianer > img").css("transform", "Scale(1)");
            $(".after").css("left", "90%");
            $(".before").css("right", "90%");
        }
    });

    let swip = new Swiper(".mySwiper", {
        spaceBetween: 5,
        slidesPerView: 4,
        direction: "vertical",
        freeMode: true,
        observer: true,
        observeParents: true,
        parallax: true,
        mousewheel: true,
        watchSlidesProgress: true,
        grabCursor: true,
    });

    const swiper2 = new Swiper(".mySwiper2", {
        spaceBetween: 0,
        loop: true,

        observer: true,
        observeParents: true,
        parallax: true,

        thumbs: {
            swiper: swip,
        },
    });
});

//////////////////////////////////////////////////////////////

const feedbackSwiper = new Swiper(".feedback-swiper", {
    speed: 400,
    spaceBetween: 1,
    breakpointsBase: "container",
    effect: "fade",
    navigation: {
        nextEl: ".swiper-nex",
        prevEl: ".swiper-pre",
        // hiddenClass: "swiper-button-hidden",
        // hideOnClick: true,
    },
    observer: true,
    observeParents: true,
    parallax: true,
    autoHeight: true,
    loop: false,
    // allowSlideNext:true,
    breakpoints: {
        // when window width is >= 320px
        320: {
            slidesPerView: 1,
        },
        // when window width is >= 640px
    },

    on: {
        setTransition: function (transition = "5000") {},
        slideChangeTransitionStart: function () {
            let stars = document.querySelectorAll(".bkh");
            for (let i = 0; i < stars.length; i++) {
                stars[i].classList.remove("animate__slideInDown");
               
            }
            console.log("swiper start");
        },
        slideChangeTransitionEnd: function () {
            let stars = document.querySelectorAll(".bkh");
            for (let i = 0; i < stars.length; i++) {
              
                stars[i].classList.add("animate__slideInDown");
            }
        },
    },
});

//
// feedbackSwiper.slideNext('5000',true);
// feedbackSwiper.slidePrev('5000',true);

////////////////////////////////////////////////////////////////
let x = document.querySelectorAll(".nav-item");

for (let i = 0; i < x.length; i++) {
    x[i].addEventListener("mouseover", function () {
        let linko = $(".nav-item > a").eq(i).text();

        if (linko == "+ Hambozo") {
            $("#links").slideDown("slow", "linear");
            $("#Profile").css("display", "none");
            $("#search").css("display", "none");

            $("#Hambozo").css("display", "block");
        }

        if (linko == "+ Profile") {
            $("#Hambozo").css("display", "none");
            $("#links").slideDown("slow", "linear");
            $("#search").css("display", "none");

            $("#Profile").slideDown("slow", "linear");
        }
    });
}

////////////////////////////////////////////////

//small menue button actions/////
$(".menue-btn").on("click", function () {
    if (!$(".menue-btn").hasClass("open")) {
        $(".menue-btn").addClass("open");
        $("#small-menue").slideDown("slow", "linear");
        $(".navig-item").each(function () {
            $(this).addClass("animate__slideInLeft");
        });
    } else {
        $(".menue-btn").removeClass("open");
        $("#small-menue").slideUp("slow", "linear");
        $(".navig-item").each(function () {
            $(this).removeClass("animate__slideInLeft");
        });

        $("#sliding-canvas").animate({ left: "100%" }, "fast", "linear");
        $("#sliding-canvas").animate({ right: "-100%" }, "fast", "linear");
        $("#sliding-convas-shop").animate({ left: "100%" }, "slow", "linear");
        $("#sliding-convas-shop").animate({ right: "-100%" }, "slow", "linear");
    }
});
/////////////

function addSlidingCanvascontent(header) {
    $("#sliding-convas-header").text(header);
    let blog = ["NEWS", "NOTEBOOK"];
    let about = ["WHO WE ARE", "FAQ", "CONTACTS", "MEET THE TEAM", "FAN PAG"];
    let collections = [
        "Spring/Summer",
        "Ready-to-Wear",
        "Last Chance",
        "View All",
    ];
    let sale = ["One Piece", "Tops", "bottoms", "view All"];
    let allStyles = [
        "One Piece",
        "Dresses",
        "Tops",
        "Shirts",
        "Bottoms",
        "Skirts",
    ];

    if (header == "BLOG") {
        for (let i = 0; i < blog.length; i++) {
            $(".sliding-convas-paragraph").eq(i).text(blog[i]);
            $("#sliding-canvas").animate({ left: "0" }, "slow", "linear");
            $("#sliding-canvas").animate({ right: "0" }, "slow", "linear");
        }
    } else if (header == "ABOUT") {
        for (let i = 0; i < blog.length; i++) {
            $(".sliding-convas-paragraph").eq(i).text(about[i]);
            $("#sliding-canvas").animate({ left: "0" }, "slow", "linear");
            $("#sliding-canvas").animate({ right: "0" }, "slow", "linear");
        }
    } else if (header == "SHOP") {
        $("#sliding-convas-shop").animate({ left: "0" }, "slow", "linear");
        $("#sliding-convas-shop").animate({ right: "0" }, "slow", "linear");
    } else if (header == "COLLECTIONS") {
        for (let i = 0; i < collections.length; i++) {
            $(".sliding-convas-paragraph").eq(i).text(collections[i]);
            $("#sliding-canvas").animate({ left: "0" }, "slow", "linear");
            $("#sliding-canvas").animate({ right: "0" }, "slow", "linear");
        }
    } else if (header == "ALL STYLES") {
        for (let i = 0; i < allStyles.length; i++) {
            $(".sliding-convas-paragraph").eq(i).text(allStyles[i]);
            $("#sliding-canvas").animate({ left: "0" }, "slow", "linear");
            $("#sliding-canvas").animate({ right: "0" }, "slow", "linear");
        }
    } else if (header == "SALE") {
        for (let i = 0; i < sale.length; i++) {
            $(".sliding-convas-psaleraph").eq(i).text(sale[i]);
            $("#sliding-canvas").animate({ left: "0" }, "slow", "linear");
            $("#sliding-canvas").animate({ right: "0" }, "slow", "linear");
        }
    }
}

let z = document.querySelectorAll(".navig-item i");
for (let i = 0; i < z.length; i++) {
    z[i].addEventListener("click", function () {
        var header = $(".navig-item > p").eq(i).text();
        console.log(header);
        addSlidingCanvascontent(header);
    });
}

//
///search icon action/////////////////
$(".search-icon").on("click", function () {
    $("#search").slideDown("slow", "linear");
    $("#search-caption").addClass("animate__slideInUp");
    $("#search-input").addClass("animate__slideInUp");
});

$(document).ready(function () {
    $(".first-caption").css("display", "block");
    $(".first-caption").addClass("animate__slideInUp");
    $("#intro-image").addClass("scalling-image");
});

$("#links").on("mouseleave", function () {
    $("#links").slideUp("slow", "linear");
});

let list = Array.from(document.querySelectorAll(".myswiper img"));
list.forEach((el) => {
    el.addEventListener("click", (e) => {
        //code that affects the element you click on
        el.style.boxShadow = "0 7px #261d09";

        list.filter((x) => x != el).forEach((otherEl) => {
            //code that affects the other elements you didn't click on
            otherEl.style.boxShadow = "none";
        });
    });
});
