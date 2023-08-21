// Caminho para o arquivo JSON contendo os dados das rotas
const jsonFilePath = 'core/json/routes.json';
let pageData; // Declaração da variável

// Função para carregar o arquivo JSON
async function loadJSON(filePath) {
    try {
        // Faz uma requisição para o arquivo JSON
        const response = await fetch(filePath);
        // Converte a resposta em formato JSON
        const data = await response.json();
        return data;
    } catch (error) {
        console.log('Erro ao carregar o arquivo JSON:', error);
        throw error;
    }
}

// Função para carregar a página e atualizar o conteúdo da div
async function loadPage(path, targetId) {
    // Monta a URL para a página a ser carregada
    const url = `./mobiLoadPage/${path}`;
    try {
        // Faz uma requisição para a página
        const response = await fetch(url);
        // Obtém o conteúdo da página como texto
        const data = await response.text();
        // Seleciona a div alvo pelo ID e atualiza o conteúdo
        const targetDiv = document.getElementById(targetId);
        targetDiv.innerHTML = data;
        // Adiciona classes para exibir a página e ocultá-la
        targetDiv.classList.add("m-page");
        targetDiv.classList.add("m-none");
        
    } catch (error) {
        console.log(`Erro ao carregar a página ${path}:`, error);
    }
}

// Função para abrir a página correspondente com base na URL
function openPage(pageData) {
    const currentPath = window.location.pathname;
    let pageFound = false;
    
    for (const path in pageData) {
        const targetId = "m" + pageData[path];
        const targetDiv = document.getElementById(targetId);
        
        if (currentPath === path) {
            // Remove a classe "m-none" para tornar a página visível
            targetDiv.classList.remove("m-none");
            pageFound = true;
        } else {
            // Adiciona a classe "m-none" para ocultar as outras páginas
            targetDiv.classList.add("m-none");
        }
    }

    // Se nenhuma página foi encontrada, remove o m-none da página mNotFound
    if (!pageFound) {
        const notFoundDiv = document.getElementById("mNotFound");
        notFoundDiv.classList.remove("m-none");
    }
}

// Carrega o arquivo JSON e armazena na constante
(async () => {
    try {
        // Carrega os dados do JSON
        pageData = await loadJSON(jsonFilePath);

        // Seleciona a div com o ID "app"
        const appDiv = document.getElementById("app");

        // Itera sobre as rotas do JSON
        for (const path in pageData) {
            // Monta o ID da div alvo
            const targetId = "m" + pageData[path];
            // Cria uma nova div com o ID alvo
            const targetDiv = document.createElement("div");
            targetDiv.id = targetId;
            // Adiciona a nova div como filho da div "app"
            appDiv.appendChild(targetDiv);

            // Carrega a página correspondente na div alvo
            loadPage(pageData[path], targetId); // Passa o valor do JSON em vez da chave
        }

        // Aguarda meio segundo (500 milissegundos) e, em seguida, abre a página correspondente
        setTimeout(() => {
            openPage(pageData);
        }, 100);

    } catch (error) {
        // Lidar com erros, se necessário
    }
})();

// Função para verificar se um link é interno ou externo
function isInternalLink(link) {
    // Remove a parte após o último / para comparar com a URL base
    const baseHref = window.location.href.split('/').slice(0, -1).join('/');
    return link.startsWith(baseHref);
}

// Função para lidar com o clique em links
function handleLinkClick(event) {
    const clickedLink = event.target.href;

    if (isInternalLink(clickedLink)) {
        event.preventDefault(); // Impede o comportamento padrão de seguir o link

        // Alterar a URL na barra de endereços e no histórico do navegador
        history.pushState(null, null, clickedLink);

        // Chamar a função openPage para exibir a página correspondente
        openPage(pageData);

        return false;
    }

    // Se não for um link interno, deixe o comportamento padrão
    return true;
}

// Adicione um ouvinte de evento de clique aos links da página
document.addEventListener('click', function(event) {
    if (event.target.tagName === 'A') {
        handleLinkClick(event);
    }
});
