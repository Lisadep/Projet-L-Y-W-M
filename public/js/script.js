
// fonction affiche nom continent.


$(function(){ 

  $('[id*=Pays]').on('click',function(){
 
    let Pays = $(this);

   let PaysId = $(this)["0"].id;
   let allPays = $('[id*=Pays]');

   allPays.css('fill','#FFFFFF');
   Pays.css('fill','#000000');

   PaysId = PaysId.replace('Pays_',' ');
   
        let boucle = true;
   
         do {
         
        PaysId = PaysId.replace('_',' ');
   
         if (PaysId.indexOf('_') == -1)
            
         boucle = false;
   
         }  while(boucle);
    
   $('#infosPays').text(PaysId);
   console.log(PaysId);

        });

   });


  //  fonction cacher le element

  // créer une fonction qui fait apparaitre afficher le continnent_1 et 
  // cache le continent 2 et 3
  
  
  // en js = afficher= show ()
  // // en js =cacher= hide ()
   
    $('#Pays_Amerique_Du_Nord').click(function(){
      $('.modal_Pays_Amerique_Du_Nord').show();
      $('.MapGoogle').show();
      $('.modal_Pays_Amerique_Du_Sud').hide();
      $('.modal_Pays_Europe_Asie_Afrique').hide();
   });
   
     

    $('#Pays_Amerique_Du_Sud').click(function(){
      $('.modal_Pays_Amerique_Du_Sud').show();
      $('.MapGoogle').show();
      $('.modal_Pays_Amerique_Du_Nord').hide();
      $('.modal_Pays_Europe_Asie_Afrique').hide();
    });

    

    $('#Pays_Europe_Asie_Afrique').click(function(){
      $('.modal_Pays_Europe_Asie_Afrique').show();
      $('.MapGoogle').show();
      $('.modal_Pays_Amerique_Du_Nord').hide();
      $('.modal_Pays_Amerique_Du_Sud').hide();
    });
