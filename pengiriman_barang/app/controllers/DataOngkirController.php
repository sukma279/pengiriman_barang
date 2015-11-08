<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class DataOngkirController extends ControllerBase
{

    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for data_ongkir
     */
    public function searchAction()
    {

        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "DataOngkir", $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "_id";

        $data_ongkir = DataOngkir::find($parameters);
        if (count($data_ongkir) == 0) {
            $this->flash->notice("The search did not find any data_ongkir");

            return $this->dispatcher->forward(array(
                "controller" => "data_ongkir",
                "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $data_ongkir,
            "limit"=> 10,
            "page" => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Displays the creation form
     */
    public function newAction()
    {

    }

    /**
     * Edits a data_ongkir
     *
     * @param string $_id
     */
    public function editAction($_id)
    {

        if (!$this->request->isPost()) {

            $data_ongkir = DataOngkir::findFirstBy_id($_id);
            if (!$data_ongkir) {
                $this->flash->error("data_ongkir was not found");

                return $this->dispatcher->forward(array(
                    "controller" => "data_ongkir",
                    "action" => "index"
                ));
            }

            $this->view->_id = $data_ongkir->_id;

            $this->tag->setDefault("_id", $data_ongkir->_id);
            $this->tag->setDefault("nama_daerah", $data_ongkir->nama_daerah);
            $this->tag->setDefault("ongkir", $data_ongkir->ongkir);
                      
        }
    }

    /**
     * Creates a new data_ongkir
     */
    public function createAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "data_ongkir",
                "action" => "index"
            ));
        }

        $data_ongkir = new DataOngkir();

        $data_ongkir->nama_daerah = $this->request->getPost("nama_daerah");
        $data_ongkir->ongkir = $this->request->getPost("ongkir");
        
        if (!$data_ongkir->save()) {
            foreach ($data_ongkir->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "data_ongkir",
                "action" => "new"
            ));
        }

        $this->flash->success("data_ongkir was created successfully");

        return $this->dispatcher->forward(array(
            "controller" => "data_ongkir",
            "action" => "index"
        ));

    }

    /**
     * Saves a data_ongkir edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "data_ongkir",
                "action" => "index"
            ));
        }

        $_id = $this->request->getPost("_id");

        $data_ongkir = DataOngkir::findFirstBy_id($_id);
        if (!$data_ongkir) {
            $this->flash->error("data_ongkir does not exist " . $_id);

            return $this->dispatcher->forward(array(
                "controller" => "data_ongkir",
                "action" => "index"
            ));
        }

        $data_ongkir->nama_daerah = $this->request->getPost("nama_daerah");
        $data_ongkir->ongkir = $this->request->getPost("ongkir");
        
        if (!$data_ongkir->save()) {

            foreach ($data_ongkir->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "data_ongkir",
                "action" => "edit",
                "params" => array($data_ongkir->_id)
            ));
        }

        $this->flash->success("data_ongkir was updated successfully");

        return $this->dispatcher->forward(array(
            "controller" => "data_ongkir",
            "action" => "index"
        ));

    }

    /**
     * Deletes a data_ongkir
     *
     * @param string $_id
     */
    public function deleteAction($_id)
    {

        $data_ongkir = DataOngkir::findFirstBy_id($_id);
        if (!$data_ongkir) {
            $this->flash->error("data_ongkir was not found");

            return $this->dispatcher->forward(array(
                "controller" => "data_ongkir",
                "action" => "index"
            ));
        }

        if (!$data_ongkir->delete()) {

            foreach ($data_ongkir->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "data_ongkir",
                "action" => "search"
            ));
        }

        $this->flash->success("data_ongkir was deleted successfully");

        return $this->dispatcher->forward(array(
            "controller" => "data_ongkir",
            "action" => "index"
        ));
    }

}
