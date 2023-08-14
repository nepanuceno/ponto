This is a simple Laravel Framework system to generate PDF timesheets. You just need to register the departments, respecting the hierarchy organization chart between them, register the positions and finally the Employees of the company or institution.
Okay, with that, you can now generate your timesheets. 

### Execute cada comando na ordem a seguir

```composer install```
```php artisan key:generate```
```npm install```
```npm run dev```
#### acesse o servidor de banco de dados e crie o banco "livro-de-pontos"
```php artisan migrate```
```php artisan db:seed --class=PermissionTableSeeder```
```php artisan db:seed --class=CreateAdminUserSeeder```
```php artisan storage:link```
```chmod -R 777 storage```
```chmod -R 777 /var/www/ponto/vendor/dompdf/dompdf/lib/fonts```

Consulte a documentação do AdminLTE em caso de dúvidas ou dificuldades:
https://github.com/jeroennoten/Laravel-AdminLTE/wiki

### Credencial padrão para o primeiro acesso
* Usuário: admin@gmail.com
* Senha: 123456
