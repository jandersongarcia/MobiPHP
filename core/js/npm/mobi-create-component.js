const fs = require('fs');
const path = require('path');

const componentName = process.argv[2];

if (!componentName) {
  console.error('Component name not provided.');
  process.exit(1);
}

function capitalizeFirstLetter(input) {
  return input.charAt(0).toUpperCase() + input.slice(1);
}

const normalizedComponentName = componentName.toLowerCase();
const capitalizedComponentName = capitalizeFirstLetter(normalizedComponentName);

const projectRootDir = path.join(__dirname, '..', '..', '..');
const componentDir = path.join(projectRootDir, 'components', capitalizedComponentName);

if (!fs.existsSync(componentDir)) {
  fs.mkdirSync(componentDir);
}

const componentFiles = [
  `${capitalizedComponentName}.php`,
  `${capitalizedComponentName}.model.php`,
  `${capitalizedComponentName}.css`,
  `${capitalizedComponentName}.js`
];

componentFiles.forEach(filename => {
  const filePath = path.join(componentDir, filename);
  let fileContent = '';

  if (filename === `${capitalizedComponentName}.model.php`) {
    fileContent = `<?php\n\nif ($_SERVER['REQUEST_METHOD'] === 'POST') {\n\n   # Write your script here\n\n} else {\n   $message = ['message' => 'Forbidden page access mode'];\n   echo json_encode($message);\n}`;
  }

  fs.writeFileSync(filePath, fileContent, 'utf-8');
});

console.log(`Component ${capitalizedComponentName} successfully created.`);
