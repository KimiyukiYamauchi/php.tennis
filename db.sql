create database tennis;

use tennis;

create table bbs(
  id int not null auto_increment primary key,
  name varchar(255) not null,
  title varchar(255),
  body text not null,
  date datetime not null,
  pass char(4) not null
) default character set=utf8;

create table users(
  id int primary key not null auto_increment,
  name varchar(255) not null,
  password varchar(255) not null
) default character set=utf8;

insert into users (name, password) values
('yamada', sha2('yamadapass', 256)),
('tanaka', sha2('tanakapass', 256)),
('kikuchi', sha2('kikuchipass', 256));

grant all on tennis.* to 'tennisuser'@'localhost' identified by 'password';
flush privileges;

create table profiles (
  id int primary key not null,
  name varchar(50) not null,
  body text,
  mail varchar(255)
) default character set=utf8;

insert into profiles values
  (1, '山田太郎', null, null),
  (2, '田中次郎', null, null),
  (3, '菊池三郎', null, null);


SET PASSWORD FOR root@localhost = PASSWORD('pass');

mysql --port 3336 -u root -p < 230614.sql

mysql --port 3336 -u root -p