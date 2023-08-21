const readline = require('readline');
const fs = require('fs/promises');
const path = require('path');

const rl = readline.createInterface({
  input: process.stdin,
  output: process.stdout
});

const pageName = process.argv[2]; // Nome da pasta com a primeira letra maiúscula
const pageNameLowerCase = pageName.toLowerCase(); // Convertendo para minúsculas
const projectRootDir = path.join(__dirname, '..', '..', '..');
const pagesPath = path.join(projectRootDir, 'src/pages', pageName); // Ajuste no caminho
const routesFilePath = path.join(projectRootDir, 'core/json/routes.json'); // Ajuste no caminho

/// Verifica se a pasta existe
fs.access(pagesPath, fs.constants.F_OK)
.then(() => {
  rl.question(`Are you sure you want to delete the "${pageName}" folder and its files? (y/n): `, (answer) => {
    if (answer.toLowerCase() === 'y') {
      // Apaga a pasta e seus arquivos
      fs.rm(pagesPath, { recursive: true })
        .then(() => {
          console.log(`The "${pageName}" folder and its files have been deleted.`);
          
          // Remove a entrada do arquivo routes.json
          fs.readFile(routesFilePath, 'utf-8')
            .then(data => {
              const routes = JSON.parse(data);
              if (routes[`/${pageNameLowerCase}`]) {
                delete routes[`/${pageNameLowerCase}`];
                return fs.writeFile(routesFilePath, JSON.stringify(routes, null, 2));
              }
              return Promise.resolve(); // Não é necessário alterar o arquivo se a entrada não existir
            })
            .then(() => {
              console.log(`The route "/${pageNameLowerCase}" has been removed from routes.json.`);
              console.log('Process completed.');
              rl.close();
            })
            .catch(error => console.error('Error:', error));
        })
        .catch(error => console.error('Error:', error));
    } else {
      console.log('Deletion canceled. Exiting...');
      rl.close();
    }
  });
})
.catch(() => {
  console.error(`The folder "${pageName}" does not exist.`);
  rl.close();
});