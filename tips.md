## ������� ��� �������������

### ������

#### ��������
`php artisan module:make Blog` -- ����� ������ ������ Blog
`php artisan module:make Blog Portfolio User` -- ����� ������� 3 ������ � ���������������� ����������

#### ����������
� composer.json ������ ���� ������:

`
	"psr-4": {
            "App\\": "app/",
            "Modules\\": "Modules"
        }
`
���� �� ��� - ������� ���������� �� ��������� ������ ����������� ��� ��� ������������ ������� �� ����� ��������.

����� �������� ������ ��� ����� ������������ ��������:
`composer dump-autoload`

#### �������� � �������

`php artisan module:make-migration <MigrationName> <ModuleName>`

��������:

`php artisan module:make-migration create_table_users user`

>>>> ������� ������������ ������ � ������� ��������, ��� �������� ������� ������� �������� create_table_<table> , ��� ���������� update_table_<table>. ��� ��������� �������� ����� ����� � �����.
