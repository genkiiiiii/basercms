<?php


/**
 * リプレースプレフィックスコンポーネント
 *
 * 既に用意のあるプレフィックスアクションがある場合、
 * 違うプレフィックスでのアクセスを既にあるアクション、ビューに置き換える
 *
 * 【例】
 * /admin/users/login・・・admin_login が呼び出される
 * /mypage/users/login・・・admin_login が呼び出される
 *
 * リクエストしたプレフィックスに適応したアクションがある場合はそちらが優先される
 * リクエストしたプレフィックスに適応したビューが存在する場合はそちらが優先される
 *
 * 【注意事項】
 * ・baserCMS用のビューパスのサブディレクトリ化に依存している。
 * ・リクエストしたプレフィックスに適応したアクションが存在する場合は、ビューの置き換えは行われない。
 * ・Authと併用する場合は、コンポーネントの宣言で、Authより前に宣言しないと認証処理が動作しない。
 *
 * baserCMS :  Based Website Development Project <http://basercms.net>
 * Copyright 2008 - 2015, baserCMS Users Community <http://sites.google.com/site/baserusers/>
 *
 * @copyright		Copyright 2008 - 2015, baserCMS Users Community
 * @link			http://basercms.net baserCMS Project
 * @package			Baser.Controller.Component
 * @since			baserCMS v 0.1.0
 * @license			http://basercms.net/license/index.html
 */
class BcReplacePrefixComponent extends Component {

/**
 * プレフィックス置き換えを許可するアクション
 * プレフィックスなしの純粋なアクション名を指定する
 *
 * @var array
 * @access public
 */
	public $allowedPureActions = array();

/**
 * 置き換え後のプレフィックス
 *
 * @var string
 * @access public
 */
	public $replacedPrefix = 'admin';

/**
 * 対象コントローラーのメソッド
 *
 * @var array
 * @access	protected
 */
	protected $_methods;

/**
 * Initializes
 *
 * @param Controller $Controller
 * @return void
 * @access public
 */
	public function initialize(Controller $Controller) {
		$this->_methods = $Controller->methods;
	}

/**
 * プレフィックスの置き換えを許可するアクションを設定する
 *
 * $this->Replace->allow('action', 'action',...);
 *
 * @param string $action
 * @param string $action
 * @param string ... etc.
 * @return void
 * @access public
 */
	public function allow() {
		$args = func_get_args();
		if (isset($args[0]) && is_array($args[0])) {
			$args = $args[0];
		}
		$this->allowedPureActions = array_merge($this->allowedPureActions, $args);
	}

/**
 * startup
 *
 * @return	void
 * @access	public
 */
	public function startup(Controller $Controller) {
		if (in_array($Controller->action, $this->_methods)) {
			return;
		}

		if (!isset($Controller->request->params['prefix'])) {
			$requestedPrefix = '';
		} else {
			$requestedPrefix = $Controller->request->params['prefix'];
		}

		$pureAction = preg_replace('/^' . $requestedPrefix . '_/', '', $Controller->action);

		if (!in_array($pureAction, $this->allowedPureActions)) {
			return;
		}
		if (!in_array($this->replacedPrefix . '_' . $pureAction, $this->_methods)) {
			return;
		}
		if($requestedPrefix) {
			$Controller->request->params['prefix'] = $requestedPrefix;
		} else {
			$Controller->request->params['prefix'] = 'front';
		}
		$Controller->action = $this->replacedPrefix . '_' . $pureAction;
		$Controller->layoutPath = $this->replacedPrefix;	// Baserに依存
		$Controller->subDir = $this->replacedPrefix;		// Baserに依存

		if ($requestedPrefix != $this->replacedPrefix) {
			// viewファイルが存在すればリクエストされたプレフィックスを優先する
			$existsLoginView = false;
			$viewPaths = $this->getViewPaths($Controller);
			$prefixPath = str_replace('_', DS, $requestedPrefix);
			foreach ($viewPaths as $path) {
				if ($prefixPath) {
					$file = $path . $Controller->name . DS . $prefixPath . DS . $pureAction . $Controller->ext;
				} else {
					$file = $path . $Controller->name . DS . $pureAction . $Controller->ext;
				}
				if (file_exists($file)) {
					$existsLoginView = true;
					break;
				}
			}

			if ($existsLoginView) {
				$Controller->subDir = $prefixPath;
				$Controller->layoutPath = $prefixPath;
			}
		}
	}
	
	public function beforeRender(Controller $controller) {
		parent::beforeRender($controller);
		if($controller->request->params['prefix'] == 'front') {
			$controller->request->params['prefix'] = '';
		}
	}
/**
 * Return all possible paths to find view files in order
 *
 * @param string $plugin
 * @return array paths
 * @access private
 */
	public function getViewPaths($Controller) {
		$paths = array_merge(App::path('View', $Controller->plugin), App::path('View'));
		if (!empty($Controller->theme)) {
			array_unshift($paths, WWW_ROOT . 'theme' . DS . $Controller->theme . DS);
		}
		return $paths;
	}

}
