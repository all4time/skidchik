$(document).ready(function(){
    $(document).on('click', '.show_more', function(){
        var targetContainer = $('.catalog_items .tile'),          //  Контейнер, в котором хранятся элементы
            url =  $('.show_more').attr('data-url');    //  URL, из которого будем брать элементы
        if (url !== undefined) {
            $.ajax({
                type: 'GET',
                url: url,
                dataType: 'html',
                success: function(data){
                    //  Удаляем старую навигацию
                    $('.show_more').remove();
                    var elements = $(data).find('.catalog_items .tile .item'),  //  Ищем элементы
                        pagination = $(data).find('.show_more');//  Ищем навигацию
                    targetContainer.append(elements);   //  Добавляем посты в конец контейнера
                    targetContainer.append(pagination); //  добавляем навигацию следом
                }
            })
        }
    });
});