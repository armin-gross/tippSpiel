let ueberpruefung = 0;
function neuesFeld(){
  if(ueberpruefung == 0){
  feldTeamA = document.createElement("input");
  feldTeamA.setAttribute('class', "teamA");
  feldTeamA.setAttribute('type',"text");

  feldTeamB = document.createElement("input");
  feldTeamB.setAttribute('class', "teamB");
  feldTeamB.setAttribute('type',"text");

  document.getElementById('feld1').innerHTML = "sepp";
  document.getElementsByTagName('body')[0].appendChild(feldTeamA);
  document.getElementsByTagName('body')[0].appendChild(feldTeamB);
  ueberpruefung++;
}
}
