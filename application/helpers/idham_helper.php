<?php
function gen_id($kd, $table, $kolom, $panjang)
{
  $ci =& get_instance();
  $query = $ci->db->query("select ifnull(max(substr(".$kolom.",".$panjang.")),0)+1 as max_id from ".$table."");
  $id = $query->row_array();
  var_dump($id);
  $max = $id["max_id"];
  return strtoupper($kd)."-".str_pad($max,4,"0",STR_PAD_LEFT);

  //Penggunaan echo gen_id("kode awal", "nama tabel", "nama kolom", "panjang karakter setelah - ");
}
