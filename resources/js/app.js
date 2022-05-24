//   require('./bootstrap');





let x = document.querySelectorAll('a');
for (let i = 0; i < x.length; i++) {

    x[i].addEventListener("mouseover", function () {

        let linko = $("a").eq(i).text();
        console.log(linko);
        if (linko == "+ Hambozo") {
            // $('#links').empty();
            console.log('hi')
            $('#links').slideDown('slow', 'linear');
            $('#Profile').css('display', 'none');
            $('#Hambozo').css('display', 'block');





        }

        if (linko == "+ Profile") {
            console.log('hello')
            $('#Hambozo').css('display', 'none');
            $('#links').slideDown('slow', 'linear');
            $('#Profile').css('display', 'block');




        }







    });






};


$(document).ready(function () {
    $('.first-caption').css('display', 'block');
    $('.first-caption').addClass('animate__slideInUp');
     $('#intro-image').addClass('scalling-image');
    // $('#intro-image').css('transformScaleY', '100%');
   
});

$('#links').on('mouseleave', function () {

    //     console.log('hello');

    $('#links').slideUp('slow', 'linear');


});
// $(document).ready(function () {


//     var options = {
//         strings: ['<     EXTRA 20% OFF SALE       >', '< bkh >', '< hhhhh >', '< ohh >'],
//         typeSpeed: 3000,
//         backSpeed: 3000,
//         smartBackspace: false,
//         fadeOut: false,
//         fadeOutClass: 'typed-fade-out',
//         fadeOutDelay: 100,
//         loop: true,
//         loopCount: Infinity,
//         backDelay: 0,
//         showCursor: true,
//         cursorChar: '|',
//         autoInsertCss: true,
//     }
//     var typed = new Typed('#header-item', options);

    // for (var i = 0; i < offers.length; i++) {
    //     let time = setTimeout(addHtml, 5000)
    //     function addHtml() {
    //         // document.getElementById('header').innerHTML = offers[i];
    //         console.log("hello");
    //         $('#header').html(offers[i])

    //     }
    //     // myStopFunction();


    //     // function myStopFunction() {
    //     //     clearTimeout(time);
    //     // }


    // }
// });

