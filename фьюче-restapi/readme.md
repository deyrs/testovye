<p> Запускается на встроенном сервере примерно так: php -S localhost:8000 index.php </p>
index.php используется как роутер
Нужно активировать pdo-sqlite драйвер, добавив в php.ini строку в таком формате:
extension="C:\php\ext\php_pdo_sqlite.dll"
