<?php

class ProdutoRepositorio
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function dadosSimplificado($dados)
    {
        return new Produto(
            $dados['id'],
            $dados['tipo'],
            $dados['nome'],
            $dados['descricao'],
            $dados['imagem'],
            $dados['preco']
        );
    }

    public function opcoesCafe()
    {
        $sql1 = "SELECT * FROM produtos WHERE tipo = 'Café' ORDER BY preco";
        $statment = $this->pdo->query($sql1);
        $produtosCafe = $statment->fetchAll(PDO::FETCH_ASSOC);


        $dadosCafe = array_map(function ($cafe) {
            return $this->dadosSimplificado($cafe);
        }, $produtosCafe);

        return $dadosCafe;
    }

    public function opcoesAlmoco()
    {
        $sql1 = "SELECT * FROM produtos WHERE tipo = 'Almoço' ORDER BY preco";
        $statment = $this->pdo->query($sql1);
        $produtosAlmoco = $statment->fetchAll(PDO::FETCH_ASSOC);


        $dadosAlmoco = array_map(function ($almoco) {
            return $this->dadosSimplificado($almoco);
        }, $produtosAlmoco);

        return $dadosAlmoco;
    }
}
