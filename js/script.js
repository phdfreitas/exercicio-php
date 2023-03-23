let url = window.location.href.split('?');
console.log(url.length)

let dadosCovid = document.getElementById('dadosCovid');
let divInformacao = document.getElementById('divInformacoes');
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
    divInformacao.hidden = true;
}
if(url[1].length >= 1 && url[1].length <= 14){
    console.log("entrou aqui")
    paisInformacao.innerHTML = alteraNomePais(url[1].substring(5));
}else{
    divInformacao.hidden = true;
}

