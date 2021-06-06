function changeStatus() {
    var selectedValue = document.getElementById("list").value;
    var selectedSemUn = document.getElementById("anun");
    var selectedSemDeux = document.getElementById("andeux");
    var selectedSemTrois = document.getElementById("antrois");
    var pas_de_filliere_select = document.getElementById("messageFilliere");

    if(selectedValue == "ALSIR3"){
        selectedSemTrois.style.display = 'block';
        selectedSemUn.style.display = 'none';
        selectedSemDeux.style.display = 'none';
        pas_de_filliere_select.style.display='none';
    }
    else if (selectedValue == "ALMPC2"){
        selectedSemDeux.style.display = 'block';
        selectedSemUn.style.display = 'none';
        selectedSemTrois.style.display = 'none';
        pas_de_filliere_select.style.display='none';
    }
    else if(selectedValue == "ALMPC1"){
        selectedSemUn.style.display = 'block';
        selectedSemDeux.style.display = 'none';
        selectedSemTrois.style.display = 'none';
        pas_de_filliere_select.style.display='none';
    }
    else{
        
        // pas_de_filliere_select.innerHTML = "*Veuillez selectionne une filliere valide";
        selectedSemUn.style.display = 'none';
        selectedSemDeux.style.display = 'none';
        selectedSemTrois.style.display = 'none';

    }}


    function changeStatusYear() {
        var selectedyear = document.getElementById("stud").value;
        var selectedanneeReleve = document.getElementById("dataReleve");
        var selectedanneeInsc = document.getElementById("dataInsc");
        var selectedanneeSco = document.getElementById("dataSco");
        console.log(selectedyear);
        if(selectedyear=="releves"){
            selectedanneeInsc.style.display = 'none';
            selectedanneeReleve.style.display = 'block';
        }
        else if(selectedyear=="inscription" ||selectedyear=="scolarite" ){
            selectedanneeInsc.style.display = 'block';
            selectedanneeReleve.style.display = 'none';
        }
        else{
            selectedanneeInsc.style.display = 'none';
            selectedanneeReleve.style.display = 'none';
        }
 }


 function updatedStatut(id){
     var xmlhttp =new XMLHttpRequest();
     xmlhttp.onreadystatechange = function(){
         if(xmlhttp.readyState == 4 && xmlhttp.status== 200){
             alert(xmlhttp.responseText);
         }
     };
     xmlhttp.open("GET","update.php?id="+id,true);
     xmlhttp.send();
 }