<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Mahasiswa extends RestController
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model("Mahasiswa_model", "mahasiswa");
    }

    /* 
        HTTP Code:
        => 200 = OK
        => 201 = CREATED
        => 204 = NO CONTENT
        => 400 = BAD REQUEST
        => 404 = NOT FOUND 
    */

    public function index_get()
    {
        $id = $this->get('id');

        if ($id === null) {
            $mahasiswa = $this->mahasiswa->getAll();
        } else {
            $mahasiswa = $this->mahasiswa->getAll($id);
        }

        if ($mahasiswa) {
            $this->response([
                'status' => true,
                'message' => "success",
                'data' => $mahasiswa,
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => "Mahasiswa not found",
            ], 404);
        }
    }

    public function index_delete()
    {
        $id = $this->delete('id');

        if ($id === null) {
            $this->response([
                'status' => false,
                'message' => "Please provide an id",
            ], 400);
        } else {
            $deleted = $this->mahasiswa->delete($id);

            if ($deleted > 0) {
                // Delete success
                $this->response([
                    'status' => true,
                    'id' => $id,
                    'message' => "Mahasiswa deleted",
                ], 200);
            } else {
                // Id not found
                $this->response([
                    'status' => false,
                    'message' => "Mahasiswa not found",
                ], 404);
            }
        }
    }

    public function index_post()
    {
        $data = array(
            'nama' => $this->post("nama"),
            'nrp' => $this->post("nrp"),
            'email' => $this->post("email"),
            'jurusan' => $this->post("jurusan"),
        );

        $insert = $this->mahasiswa->insert($data);

        if ($insert > 0) {
            $this->response([
                'status' => true,
                'message' => "New mahasiswa added",
            ], 201);
        } else {
            $this->response([
                'status' => false,
                'message' => "Failed",
            ], 400);
        }
    }

    public function index_put()
    {
        $id = $this->put("id");

        $data = array(
            'nama' => $this->put("nama"),
            'nrp' => $this->put("nrp"),
            'email' => $this->put("email"),
            'jurusan' => $this->put("jurusan"),
        );

        $modify = $this->mahasiswa->update($id, $data);

        if ($modify > 0) {
            $this->response([
                'status' => true,
                'id' => $id,
                'message' => "Mahasiswa updated",
            ], 201);
        } else {
            $this->response([
                'status' => false,
                'message' => "Failed",
            ], 400);
        }
    }
}
