<?PHP
require_once('api/Simpla.php');

class FeatureAdmin extends Simpla
{

	function fetch()
	{
		$feature = new stdClass;
		
		if($this->request->method('post'))
		{
			$feature->id = $this->request->post('id', 'integer');
			$feature->name = $this->request->post('name');
			$feature->in_filter = $this->request->post('in_filter', 'boolean');
			$feature->text = $this->request->post('text');
			$feature->type = $this->request->post('type', 'integer');
			$feature->units = $this->request->post('units', 'string');
			$feature->on_show = $this->request->post('on_show', 'boolean');
			$feature->visible = $this->request->post('visible', 'boolean');
			$feature->visible_category = $this->request->post('visible_category', 'boolean');

			$feature_categories = $this->request->post('feature_categories');

			if(empty($feature->name))
			{
				$this->design->assign('message_error', 'empty_name');
			}
			else
			{
				if(empty($feature->id))
				{
					$feature->id = $this->features->add_feature($feature);
					$feature = $this->features->get_feature($feature->id);
					$this->design->assign('message_success', 'added');
				}
				else
				{
					$this->features->update_feature($feature->id, $feature);
					$feature = $this->features->get_feature($feature->id);
					$this->design->assign('message_success', 'updated');
				}
				
				$this->features->update_feature_categories($feature->id, $feature_categories);
			}
		}
		else
		{
			$feature->id = $this->request->get('id', 'integer');
			
			if(!empty($feature->id))
				$feature = $this->features->get_feature($feature->id);
		}

		$feature_categories = array();	
		if(!empty($feature->id))
		{	
			$feature_categories = $this->features->get_feature_categories($feature->id);
		}
		
		$categories = $this->categories->get_categories_tree();
		$this->design->assign('categories', $categories);
		$this->design->assign('feature', $feature);
		$this->design->assign('feature_categories', $feature_categories);
		return $this->body = $this->design->fetch('feature.tpl');
	}
}