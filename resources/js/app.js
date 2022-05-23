//   require('./bootstrap');

 let x=document.querySelectorAll('.nav-item');
 for(let i=0;i<x.length;i++)
 {
     x[i].addEventListener("mouseover",function(){

        X[i].

         $('#links').css('display','block')
        //   $ ('#links').addClass('display-block');
          console.log(x[i]);
     });
      x[i].addEventListener("mouseout",function(){

          $('#links').css('display','none')
            // $ ('#links').addClass('display-none');
           console.log(x[i]);
      });


 };

$('#links').on('mouseenter',function(){
//    let op= $('#links').css('display','block');
   $('#links').css('display','block');
   console.log(op)});
   $('#links').on('mouseout',function(){
    //    let op= $('#links').css('display','block');
       $('#links').css('display','none');
       console.log(op)});





    // ($this).removeClass('display-none');
// },function(){
//     let op=  ($this).css('opacity',"0");
//     console.log(op);

// });
// $ ('.links').on('mouseout',function(){
//     ($this).removeClass('display-block');
//     ($this).addClass('display-none');
// })

// {
//     element.addEventListener('mouseover',function(){



// }
// x.addEventListener('mouseover',function(){

//     $('.links').toggleClass('display-block');

// })


