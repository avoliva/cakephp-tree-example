<?php
App::uses('AppController', 'Controller');
/**
 * Categories Controller
 *
 * @property Category $Category
 * @property PaginatorComponent $Paginator
 */
class CategoriesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
    var $name = 'Categories';  
             
	public function index() {
	  $this->Category->id = $id;
      $categories = $this->Category->generateTreeList(
      	null, null, null, ' ');
      $categories = $this->Category->children(1);
      $this->can_read($this->Category, "Category", $id);
      $this->set(compact('categories'));    
    }

    private function current_position($model, $id) {
    	$children = $this->$model->children(0);
    	foreach ($children as $child) {
    		if ($child[$model]['id'] == $id){
    			return $child;
    		}
    	}
    	return Exception('Something terrible happened.');
    }

    private function can_do_thing($self, $other, $model) {
    	if ($self[$model]['lft'] < $other[$model]['lft']
    		&& $self[$model]['rght'] > $other[$model]['rght']) {
    		return true;
    	}
    	return false;
    }


/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Category->id = $id;
		if (!$this->Category->exists($id)) {
			throw new NotFoundException(__('Invalid category'));
		}
		$categories = $this->Category->children(1);
      	$other = $this->current_position('Category', 1);
      	$self = $this->current_position('Category', 3);
      	debug($this->can_do_thing($self, $other, 'Category'));
      	die;
		// $this->can_read($this->Category, "Category", $id);
      	// $this->set(compact('categories'));   
		$options = array('conditions' => array('Category.' . $this->Category->primaryKey => $id));
		$this->set('category', $this->Category->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Category->create();
			if ($this->Category->save($this->request->data)) {
				$this->Session->setFlash(__('The category has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The category could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Category->exists($id)) {
			throw new NotFoundException(__('Invalid category'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Category->save($this->request->data)) {
				$this->Session->setFlash(__('The category has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The category could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Category.' . $this->Category->primaryKey => $id));
			$this->request->data = $this->Category->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Category->id = $id;
		if (!$this->Category->exists()) {
			throw new NotFoundException(__('Invalid category'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Category->delete()) {
			$this->Session->setFlash(__('The category has been deleted.'));
		} else {
			$this->Session->setFlash(__('The category could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
