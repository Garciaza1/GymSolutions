<div class="text-center">

    <h1>Acesso Negado</h1>
    
    <p>Você não tem permissão para acessar esta página.</p>
    
    <a href="?ct=main&mt=index">Voltar à Página Inicial</a>


    <div class="text-start">
        pilha de logs da sessão:
        <pre>
            <?php
                print_r($data);
                echo "<br>";
                echo "<br>";
                echo "<br>";

                function ofuscar($string) {
                    // Substitui cada caractere por um valor específico (pode ser mais complexo)
                    return str_replace(['a', 'e', 'i', 'o', 'u'], '*', $string);
                }
                
                function deofuscar($string) {
                    // Inverte o processo de ofuscação
                    return str_replace('*', 'o', $string);
                }
                

            ?>
        </pre>

    </div>
</div>