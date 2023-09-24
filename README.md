## Welcome to Todo-List App
This App is made with Laravel Vue.js

If you are Cloning it From Github :

```bash
Git clone https://github.com/maas97/Todo-List-Laravel-Vue.git
```

1- In the .env File Make Sure DB name is Correct and Everything is Fine and the Database exists ;

2-Install the Needed Packages :

```bash
 composer update
```
composer dump-autoload
[ If needed ]

```bash
 npm install
```
3- Generate the Key For the App :

```bash
  php artisan key:generate
```

4- In the .Env, Make Sure DB name is Correct with your user and password DB information;

5- If the Database is Empty Migrate the Tables :

```bash
  php artisan migrate
```

```bash
  php artisan migrate:fresh
```

6- To run The Server  

```bash
  php artisan serve
```
It'll open a Login Page, Please Register a new user first and it'll redirect you to home page
