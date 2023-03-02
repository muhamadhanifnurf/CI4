<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Consultations extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }
    public function index()
    {
        //
        // $data = [
        //     "status" => 'ok'
        // ];
        // return $this->respond($data);
    }
    public function detail()
    {
        $token = $this->request->getGet('token');
        $data = $this->db->table('consultations')->get()->getResult();
        $array["consultations"] = $data;
        $array["token"] = $token;
        $builder = $this->db->table('consultations');
        $builder->join('societies', 'societies.id = consultations.society_id')
            ->where('societies.login_tokens=', $token);
        $query = $builder->get();
        return $this->respond($array);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        //
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        //
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        //
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        //
    }
}
