$(function () {

  $('[id*=Pays]').on('click', function () {

    let Pays = $(this);

    let PaysId = $(this)["0"].id;
    let allPays = $('[id*=Pays]');

    allPays.css('fill', '#FFFFFF');
    Pays.css('fill', '#000000');

    $('#infosPays').text(PaysId);

    console.log(PaysId);
  });
});