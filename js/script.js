let url = window.location.href.split('?');
console.log(url[1].length)

let dadosCovid = document.getElementById('dadosCovid');
let informacao = document.getElementById('informacao');
let paisInformacao = document.getElementById('paisInformacao');

const alteraNomePais = (nomePais) => {
    if(nomePais === "Brazil"){
        return "Brasil";
    }
    else if(nomePais === "Canada"){
        return "Canadá";
    }

    return nomePais;
}

if (url.length === 1) {
    dadosCovid.hidden = true;
    informacao.innerHTML = 'Nenhum país foi selecionado';
}
else if(url[1].length >= 1 && url[1].length <= 14){
    paisInformacao.innerHTML = alteraNomePais(url[1].substring(5));
}

