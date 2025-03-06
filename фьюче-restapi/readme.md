<p>Запускается на встроенном сервере примерно так: php -S localhost:8000 index.php</p>
<p>index.php используется как роутер</p>
<p>Нужно активировать pdo-sqlite драйвер, добавив в php.ini строку в таком формате:</p>
extension="C:\php\ext\php_pdo_sqlite.dll"
