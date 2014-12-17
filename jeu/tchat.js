 $('#form').submit(function(event){
        event.preventDefault();

        if($('#message').val() == '')
        {
            alert('Vous devez entrer un message !');
        }
        else{
           
            // Sécurité tchat
           
           function strip_tags(html)
            {
                //PROCESS STRING
                if(arguments.length < 3) {
                    html=html.replace(/<\/?(?!\!)[^>]*>/gi, '');
                } else {
                    var allowed = arguments[1];
                    var specified = eval("["+arguments[2]+"]" );
                    if(allowed){
                        var regex='</?(?!(' + specified.join('|') + '))\b[^>]*>';
                        html=html.replace(new RegExp(regex, 'gi'), '');
                } else {
                        var regex='</?(' + specified.join('|') + ')\b[^>]*>';
                        html=html.replace(new RegExp(regex, 'gi'), '');
                    }
            }
                //CHANGE NAME TO CLEAN JUST BECAUSE  
                var clean_string = html;
                //RETURN THE CLEAN STRING
                return clean_string;
            }
    
    message= strip_tags($('#message').val()); // on sécurise les données

    socket.emit('creation_message', {
        message : message,
        pseudo: pseudo,
	});
  
    $('#message').val('');
    $('#message').focus();
    return false;
    }
});


socket.on('envoie_message', function(data){

           $('#affichageMessage').append( '<div class="message">' + data.pseudo + ' : '+ data.message + '</div>' );
            $("#affichageMessage").animate({scrollTop: $("#affichageMessage")[0].scrollHeight},50);
        });
