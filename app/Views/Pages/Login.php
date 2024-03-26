<?php 


session_start();

if(isset($_SESSION['email'])) {
    header("Location: home");
    exit;
}

    $errors = [];

    require_once MODELS . "UserModel.php";

    if(isset($_POST) && isset($_POST['email']) && isset($_POST['password'])) {
        $userModel = new UserModel();

        $loginData = $userModel->loginUser($_POST['email'], $_POST['password']);

        if(isset($loginData) && !$loginData['status']) {
            $errors = $loginData['payload'];
        }


        if(isset($loginData) && $loginData['status'] == true) {
            var_dump($loginData);
            $_SESSION['email'] = $loginData['payload']['email'];
            $_SESSION['id'] = $loginData['payload']['id'];
            $_SESSION['username'] = $loginData['payload']['username'];
            $_SESSION['token'] = $loginData['payload']['token'];

            header("Location: home");
        }
    }

?>

<main class="container-fluid row vh-100">
    <div class="col-lg-6 col-12 p-5 bg-white">
        <h1 class="text-danger">Welcome back!</h1>
        <p>You can log into your account using the form below</p>
        <form class="mt-5" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" >
            <label for='email'>Email Address</label>
            <div class="mt-1"></div>
            <input name='email' type='text' class="w-100 border-0 py-2 px-3 bg bg-light rounded-2" placeholder="Enter your email" autofocus />
            <?php
            if(isset($errors)) {
                foreach($errors as $error) {
                    if($error['type'] == 'email' || $error['type'] == 'both') {
                    echo "<div class='bg bg-danger rounded-2 bg-opacity-50 mt-2 p-2 text-white '>{$error['error']}</div>";
                    }
                }
            }
            
            
            ?>
            <div class="mt-2"></div>
            <label for='password'>Password</label>
            <div class="mt-1"></div>
            <div class="d-flex align-items-center w-100 py-2 rounded-2 bg bg-light px-3 gap-3">
                <input type='password' name='password' class="flex-fill  border-0 bg-transparent" placeholder="*******" />
                <i class="material-icons cursor-pointer" id='password-visibility'>
                    visibility
                </i>
            </div>
            <?php
            
            if(isset($errors)) {
                foreach($errors as $error) {
                    if($error['type'] == 'password' || $error['type'] == 'both') {
                    echo "<div class='bg bg-danger rounded-2 bg-opacity-50 mt-2 p-2 text-white '>{$error['error']}</div>";
                    }
                }
            }
            
            ?>
            
            <div class="mt-4"></div>
            <button type='submit' class="btn btn-danger">Login</button>
        </form>
    </div>
    <div class="col-lg-6 p-5 bg-white d-lg-flex d-none justify-content-center align-items-center">
        <div class="bg-light rounded-2 w-100 h-100">
            <img class="rounded-2 object-fit-cover h-100 w-100" src="https://media.es.wired.com/photos/644827f3a566376ee967ba56/16:9/w_2580,c_limit/Apple-iPhone-14-Pro-Colors-Gear.jpg" alt='iphones' />
        </div>
    </div>
</main>