<!-- <p>Запускается на встроенном сервере примерно так: php -S localhost:8000 index.php</p>
<p>index.php выступает как роутер</p>
<p>Необходимо включить в php.ini sqlite-драйвер, для этого нужно добавить примерно такую строку:<br>
    extension="C:\php\ext\php_pdo_sqlite.dll" где "C:\php\" это путь к php.
</p>
<ul>
    <li>restapi.db пустая бд</li>
    <li>restapi-test.db со сгенерерированными значениями</li>
</ul> -->
<p>docker pull deyrs/future-restapi</p>
<p>docker run -p 8080:8080 deyrs/future-restapi</p>
<p>Тестировал с помощью Postman</p>
<p><a href="https://deyrs.github.io/verstka/swagger.html">Ссылка на swagger-описание</a></p>