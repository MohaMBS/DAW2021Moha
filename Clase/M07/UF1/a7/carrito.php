<!DOCTYPE html>
<?php 
require ("funcciones.php");
if (!isset($_SESSION["control"])){
    header("Location: login.php?error=1");
}
?>
<html>
  <head>
    <title>Buy cool new product</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://polyfill.io/v3/polyfill.min.js?version=3.52.1&features=fetch"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <style>
    img{
        width: 100px;
        high:75px;
    }
    </style>
  </head>
  <body>
    <section>
      <div class="product">
        <div class="description">
          <table>
          <?php 
            $_SESSION["precioPagar"]=0;
            if (isset($_SESSION["carritoUser"])){
                if(empty($_SESSION["carritoUser"])){
                    ?>
                    <h1 style="color:red;">No tienes nada en tu carrito :...</h1>
                    <?php
                }else{
                    ?>
                    <table>
                    <tr>
                        <td><h3>Nom</h3></td>
                        <td><h3>descripcio</h3></td>
                        <td><h3>Imatge</h3></td>
                        <td><h3>Preu</h3></td>
                        <td><h3>Categoria</h3></td>
                    </tr>
                    <tr>
                    <?php
                    foreach ($_SESSION["carritoUser"] as &$value) {
                        echo (BuscarPro("",true,$value));
                        $_SESSION["precioPagar"]+=buscarPrecio($value);
                    }
                    ?>
                    </tr>
                    <tr>
                        <td colspan=5><p>Precio a pagar: <?echo $_SESSION["precioPagar"];?>€</p></td>
                    </tr>
                    </table>
                    <?php
                }
            }else{
                echo('<h1 style="color:red;">No tienes nada en tu carrito :...</h1>');
            }
            ?>
          </table>
        </div>
      </div>
      <button id="checkout-button">PAGAR</button>
      <form action="privada.php">
        </br>
        <input type="submit" value="Volver" style="color:red;">
      </form>
    </section>
  </body>
  <script type="text/javascript">
    // Create an instance of the Stripe object with your publishable API key
    var stripe = Stripe("pk_test_51HoC71IphK9Qq3yqtE1ALnakYkSa8hDVatwKUhwlKYrvXovkGKwPVCvn2GUzjMSFWI6H0KNyOpjfTPft9snyPt7500nWeyB0Ir");
    var checkoutButton = document.getElementById("checkout-button");
    checkoutButton.addEventListener("click", function () {
      fetch("create-session.php", {
        method: "POST",
      })
        .then(function (response) {
          return response.json();
        })
        .then(function (session) {
          return stripe.redirectToCheckout({ sessionId: session.id });
        })
        .then(function (result) {
          // If redirectToCheckout fails due to a browser or network
          // error, you should display the localized error message to your
          // customer using error.message.
          if (result.error) {
            alert(result.error.message);
          }
        })
        .catch(function (error) {
          console.error("Error:", error);
        });
    });
  </script>
</html>