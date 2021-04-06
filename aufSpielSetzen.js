
let ueberpruefung = 0;

function neuesFeld(i, mannschaftA, mannschaftB, anzahlSpiele) {
  //überprüfung ob die anzahl der Spiele nicht übersteigt wird
  if (ueberpruefung <= anzahlSpiele) {

    //erstellen von label und eingabe feld des Team A
    nameTeamA = document.createElement("label");
    nameTeamA.textContent = mannschaftA + " schießt: ";

    feldTippA = document.createElement("input");
    feldTippA.setAttribute('id', "tippA");
    feldTippA.setAttribute('name', "tippA");
    feldTippA.setAttribute('type', "text");

    //erstellen von label und eingabe feld des Team B
    nameTeamB = document.createElement("label");
    nameTeamB.textContent = " Tore und " + mannschaftB + " schießt: ";

    feldTippB = document.createElement("input");
    feldTippB.setAttribute('id', "tippB");
    feldTippB.setAttribute('name', "tippB");
    feldTippB.setAttribute('type', "text");

    //wort Tore das den Satz beendet
    wortTore = document.createElement("label");
    wortTore.textContent = " Tore ";

    // Button um Tipp in Datenbank einzutragen
    tippen_bt = document.createElement("button");
    tippen_bt.setAttribute('id', 'tippen_bt');
    tippen_bt.setAttribute('name', 'tippen_bt');
    tippen_bt.textContent = "Tipp Abgeben";

    //spiel = button welcher geklickt wurde
    let spiel = document.getElementById("spiel" + i + "_bt");

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



function neueManschaftenAdmin() {

  //Formular
  f = document.createElement("form");
  f.setAttribute('method', "post");
  f.setAttribute('id', "formularTeams");

  teamAheisst = document.createElement("label");
  teamAheisst.textContent = "Was ist der Name von Team A? ";

  //input Feld name Team A
  neuesTeamA = document.createElement("input");
  neuesTeamA.setAttribute('id', "neuesTeamA");
  neuesTeamA.setAttribute('name', "neuesTeamA");
  neuesTeamA.setAttribute('placeholder', "Team A");

  absatz1 = document.createElement("br");
  absatz2 = document.createElement("br");

  teamBheisst = document.createElement("label");
  teamBheisst.textContent = "Was ist der Name von Team B? ";

  //input Feld name Team A
  neuesTeamB = document.createElement("input");
  neuesTeamB.setAttribute('id', "neuesTeamB");
  neuesTeamB.setAttribute('name', "neuesTeamB");
  neuesTeamB.setAttribute('placeholder', "Team B");

  //Button um spel in Datenbank einzutragen
  teamsEintragen = document.createElement("button");
  teamsEintragen.setAttribute('id', 'teamsEintragen');
  teamsEintragen.setAttribute('name', 'teamsEintragen');
  teamsEintragen.textContent = "Teams Eintragen";

  //alles wird dem formular hinzugefügt
  f.appendChild(teamAheisst);
  f.appendChild(neuesTeamA);
  f.appendChild(absatz1);
  f.appendChild(teamBheisst);
  f.appendChild(neuesTeamB);
  f.appendChild(absatz2);
  f.appendChild(teamsEintragen);

  //formular zu body hinzufügen
  document.getElementsByTagName('body')[0].appendChild(f);

  //button der diese function ausführt wird entfernt
  document.getElementById("spiel_erstellen_Felder_button").remove();
}






function neuesErgebnisAdmin(teamA, teamB) {
  document.getElementById("spiel_erstellen_Felder_button").remove();
  //Formular
  f = document.createElement("form");
  f.setAttribute('method', "post");
  f.setAttribute('id', "formularTore");

  teamAschiesst = document.createElement("label");
  teamAschiesst.textContent = "Wie viele Tore schießt " + teamA + " ";

  //input Feld name Team A
  toreTeamA = document.createElement("input");
  toreTeamA.setAttribute('id', "toreTeamA");
  toreTeamA.setAttribute('name', "toreTeamA");

  absatz1 = document.createElement("br");
  absatz2 = document.createElement("br");

  teamBschiesst = document.createElement("label");
  teamBschiesst.textContent = "Wie viele Tore schießt " + teamB + " ";

  //input Feld name Team A
  toreTeamB = document.createElement("input");
  toreTeamB.setAttribute('id', "toreTeamB");
  toreTeamB.setAttribute('name', "toreTeamB");

  //Button um spel in Datenbank einzutragen
  toreEintragen = document.createElement("button");
  toreEintragen.setAttribute('id', 'toreEintragen');
  toreEintragen.setAttribute('name', 'toreEintragen');
  toreEintragen.textContent = "Tore Eintragen";

  //alles wird dem formular hinzugefügt
  f.appendChild(teamAschiesst);
  f.appendChild(toreTeamA);
  f.appendChild(absatz1);
  f.appendChild(teamBschiesst);
  f.appendChild(toreTeamB);
  f.appendChild(absatz2);
  f.appendChild(toreEintragen);

  //formular zu body hinzufügen
  document.getElementsByTagName('body')[0].appendChild(f);
}









function datumUhrzeit() {
document.getElementById("spiel_erstellen_Felder_button").remove();
  //Formular
  f = document.createElement("form");
  f.setAttribute('method', "post");
  f.setAttribute('id', "datumUhrzeit");

  uhrzeit_lbl = document.createElement("label");
  uhrzeit_lbl.textContent = "Um wie spät findet das Spiel statt?";

  //input Feld name Team A
  uhrzeit = document.createElement("input");
  uhrzeit.setAttribute('id', "uhrzeit");
  uhrzeit.setAttribute('name', "uhrzeit");
  uhrzeit.setAttribute('type', "time");

  absatz1 = document.createElement("br");
  absatz2 = document.createElement("br");

  datum_lbl = document.createElement("label");
  datum_lbl.textContent = "Wann findet das Spiel statt?";

  //input Feld name Team A
  datum = document.createElement("input");
  datum.setAttribute('id', "datum");
  datum.setAttribute('name', "datum");
  datum.setAttribute('type', "date");

  //Button um spel in Datenbank einzutragen
  datumUhrzeitEintragen = document.createElement("button");
  datumUhrzeitEintragen.setAttribute('id', 'datumUhrzeitEintragen');
  datumUhrzeitEintragen.setAttribute('name', 'datumUhrzeitEintragen');
  datumUhrzeitEintragen.textContent = "Datum und Uhrzeit Eintragen";

  //alles wird dem formular hinzugefügt
  f.appendChild(uhrzeit_lbl);
  f.appendChild(uhrzeit);
  f.appendChild(absatz1);
  f.appendChild(datum_lbl);
  f.appendChild(datum);
  f.appendChild(absatz2);
  f.appendChild(datumUhrzeitEintragen);

  //formular zu body hinzufügen
  document.getElementsByTagName('body')[0].appendChild(f);
}
