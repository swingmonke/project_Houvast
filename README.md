# project_Houvast
code conventies
-Class: PascalCase (ProjectManager, GrandMaster)
-Class name is FileName LET OP ^^^
-Methodes/Functions: camelCase (addPlayer, calculateWinner)
-Variables: camelCase (compettitors, playerPoints)
-Constants: UPPER_SNAKE_CASE
-GEEN AFKORTINGEN ($a, &b etc.)
-alles volgens alt + shift + f regels
-EEN ; PER REGEL
-haakjes van structuren asl volgd

if, else, if else, for, while etc.($condition){
  //code
}

function addPlayer($id)
{
  //code
}

-Geef functions als mogelijk een return type (string, int, bool)
-Als het kan maak kleine functions met een verantwoordelijkheid
-als je commentaar schrijft. Schrijf waarom je de code hebt geschreven niet wat het doet(DAT MOET DE FUNCTIE NAAM DUIDELIJK MAKEN)

-handel alle validatie aan het begin van de functie af
function addPlayer($id)
{
  if($id < 0) return;
  if($id != int) return;
  //code
}

-BLIJF CONSISTENT!!!!!!!!!
