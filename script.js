/* ...existing code... */

document.addEventListener("DOMContentLoaded",function alerteDiffOpti() {
    let HumOptiC = document.getElementById("valHumOptiC").textContent;
    //console.log("Valeur de l'option HumOptiC : " + HumOptiC);
    let TempOptiC = document.getElementById("valTempOptiC").textContent;
    //console.log("Valeur de l'option TempOptiC : " + TempOptiC);
    let LumOptiC = document.getElementById("valLumOptiC").textContent;
    //console.log("Valeur de l'option LumOptiC : " + LumOptiC);
    let Humidite = document.getElementById("valHumidite").textContent;
    //console.log("Valeur de l'option Humidite : " + Humidite);
    let Temp = document.getElementById("valTemp").textContent;
    //console.log("Valeur de l'option Temp : " + Temp);
    let Luminosite = document.getElementById("valLum").textContent;
    //console.log("Valeur de l'option Luminosite : " + Luminosite);
    if ((Math.abs(parseFloat(HumOptiC)-parseFloat(Humidite)))>2) {
        //alert("Alerte : Humidité trop différente de l'optimale");
    }
    if ((Math.abs(parseFloat(TempOptiC)-parseFloat(Temp)))>2) {
        //alert("Alerte : Température trop différente de l'optimale");
    }
    if ((Math.abs(parseFloat(LumOptiC)-parseFloat(Luminosite)))>100) {
        //alert("Alerte : Luminosité trop différente de l'optimale");
    }
});