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


function neuesAdminFeld(){

  neuesTeamA = document.createElement("input");
  neuesTeamA.setAttribute('id', "neuesTeamA");
  neuesTeamA.setAttribute('placeholder', "Mannschaft A");

  wortSchisst = document.createElement("label");
  wortSchisst.textContent = " schießt ";

  teamATore = document.createElement("input");
  teamATore.setAttribute('id', "teamATore");
  teamATore.setAttribute('placeholder', "0,1,2..");

  wortToreUnd = document.createElement("label");
  wortToreUnd.textContent = " Tore und ";

  neuesTeamB = document.createElement("input");
  neuesTeamB.setAttribute('id', "neuesTeamB");
  neuesTeamB.setAttribute('placeholder', "Mannschaft B");

  wortSchisst2 = document.createElement("label");
  wortSchisst2.textContent = " schießt ";

  teamBTore = document.createElement("input");
  teamBTore.setAttribute('id', "teamBTore");
  teamBTore.setAttribute('placeholder', "0,1,2..");

  wortTore = document.createElement("label");
  wortTore.textContent = " Tore. ";

  spielErstellen = document.createElement("button");
  spielErstellen.setAttribute('name', 'spielErstellen');
  spielErstellen.setAttribute('id', 'spielErstellen');
  spielErstellen.setAttribute('type', 'submit');
  spielErstellen.textContent = "Spiel erstellen";


  document.getElementsByTagName('body')[0].appendChild(neuesTeamA);
  document.getElementsByTagName('body')[0].appendChild(wortSchisst);
  document.getElementsByTagName('body')[0].appendChild(teamATore);
  document.getElementsByTagName('body')[0].appendChild(wortToreUnd);
  document.getElementsByTagName('body')[0].appendChild(neuesTeamB);
  document.getElementsByTagName('body')[0].appendChild(wortSchisst2);
  document.getElementsByTagName('body')[0].appendChild(teamBTore);
  document.getElementsByTagName('body')[0].appendChild(wortTore);
  document.getElementsByTagName('body')[0].appendChild(spielErstellen);
}
