<p align="center">
	<img src="https://www.skyhub.bio/wp-content/uploads/2021/09/kidopi.png">
</p>

## Desafio
O desafio consiste em construir um sistema que possibilite ao usuário obter informações sobre os casos de morte por Covid. Os dados foram obtidos a partir de uma API disponibilizada pela Kidopi. A API fornece o número de casos de covid confirmados e o número de mortes de vários países. O desafio/exercício foi dividido em 3 partes obrigatórias e 1 parte extra opcional.

### Parte 1 - Chamada a API e Exibição dos Dados
Nessa parte o usuário deve conseguir visualizar os dados de um país que ele escolher, nesse caso, as opções de países são: Brasil, Canadá ou Australia. Na minha solução, optei por mostrar os dados de Covid em uma tabela para que ficasse mais 'clean'. 

### Parte 2 - Banco de dados
Deve ser armazenado no MySql a data e hora de quando a API foi acessada e também qual o país foi escolhido. (Não há o que falar da solução aqui).

### Parte 3 - Rodapé e Front-end
- Toda a página foi desenvolvida usando HTML, CSS e (um pouco de) JS. Além disso, também usei Bootstrap para não precisar criar todos os estilo 'na mão'. No caso do JavaScript, usei apenas para controlar o que deveria ser exibido com base no que o usuário queria (Mais especificamente levando em conta a url). 
- Com relação ao rodapé da página e a exibição da última chamada a API, usei a query abaixo:

```
SELECT country, DATE_FORMAT(moment, '%d/%m/%Y %H:%i:%s') as moment 
            FROM api_call WHERE id = (SELECT count(id) from api_call);
```
- **Explicação**
    1. Considerando que assim que a chamada a API é feita o país escolhido e o horário da chamada são salvos no banco de dados, então *o último acesso* no banco será sempre **o de maior id**. (Para essa solução)  
    2. A função **DATE_FORMAT** foi usada apenas para formatar a data e a hora para exibição em formato brasileiro.

### Parte bônus
Em resumo, nessa parte eu uso a API de países disponíveis para fazer dois inputs 'select' e permitir que o usuário escolha os países que quer observar a diferença na taxa de mortalidade. Uma vez escolhidos os países, faço a chamada para a API de covid-19 duas vezes (uma para cada país) e faço os calculos da taxa de morte de cada país e por fim faço o calculo da diferença das taxas. Nesse ponto em específico, é necessário deixar duas coisas claras: 

1. Sobre o calculo dos casos confirmados e mortos de cada país. 
```
foreach($jsonPais1 as $key => $dados){
    $totalConfirmadosPais1 += $dados->Confirmados;
    $totalMortosPais1 += $dados->Mortos;
}

foreach($jsonPais2 as $key => $dados){
    $totalConfirmadosPais2 += $dados->Confirmados;
    $totalMortosPais2 += $dados->Mortos;
}
```
Como o número de estados em cada país não é tão grande e há países sem os dados separados por estados então fiz um "for" simples (código acima) para cada chamada. Optei por isso pois no melhor dos casos (onde não há dados de estados) o loop só vai acontecer 1 vez e no pior dos casos o número de estados não será tão grande e não afetará a performance. 

2. Sobre o calculo da taxa de morte propriamente dita:
```
$taxaMortePais1 = number_format(($totalMortosPais1 * 1000 / $totalConfirmadosPais1), 3);
$taxaMortePais2 = number_format(($totalMortosPais2 * 1000 / $totalConfirmadosPais2), 3);
```
Nesse caso, multiplico o número total de mortes de cada país por 1000 apenas para ter como resultado um número melhor de exibido. No entanto, obviamente não altera o resultado final. 

### Interface
<p align="center">
	<img src="public/home.png">
</p>

### Banco de Dados
Segue o script para a criação do banco de dados e tabela

```
CREATE database desafio_php;

CREATE TABLE api_call (
	id int not null auto_increment primary key,
    country varchar(15) not null,
    moment timestamp default current_timestamp
);
```

### Comentários adicionais
1. A ideia da interface era ser o mais clean possível, mas sem ser desconfortável para o usuário. 
2. Para conseguir executar o backend + banco de dados sem problemas só é preciso copiar o script do banco deixado acima e executar o mesmo no mysql. 
3. Quando o banco de dados estiver vazio nenhuma informação é exibida no rodapé da página
4. Apenas as chamadas simples são salvas no banco de dados, ou seja, as chamadas para API envolvendo a comparação da taxa de morte entre dois países não vai para o banco de dados. 
5. Altere as configurações de acesso ao banco de dados no arquivo **db.sql** para as configurações do seu banco de dados local.
6. É possível que os nomes de arquivos e variáveis não sejam os mais indicados (e nem estejam no padrão ideal) para uma aplicação desenvolvida em equipe e que irá para produção.  