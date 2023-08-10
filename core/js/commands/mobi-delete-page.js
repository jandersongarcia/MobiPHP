const fs = require('fs').promises; // Importe o módulo fs com suporte a promessas
const path = require('path');
const readline = require('readline');

const pageName = process.argv[2];

if (!pageName) {
  console.error('Nome da página não fornecido.');
  process.exit(1);
}

const projectRootDir = path.join(__dirname, '..', '..', '..');
const pagesDir = path.join(projectRootDir, 'pages', pageName);

if (!fs.existsSync(pagesDir)) {
  console.error(`Página "${pageName}" não encontrada.`);
  process.exit(1);
}

const rl = readline.createInterface({
  input: process.stdin,
  output: process.stdout
});

rl.question(`Are you sure you want to delete the page "${pageName}"? This can cause errors when running Mobi. (Y/N): `, async (answer) => {
  rl.close();

  if (answer.toLowerCase() === 'y') {
    try {
      // Remove a página e seus arquivos
      await fs.rm(pagesDir, { recursive: true });

      // Remove a rota correspondente do routes.json
      const routesPath = path.join(__dirname, '..', '..', 'json', 'routes.json');
      const routes = require(routesPath);

      for (const route in routes) {
        if (routes[route] === pageName) {
          delete routes[route];
          break;
        }
      }

      await fs.writeFile(routesPath, JSON.stringify(routes, null, 2), 'utf-8');

      console.log(`Page "${pageName}" successfully deleted and route removed.`);
    } catch (error) {
      console.error('Ocorreu um erro:', error);
    }
  } else {
    console.log(`Canceled deletion of page "${pageName}".`);
  }
});
