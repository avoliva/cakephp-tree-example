<?php
class CategoriesController extends AppController {
    var $name = 'Categories';  
             
	public function index() {
      $categories = $this->Category->generateTreeList(
      	null, null, null, ' ');
      $categories = $this->Category->children(1);
      $this->set(compact('categories'));    
    }
 }
?>