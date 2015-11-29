<!DOCTYPE html>
<html>
    <head>
        <title>Page not found.</title>
    <body>
    <!-- Общее сообщение об ошибке -->
        {{ trans('index::errors.404') }}<br>
    <!-- Сообщение об ошибке от конкретной страницы -->
        {{ $message }}
    </body>
</html>
