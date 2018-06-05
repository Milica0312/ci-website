<!DOCTYPE html>
<html lang="en" >

  <head>
    <meta charset="UTF-8">
    <title>CRYPTOCURRENCY INVESTMENT</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/canvas.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" type="image/png" sizes="96x96" href="imgs/favicon-96x96.png">
    <link rel="apple-touch-icon" sizes="180x180" href="imgs/apple-icon-180x180.png">


    <script src='https://www.google.com/recaptcha/api.js?hl=en'></script>
  </head>
  <body>

    <div class="content-holder">
      <div class="contact-holder">

        <form action="#">


          <div class="row">
            <input type="text" name="fancy-text" id="ime"/>
            <label for="fancy-text">Ime i prezime</label>
              <p class="error" id="ime_error"></p>
          </div>
          <div class="row">
            <input type="email" name="fancy-text" id="email"/>
            <label for="fancy-text">Email</label>
            <p class="error" id="email_error"></p>
          </div>
          <div class="row">
            <input type="tel" name="fancy-text" id="broj"/>
            <label for="fancy-text">Broj telefona</label>
            <p class="error" id="broj_error"></p>
          </div>

          <div class="row">
            <textarea name="fancy-textarea" id="notes"></textarea>
            <label for="fancy-textarea">Navesti kada i kako je najbolje kontaktirati Vas</label>
            <p class="error" id="notes_error"></p>
          </div>
          <div class="row">
            <textarea name="fancy-textarea" id="upit"></textarea>
            <label for="fancy-textarea">Upit</label>
            <p class="error" id="upit_error"></p>
          </div>
          <div class="row">
            <div class="g-recaptcha" data-sitekey="6LcwwVsUAAAAACSb574xx--lZzT9gL32aUJyVT46" data-callback="recaptchaCallback"></div>
          </div>
          <button onclick="return upis();" tabindex="0">Pošalji</button>
          <div id="placefortable"></div>
        </form>


      </div>
      <div class="navholder">
        <nav id='flexmenu'>
          <div class="logo">
              <img class="logoimg" src="imgs/logo_boja.png" alt=""  />
          </div>

          <div id="mobile-toggle" class="button"></div>
          <ul id="main-menu">
            <li><a href="index.html" class="hvr-sweep-to-right">POČETNA</a>  </li>
              <li><a href="onama.html" class="hvr-sweep-to-right">O NAMA</a></li>
              <li><a href="usluge.html" class="hvr-sweep-to-right">USLUGE</a></li>
              <li><a href="#" class="hvr-sweep-to-right">BLOG</a></li>
              <li><a href="kontakt.php" class="hvr-sweep-to-right">KONTAKT</a></li>
            <li>  <a href="edukacija.html" class="hvr-sweep-to-right">EDUKACIJA</a></li>
          </ul>
        </nav>
      </div>

    </div>
      <div id="particle-canvas" class="heigher"></div>
    <footer class="" style="position:relative;">
      <p>&copy; 2018 CRYPTOCURRENCY INVESTMENT<br />Sva prava zadržana. <br /><a style="color:white; padding:5px;" href="http://doublemp-solutions.com" target="_blank">Doublemp Tim</a><p>

        <div class="documents">
          <a href="Politika privatnosti.docx" >Privacy Policy</a>
          <a href="Uslovi korišćenja.docx" >Uslovi korišćenja</a>
    </footer>


    <script>
      function upis(){
          var ime = document.getElementById("ime").value;
          //var ime_slavljenik = document.getElementById("ime_slavljenik").value;
          var email =  document.getElementById("email").value;


          //var datum = $(".datum:checked").val();
          var broj =  document.getElementById("broj").value;

          var notes =  document.getElementById("notes").value;
          var upit =  document.getElementById("upit").value;

             var ind=0;
          if (ime===null || ime===''){
            document.getElementById("ime_error").innerHTML = "Molimo vas popunite polje.";
            ind=1;
          }
                  if (email===null || email===''){
            document.getElementById("email_error").innerHTML = "Molimo vas popunite polje.";
            ind=1;
          }
          if (broj===null || broj===''){
    document.getElementById("broj_error").innerHTML = "Molimo vas popunite polje.";
    ind=1;
  }
                  if(notes===null || notes===''){
            document.getElementById("notes_error").innerHTML = "Molimo vas popunite polje.";
            ind=1;
          }
          if(upit===null || upit===''){
    document.getElementById("upit_error").innerHTML = "Molimo vas popunite polje.";
    ind=1;
  }

                  if(ind===1){
            return false;
            /*document.getElementById("email_error").innerHTML = email;
            document.getElementById("broj_error").innerHTML = broj;
            //var ime_slavljenik =  $("#ime_slavljenik:selected").val();
            document.getElementById("datum_ostavljanja_error").innerHTML = datum_ostavljanja;
            document.getElementById("vreme_dolaska_error").innerHTML = vreme_dolaska;
            document.getElementById("datum_preuzimanja_error").innerHTML = datum_preuzimanja;*/
            //window.location="./#potvrda";
          }
          else{
            var ime = document.getElementById("ime").value;
            //var ime_slavljenik = document.getElementById("ime_slavljenik").value;
            var email =  document.getElementById("email").value;
              var broj =  document.getElementById("broj").value;

            //var datum = $(".datum:checked").val();
            var notes =  document.getElementById("notes").value;
            var upit =  document.getElementById("upit").value;


            $.ajax({

              type:"POST",
              url: "upisvip.php",
              cashe: false,
              //data: dataString,
              data: {ime:ime,email:email,broj:broj,notes:notes,upit:upit,captcha:grecaptcha.getResponse()},

              success: function(data){
                document.getElementById("placefortable").innerHTML = data;
               //window.location.href = "thankyou.php";
               /* window.alert(data);*/
                /*
                if(data == "Hvala na postavljenom pitanju. Očekujte odgovor u roku od 24h."){
                 document.getElementById("kontaktfrmanone").style.display = "none";
                 document.getElementById("placefortable").innerHTML = data;
                 document.getElementById("placefortable").style.color = "#000000";
                }
                else{
                  document.getElementById("placefortable").innerHTML = data;
                  document.getElementById("placefortable").style.color = "#ed1a3b";
                }*/
              },
              error: function (req, status, err) {
                //alert(data);
            console.log('Something went wrong', status, err);
            }
            })
            return false;
          }

      }

      </script>

    <script type="text/javascript" src="https://files.coinmarketcap.com/static/widget/currency.js"></script>
    <script  src="js/canvas.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js'></script>
    <script src='https://code.jquery.com/ui/1.12.1/jquery-ui.min.js'></script>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script  src="js/main.js"></script>
  </body>

</html>
