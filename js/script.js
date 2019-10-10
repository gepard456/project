$(function() {

  $('#form-comments').submit(function(event){

    var relay = false;

    $(this).find('input, textarea').each(function(){

      if ( $(this).val().length == 0 )
      {
        $("#"+$(this).attr("id")+"-alert").removeClass("d-none");
        relay = true;
      }
      else
      {
        $("#"+$(this).attr("id")+"-alert").addClass("d-none");
      }

    });

    if( relay )
      event.preventDefault();

  });
  
});
