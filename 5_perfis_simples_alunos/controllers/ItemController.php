<?php
/**
 * Controlador para itens - Atualização 1 (Visualização)
 */
class ItemController {
    /**
     * Lista todos os itens
     */
    public function listar() {
        require_once 'Models/Item.php';
        $itens = Item::buscarTodos();

        require_once 'views/lista.php';
        renderizarLista($itens);
    }

    /**
     * Exibe detalhes de um item
     */
    public function visualizar($id) {
        if (!Auth::temPermissao('visualizar')) {
            $_SESSION['mensagem'] = 'Você não tem permissão para visualizar este item.';
            header('Location: index.php?pagina=lista');
            exit;
        }

        require_once 'Models/Item.php';
        $item = Item::buscarPorId($id);

    if (!$item) {
        $_SESSION['mensagem'] = 'Item não encontrado.';
        header('Location: index.php?pagina=lista');
        exit;
    }

    require_once 'views/visualizar.php';
    renderizarVisualizar($item);
    }

    /**
     * Exibe o formulário para adicionar um novo item
     */
    public function adicionar() {
        if (!Auth::temPermissao('adicionar')) {
            $_SESSION['mensagem'] = 'Você não tem permissão para adicionar um item.';
            header('Location: index.php?pagina=lista');
            exit;
        }

        require_once 'views/formulario.php';
        renderizarAdicionar();
    }

    /**
     * Salva um novo item
     */
    public function salvar() {
        if (!Auth::temPermissao('adicionar')) {
            $_SESSION['mensagem'] = 'Você não tem permissão para adicionar um item.';
            header('Location: index.php?pagina=lista');
            exit;
        }

        $titulo = $_POST['titulo'] ?? '';
        $conteudo = $_POST['conteudo'] ?? '';

        if (empty($titulo) || empty($conteudo)) {
            $_SESSION['mensagem'] = "Preencha todos os campos.";
            header('Location: index.php?pagina=adicionar');
            exit;
        }

        require_once 'Models/Item.php';
        
        if (Item::adicionar($titulo, $conteudo)) {
            $_SESSION['mensagem'] = "Item adicionado com sucesso.";
        } else {
            $_SESSION['mensagem'] = "Erro ao adicionar item.";
        }

        header('Location: index.php?pagina=lista');
        exit;
    }

    /**
     * Exibe o formulário para editar um item
     */
    public function editar($id) {
        if (!Auth::temPermissao('editar')) {
            $_SESSION['mensagem'] = 'Você não tem permissão para editar este item.';
            header('Location: index.php?pagina=lista');
            exit;
        }

        require_once 'models/Item.php';
        $item = Item::buscarPorId($id);

        if (!$item) {
            $_SESSION['mensagem'] = 'Item não encontrado.';
            header('Location: index.php?pagina=lista');
            exit;
        }

        require_once 'views/formulario.php';
        renderizarFormulario($item);
    }

    /**
     * Atualiza um item
     */
    public function atualizar($id) {
        if (!Auth::temPermissao('editar')) {
            $_SESSION['mensagem'] = 'Você não tem permissão para editar este item.';
            header('Location: index.php?pagina=lista');
            exit;
        }

        $titulo = $_POST['titulo'] ?? '';
        $conteudo = $_POST['conteudo'] ?? '';

        if (empty($titulo) || empty($conteudo)) {
            $_SESSION['mensagem'] = "Preencha todos os campos.";
            header('Location: index.php?pagina=editar&id=' . $id);
            exit;
        }

        require_once 'Models/Item.php';

        if (Item::atualizar($id, $titulo, $conteudo)) {
            $_SESSION['mensagem'] = "Item atualizado com sucesso.";
        } else {
            $_SESSION['mensagem'] = "Erro ao atualizar item.";
        }

        header('Location: index.php?pagina=lista');
        exit;
    }
}