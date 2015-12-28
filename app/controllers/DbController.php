<?php
/**
 * Database controller with crud
 * @author: Mihai Petcu mihai.costin.petcu@gmail.com
 * @date: 1.11.2015
 */
class DbController extends ControllerBase
{
    public function initialize(){
        parent::initialize();
        $this->view->dbs = Db::find();
        $this->view->currentDbId = $this->request->get('id');
        $this->allowRoles();
    }

    /**
     * List all databases
     */
    public function indexAction()
    {
        $this->view->dbsl = $this->view->dbs;
        $this->view->dbs = false;
    }

    /**
     * Show a specific databases with reports
     */
    public function showAction()
    {
        $this->view->dbm = Db::findById($this->request->get('id'));
        $this->view->refreshTime = 1000*60;
    }

    /**
     * Add new database
     * @return mixed
     */
    public function newAction(){
        $db = new Db();
        if($this->processForm($db, 'DbForm')){
            $this->flash->success("Database connection <b>".$this->request->get('name')."</b> was succesfully created.");
            return $this->response->redirect('db/index');
        }
    }

    public function editAction(){
        $db = Db::findById($this->request->get('id'));
        if($this->processForm($db, 'DbForm')){
            $this->flash->success("Database connection <b>".$this->request->get('name')."</b> was succesfully changed.");
            return $this->response->redirect('db/show?id='.$db->getId());
        }
        $this->view->dbm = $db;
    }

    /**
     * Remove a database
     * @return mixed
     */
    public function deleteAction(){
        $db = Db::findById($this->request->get('id'));
        if($this->request->get('confirm')) {
            $dbname = $db->name;
            if ($db->delete()) {
                $this->flash->success("Database connection <b>" . $dbname . "</b> was succesfully removed.");
                return $this->response->redirect('db/index');
            }
            return $this->response->redirect('db/show?id=' . $this->request->get('id'));
        }
        $this->view->dbm = $db;
    }

}
