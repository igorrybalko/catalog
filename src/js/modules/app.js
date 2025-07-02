const tpmlSelect = $('#catsselect').html();
const catsel = $('#catsel');
catsel.html(tpmlSelect);
catsel.find('select').on('change', function (ev) {
 $('#cat-field').val(ev.target.value);
});

if (location.search) {
 const catId = location.search.replace('?catid=', '');

 if (catId) {
  catsel.find('option').each(function () {
   const value = $(this).val();
   if (value) {
    const valArr = value.split(':');
    if (valArr[0] == catId) {
     $(this).attr('selected', 'selected');
     $('#cat-field').val(value);
    }
   }
  });
 }
}

$('#tm-btn').on('click', function () {
 $('.top-menu').slideToggle('active');
});

const catWr = $('#catwr');
if (catWr.length) {
 const catId = catWr.data('catid');
 const addLink = $('.addlink a');
 const href = addLink.attr('href');
 addLink.attr('href', href + '?catid=' + catId);
}
