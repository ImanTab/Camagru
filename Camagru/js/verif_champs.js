var pass = "";

function light_on(champ, erreur)
{
   if(erreur)
      champ.style.backgroundColor = "#fba";
   else
      champ.style.backgroundColor = "#9AF6AE";
}

function verifPseudo(champ)
{
   if(champ.value.length < 2 || champ.value.length > 25)
   {
      light_on(champ, true);
      return false;
   }
   else
   {
      light_on(champ, false);
      return true;
   }
}

function verifMail(champ)
{
   var regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
   if(!regex.test(champ.value))
   {
      light_on(champ, true);
      return false;
   }
   else
   {
      light_on(champ, false);
      return true;
   }
}

function verifPass(champ)
{
	var el = document.getElementById('passw');
	var regex = /[A-Za-z]+[0-9]/;

	if (typeof el.addEventListener != "undefined") {
	    el.addEventListener("keyup", function(evt) {
	        pass = el.value;
	    }, false);
	}
   if(!regex.test(champ.value))
   {
      light_on(champ, true);
			// champ.placeholder = "Votre mot de passe doit être composé de lettres ET de chiffres";
			// champ.placeholder.style.color = "red";
      return false;
   }
   else
   {
      light_on(champ, false);
			return true;
   }
}

function verifConfirm(champ)
{
	// pass = verifPass();
	console.log("pass = "+pass);
   if((champ.value) != pass)
   {
      light_on(champ, true);
      return false;
   }
   else
   {
      light_on(champ, false);
      return true;
   }
}

function verifForm(f)
{
   var pseudoOk = verifPseudo(f.pseudo);
	 var mailOk = verifMail(f.email);
	 var passOk = verifPass(f.password);
   var confirmOk = verifConfirm(f.confirm);

   if(pseudoOk && mailOk && passOk && confirmOk)
      return true;
   else
   {
      alert("Veuillez remplir correctement tous les champs");
      return false;
   }
}
