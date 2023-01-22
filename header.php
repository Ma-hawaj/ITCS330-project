<?php
// session_start();

if (!isset($_SESSION)) {
  session_start();
}
 ?>

<header class="navbar">
    <div class="webName">
      <a class="title" href="home.php">Smart Thing</a>

    </div>
    <button class="toggle-menu">
      <span class="bar"></span>
      <span class="bar"></span>
      <span class="bar"></span>
    </button>
    <div class="links">
      <ul>
            <li><a href="allProducts.php">All items</a>
                <div class="sub-menu">
                    <ul>
                        <li><a href="allProducts.php?cat=0">Voice assistants</a></li>
                        <li><a href="allProducts.php?cat=1">Smart switches</a></li>
                        <li><a href="allProducts.php?cat=2">Smart lights</a></li>
                        <li><a href="allProducts.php?cat=3">Smart sensors</a></li>
                        <li><a href="allProducts.php?cat=4">Smart plugs</a></li>
                        <li><a href="allProducts.php?cat=5">Smart controllers</a></li>

                    </ul>

                </div>


            </li>
            <li><a href="aboutUs.php">about us</a></li>

            <?php
              if(!isset($_SESSION['user'])){
                echo "  <li><a href='login.php'>login</a></li>
                <li><a href='register.php'>register</a></li>";
              }
              else {
                if($_SESSION['user']['admin'] == true){
                  echo "<li><a href='homeadmin.php'>Adminstration</a></li>";
                }
                echo "  <li><a href='viewCart.php'>cart</a></li>
                <li><a href='singout.php'>sign out</a></li>";
              }
             ?>


      </ul>
    </div>
</header>
<script>
const toggleButton = document.getElementsByClassName('toggle-menu')[0]
const linkss = document.getElementsByClassName('links')[0]

toggleButton.addEventListener('click', ()=>{

  linkss.classList.toggle('active')
})

</script>
