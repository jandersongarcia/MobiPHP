
/* Definindo a classe Mobi */
class Mobi {
  constructor() {
    // Vincula os métodos de classe aos seus contextos.
    this.post = this.post.bind(this);
    // Carrega as rotas quando a instância da classe é criada.
    this.loadRoutes();
    // Cria uma instância do gerenciador de armazenamento.
    this.storage = new StorageManager();
  }

  // Método para enviar uma requisição POST com dados.
  post(url, data, successCallback, errorCallback) {
    // Cria um objeto FormData para armazenar os dados.
    const formData = new FormData();
    // Itera sobre as chaves dos dados e as adiciona ao FormData.
    for (const key in data) {
      formData.append(key, data[key]);
    }

    // Envia uma requisição POST usando o método fetch.
    fetch(url, {
      method: "POST",
      body: formData
    })
      .then(response => {
        // Verifica se a resposta não foi bem-sucedida.
        if (!response.ok) {
          throw new Error("Network response was not ok");
        }
        // Converte a resposta para JSON e passa para o próximo 'then'.
        return response.json();
      })
      .then(data => {
        // Chama o callback de sucesso com os dados recebidos.
        successCallback(data);
      })
      .catch(error => {
        // Chama o callback de erro com a mensagem de erro.
        errorCallback(error.message);
      });
  }

  // Método para carregar as rotas a partir de um arquivo JSON.
  loadRoutes() {
    // Faz uma requisição para o arquivo JSON de rotas.
    fetch('./core/json/routes.json')
      .then(response => {
        // Verifica se a resposta não foi bem-sucedida.
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        // Converte a resposta para JSON e passa para o próximo 'then'.
        return response.json();
      })
      .then(data => {
        // Armazena os dados das rotas na janela global.
        window.routes = data;
      })
      .catch(error => {
        // Exibe uma mensagem de erro caso ocorra um problema.
        console.error('Error loading routes:', error.message);
      });
  }
}

// Cria uma instância da classe Mobi ao carregar o script.
const mobi = new Mobi();
