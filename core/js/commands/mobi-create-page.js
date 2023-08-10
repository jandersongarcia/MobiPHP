const fs = require('fs');
const path = require('path');
const readline = require('readline');

const pageName = process.argv[2];

if (!pageName) {
  console.error('Page name not provided.');
  process.exit(1);
}

const projectRootDir = path.join(__dirname, '..', '..', '..');
const pagesDir = path.join(projectRootDir, 'pages', pageName);

if (!fs.existsSync(pagesDir)) {
  fs.mkdirSync(pagesDir);
} else {
  console.error(`Page "${pageName}" already exists.`);
  process.exit(1);
}

const pageFiles = [
  `${pageName}.php`,
  `${pageName}.js`,
  `${pageName}.css`
];

pageFiles.forEach(filename => {
  const filePath = path.join(pagesDir, filename);
  fs.writeFileSync(filePath, '', 'utf-8');
});

const rl = readline.createInterface({
  input: process.stdin,
  output: process.stdout
});

rl.question('Enter the route name for this page:', (routeName) => {
  rl.close();

  const routesPath = path.join(__dirname, '..', '..', 'json', 'routes.json');
  const routes = require(routesPath);
  routes[routeName] = pageName;

  fs.writeFileSync(routesPath, JSON.stringify(routes, null, 2), 'utf-8');

  console.log(`Page "${pageName}" created and route added: "${routeName}"`);
});
