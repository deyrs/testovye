<p>Запускается на встроенном сервере примерно так: php -S localhost:8000 index.php</p>
<p>index.php выступает как роутер</p>
<p>Необходимо включить в php.ini sqlite-драйвер, для этого нужно примерно такую строку:<br>
    extension="C:\php\ext\php_pdo_sqlite.dll" где "C:\php\" это путь к php.
</p>
<ul>
    <li>restapi.db пустая бд</li>
    <li>restapi-test.db со сгенерерированными значениями</li>
</ul>
<p>Тестировал вручную с помощью Postman, просил нейросеть сгенерировать тестовые случаи</p>
<p><a href="https://deyrs.github.io/verstka/swagger.html">Ссылка на swagger-описание</a></p>