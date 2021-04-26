<?php

    $mensagem = '';
    if(isset($_GET['status'])){
        switch ($_GET['status']){
            case 'success':
                $mensagem = '<div class="alert alert-success">Ação executada com sucesso!</div>';
                break;

            case 'error':
                $mensagem = '<div class="alert alert-danger">Ação Não executada!"</div>';
                break;
        }
    }

    $resultados = '';
    foreach($vagas as $vagas){
        $resultados .= '<tr>
                            <td>'.$vagas->id.'</td>
                            <td>'.$vagas->titulo.'</td>
                            <td>'.$vagas->descricao.'</td>
                            <td>'.($vagas->ativo == 's' ? 'Ativo' : 'Inativo').'</td>
                            <td>'.date('d/m/Y à\s H:i:s',strtotime($vagas->data)).'</td>
                            <td>
                                <a href="editar.php?id='.$vagas->id.'">
                                    <button type = "button" class="btn btn-primary">Editar</button>
                                </a>
                                <a href="excluir.php?id='.$vagas->id.'">
                                    <button type = "button" class="btn btn-danger">Excluir</button>
                                </a>
                            </td>
                        </tr>';
    }

    $resultados = strlen($resultados) ? $resultados : '<tr>
                                                            <td colspan="6" class="text-center">Nenhuma vaga encontrada</td>
                                                        </tr>';


?>


<main>

    <?=$mensagem?>

    <section>
        <a href="cadastrar.php">
            <button class="btn btn-success"> Cadastrar </button>
        </a>
    </section>

    <section>

        <table class="table bg-light mt-3">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Descrição</th>
                    <th>Status</th>
                    <th>Data</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?=$resultados?>
            </tbody>

        </table>

    </section>

</main>