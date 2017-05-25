<?php
function cmb_dinamis($name,$table,$field,$pk,$selected){
    $ci = get_instance();
    $cmb = "<select name='$name' class='form-control'>";
    $data = $ci->db->get($table)->result();
    foreach ($data as $d){
        $cmb .="<option value='".$d->$pk."'";
        $cmb .= $selected==$d->$pk?" selected='selected'":'';
        $cmb .=">".  strtoupper($d->$field)."</option>";
    }
    $cmb .="</select>";
    return $cmb;
}

function gen_id($kd, $table, $kolom)
{
  $ci =& get_instance();
  $query = $ci->db->query("select ifnull(max(substr(".$kolom.",4)),0)+1 as max_id from ".$table."");
  $id = $query->row_array();
  var_dump($id);
  $max = $id["max_id"];
  return $kd."-".str_pad($max,4,"0",STR_PAD_LEFT);

  //Penggunaan echo gen_id("kode awal", "nama tabel", "nama kolom");
}
