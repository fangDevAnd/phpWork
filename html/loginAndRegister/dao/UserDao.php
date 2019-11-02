<?php


//class UserDao
//{
//
//
//    public function registerUser(User $user)
//    {
//
//    }
//
//    public function isExistUser(User $user)
//    {
//        DaoHelper::query("select count from user", function ($obj) {
//            //闭包回调
//            echo $obj + "数据";
//        });
//
//    }
//
//}


//$dao = new UserDao();

//$dao::isExistUser(new User("223", "22424", 1));//1代表男  0代表女

//DaoHelper::insert("insert into user('user','pass','sex') values ('1222','32523',1);")


//$conn = mysqli_connect("localhost", "root", "123");


$conn = mysqli_connect("localhost", "root", "123","db1");


//$conn=mysql_connect("localhost","root","123");


//$stmt = new PDO('mysql:host=localhost;dbname=db1', 'root', '123');




if(!$conn){
    echo "连接出错";
}

//print phpinfo();





?>