<?php
App::uses('AppController', 'Controller');
/**
 * Ptests Controller
 *
 * @property Ptest $Ptest
 * @property PaginatorComponent $Paginator
 */
class PtestsController extends AppController {

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
	public function index() {
		$this->Ptest->recursive = 0;
		$this->set('ptests', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Ptest->exists($id)) {
			throw new NotFoundException(__('Invalid ptest'));
		}
		$options = array('conditions' => array('Ptest.' . $this->Ptest->primaryKey => $id));
		$this->set('ptest', $this->Ptest->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Ptest->create();
			if ($this->Ptest->save($this->request->data)) {
				$this->Flash->success(__('The ptest has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The ptest could not be saved. Please, try again.'));
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
		if (!$this->Ptest->exists($id)) {
			throw new NotFoundException(__('Invalid ptest'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Ptest->save($this->request->data)) {
				$this->Flash->success(__('The ptest has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The ptest could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Ptest.' . $this->Ptest->primaryKey => $id));
			$this->request->data = $this->Ptest->find('first', $options);
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
		$this->Ptest->id = $id;
		if (!$this->Ptest->exists()) {
			throw new NotFoundException(__('Invalid ptest'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Ptest->delete()) {
			$this->Flash->success(__('The ptest has been deleted.'));
		} else {
			$this->Flash->error(__('The ptest could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}