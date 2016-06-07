<?PHP

/**
 * Simpla CMS
 *
 * @copyright 	2011 Denis Pikusov
 * @link 		http://simp.la
 * @author 		Denis Pikusov
 *
 * Отображение статей на сайте
 * Этот класс использует шаблоны articles.tpl и article.tpl
 *
 */
 
require_once('View.php');

class FeedbackView extends View
{
	function fetch()
	{
		//$feedback = new stdClass;
		
		//Области
		//$location_subjects = file_get_contents($this->config->root_url.'/js/location/russia.subjects.json');
		//$location_subjects = json_decode($location_subjects);
		//$this->design->assign('location_subjects', $location_subjects->data);		
		

		
		if($this->request->method('post') && $this->request->post('register'))
		{
			$feedback 				= $this->request->post('field');
			$captcha_code           = $this->request->post('captcha_code');
			
			foreach($feedback as $field_name => $value)
			{
				//Тут должна быть проверка полей. 
			}
			
			$this->design->assign('field',  $feedback);
			
			if(empty($_SESSION['captcha_code']) || $_SESSION['captcha_code'] != $captcha_code || empty($captcha_code))
			{
				$this->design->assign('error', 'captcha');
			}
			else
			{
				$this->design->assign('message_send', true);	
				$this->design->assign('data', $feedback);

				// Отправляем письмо
				$email_template = $this->design->fetch($this->config->root_dir.'design/'.$this->settings->theme.'/html/email/email_register_avon.tpl');
				$subject = $this->design->get_var('subject');
				$this->notify->email($this->settings->comment_email, $subject, $email_template, "$feedback[first_name] <$feedback[email]>");
				
				// Приберем сохраненную капчу, иначе можно отключить загрузку рисунков и постить старую
				unset($_SESSION['captcha_code']);
				
				unset($feedback);
			}			
		}

		return $this->design->fetch('feedback.tpl');
	}
}
