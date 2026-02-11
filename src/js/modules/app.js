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

const wpcf7Elm = document.querySelector(
 '.page-template-add-site-custom-page .wpcf7'
);

if (wpcf7Elm) {
 wpcf7Elm.addEventListener(
  'wpcf7mailsent',
  function (event) {
   const tmpl =
    '<div>Дякуємо. Форма відправлена</div>' + 
    '<div>Якщо ви міжнародна організація або орієнтуєтесть на іноземних користувачів, то ви можете ще додати свій сайт в наш англомовний каталог - ' +
    '<a href="https://webdir.top" target="_blank" class="underline">https://webdir.top</a></div>';

    setTimeout(() => {
        $('.wpcf7-response-output').html(tmpl);
    }, 800);
  },
  false
 );
}
