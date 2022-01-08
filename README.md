




Cliente de entidade e organizadora de eventos, tem a necessidade de disponibilizar vales de descontos ou cortesia aos compradores dos seus produtos.(Ex: Curso;exame;eventos e etc....). Com os vales disponiveis distribuir esses vales para patrocinadores, funcionarios ou em alguma ação de marketing.

Para que as pessoas que receberam esse vale, aplicar na plataforma de Cursos(Entity) no momento da compra dos seus cursos. e validar seus descontos

1: introdução


       Pessoa no ato da compra de um curso vai aplica um voucher de desconto que recebeu em uma promoção, para que assim ele possa obter novo curso e validar seu desconto recebido.

       Atraves de um campo localizado no carrinho ou na tela de pagamentos no sistema(entity) inserir o voucher para aplicar os descontos.

      O sistema vai validar o voucher passado, que é cadastrado no admin(icase ou icongresso) e aplicar os descontos de acordo com as regras cadastradas no sistema. Os tipos de voucher cadastrados no admin são. Nominal: voucher especifico para uma pessoa; Atividade especificas: voucher que aplica desconto somente na compra de uma atividade determinada; Voucher com prefixo: Voucher com apelido, varios voucher podem ter o mesmo apelido; Voucher valor: voucher que aplica desconto de um valor especifico; Voucher percentagem: voucher que aplica desconto baseado em uma percentagem do valor do produto; Voucher com validade: Voucher com prazo para poder aplicar.

OBS: As configurações dos vouchers podem ser combinadas ex: voucher nominal do tipo valor ou percentagem.

2: Regras

     R1: A opção de inserir voucher no sistema só vai ser exibida se o configurador "379 ATIVA_VOUCHER" estiver ativo e com valor referencia igual a 'S', na inesistencia ou o valor referencia estiver diferente de 'S' não exibir opção de inserir voucher em nenhuma tela.

    R2: Caso exista duas configurações cadastradas o sistema vai considerar como prioridade o configurador cadastrado para o centro de custo logado, caso não exista considerar o configurador geral cadastrado que tenha referencia de centro de custo vazia ou nula.

    R3: Caso exista configurações cadastradas com idioma o sistema vai considerar como prioridade o configurador cadastrado para o idioma ativo no sistema, caso não exista considerar o configurador geral cadastrado que tenha referencia de idioma vazia ou nula.

    R4: Ao aplicar um voucher que anule o valor do item que está sendo comprado  o item deve ser ter o valor riscado e atualizado para zero

    R5: Ao aplicar um voucher que anule o valor do item que está sendo comprado e esse item for o unico dentro do carrinho o sistema vai ser redirecionado para tela que exibe os cursos comprados exibindo que o mesmo foi quitado atraves de voucher.

    R6:  Na tentativa de aplicar um voucher exibir mensagem e não aplicar o desconto. ex de voucher invalido: voucher informado não encontrado na base; voucher informado que ja foi utilizado; voucher de uma atividade especifica que não está incluida no carrinho; voucher pertencer a outra pessoa; voucher fora do prazo de validade

   R7: voucher com prefixo cadastrado de forma geral informando somente o desconto e centro de custo, sem especificar pessoa ou atividade. deve ser aplicado um voucher para cada atividade incluida no carrinho enquanto tiver voucher do prefixo cadastrado disponivel.