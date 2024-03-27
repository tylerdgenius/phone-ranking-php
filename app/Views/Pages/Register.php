<?php 


session_start();

if(isset($_SESSION['email'])) {
    header("Location: home");
    exit;
}

    $errors = [];

    require_once MODELS . "UserModel.php";

    if(isset($_POST) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['username'])) {
        $userModel = new UserModel();

        $registerData = $userModel->createUser($_POST['email'], $_POST['username'], $_POST['password']);

        if(isset($registerData) && !$registerData['status']) {
            $errors = $registerData['payload'];
        }


        if(isset($registerData) && $registerData['status'] == true) {
            // header("Location: login");
        }
    }

?>

<main class="container-fluid row vh-100">
    <div class="col-lg-6 col-12 p-5 bg-white">
        <a class="fs-1 text-decoration-none text-danger" href='home'>Phone Recommendation</a>
        <h3  class="text-danger mt-5 text-black opacity-50">Welcome</h3>
        <p>You can signup using the form below</p>
        <form class="mt-5" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" >
            <label for='email'>Email Address</label>
            <div class="mt-1"></div>
            <input id='emailInput' name='email' type='text' class="w-100 border-0 py-2 px-3 bg bg-light rounded-2" placeholder="Enter your email" autofocus />
            <?php
                if(isset($errors)) {
                    foreach($errors as $error) {
                        if($error['type'] == 'email' || $error['type'] == 'both') {
                        echo "<div id='emailError' class='bg bg-danger rounded-2 bg-opacity-50 mt-2 p-2 text-white '>{$error['error']}</div>";
                        }
                    }
                }
            ?>

            <label for='email' class="mt-2">Username</label>
            <div class="mt-1"></div>
            <input id='usernameInput' name='username' type='text' class="w-100 border-0 py-2 px-3 bg bg-light rounded-2" placeholder="Enter your username" />
            <?php
                if(isset($errors)) {
                    foreach($errors as $error) {
                        if($error['type'] == 'email' || $error['type'] == 'both') {
                        echo "<div id='usernameError' class='bg bg-danger rounded-2 bg-opacity-50 mt-2 p-2 text-white '>{$error['error']}</div>";
                        }
                    }
                }
            ?>

            <label for='password' class="mt-2">Password</label>
            <div class="d-flex mt-1 align-items-center w-100 py-2 rounded-2 bg bg-light px-3 gap-3">
                <input type='password' name='password' id="passwordInput" class="flex-fill  border-0 bg-transparent" placeholder="*******" />
                <i class="material-icons cursor-pointer" id='password-visibility'>
                    visibility
                </i>
            </div>
            <?php
            
            if(isset($errors)) {
                foreach($errors as $error) {
                    if($error['type'] == 'password' || $error['type'] == 'both') {
                    echo "<div id='passwordError' class='bg bg-danger rounded-2 bg-opacity-50 mt-2 p-2 text-white '>{$error['error']}</div>";
                    }
                }
            }
            
            ?>

            <button type='submit' class="btn btn-danger mt-3">Login</button>
        </form>
        <p class="mt-5">
            Got an account? <a href="login" class="text-danger text-decoration-none ">Login now!</a>
        </p>
    </div>
    <div class="col-lg-6 p-5 bg-white d-lg-flex d-none justify-content-center align-items-center">
        <div class="bg-light rounded-2 w-100 h-100">
            <img class="rounded-2 object-fit-cover h-100 w-100" src="https://media.es.wired.com/photos/644827f3a566376ee967ba56/16:9/w_2580,c_limit/Apple-iPhone-14-Pro-Colors-Gear.jpg" alt='iphones' />
        </div>
    </div>
</main>