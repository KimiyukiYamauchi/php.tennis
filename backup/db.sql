grant all on tennis.* to 'tennisuser'@'localhost' identified by 'password';
flush privileges;

SET PASSWORD FOR root@localhost = PASSWORD('pass');

mysql --port 3336 -u root -p < 230614.sql

mysql --port 3336 -u root -p