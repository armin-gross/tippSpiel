let ueberpruefung = 0;
function neuesFeld(i, mannschaftA, mannschaftB, anzahlSpiele){
  //überprüfung ob die anzahl der Spiele nicht übersteigt wird
  if(ueberpruefung <= anzahlSpiele){

//erstellen von label und eingabe feld des Team A
  nameTeamA = document.createElement("label");
  nameTeamA.textContent = mannschaftA+" schießt: ";

  feldTippA = document.createElement("input");
  feldTippA.setAttribute('id', "tippA");
  feldTippA.setAttribute('name', "tippA");
  feldTippA.setAttribute('type',"text");

//erstellen von label und eingabe feld des Team B
  nameTeamB = document.createElement("label");
  nameTeamB.textContent = " Tore und "+mannschaftB+" schießt: ";

  feldTippB = document.createElement("input");
  feldTippB.setAttribute('id', "tippB");
  feldTippB.setAttribute('name', "tippB");
  feldTippB.setAttribute('type',"text");

//wort Tore das den Satz beendet
  wortTore = document.createElement("label");
  wortTore.textContent = " Tore ";

// Button um Tipp in Datenbank einzutragen
  tippen_bt = document.createElement("button");
  tippen_bt.setAttribute('id', 'tippen_bt');
  tippen_bt.setAttribute('name', 'tippen_bt');
  tippen_bt.textContent = "Tipp Abgeben";

//spiel = button welcher geklickt wurde
  let spiel = document.getElementById("spiel"+i+"_bt");

//Ausgabe der labels, felder und button
  document.getElementsByTagName('body')[0].appendChild(nameTeamA);
  document.getElementsByTagName('body')[0].appendChild(feldTippA);

  document.getElementsByTagName('body')[0].appendChild(nameTeamB);
  document.getElementsByTagName('body')[0].appendChild(feldTippB);

  document.getElementsByTagName('body')[0].appendChild(wortTore);

  document.getElementsByTagName('body')[0].appendChild(tippen_bt);

//labels, felder und button an richtige stelle bringen
  spiel.parentNode.insertBefore(nameTeamA, spiel);
  spiel.parentNode.insertBefore(feldTippA, spiel);

  spiel.parentNode.insertBefore(nameTeamB, spiel);
  spiel.parentNode.insertBefore(feldTippB, spiel);

  spiel.parentNode.insertBefore(wortTore, spiel);

  spiel.parentNode.insertBefore(tippen_bt, spiel);
  spiel.remove();

  ueberpruefung++;

}
}

  function loescheButton(i){
    document.getElementById("spiel2_bt").remove();
  }
