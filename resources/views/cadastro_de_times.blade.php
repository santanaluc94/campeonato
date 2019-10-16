<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Times</title>
</head>
<body>
    <form action="/cadastrar" method="POST">
        {{ csrf_field() }}
        <div class="card">
            <span class="texto-card">Time 1</span>
            <input name="time_1" type="text" style="width:400px;"/>
        </div>

        <div class="card">
            <span class="texto-card">Time 2</span>
            <input name="time_2" type="text" style="width:400px;"/>
        </div>

        <div class="card">
            <span class="texto-card">Time 3</span>
            <input name="time_3" type="text" style="width:400px;"/>
        </div>

        <div class="card">
            <span class="texto-card">Time 4</span>
            <input name="time_4" type="text" style="width:400px;"/>
        </div>

        <button type="submit">Cadastrar Times</button>
    </form>
</body>
</html>