training
========

A Symfony project created on June 16, 2017, 5:06 pm.


###Building the search-js

```bash
npm install -g yarn
yarn
```

Development:
```bash
npm run watch
```

production build:
```bash
npm run build
```

Use PHP as a template: composer require symfony/templating

Migrations:
1. bin/console d:m:d
2. bin/console d:m:m

Algoila reindex:
bin/console algolia:reindex "\AppBundle\Entity\User"
bin/console algolia:reindex "\AppBundle\Entity\Training"

WYSIWYG Texteditor:
composer require egeloen/ckeditor-bundle
php bin/console ckeditor:install
php bin/console assets:install --symlink
https://symfony.com/doc/current/bundles/EasyAdminBundle/integration/ivoryckeditorbundle.html
