$(document).ready(function(){
    var nb_article = $('.nb_article');
    var total = $('.total');
    var destroy = $('span.delete a');
    var update_form = $('span.update_form form');


    $(destroy).each(function(){
        $(this).on('click',function(){
            if(confirm('Confirmez-vous la suppression?')){
                var url = $(this).attr('href');
                tr = $(this).closest('tr');
                $.getJSON(url, function(data){
                    if(data.success){
                        $(tr).fadeOut();
                        $(nb_article).text(data.nb_article);
                        $(total).text(data.total);
                    }
                });
            }
        return false;
        });
    });
    
    $(update_form).each(function(){
       $(this).submit(function(){
           var data = $(this).serialize();
           var url = $(this).attr('action');
           var total_for_item = $(this).closest('tr').find('td:last');
   
           $.ajax({
              type:'POST',
              data:data,
              url:url,
              dataType:'json',
              success:function(data){
                if(data.success){
                   $(nb_article).text(data.nb_article);
                   $(total).text(data.total + " €");
                   $(total).css('font-weight','bold');
                   $(total_for_item).text(data.total_for_item + " €");
                   $(total_for_item).css('font-weight','bold');
                }
            }
                  
           });
           
            return false;
       });
    });

});
