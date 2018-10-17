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
- Copy "dtech" file from "/vendor/dtech-lar-cli/cli" into root folder.

### Show command list
In root folder, run command
```
php dtech make
```
then show comand list
```
make:controller          Create controller in folder app/Http/Controllers/
make:function            Create store function in folder database/migrations/
make:model               Create model in folder app/Models/
make:procedure           Create store procedure in folder database/migrations/
make:repository          Create repository in folder app/Repositories/
make:request             Create request in folder app/Htpp/Requests/
make:scope               Create scope in folder app/Scopes/
make:trait               Create trait in folder app/Traits/
make:trigger             Create trigger in folder database/migrations/
```

### Usage
- Make Controller: base folder "/app/Http/Controllers"
```
php dtech make:controller Product
```
> File: app/Http/Controllers/ProductController.php will be created

or:
```
php dtech make:controller Admin/Product
```
> File: app/Http/Controllers/Admin/ProductController.php will be created

- Make Model: base folder "/app/Models"
```
php dtech make:model Product
```
> File: app/Models/Product.php will be created

or:
```
php dtech make:model Admin/Product
```
> File: app/Models/Admin/Product.php will be created

- Make Repository: base folder "/app/Repositories"
```
php dtech make:repository Product
```
> File: app/Repositories/ProductRepository.php will be created

or:
```
php dtech make:repository Admin/Product
```
> File: app/Repositories/Admin/ProductRepository.php will be created

- Make Request: base folder "/app/Http/Requests"
```
php dtech make:request Product
```
> File: app/Http/Requests/ProductRequest.php will be created

or:
```
php dtech make:request Admin/Product
```
> File: app/Http/Requests/Admin/ProductRequest.php will be created

- Make Scope: base folder "/app/Scopes"
```
php dtech make:scope Product
```
> File: app/Scopes/ProductScope.php will be created

or:
```
php dtech make:scope Admin/Product
```
> File: app/Scopes/Admin/ProductScope.php will be created

- Make Trait: base folder "/app/Traits"
```
php dtech make:trait Product
```
> File: app/Traits/ProductTrait.php will be created

or:
```
php dtech make:trait Admin/Product
```
> File: app/Traits/Admin/ProductTrait.php will be created

- Make Store function: base folder "/database/migrations". Params: function name.
```
php dtech make:function get_user_list
```
> File: database/migrations/2018_10_18_012236_function_get_user_list.php will be created

- Make Store procedure: base folder "/database/migrations". Params: procedure name.
```
php dtech make:procedure user_count
```
> File: database/migrations/2018_10_18_012811_procedure_user_count.php will be created

- Make Trigger: base folder "/database/migrations". Params: trigger name and table name.
```
php dtech make:trigger after_insert users
```
> File: database/migrations/2018_10_18_012822_trigger_after_insert.php will be created

### Author
- [Phạm Văn Đoan](https://github.com/doan281?tab=repositories) 
- Email: doan281@gmail.com

### Refer to
- [Vu Thanh Tai](https://github.com/thanhtaivtt/taiscript)
