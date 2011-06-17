<?php defined('APP_DIR') or die('Cannot access file.');	

class AuthorController extends Controller {
	protected $redirect_bad_actions = 'list';
	protected $default_action = 'list';
	
	private function getAuthor() {
		$author = $this->getParameter(0);
		
		return (!$author || !preg_match('/^[A-Za-z0-9\ \-.]+$/', $author)) ? false : $author;
	}
	
	public function doList() {
		// Get author
		$author = $this->getAuthor();
		if (!$author) {
			$this->forward('posts', 'page');
			die();
		}
		
		// Get the appropriate posts
		$results = Database::getFactory()->query('SELECT date, text FROM ~~~posts WHERE author = ? ORDER BY id DESC LIMIT ?', 
												array (
													$author, 
													Config::get('posts', 'posts_per_page')
												), 
												FALSE, 
												PDO::FETCH_ASSOC);
		
		// Check if json was requested
		if (is_string($this->getParameter(1)) && $this->getParameter(1) == 'json') {
			echo json_encode( array(
				'count' => count($results),
				'rows'  => $results
			));
			die();
		}
		
		// Redirect if the author does not exist
		if (count($results) == 0) {
			$this->forward('posts', 'page');
			die();
		}

		// Generate the templates
		$template = new Template();
		$template->assign('title', 'Posts by '.$author);
		$template->display('header.tpl');
		
		// Print the author header
		$template->assign('author', $author);
		$template->display('author.header.tpl');
		
		// Build up the body with all the posts
		$content = '';
		foreach($results as $result) {
			$template->assign(array('date' => $result['date'],
									'text' => $result['text']));
			$content.=$template->fetch('author.post.tpl');
		}
		
		// Print the content and the footer
		$data = new Smarty_Data();
		$data->assign('content', $content);
		$template->display('body.tpl', $data);
		
		$template->display('footer.tpl');
		
	}

}