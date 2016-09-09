<?php
/**
 * Classe principal para criação de Classes controle.
 *
 * Aqui deve ser implementado extritamente métodos padrão para controle
 */

namespace Facim\application\controller;
use Exception;
use Facim\application\model\Pessoas;
use Facim\application\view\View;

/**
 * Classe Controller
 *
 * Implementa as funções padrões para controladores
 *
 * @package Facim\application\controller
 */
class Controller
{
    /** @var array configurações padrão da aplicação */
    protected $config;

    /**
     * Construtor de controles
     */
    public function __construct()
    {
        global $config;
        $this->config = $config;
    }

    /**
     * Carrega um modelo de representação do Banco de Dados
     *
     * @param string    $model Nome do Modelo
     * @return Object
     */
    protected function loadModel($model)
    {
        $modelPath = MODEL_DIR . $model . '.php';
        try {
            require_once($modelPath);
			$model = '\Facim\application\model\\' . "$model";
            return new $model;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Carrega um arquivo de view e suas dependências
     * @param string $view Nome da View
     * @return View
     */
    protected function loadView($view = 'index')
    {
        return new View($view);
    }

    /**
     * Extrai o conteúdo da variável post, criando um array para manipulação dos valores
     * @return array
     */
    protected function getPost()
    {
        $post = array();
        foreach ($_POST as $key => $value) {
            $post[$key] = $value;
        }
        return $post;
    }
}