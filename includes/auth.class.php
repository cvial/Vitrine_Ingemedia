<?php
/**
 *
 * auth.class.php
 *
 * Authentification utilisateur utilisant phpActiveRecord
 *
 * @author Florent Desjardins <florent.desjardins@gmail.com>
 *
 */
class Auth {
	
	/**
	 * Page accès interdit
	 *
	 * @var string
	 * @access private
	 */
	private $forbidden = "forbidden";
	
	/**
	 * Redirection après login
	 *
	 * Changer la valeur à true pour rediriger l'utilisateur après login, à false sinon
	 *
	 * @var boolean
	 * @access private
	 */
	private $redirect = false;
	
	/**
	 * URL de redirection après login
	 *
	 * @var string
	 * @access private
	 */
	private $redirecturl = BASEURL;
	
	/**
	 * Login
	 *
	 * @access public
	 */
	function login($email, $password) {
		$query = "SELECT `users`.`id`, `users`.`email`, `users`.`firstname`, `roles`.`name`, `roles`.`slug`, `roles`.`level` ";
		$query .= "FROM `users` ";
		$query .= "LEFT JOIN `roles` ON `users`.`role_id` = `roles`.`id` ";
		$query .= "WHERE `email` = '".$email."' ";
		$query .= "AND `password` = '".$this->hashpass($password)."'";
		$user = User::find_by_sql($query);
		if(count($user) != 1) {
			$_SESSION['notification']['error'] = "Identifiant ou mot de passe incorrects.";
			return false;
		}
		else {
			$user = $user[0];
			$data_user = array(
				'id' => $user->id,
				'email' => $user->email,
				'firstname' => $user->firstname,
				'role_name' => $user->name,
				'role_level' => intval($user->level),
				'role_slug' => $user->slug
			);
			$_SESSION['auth'] = $data_user;
			$_SESSION['notification']['error'] = false;
			if($this->redirect) { header('location: '.$this->redirecturl); } else { return true; }
		}
	}
	
	/**
	 * Logout
	 *
	 * @access public
	 */
	function logout() {
		$_SESSION['auth'] = false;
		header('location: '.BASEURL);
	}
	
	/**
	 * Allow
	 *
	 * @access public
	 */
	function allow($slug) {
		$datas = User::find_by_sql("SELECT `slug`, `level` FROM `roles`");
		$roles = array();
		foreach($datas as $data) {
			$roles[$data->slug] = $data->level;
		}
		if(!$this->isLoggedIn()) {
			//$this->forbidden();
			return false;
		}
		else {
			if($roles[$slug] > $_SESSION['auth']['role_level']) {
				//$this->forbidden();
				return false;
			}
		}
		return true;
	}
	
	/**
	 * Is logged In
	 *
	 * @access public
	 */
	function isLoggedIn() {
		if(!empty($_SESSION['auth'])) { return true; } else { return false; }
	}
	
	/**
	 * Forbidden
	 *
	 * @access public
	 */
	function forbidden() {
		header('location: '.$this->forbidden);
	}
	
	/**
	 * Cryptage de mot de passe
	 *
	 * @access public
	 */
	function hashpass($password) {
		return sha1(md5($password));
	}
	
}
?>