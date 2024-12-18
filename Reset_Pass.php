<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>

<!-- CSS files -->
<link rel="stylesheet" href="./style/css/bootstrap.css">
<link rel="stylesheet" href="./style/JS/bootstrap.JS">
<link rel="stylesheet" href="./style/Login.css" >
<link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/headers/">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
<link href="/docs/5.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<!-- Meta Infos -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Acadimic Advising system">
<meta name="author" content="Eythar Alghamdi">
<title>Murshdy</title>


<!-- Favicons -->    

<link rel="icon" type="image/png" href="./images/logo-transparent.png">
</head>
 
<body>

<!-- Header start HERE -->
<header>
<div class="px-3 py-2 text-bg-light border-bottom">
<div class="container">
<div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
<a href="#" class="d-flex align-items-center my-2 my-lg-0 me-lg-auto text-white text-decoration-none">
<img src="./images/logo-no-background.png" alt="Logo" width="180" ></a>
<ul class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small">
<li>
<a href="#" class="nav-link text-secondary">Log In</a>
</li>
<li>
<a href="https://www.ub.edu.sa" class="nav-link text-secondary">University Home page</a>
</li>
<li>
<a href="#" class="nav-link text-secondary">Contact Us</a>
</li>         
</ul>
</div>
</div>
</div>
</header>
<!-- Header End HERE -->


<!-- Form start HERE -->
<div class="d-flex align-items-center py-4 bg-body-white" style="height: 61%">
<main class="form-signin w-100 m-auto">
<form>   
<center> <h2 class="h2 mb-3 fw-normal center" style="color: #2C5899"> Reset your password</h2>
<div class="form-floating">
<input  class="form-control" id="floatingInput" placeholder="name@example.com">
<label for="floatingInput">User name</label>
</div>
<div class="form-floating">
<input type="Email" class="form-control" id="floatingEmail" placeholder="Password">
<label for="floatingPassword">Email</label>
</div>
<div class="my-3">
</div>

<button class="btn btn-primary w-100 py-2" type="submit" style="background-color: #04AA6D; border: red" onclick="Reset()">Reset</button>
<script>
function Reset() {
  alert("Password reset request sent successfully!");
}
</script> 
</form>
</main>
</div>
<!-- Form Enf HERE -->

<!-- Footer start HERE -->
<footer class="bg-dark text-light text-center text-md-left">	
<p class="text-center text-white border-top border-secondary py-4">
<img src="./images/Logo_Uni.png" alt="Logo" width="200" >

<br>
<br>
</p>
</div>
</footer>
<!-- Footer End HERE -->


</body>
</html>