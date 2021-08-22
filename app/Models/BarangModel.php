<?php namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model{
    protected $table = 'barang';
    protected $allowedFields = ['nama','kategori','harga','image_name'];


    public function __construct() {
        parent::__construct();
        $db = \Config\Database::connect();
        $builder = $db->table('barang');
    }

    public function get_all_barang() {
        $query = $this->db->query('select * from barang');
        return $query->getResult();
    }

    public function barang_add($data) {

        $query = $this->db->table($this->table)->insert($data);

        return $this->db->insertID();
    }
    public function get_by_id($id) {
        $sql = 'select * from barang where id ='.$id ;
        $query =  $this->db->query($sql);

        return $query->getRow();
    }
    public function barang_update($where, $data) {
        $this->db->table($this->table)->update($data, $where);
        return $this->db->affectedRows();
    }

    public function delete_by_id($id) {
        $this->db->table($this->table)->delete(array('id' => $id));
    }


}
