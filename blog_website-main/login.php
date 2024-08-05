<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            margin-top: 50px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
        }
        .form-group button {
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
        }
        .register-link {
            margin-top: 15px;
            display: block;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Admin Login</h2>
        <form action="authenticate.php" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <button type="submit">Login</button>
            </div>
        </form>
        <a href="register.php" class="register-link">New user? Register here</a> -->
    <!-- </div>
</body>
</html>  -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Mastery</title>
   <style>/* Reset CSS */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    
    body, html {
        font-family: Arial, sans-serif;
    }
    
    header {
        background-color: #663399;
        color: white;
        padding: 10px 20px;
    }
    
    .header-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .logo {
        height: 50px;
    }
    
    nav ul {
        list-style: none;
        display: flex;
        gap: 20px;
    }
    
    nav ul li a {
        color: white;
        text-decoration: none;
        font-weight: bold;
    }
    
    .hero {
        position: relative;
        background: linear-gradient(180deg, #8bcdf9, #66ffba);
        color: white;
        /* padding: 50px 20px; */
        text-align: center;
        height: 100%;
    }
    
    .hero .content {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 20px;
        height: 600px;
    }
    
    .hero .hero-image img {
        width: 300px;
        border-radius: 10px;
    }
    
    .hero .hero-text {
        max-width: 600px;
    }
    
    .hero .hero-text h1 {
        font-size: 2.5em;
        margin-bottom: 10px;
    }
    
    .hero .hero-text p {
        font-size: 1.2em;
        margin-bottom: 20px;
    }
    
    .hero .hero-text input {
        padding: 10px;
        font-size: 1em;
        margin-right: 10px;
    }
    
    .hero .hero-text button {
        padding: 10px 20px;
        font-size: 1em;
        background-color: #4caf50;
        border: none;
        color: white;
        cursor: pointer;
    }
    
    .wave-container {
        position: absolute;
        bottom: 0;
        width: 100%;
        overflow: hidden;
        line-height: 0;
        top: 80%;
    }
    
    .wave-container .waves {
        position: relative;
        width: 100%;
        height: 150px;
    }
    
    .wave-container .parallax > use {
        animation: move-forever 25s cubic-bezier(0.55, 0.5, 0.45, 0.5) infinite;
    }
    
    .wave-container .parallax > use:nth-child(1) {
        animation-delay: -2s;
        animation-duration: 7s;
    }
    
    .wave-container .parallax > use:nth-child(2) {
        animation-delay: -3s;
        animation-duration: 10s;
    }
    
    .wave-container .parallax > use:nth-child(3) {
        animation-delay: -4s;
        animation-duration: 13s;
    }
    
    .wave-container .parallax > use:nth-child(4) {
        animation-delay: -5s;
        animation-duration: 20s;
    }
    
    @keyframes move-forever {
        0% {
            transform: translate3d(-90px, 0, 0);
        }
        100% {
            transform: translate3d(85px, 0, 0);
        }
    }
    .card {
        top: 40%;
  position: relative;
  width: 500px;
  height: 350px;
  border-radius: 14px;
  z-index: 1111;
  overflow: hidden;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  box-shadow: 5px 5px 15px #bebebe, -5px -5px 15px #ffffff;
  ;
}

.bg {
  position: absolute;
  top: 5px;
  left: 5px;
  width: 490px;
  height: 340px;
  z-index: 2;
  background: rgba(255, 255, 255, 0.763);
  backdrop-filter: blur(24px);
  border-radius: 10px;
  overflow: hidden;
  outline: 1px solid white;
  display: flex;
  justify-content:center ;
  align-items: center;
}

@keyframes blob-bounce {
  0% {
    transform: translate(-100%, -100%) translate3d(0, 0, 0);
  }

  25% {
    transform: translate(-100%, -100%) translate3d(100%, 0, 0);
  }

  50% {
    transform: translate(-100%, -100%) translate3d(100%, 100%, 0);
  }

  75% {
    transform: translate(-100%, -100%) translate3d(0, 100%, 0);
  }

  100% {
    transform: translate(-100%, -100%) translate3d(0, 0, 0);
  }
}
.container{
    color: black;
    width: 100%;

}
.form-group{
    /* margin: 20px; */
    padding: 10px;
}
.form-group h3{
    text-align: start;
    padding: 10px;
    margin-left: 40px;
 
}
input[type="text"], input[type="password"]{
    width: 80%;
    border-radius: 10px;
    padding: 10px;
    border: gray;
}

#submit-button{
    width: 50%;
    border-radius: 10px;
    padding: 10px;
    border: gray;
    background-color: #fff;
    cursor: pointer;
    font-weight: bold;
    /* display: flex; */
}
#submit-button:hover{
transform: scale(1.05);
background: linear-gradient(180deg, #8bcdf9, #66ffba);

}


    </style>
</head>
<body>

    <section class="hero">
        <div class="content">
            <div class="hero-image">
                <div class="card">
                    <div class="bg">
                    <div class="container">
        <h2>Admin Login</h2>
        <form action="authenticate.php" method="post">
            <div class="form-group">
                <h3>Username</h3>
                <input type="text" id="username" name="username" placeholder="Enter Username" required>
            </div>
            <div class="form-group">
                <h3>Password</h3>
                <input type="password" id="password" name="password" placeholder="Enter Password" required>
            </div>
            <div class="form-group">
                <button id="submit-button" type="submit">Login</button>
               <!-- <iframe src="https://lottie.host/embed/ae9f1d00-9a21-4df2-8adb-0db2662a2841/TzYpj3cHTe.json" style="width: 25px; height:
                    25px; margin:10px;" frameborder="0"></iframe> -->
            </div>
        </form>
        <a href="register.php" class="register-link">New user? Register here</a> 
    </div>
                    </div>
                    
                  </div>
            </div>
        </div>




        <div class="wave-container">
            <svg class="waves" xmlns="http://www.w3.org/2000/svg" viewBox="0 24 150 28" preserveAspectRatio="none">
                <defs>
                    <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z"/>
                </defs>
                <g class="parallax">
                    <use href="#gentle-wave" x="48" y="0" fill="rgba(255,255,255,0.7"/>
                    <use href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.5)"/>
                    <use href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.3)"/>
                    <use href="#gentle-wave" x="48" y="7" fill="#fff"/>
                </g>
            </svg>
        </div>
    </section>

</body>
</html>
