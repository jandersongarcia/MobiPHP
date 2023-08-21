# MobiPHP Framework

MobiPHP is a framework designed to streamline application development and code maintenance. This framework operates using modules and incorporates various internal commands. To make the most of MobiPHP, it's recommended to have Node.js installed on your computer, as it utilizes certain NPM commands to expedite the development process.

## Folder Structure

- **components/**
- **config/**
- **core/**
  - **class/**
  - **css/**
  - **data/**
  - **js/**
  - **json/**
  - **template/**
- **lang/**
- **public/**
- **src/**
  - **pages/**
  - **images/**
- **vendor/**

## Creating Pages

To create pages, use the following command: `npm run mobi-create-page page-name`. This command generates a folder named `page-name` within `src/pages`. This folder will contain all the necessary files for the page to function properly. After creating the page, the system prompts you to provide a name for the route that JavaScript uses for frontend page loading. The routes can be manually adjusted; the route file is located within `core/json` and named `routes.json`.

## Creating Components

Creating components follows a similar process to creating pages. Use the command `npm run mobi-create-component component-name`. To include a component on a page, use the following PHP commands:
```php
$m->declareComponents(['NavBar']); // Loads the JS and CSS for the component
$m->loadComponent('NavBar'); // Places the component where desired
```

CSS and JS files for components should be developed within their respective files, created within each component's folder.

## Global CSS and JS

If you have styles or scripts that need to apply globally, insert them into `public/css/rootStyle.css` for CSS and `public/js/rootScript.js` for JavaScript. The `public` directory serves as a repository for files used across the entire application.

## Language Handling

Configure language settings in `config/config.php`, under the `'language' => 'en'` array. The language file's name should match the language declared (e.g., `lang/en.php`). Inside this file, a `Language` class holds words and phrases as public arrays, accessible using the `$lang->word-or-phrase` syntax.

## Page Initialization

Upon accessing a page, the main file is `src/starting.php`. Here, the initial HTML, `mobi.css`, and `mobi.js` files are loaded. These paths facilitate the loading of essential scripts and styles. JavaScript loads all pages and their components simultaneously within the `<div id="app"></div>`. Routing responsibilities are managed by the routing system.

## Database Usage

For database usage, start by configuring the `database` array with the following information:
```php
'database' => [
    'use' => true, // Set to true if working with a database
    'type' => 'mysql', // Default database type (mysql, postgresql, sqlite)
    'servername' => 'localhost',
    'username' => 'root',
    'password' => '123456',
    'database_name' => 'mobi_tasks'
],
```
Once configured, you can utilize `$msql` to work with CRUD operations efficiently.

## Frontend Requests

For frontend requests, use `mobi.post`:
```javascript
mobi.post(
    url,
    data,
    function (response) {
      console.log(response);
    },
    function (error) {
      console.error(error);
    }
);
```

---

Feel free to contribute to the MobiPHP framework and leverage its features to enhance your application development process.