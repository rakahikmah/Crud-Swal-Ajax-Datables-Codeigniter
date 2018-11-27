<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function index()
    {
        $this->load->view('tampildata');
        $this->load->view('ajaxcrud');
    }

    public function datamahasiswa()
    {
        
        $datamahasiswa = $this->datamahasiswa_model->getdatamahasiswa();
        $no =1;
        foreach ($datamahasiswa as  $value) {
            $tbody = array();
            $tbody[] = $no++;
            $tbody[] = $value['nama_mahasiswa'];
            $tbody[] = $value['alamat'];
            $aksi= "<button class='btn btn-success ubah-mahasiswa' data-toggle='modal' data-id=".$value['id'].">Ubah</button>".' '."<button class='btn btn-danger hapus-mahasiswa' id='id' data-toggle='modal' data-id=".$value['id'].">Hapus</button>";
            $tbody[] = $aksi;
            $data[] = $tbody; 
        }

        if ($datamahasiswa) {
            echo json_encode(array('data'=> $data));
        }else{
            echo json_encode(array('data'=>0));
        }
    }

    public function tambahmhs()
    {
        // didapat dari ajax yang dimana data{nama:nama,alamat:alamat}
        $nama = $this->input->post('nama'); 
        $alamat = $this->input->post('alamat');

        $tambahmhs = array (
            'nama_mahasiswa'=>$nama,
            'alamat'        => $alamat
        );

        $data = $this->datamahasiswa_model->insertmahasiswa($tambahmhs);

        echo json_encode($data);
    }

    public function formedit()
    {
        // id yang telah diparsing pada ajax ajaxcrud.php data{id:id}
        $id = $this->input->post('id');

        $data['datapermahasiswa'] = $this->datamahasiswa_model->datamahasiswaedit($id);
        $this->load->view('formeditmhs',$data);
    }

    public function ubahmahasiswa()
    {
        $objdata = array(
            'nama_mahasiswa'=>$this->input->post('editnama'),
            'alamat'=>$this->input->post('editalamat')
        );

        $id = $this->input->post('id');
        $data = $this->datamahasiswa_model->ubahmahasiswa($objdata,$id);

        echo json_encode($data);
    }

    public function hapusmahasiswa()
    {
         // id yang telah diparsing pada ajax ajaxcrud.php data{id:id}
         $id = $this->input->post('id');

         $data = $this->datamahasiswa_model->hapusdatamahasiswa($id);
         echo json_encode($data);
    }

}

/* End of file Home.php */
