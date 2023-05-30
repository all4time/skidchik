$(document).ready(function(){
    $(document).on('click', '.show_more', function(){
        var targetContainer = $('.catalog_items .tile'),          //  ���������, � ������� �������� ��������
            url =  $('.show_more').attr('data-url');    //  URL, �� �������� ����� ����� ��������
        if (url !== undefined) {
            $.ajax({
                type: 'GET',
                url: url,
                dataType: 'html',
                success: function(data){
                    //  ������� ������ ���������
                    $('.show_more').remove();
                    var elements = $(data).find('.catalog_items .tile .item'),  //  ���� ��������
                        pagination = $(data).find('.show_more');//  ���� ���������
                    targetContainer.append(elements);   //  ��������� ����� � ����� ����������
                    targetContainer.append(pagination); //  ��������� ��������� ������
                }
            })
        }
    });
});