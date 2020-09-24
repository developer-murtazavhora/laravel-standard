# [Laravel](https://laravel.com) Boilerplate

This is a simple laravel boilerplate which provides CRUD operation.

## Installation using [Composer](https://getcomposer.org/)

Use below commands step by step to get started.

> Use following commands to update all require dependencies
```bash
- composer update
- composer require laravel/ui:^2.4
```

> Create .env file and copy keys from .env.example and then run following commands to generate app key and create database structure using migration scripts
```bash
php artisan key:generate
php artisan migrate --seed
```

> Add scaffolding for authentications and install dependencies of node package manager 
```bash
php artisan ui bootstrap
php artisan ui bootstrap --auth
npm install && npm run dev
```

**User List**

[![User List](https://user-images.githubusercontent.com/15919490/93351717-aa3a1d80-f857-11ea-94ea-764ab89588cc.png)]()

**Car List**

[![Car List](https://user-images.githubusercontent.com/15919490/93351755-b58d4900-f857-11ea-89a5-942b2c56aac1.png)]()

## License
[MIT](https://choosealicense.com/licenses/mit/)
