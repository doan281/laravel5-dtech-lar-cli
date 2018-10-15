## DTECH CLI

### Install
```
composer install dtech-lar-cli/cli@dev-master
```
or config in composer.json
```
"require": 
{
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
### Usage
#### Step 1:
- Copy "dtech" file from "\vendor\dtech-lar-cli\cli" into root folder.
#### Step 2:
- Use command to create Model or Controller by command line from root folder:
```shell
php dtech make:model Product (Create file: app/Models/Product.php)
php dtech make:model Amin/Product (Create file: app/Models/Admin/Product.php)
php dtech make:controller Product (Create file: app/Http/Controllers/Product.php)
```
