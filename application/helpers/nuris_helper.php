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
function helpNumeric($var, $res = 0)
{
	$var = str_replace('.', '', $var);
	return is_numeric($var) ? $var : $res;
}
		
function radio_aktif($name){?>
			<?php
			if($name == 'y'){?>
			<input type="radio"  name="aktif" id="<?php echo $name; ?>" value='y' checked /> Aktif 
			&nbsp;
			<input type="radio"  name="aktif" id="<?php echo $name; ?>" value='t' /> Tidak Aktif
			<?php }elseif($name == 't'){ ?>
			<input type="radio"  name="aktif" id="<?php echo $name; ?>" value='y' /> Aktif 
			&nbsp;
			<input type="radio" name="aktif" id="<?php echo $name; ?>" checked value='t' /> Tidak Aktif
			<?php }else{ ?>
				<input type="radio" name="aktif" id="<?php echo $name; ?>" checked value='y' /> Aktif 
			&nbsp;
			<input type="radio"  name="aktif" id="<?php echo $name; ?>" value='t' /> Tidak Aktif
			<?php } ?>
<?php } ?>


