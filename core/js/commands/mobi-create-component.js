const fs = require('fs');
const path = require('path');

const componentName = process.argv[2];

if (!componentName) {
  console.error('Component name not provided.');
  process.exit(1);
}

const projectRootDir = path.join(__dirname, '..', '..', '..');
const componentDir = path.join(projectRootDir, 'components', componentName);

if (!fs.existsSync(componentDir)) {
  fs.mkdirSync(componentDir);
}

const componentFiles = [
  `${componentName}.php`,
  `${componentName}.css`,
  `${componentName}.js`
];

componentFiles.forEach(filename => {
  const filePath = path.join(componentDir, filename);
  fs.writeFileSync(filePath, '', 'utf-8');
});

console.log(`Component ${componentName} successfully created.`);
