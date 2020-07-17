$(document).ready(function(){ 
    // filtre les anime et cache les mangas
    $(".animeFilter").click(function(){ 
        $('.ficheAnime').show();
        $('.ficheManga').hide();
     }); 

     // filtre les manga et cache les anime
     $(".mangaFilter").click(function(){ 
        $('.ficheAnime').hide();
        $('.ficheManga').show();
     }); 

     $(".coeur").click(function(){
         if($('.heartwishList').css('fill') == 'rgb(255, 255, 255)'){
            $('.heartwishList').css('fill','#D7443E');
         }
         else{
            $('.heartwishList').css('fill','rgb(255, 255, 255)');
         }
     });
}); 