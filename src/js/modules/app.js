const tpmlSelect = $('#catsselect').html();

$('#catsel').html(tpmlSelect);

$('#catsel').find('select').on('change', function(ev){
    $('#cat-field').val(ev.target.value);
});

$('#tm-btn').on('click', function(){
 $('.top-menu').slideToggle('active');
});