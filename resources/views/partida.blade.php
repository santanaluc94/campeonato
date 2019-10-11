<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Partida</title>
</head>
<body>
    <form action="/partida" method="POST">
        {{ csrf_field() }}
        <div class="card">
            <h3>Jogo 1</h3>
            <span class="texto-card">Sociedade Esportiva Teste</span>
            <input name="time_1" type="hidden" value="Sociedade Esportiva Teste" />
            <input name="placar_time_1" type="number" style="width: 50px;">
                x 
            <span class="texto-card">Clube Atletico Teste</span>
            <input name="time_2" type="hidden" value="Clube Atletico Teste" />
            <input name="placar_time_2" type="number" style="width: 50px;">
        </div>

        <div class="card">
            <h3>Jogo 2</h3>
            <span class="texto-card">Teste Futebol Clube</span>
            <input name="time_3" type="hidden" value="Teste Futebol Clube" />
            <input name="placar_time_3" type="number" style="width: 50px;">
                x 
            <span class="texto-card">Clube Atlético Teste</span>
            <input name="time_4" type="hidden" value="Clube Atlético Teste" />
            <input name="placar_time_4" type="number" style="width: 50px;">
        </div>
        <button type="submit">Enviar Partidas</button>
    </form>

    <hr>

    <table class="tabela-classificacao">
        <thead>
            <tr class="tabela-titulo">
                <th colspan="9">SÉRIE B1 - 2ª FASE</th>
            </tr>
            <tr>
                <th class="col-peq dados-classificacao">Class</th>
                <th class="col-times dados-classificacao">Times</th>
                <th class="col-peq dados-classificacao">Pts</th>
                <th class="col-peq dados-classificacao">V</th>
                <th class="col-peq dados-classificacao">E</th>
                <th class="col-peq dados-classificacao">D</th>
                <th class="col-peq dados-classificacao">GP</th>
                <th class="col-peq dados-classificacao">GC</th>
                <th class="col-peq dados-classificacao">SD</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="col-peq dados-classificacao">1</td>
                <td class="col-times dados-classificacao">MARÍLIA</td>
                <td class="col-peq dados-classificacao">8</td>
                <td class="col-peq dados-classificacao">2</td>
                <td class="col-peq dados-classificacao">2</td>
                <td class="col-peq dados-classificacao">0</td>
                <td class="col-peq dados-classificacao">5</td>
                <td class="col-peq dados-classificacao">3</td>
                <td class="col-peq dados-classificacao">2</td>
            </tr>
            
        </tbody>
    </table>
</body>
</html>