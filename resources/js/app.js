
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














