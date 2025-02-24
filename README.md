# DesafioRanking

Precisamos criar um banco de dados chamado BancoDesafio

nesse banco precisamos criar o usuario e dar permissoes a ele, com o comando:

CREATE USER 'root'@'%' IDENTIFIED BY '123456';
GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' WITH GRANT OPTION;
FLUSH PRIVILEGES;

dentro da pasta DesafioRanking rodar o comando:
- php artisan serve --port=8003

se der algum problema de autoload pode ser que seja alguma dependencia, podemos rodar:
- composer install ou composer update