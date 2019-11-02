



create table user(

    id int primary key auto_increment,
    user varchar(20) not null ,
    pass varchar(20) not null,
    sex int
)default charset=UTF8;



insert into user('user','pass','sex') values ('1222','32523',1);

