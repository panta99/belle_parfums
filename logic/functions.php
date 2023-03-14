<?php
    if($_SERVER['REQUEST_METHOD']== 'POST'){
    include "../config/connection.php";
    //Check if email is in the database
    function checkMailInDb($mail){
        global $conn;
        $upit = "SELECT * FROM users u WHERE u.email = :mail";
        $priprema = $conn->prepare($upit);
        $priprema->bindParam(':mail',$mail);
        $priprema->execute();
        $rezultat = $priprema->rowCount();
        return $rezultat;
    }
    //Insert user
    function regUpis($firstname,$lastname,$email,$passwd){
        global $conn;
        $activ_code = sendActivationMail($email);
        $sifPass = sha1($passwd);
        $upit = "INSERT INTO users (first_name, last_name, email, pass, activation_code, active, id_user_type) VALUES (:first_name,:last_name,:email,:pass,:activation_code,:active,:id_user_type)";
        $priprema = $conn->prepare($upit);
        $priprema->bindParam(':first_name',$firstname);
        $priprema->bindParam(':last_name',$lastname);
        $priprema->bindParam(':email',$email);
        $priprema->bindParam(':pass',$sifPass);
        $priprema->bindParam('activation_code',$activ_code);
        $priprema->bindValue(':active',1,PDO::PARAM_INT);
        $priprema->bindValue(':id_user_type',2,PDO::PARAM_INT);
        $priprema->execute();
        return 1;
    }
    //Send activation mail
    function sendActivationMail($email){
        $to = $email;
        $vreme = time();
        $activ_code = md5($vreme.$email);
        $subject = "BellePerfums - Activate your account";
        $message = "Hello, please activate your account by clicking on the following link: https://belle-parfums.000webhostapp.com/logic/activate_acc.php?activ_code=".$activ_code;
        $headers = "From: aleksa.pantic.102.19@ict.edu.rs\r\n";
        $headers .= "Reply-To: aleksa.pantic.102.19@ict.edu.rs\r\n";
        $headers .= "Content-Type: text/html\r\n";

        // Send the email using PHP's mail function
        ini_set('SMTP', 'localhost');
        ini_set('smtp_port', 25);
        if(mail($to, $subject, $message, $headers)){
            return $activ_code;
        } else {
            echo "Failed to send activation email.";
        }
    }
    //Check out login
    function checkLogIn($email,$sifPasswd){
        global $conn;
        $upit = "SELECT * FROM users u JOIN user_type ut ON u.id_user_type =ut.id_user_type  WHERE email = :email AND pass = :sifPasswd AND active=1";
        $priprema = $conn->prepare($upit);
        $priprema->bindParam(":email",$email);
        $priprema->bindParam(":sifPasswd",$sifPasswd);
        $priprema->execute();
        $rez = $priprema->fetch();
        return $rez;

    }}
    //Activate account with code
    function activateAcc($activ_code){
        global $conn;
        $drugiUpit = "SELECT active from users WHERE activation_code = :activ_code";
        $priprema2= $conn->prepare($drugiUpit);
        $priprema2->bindParam(":activ_code",$activ_code);
        $vrednost = $priprema2->execute();
        if($vrednost == 1)
        {
            header("Location: ../index.php");
            return "";
        }
        else{
        $upit = "UPDATE users SET active = :vrednost WHERE activation_code = :activ_code";
        $priprema = $conn->prepare($upit);
        $priprema->bindValue(":vrednost",1,PDO::PARAM_INT);
        $priprema->bindParam(":activ_code",$activ_code);
        $priprema->execute();
        return "Successfully activated account!";
        }
    }
    //Return brends
    function returnBrands(){
        global $conn;
        $upit = "SELECT * FROM brands ORDER BY id_brand DESC";
        $podaci = $conn->query($upit)->fetchAll();
        return $podaci;
    }
    //Get user data
    function getUsersData(){
        global $conn;
        $upit = "SELECT * FROM users u JOIN user_type ut ON u.id_user_type =ut.id_user_type WHERE u.deleted_at IS NULL";
        $podaci = $conn->query($upit)->fetchAll();
        return $podaci;
    }
    //Select user for delete
    function selektujZaBrisanje($id){
        global $conn;
        $upit = "SELECT * FROM users u JOIN user_type ut ON u.id_user_type =ut.id_user_type WHERE id_user=:id";
        $priprema = $conn->prepare($upit);
        $priprema->bindParam(":id",$id);
        $priprema->execute();
        $rezultat = $priprema->fetch();
        return $rezultat;
    }
    function obrisiKorisnika($id){
        global $conn;
        $timeStamp = time();
        $deleted_at = date("Y-m-d H:i:s",$timeStamp);
        $upit = "UPDATE users SET deleted_at=:deleted_at WHERE id_user=:id";
        $priprema = $conn->prepare($upit);
        $priprema->bindParam(":deleted_at",$deleted_at);
        $priprema->bindParam(":id",$id);
        $priprema->execute();
    }
    function returnBrandsAsc(){
        global $conn;
        $upit = "SELECT * FROM brands ORDER BY brand_name ASC";
        $podaci = $conn->query($upit)->fetchAll();
        return $podaci;
    }
    function getCategories(){
        global $conn;
        $upit = "SELECT * FROM categories";
        $podaci = $conn->query($upit)->fetchAll();
        return $podaci;
    }
    function getVolume(){
        global $conn;
        $upit = "SELECT * FROM volume";
        $podaci = $conn->query($upit)->fetchAll();
        return $podaci;
    }
    function checkBrand($brand){
        global $conn;
        $upit = "SELECT * FROM brands";
        $podaci = $conn->query($upit)->fetchAll();
        $vrednost = false;
        foreach($podaci as $pod){
            if($pod->id_brand ==$brand){
                $vrednost = true;
                break;
            }
            else{
                $vrednost = false;
            }
        }
        return $vrednost;
    }
    function checkCategory($category){
        global $conn;
        $upit = "SELECT * FROM categories";
        $podaci = $conn->query($upit)->fetchAll();
        $vrednost = false;
        foreach($podaci as $pod){
            if($pod->id_category == $category){
                $vrednost = true;
                break;
            }
            else{
                $vrednost = false;
            }
        }
        return $vrednost;
    }
    function checkVolume($volume){
        global $conn;
        $upit = "SELECT * FROM volume";
        $podaci = $conn->query($upit)->fetchAll();
        $vrednost = false;
        foreach($podaci as $pod){
            if($pod->id_volume == $volume){
                $vrednost = true;
                break;
            }
            else{
                $vrednost = false;
            }
        }
        return $vrednost;
    }
    function createNewProduct($brand,$category,$volume,$prName,$price,$discount,$file){
        global $conn;
        $putanja = "../assets/img/products/";
        $tmpFajla = $file['tmp_name'];
        $fileName = time().'_'.$file['name'];
        $timeStamp = time();
        $created_at = date("Y-m-d H:i:s",$timeStamp);
        move_uploaded_file($tmpFajla,$putanja .$fileName);
        $upit1 = "INSERT INTO products(product_name,id_brand,id_category,id_volume,img_path,created_at,deleted_at) VALUES(:prName,:brand,:category,:volume,:imgName,:created,:deleted)";
        $priprema = $conn->prepare($upit1);
        $priprema->bindParam(":prName",$prName);
        $priprema->bindParam(":brand",$brand);
        $priprema->bindParam(":category",$category);
        $priprema->bindParam(":volume",$volume);
        $priprema->bindParam(":imgName",$fileName);
        $priprema->bindParam(":created",$created_at);
        $priprema->bindValue(":deleted",NULL);
        $priprema->execute();
        $id_product = $conn->lastInsertId();
        if($discount == "" || $discount == 0){
            $discount = NULL;
        }
        $upit2 = "INSERT INTO prices(id_product,price,discount,created_at,deleted_at) VALUES(:id_product,:price,:discount,:created,:deleted)";
        $priprema2 = $conn->prepare($upit2);
        $priprema2->bindParam(":id_product",$id_product);
        $priprema2->bindParam(":price",$price);
        $priprema2->bindParam(":discount",$discount);
        $priprema2->bindParam(":created",$created_at);
        $priprema2->bindValue(":deleted",NULL);
        $priprema2->execute();
    }
    function insertOrder($firstName,$lastName,$city,$address,$phoneNumber,$products,$id_user){
        global $conn;
        $cena = null;
        $sent =0;
        $timeStamp = time();
        $created_at = date("Y-m-d H:i:s",$timeStamp);
        $upit = "INSERT INTO orders(id_user, price, created_at, deleted_at, first_name, last_name, city, `address`, phone_number) 
         VALUES (:idUser, :cena, :created_at, :deleted_at, :firstName, :lastName, :city, :adresa, :phoneNumber)";
        $priprema=$conn->prepare($upit);
        $priprema->bindParam(":idUser",$id_user);
        $priprema->bindValue(":cena",NULL);
        $priprema->bindParam(":created_at",$created_at);
        $priprema->bindValue(":deleted_at",NULL);
        $priprema->bindParam(":firstName",$firstName);
        $priprema->bindParam(":lastName",$lastName);
        $priprema->bindParam(":city",$city);
        $priprema->bindParam(":adresa",$address);
        $priprema->bindParam(":phoneNumber",$phoneNumber);
        $priprema->execute();
        $id_order = $conn->lastInsertId();
        $cenaUkupna = 0;
        foreach($products as $prod){
            $upit1 = "SELECT * FROM products p JOIN prices pr ON p.id_product=pr.id_product WHERE p.id_product=:product";
            $priprema = $conn->prepare($upit1);
            $priprema->bindParam(":product",$prod->id);
            $priprema->execute();
            $proizvod = $priprema->fetch();
            $cena = 0;
            if($proizvod->discount == null){
                $cena = $proizvod->price * $prod->kolicina;
            }
            else{
                $cena = $proizvod->discount * $prod->kolicina;
            }
            $upit2 = "INSERT INTO order_product(id_order, id_product, quantity, price) VALUES(:id_order,:id_product,:quantity, :price)";
            $cenaUkupna += $cena;
            $priprema2 =$conn->prepare($upit2);
            $priprema2->bindParam(":id_order",$id_order);
            $priprema2->bindParam(":id_product",$proizvod->id_product);
            $priprema2->bindParam(":quantity",$prod->kolicina);
            $priprema2->bindParam(":price",$cena);
            $priprema2->execute();
        }
        $upit3 = "UPDATE orders SET `price`=:cenaUkupna, `sent`=0 WHERE id_order=:id_order";
        $priprema3= $conn->prepare($upit3);
        $priprema3->bindParam(":cenaUkupna",$cenaUkupna);
        $priprema3->bindParam(":id_order",$id_order);
        $priprema3->execute();
    }
    function checkCurrentPassword($pass){
        global $conn;
        $nova = sha1($pass);
        $upit = "SELECT * FROM users WHERE pass=:lozinka";
        $priprema= $conn->prepare($upit);
        $priprema->bindParam(":lozinka", $nova);
        $priprema->execute();
        return $priprema->rowCount();
    }
    function changeProfile($firstName,$lastName,$oldPassword,$password,$email){
        session_start();
        $_SESSION['korisnik']->first_name=$firstName;
        $_SESSION['korisnik']->last_name=$lastName;
        global $conn;
        if($password ==''){
            $upit = "UPDATE users SET first_name=:first_name,last_name=:last_name WHERE email=:email";
            $priprema = $conn->prepare($upit);
            $priprema->bindParam("first_name",$firstName);
            $priprema->bindParam(":last_name",$lastName);
            $priprema->bindParam(":email",$email);
            $priprema->execute();
        }
        else{
            $sifPass = sha1($password);
            $upit = "UPDATE users SET first_name=:first_name,last_name=:last_name,pass=:pass WHERE email=:email";
            $priprema = $conn->prepare($upit);
            $priprema->bindParam("first_name",$firstName);
            $priprema->bindParam(":last_name",$lastName);
            $priprema->bindParam(":pass",$sifPass);
            $priprema->bindParam(":email",$email);
            $priprema->execute();
        }
    }
    function getOrders(){
        global $conn;
        $upit = "SELECT * FROM orders WHERE sent=0";
        $rezultat = $conn->query($upit)->fetchAll();
        return $rezultat;
    }
    function getProductsByOrder($id){
        global $conn;
        $upit = "SELECT * FROM order_product ord JOIN products p ON ord.id_product=p.id_product JOIN brands b ON p.id_brand=b.id_brand JOIN prices pr ON p.id_product=pr.id_product  WHERE ord.id_order =:id";
        $priprema = $conn->prepare($upit);
        $priprema->bindParam(":id",$id);
        $priprema->execute();
        return $priprema->fetchAll();
    }
    function promeniStatus($idSend){
        global $conn;
        $upit = "UPDATE orders SET `sent`=:vrednost WHERE id_order=:idSend";
        $priprema = $conn->prepare($upit);
        $priprema->bindValue(":vrednost",1);
        $priprema->bindParam(":idSend",$idSend);
        $priprema->execute();
    }
    function insertMessage($message,$idUser){
        global $conn;
        $upit = 'INSERT INTO messages(id_user, message_text) VALUES(:idUser,:textpor)';
        $priprema = $conn->prepare($upit);
        $priprema->bindParam(":idUser",$idUser);
        $priprema->bindParam(":textpor",$message);
        $priprema->execute();
    }
    function getMessages(){
        global $conn;
        $upit = "SELECT * FROM messages m JOIN users u ON m.id_user=u.id_user WHERE m.deleted_at IS NULL ORDER BY m.id_message DESC";
        $rezultat = $conn->query($upit)->fetchAll();
        return $rezultat;
    }
    function getProductsForDelete(){
        global $conn;
        $upit = "SELECT * FROM products p JOIN brands b ON p.id_brand=b.id_brand JOIN volume v ON p.id_volume=v.id_volume WHERE p.deleted_at IS NULL ORDER BY p.id_product DESC";
        $rezultat = $conn->query($upit)->fetchAll();
        return $rezultat;
    }
    function deleteProduct($id){
        global $conn;
        $timeStamp = time();
        $deleted = date("Y-m-d H:i:s",$timeStamp);
        $upit = "UPDATE products SET deleted_at=:deleted WHERE id_product=:id";
        $priprema = $conn->prepare($upit);
        $priprema->bindParam("deleted",$deleted);
        $priprema->bindParam("id",$id);
        $priprema->execute();
    }
    function isThereActivePoll($id){
        global $conn;
        $upit="SELECT * FROM poll p JOIN poll_answer_user pau ON p.id_poll=pau.id_poll WHERE pau.id_user=:id AND p.active=:aktivno";
        $priprema = $conn->prepare($upit);
        $priprema->bindParam(":id",$id);
        $priprema->bindValue(":aktivno", 1);
        $priprema->execute();
        $priprema->fetchAll();
        $rez = $priprema->rowCount();
        if($rez){
            return 0;
        }
        else{
            return 1;
        }
    }
    function getPollId(){
        global $conn;
        $upit="SELECT * FROM poll WHERE active=1";
        $rez = $conn->query($upit);
        $rez = $rez->fetch();
        return $rez;
    }
    function getAnswers($id){
        global $conn;
        $upit = "SELECT * FROM poll_answer WHERE id_poll=:id";
        $priprema = $conn->prepare($upit);
        $priprema->bindParam(":id",$id);
        $priprema->execute();
        $rez = $priprema->fetchAll();
        return $rez;
    }
    function writeAnswer($idAns,$idUser,$idPoll){
        global $conn;
        $upit = "INSERT INTO poll_answer_user(id_user, id_poll,id_answer) VALUES (:idUser,:idPoll,:idAns)";
        $priprema = $conn->prepare($upit);
        $priprema->bindParam(":idUser",$idUser);
        $priprema->bindParam(":idPoll",$idPoll);
        $priprema->bindParam(":idAns",$idAns);
        $priprema->execute();
    }
    function numberOfVotes($id){
        global $conn;
        $upit= "SELECT * FROM poll_answer_user WHERE id_answer=:id";
        $priprema= $conn->prepare($upit);
        $priprema->bindParam(":id",$id);
        $priprema->execute();
        return $priprema->rowCount();
    }

?>