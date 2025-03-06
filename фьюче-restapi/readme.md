<p>Запускается на встроенном сервере примерно так: php -S localhost:8000 index.php</p>
<p>index.php используется как роутер</p>
<ul>
  <li>restapi.db пустая бд</li>
  <li>restapi-test.db с тестовыми значениями</li>
</ul>
<p>Нужно активировать pdo-sqlite драйвер, добавив в php.ini строку в таком формате:</p>
`extension="C:\php\ext\php_pdo_sqlite.dll"`
<p>Тестировал вручную с помощью Postman, просил нейросеть сгенерировать тестовые случаи.</p>
