let ueberpruefung = 0;
function neuesFeld(i, mannschaftA, mannschaftB, anzahlSpiele){
  //überprüfung ob die anzahl der Spiele nicht übersteigt wird
  if(ueberpruefung <= anzahlSpiele){

//erstellen von label und eingabe feld des Team A
  nameTeamA = document.createElement("label");
  nameTeamA.textContent = mannschaftA+" schießt: ";

  feldTeamA = document.createElement("input");
  feldTeamA.setAttribute('class', "teamA");
  feldTeamA.setAttribute('id', "teamA");
  feldTeamA.setAttribute('type',"text");

//erstellen von label und eingabe feld des Team B
  nameTeamB = document.createElement("label");
  nameTeamB.textContent = " Tore und "+mannschaftB+" schießt: ";

  feldTeamB = document.createElement("input");
  feldTeamB.setAttribute('class', "teamB");
  feldTeamA.setAttribute('id', "teamB");
  feldTeamB.setAttribute('type',"text");

//wort Tore das den Satz beendet
  wortTore = document.createElement("label");
  wortTore.textContent = " Tore ";

//Button um Tipp in Datenbank einzutragen
  // tippen_bt = document.createElement("button");
  // tippen_bt.setAttribute('id', 'tippen_bt');
  // tippen_bt.setAttribute('name', 'tippen_bt');
  // tippen_bt.setAttribute('type', 'button');
  // tippen_bt.textContent = "Tipp Abgeben";

//spiel = button welcher geklickt wurde
  let spiel = document.getElementById("spiel"+i+"_bt");

//Ausgabe der labels, felder und button
  document.getElementsByTagName('body')[0].appendChild(nameTeamA);
  document.getElementsByTagName('body')[0].appendChild(feldTeamA);

  document.getElementsByTagName('body')[0].appendChild(nameTeamB);
  document.getElementsByTagName('body')[0].appendChild(feldTeamB);

  document.getElementsByTagName('body')[0].appendChild(wortTore);

  // document.getElementsByTagName('body')[0].appendChild(tippen_bt);

//labels, felder und button an richtige stelle bringen
  spiel.parentNode.insertBefore(nameTeamA, spiel);
  spiel.parentNode.insertBefore(feldTeamA, spiel);

  spiel.parentNode.insertBefore(nameTeamB, spiel);
  spiel.parentNode.insertBefore(feldTeamB, spiel);

  spiel.parentNode.insertBefore(wortTore, spiel);

  // spiel.parentNode.insertBefore(tippen_bt, spiel);
  spiel.remove();
  ueberpruefung++;

}
}
