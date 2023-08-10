const fs = require('fs');
const path = require('path');
const readline = require('readline');

const componentName = process.argv[2];

if (!componentName) {
  console.error('Component name not provided.');
  process.exit(1);
}

const projectRootDir = path.join(__dirname, '..', '..', '..');
const componentDir = path.join(projectRootDir, 'components', componentName);

if (!fs.existsSync(componentDir)) {
  console.error(`${componentName} component not found.`);
  process.exit(1);
}

const rl = readline.createInterface({
  input: process.stdin,
  output: process.stdout
});

rl.question(`Are you sure you want to delete the "${componentName}" component? IThis can cause errors when running Mobi. (Y/N): `, (answer) => {
  rl.close();
  
  if (answer.toLowerCase() === 'y') {
    fs.rmdirSync(componentDir, { recursive: true });
    console.log(`"${componentName}" component deleted successfully..`);
  } else {
    console.log(`Canceled deletion of component "${componentName}".`);
  }
});
