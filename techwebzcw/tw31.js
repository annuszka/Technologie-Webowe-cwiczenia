//JQuery
$(document).ready( function() {

  $('#imie').keyup( function() {
    if( $(this).val().length > 0 )
    $.getJSON('service.php', { "imie" : $(this).val() }, function(data) {
      var txt = '';
      for(i=0; i<data.length; i++)
        txt = txt + '<span>' + data[i] + '</span> ';
      $('#podpimie').html(txt).hide().slideDown('slow');
      $('#podpimie span')
        .click( function() { $('#imie').val( $(this).text() ); })
        .css('cursor', 'pointer')
        .hover( function() { $(this).css('background', 'yellow') } , 
                function() { $(this).css('background', '') } );
      
    });
    else
      $('#podpimie').slideUp('slow').html('');
  });
  
  $('#nazw').keyup( function() {
    if( $(this).val().length > 0 )
    $.getJSON('service.php', { "nazw": $(this).val() }, function(data) {
      txt = '';
      for(i=0; i<data.length; i++)
        txt = txt + '<span>' + data[i] + '</span> ';
      $('#podpnazw').html(txt);
      $('#podpnazw span')
        .click( function() { $('#nazw').val( $(this).text() ); })
        .css('cursor', 'pointer')
        .hover( function() { $(this).css('background', 'yellow') },
                function() { $(this).css('background', '') } );  
    });
  });
  
  $('#wyslij').click( function() {
    if( $('#imie').val().length < 2 )
      {
      alert("Musisz podać imię");
      $('#imie').focus();
      }
  });

});