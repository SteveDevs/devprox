Technologies used:

PHP 7.2, Mysql, Javascript, Jquery, HTML

Database steve_devprox needs to be create.

How to run:
Have a server that such as Apache or xammp running.

Copy devprox folder to server, linux: var/www/html, windows: xammp.

edit php.ini: 

- post_max_size 1000M
- memory_limit = 2000M
----------------------------------------------------------------------
In test1 folder.

test1/config.php: update to your database settings

execute test1/sql.sql

navigate in browser:
localhost/devprox/test1

------------------------------------------------------------------------
In test2 folder.

test2/config.php: update to your database settings

execute test2/sql.sql

navigate in browser:
localhost/devprox/test2

Generating 1000000 nodes takes a while but does work.

After creating the CSV the upload to database is relatively quicker.

If file uploading does not work, please check the permissions for the folders and files related, the file gets stoed in the storage folder.