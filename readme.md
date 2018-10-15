## DTECH CLI
The package same as artisan command in Laravel
### Install
##### Step 1: install package
- In root folder, run command:
```
composer require dtech-lar-cli/cli
```
or config in composer.json
```
"require": 
{
     ...,
     "dtech-lar-cli/cli": "dev-master"
},
```
then run command:
```
composer install
```
or run command:
```
composer update
```
##### Step 2: create dtech as artisan
- Copy "dtech" file from "\vendor\dtech-lar-cli\cli" into root folder.
### Usage
- Use command to create Model or Controller by command line from root folder:
```shell
php dtech make:model Product (Create file: app/Models/Product.php)
php dtech make:model Amin/Product (Create file: app/Models/Admin/Product.php)
php dtech make:controller Product (Create file: app/Http/Controllers/Product.php)
```
### Author
- Phạm Văn Đoan 
- Email: doan281@gmail.com
### Refer to
- [Vu Thanh Tai]https://github.com/thanhtaivtt/taiscript
