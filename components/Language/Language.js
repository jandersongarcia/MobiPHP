const ptbr = document.getElementById('ptBr');
const en = document.getElementById('en');

alert('ok');

ptbr.addEventListener('click', function (event) {
  alert('ok');
  changeLanguage('ptbr');
});

ptbr.addEventListener('click', function (event) {
  alert('ok');
  changeLanguage('en');
});

function changeLanguage(lang) {
  alert('ok');
  mobi.post(
    "/mobiPost/messagebox",
    { lang: lang },
    function (data) {
      console.log(data);
    },
    function (error) {
      console.log(error);
    }
  );
}
