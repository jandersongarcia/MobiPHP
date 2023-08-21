async function language(idioma) {
    const url = './mobiComponent/NavBar/';
    const languageData = { action: 'changeLanguage', language: idioma };

    mobi.post(
        url,
        languageData,
        resposta =>{
            console.log(resposta);
            if (resposta.status === "concluded") {
                location.reload();
            }
        },
        errorMessage => {
            console.log('Erro:', errorMessage)
        }
    )
}
