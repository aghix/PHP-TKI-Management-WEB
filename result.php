
<?php
include("koneksi.php"); 
if($_POST)
{
    $q = mysqli_real_escape_string($koneksi,$_POST['search']);
    $strSQL_Result = mysqli_query($koneksi,"select nama,email,prov_pos,code from mahasiswa where nama like '%$q%' or email like '%$q%' or code like '%$q%' or prov_pos like '%$q%' order by code LIMIT 10");
    while($row=mysqli_fetch_array($strSQL_Result))
    {
        $username   = $row['nama'];
        $email      = $row['email'];
        $prov      = $row['prov_pos'];
        $code      = $row['code'];
        $b_username = '<strong>'.$q.'</strong>';
        $b_email    = '<strong>'.$q.'</strong>';
        $b_prov    = '<strong>'.$q.'</strong>';
        $b_code    = '<strong>'.$q.'</strong>';
        $final_username = str_ireplace($q, $b_username, $username);
        $final_email = str_ireplace($q, $b_email, $email);
        $final_prov = str_ireplace($q, $b_prov, $prov);
        $final_code = str_ireplace($q, $b_code, $code);
        
        ?>
            <div class="show" align="left">
                <img src="https://fbcdn-sphotos-e-a.akamaihd.net/hphotos-ak-prn1/27301_312848892150607_553904419_n.jpg" style="width:50px; height:50px; float:left; margin-right:6px;" /><span class="name"><?php echo $final_username; ?></span>&nbsp;<br/><?php echo $final_email; ?><br/>
            </div>
        <?php
    }
}
?>
