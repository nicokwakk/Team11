//Taken from http://www.randomsnippets.com/2008/02/21/how-to-dynamically-add-form-elements-via-javascript/

var counter = 1;

var limit = 10;



function addInput(divName){
  console.log("1");
     if (counter == limit)  {

          alert("You have reached the limit of adding " + counter + " inputs");

     }

     else {

          var newdiv = document.createElement('div');

          newdiv.innerHTML = "Specification " + (counter + 1) + " <br><input type='text' name='spec" +(counter+1) +"'>";

          document.getElementById(divName).appendChild(newdiv);

          counter++;

     }

}
