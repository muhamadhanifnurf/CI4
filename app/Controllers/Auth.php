<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Auth extends ResourceController
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
    }
    public function login()
    {
        $input = $this->request->getPost();
        $where = [
            "id_card_number" => $input['id_card_number'],
            "password" => $input['password']
        ];
        $data = $this->db->table('societies')
            ->where($where)
            ->get()->getRowArray();
        if ($data) {
            $data["token"] = md5($data["id_card_number"]);
            $regid = [
                "id" => $data['regional_id']
            ];
            $data["regional"] = $this->db->table('regionals')->where($regid)->get()->getRowArray();

            unset($data["id"]);
            unset($data["id_card_number"]);
            unset($data["password"]);
            unset($data["login_tokens"]);
            unset($data["regional_id"]);
            return $this->respond($data, 200);
        } else {
            return $this->respond(['message' => 'id card number or password incorrect'], 401);
        }
    }
    public function logout()
    {
        $input = $this->request->getGet();

        if ($input["token"] != "") {
            return $this->respond(['message' => 'Logout succes'], 200);
        } else {
            return $this->respond(['message' => 'Invalid token'], 401);
        }
    }
}
