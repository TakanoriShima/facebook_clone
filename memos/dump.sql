create database facebook default character set utf8;
use facebook;
create table users(
    id int auto_increment primary key,
    name varchar(255) not null,
    email varchar(255) not null unique,
    password varchar(255) not null,
    image varchar(255) not null,
    created_at timestamp default CURRENT_TIMESTAMP,
    updated_at timestamp
);
insert into users(name, email, password, image) values('iwai', 'iwai@gmail.com', 'iwai', '1.jpg');
create table posts(
    id int auto_increment primary key,
    user_id int not null,
    title varchar(255) not null,
    content varchar(255) not null,
    image varchar(255) not null,
    created_at timestamp default CURRENT_TIMESTAMP,
    updated_at timestamp,
    foreign key(user_id) references users(id)
    on delete cascade
    on update cascade
);
insert into posts(user_id, title, content, image) values(1, 'test', 'hello', 'test.jpg');
desc users;
select * from users;
desc posts;
select * from posts;
select posts.id, users.name, posts.title, posts.content, posts.image from posts join users on posts.user_id=users.id;