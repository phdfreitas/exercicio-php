let url = window.location.href.split('?');

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
else{
    paisInformacao.innerHTML = alteraNomePais(url[1].substring(5));
}

