## DTECH CLI
The package same as artisan command in Laravel
### Install
##### Step 1: install package
Config in composer.json
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
- Make Controller: base folder "\app\Http\Controllers"
```
php dtech make:controller Product
```
or:
```
php dtech make:controller Admin/Product
```
- Make Model: base folder "\app\Models"
```
php dtech make:model Product
```
or:
```
php dtech make:model Admin/Product
```
- Make Repository: base folder "\app\Repositories"
```
php dtech make:repository Product
```
or:
```
php dtech make:repository Admin/Product
```
- Make Request: base folder "\app\Http\Requests"
```
php dtech make:request Product
```
or:
```
php dtech make:request Admin/Product
```
- Make Scope: base folder "\app\Scopes"
```
php dtech make:scope Product
```
or:
```
php dtech make:scope Admin/Product
```
- Make Trait: base folder "\app\Traits"
```
php dtech make:trait Product
```
or:
```
php dtech make:trait Admin/Product
```
### Author
- [Phạm Văn Đoan](https://github.com/doan281?tab=repositories) 
- Email: doan281@gmail.com
### Refer to
- [Vu Thanh Tai](https://github.com/thanhtaivtt/taiscript)
