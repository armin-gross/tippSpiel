function neuesFeld(){
  console.log("sepp");
  eingabe = document.createElement("input");
  eingabe.setAttribute('class', "eingabefeld");
  eingabe.setAttribute('type',"text");

  document.getElementsByTagName('body')[0].appendChild(eingabe);
}
