<?php
namespace Facim\application\view;
/**
 * Class View
 *
 * A classe gera uma view para entrega e renderização no browser, a partir de um arquivo de view em _applications/view_.
 *
 * @package Facim\application\controller
 */
class View
{
	/** @var array        Variáveis da view */
	private $pageVars = array();
	/** @var string       Nome da view */
	private $template;

	/**
	 * Contrutor de view
	 *
	 * Devem estar criadas no diretório de views
	 * _application/view/_
	 *
	 * @param $template
	 */
	public function __construct($template)
	{
		$this->template = VIEW_DIR . $template . '.php';
	}

	/**
	 * Incrementa um array para entregar como variáveis à view
	 *
	 * @param string $var Nome da variável
	 * @param $val
	 */
	public function set($var, $val)
	{
		$this->pageVars[$var] = $val;
	}

	/**
	 * Extrai as variáveis para a view e retorna o conteúdo da view para o browser
	 */
	public function show()
	{
		extract($this->pageVars);

		ob_start();
		require($this->template);
		echo ob_get_clean();
	}
}