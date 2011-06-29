<?php defined('APP_DIR') or die('Cannot access file.');	

class PostsController extends Controller {
	protected $redirect_bad_actions = 'page';
	protected $default_action = 'page';
	
	public function doPage() {
		// Get page
		$page = $this->getParameter(0);
		if (!$page) $page = 1;
		if (!is_numeric($page)) $page = 1;
		
		// Get the total number of posts
		$results = Database::getFactory()->query('SELECT COUNT(*) FROM ~~~posts');
		$total = $results[0][0];
		if ($page < 1 || $page - 1 > $total / Config::get('application', 'posts', 'posts_per_page')) $page = 1;
		
		// Get the appropriate posts
		$results = Database::getFactory()->query('SELECT * FROM ~~~posts ORDER BY id DESC LIMIT ?, ?', 
												array (
													($page-1) * Config::get('application', 'posts', 'posts_per_page'),
													Config::get('application', 'posts', 'posts_per_page')
												));
	
		// Check if JSON was specified
		if ($this->getParameter(1) && $this->getParameter(1) == 'json') {
		
			echo json_encode(array(
				'count' => count($results),
				'rows' => $results
			));
			die();
		}
	
		// Generate the templates
		$template = new Template();
		$template->assign('title', 'Posts Page '.$page);
		$template->display('header.tpl');
		
		// Build up the body, with all the add form and all the posts
		if ($this->getParameter('error')) {
			$template->assign('error', $this->getParameter('error'));
		}
		$content = $template->fetch('add.post.tpl');
		
		foreach($results as $result) {
			$template->assign($result);
			$content.=$template->fetch('post.tpl');
		}
		
		// Add the pagination
		if ($page != 1) $template->assign('next', $page - 1);
		if ($page < ($total / Config::get('application', 'posts', 'posts_per_page'))) $template->assign('previous', $page + 1);
		$template->assign('controller', 'posts');
		$template->assign('action', 'page');
		$content.=$template->fetch('pagination.tpl');

		// Print the content and the footer
		$template->assign('content', $content);
		$template->display('body.tpl');
		
		$template->display('footer.tpl');
		
	}
	
	public function doAdd() {
		// Check post data, if not set redirect
		if (!isset($_POST['submit'])) {
			$this->dispatch('page');
			die();
		}
		
		// Validate post data
		if (!preg_match('/^[A-Za-z0-9\ \-.]+$/', $_POST['author'])) {
			$this->setParameter('error', 'The name you entered contained invalid characters.');
			$this->dispatch('page');
			die();
		}
		
		// Validate input length
		if (strlen($_POST['text']) > Config::get('posts', 'max_post_length')) {
			$this->setParameter('error', 'Your post must be '.Config::get('posts', 'max_post_length').' characters or less.');
			$this->dispatch('page');
			die();
		}
		
		if (strlen($_POST['text']) == 0) {
			$this->setParameter('error', 'You cannot submit an empty post.');
			$this->dispatch('page');
			die();
		}
		
		// Clean user input
		$_POST['text'] = htmlentities($_POST['text'], ENT_QUOTES, 'UTF-8');
		
		// Insert the post
		Database::getFactory()->query('INSERT INTO ~~~posts (author, text) VALUES (?, ?)', 
									  array($_POST['author'], $_POST['text']));

		header('Location: /');
	}	

}