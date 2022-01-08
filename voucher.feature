Funcionalidade: Realizar uma inscricao
    Cenario: Realizar uma inscricao com voucher
        Dado que tenha pelo menos uma atividade disponivel
        E essa atividade esteja apta para inscricao
        Quando o usuario for digitar o código do voucher
        E o usuario clicar no botão Validar voucher
        E o voucher estiver valido
        E o usuario clica no botão pagar.
        Entao deverar aplicar o desconto
        E realizar a inscrição na atividade
