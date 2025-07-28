<?php
    include './components/connection.php';
    session_start();

    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
    }else{
        $user_id = '';
    }

    if (isset($_POST['logout'])) {
        session_destroy();
        header('location: login.php');
    }
    if(isset($_POST['submit-btn'])){
        $id = unique_id();
        $name = $_POST['name'];
        $name = filter_var($name, FILTER_SANITIZE_STRING);
        $email = $_POST['email'];
        $email = filter_var($email, FILTER_SANITIZE_STRING);
        $number = $_POST['number'];
        $number = filter_var($number, FILTER_SANITIZE_STRING);
        $msg = $_POST['message'];
        $msg = filter_var($msg, FILTER_SANITIZE_STRING);
        
        
        $select_message = $conn->prepare( "SELECT * FROM `message` WHERE name = ? AND message = ?");
        $select_message->execute([$name, $msg]);
        
        if($select_message->rowCount() > 0){
           $warning_msg[] = 'message sent already!';
        }else{
            $insert_message = $conn->prepare( "INSERT INTO `message`(message_id, user_id, name, email, number, message) VALUES(?,?,?,?,?,?)");
            $insert_message->execute([$id, $user_id, $name, $email, $number, $msg]);
            $success_msg[] = 'message sent successfully!';
        }
    }
?>
<style type="text/css">
    <?php include './style.css'; ?>
</style>    

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    
    <title>Green Coffee - Contact Us Page</title>
</head>
<body>
    <?php 
        include './components/header.php'; 
    ?>
    <div class="main">
     <div class="banner">
            <h1>Contact Us</h1>
        </div>
        <div class="title2">
            <a href="home.php">Home </a><span>/ Contact Us</span>
        </div>
        <section class="services">
            <div class="box-container">
                <div class="box">
                    <img src="./img/icon2.png" alt="">
                    <div class="detail">
                        <h3>Great Savings</h3>
                        <p>save big every order</p>
                    </div>
                </div>

                <div class="box">
                    <img src="./img/icon1.png" alt="">
                    <div class="detail">
                        <h3>24*7 Support</h3>
                        <p>one-on-one support</p>
                    </div>
                </div>

                <div class="box">
                    <img src="./img/icon0.png" alt="">
                    <div class="detail">
                        <h3>Gift Vouchers</h3>
                        <p>vouchers on every festivals</p>
                    </div>
                </div>

                <div class="box">
                    <img src="./img/icon.png" alt="">
                    <div class="detail">
                    <h3>Cash On Delivery</h3>
                    <p>all srilanka delivery</p>
                    </div>
                </div>                
            </div>
        </section>
        <div class="form-container">
            <form method="post">
                <div class="title">
                    <img src="./img/download.png" class="logo">
                    <h1>Leave A Message</h1>
                </div>
                <div class="input-field">
                    <p>Your Name <sub>*</sub></p>
                    <input type="text" name="name" required>
                </div>
                <div class="input-field">
                    <p>Your Email <sub>*</sub></p>
                    <input type="email" name="email" required>
                </div>
                <div class="input-field">
                    <p>Your Number <sub>*</sub></p>
                    <input type="tel" name="number" required>
                </div>
                <div class="input-field">
                    <p>Your Message <sub>*</su></p>
                    <textarea name="message" required></textarea>
                </div>
                <button type="submit" name="submit-btn" class="btn">Send Message</button>

            </form>
            
        </div>
        <div class="address">
                <div class="title">
                    <img src="./img/download.png" class="logo">
                    <h1>Contact Detail</h1>
                    <p>Reach Out to Us for Questions or Support Anytime!</p>
                
                </div>
                <div class="box-container">
                    <div class="box">
                        <i class="bx bxs-map-pin"></i>
                        <div>
                            <h4>Address</h4>
                            <p> vadodara</p>
                        </div>
                    </div>

                    <div class="box">
                        <i class="bx bxs-phone-call"></i>
                        <div>
                            <h4>Phone Number</h4>
                            <p>0753973856</p>
                        </div>
                    </div>

                    <div class="box">
                        <i class="bx bxl-gmail"></i>
                        <div>
                            <h4>email</h4>
                            <p>greencoffee@gmail.com</p>
                        </div>
                    </div>
                </div>
            </div> 
        


        <?php include './components/footer.php'; ?>
        
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="./script.js"></script>
    <?php include './components/alert.php'; ?>
</body>
</html>