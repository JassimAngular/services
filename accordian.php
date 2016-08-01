<?php
include './admin/config.php';
include './admin/db_connection.php';
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>OFFSET PRINTING REQUEST</title>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

        <script>
            $(function() {
                $("#accordion").accordion({
                    collapsible: true
                });
            });
        </script>
    </head>
    <body>
        <?php        
        $user_id_add_set        = $_SESSION['sohorepro_userid'];
        $company_id_view_plot   = $_SESSION['sohorepro_companyid']; 
        $customer_details       = customerName($user_id_add_set);
        $Date                   = date('m-d-Y h:i A', time());
        $comp_name              = getCompName($company_id_view_plot);
        
        $offset_data            = OffsetData('2');
        $order_id               = $offset_data[0]['order_id'];
        ?>
        <div style="float: left;width: 40%;border: 1px solid #CCCCCC;">
            <div style="float: left;width: 100%;background-color: #CCCCCC;text-align: center;font-weight: bold;font-size: 16px;line-height: 40px;">
                OFFSET PRINTING REQUEST
            </div>
            <div style="width: 100%;float: left;margin-top: 10px;">
                <ul style="width: 100%;list-style: none;float: left;">
                    <li style="width: 100%;float: left;">
                        <label style="float: left;width: 20%;margin-bottom: 5px;font-weight: bold;">Date :</label><?php echo $Date; ?>
                    </li>
                    <li style="width: 100%;float: left;">
                        <label style="float: left;width: 20%;margin-bottom: 5px;font-weight: bold;">Name :</label><?php echo $customer_details[0]['cus_fname'].'&nbsp;'.$customer_details[0]['cus_lname']; ?>
                    </li>
                    <li style="width: 100%;float: left;">
                        <label style="float: left;width: 20%;margin-bottom: 5px;font-weight: bold;">Company :</label><?php echo $comp_name; ?>
                    </li>
                    <li style="width: 100%;float: left;">
                        <label style="float: left;width: 20%;margin-bottom: 5px;font-weight: bold;">Email :</label><?php echo $customer_details[0]['cus_contact_email']; ?>
                    </li>
                    <li style="width: 100%;float: left;">
                        <label style="float: left;width: 20%;margin-bottom: 5px;font-weight: bold;">Phone :</label><?php echo $customer_details[0]['cus_contact_phone']; ?>
                    </li>
                </ul>               
            </div>
            
            <div style="float: left;width: 90%;border: 1px solid #CCCCCC;margin-left: 25px;margin-bottom: 10px;border-radius: 3px;line-height: 25px;">
            <div style="width: 100%;float: left;background-color: #CCCCCC;font-weight: bold;text-transform: uppercase;text-align: center;">
                file options
            </div>
            <?php
            if($offset_data[0]['ftp_link'] != '0'){
                
                $ftp_user_name      =   ($offset_data[0]['ftp_user_name'] != '0') ? $offset_data[0]['ftp_user_name'] : '';
                $ftp_password       =   ($offset_data[0]['ftp_pass_word'] != '0') ? $offset_data[0]['ftp_pass_word'] : '';
                ?>
                <div style="width: 90%;float: left;margin-left: 25px;margin-top: 10px;">
                <ul style="width: 100%;list-style: none;float: left;padding: 0;">                    
                    <li>
                        <div style="width: 100%;float: left;background-color: #DDDDDD;border-radius: 3px;margin-bottom: 5px;">
                            <label style="width: 40%;float: left;margin-left: 5px;">FTP Link:</label><span style="width: 55%;float: left;"><?php echo $offset_data[0]['ftp_link']; ?></span>
                        </div>
                    </li>
                    <li>
                        <div style="width: 100%;float: left;background-color: #DDDDDD;border-radius: 3px;margin-bottom: 5px;">
                            <label style="width: 40%;float: left;margin-left: 5px;">User Name:</label><span style="width: 55%;float: left;"><?php echo $ftp_user_name; ?></span>
                        </div>
                    </li>
                    <li>
                        <div style="width: 100%;float: left;background-color: #DDDDDD;border-radius: 3px;margin-bottom: 5px;">
                            <label style="width: 40%;float: left;margin-left: 5px;">Password:</label><span style="width: 55%;float: left;"><?php echo $ftp_password; ?></span>
                        </div>
                    </li>
                </ul>                
            </div>
            <?php           
            }else{                
            ?>
            <div style="width: 90%;float: left;margin-left: 25px;margin-top: 10px;">
                <ul style="width: 100%;list-style: none;float: left;padding: 0;">
                    <?php                           
                    $off_set_files      =   OffsetFiles($order_id);
                    foreach ($off_set_files as $files){
                    ?>
                    <li>
                        <div style="width: 100%;float: left;background-color: #DDDDDD;border-radius: 3px;margin-bottom: 5px;">
                            <label style="width: 80%;float: left;margin-left: 5px;"><?php echo $files['file_name']; ?></label><span style="width: 18%;float: left;">Download</span>
                        </div>
                    </li>
                    <?php                     
                    }
                    ?>                    
                </ul>                
            </div>
            <?php
            }
            ?>
            <div style="width: 90%;float: left;margin-left: 25px;">
                <span style="float: left;width: 100%;font-weight: bold;">My Question:</span>
                <span style="float: left;width: 100%;text-align: justify;"><?php echo $offset_data[0]['question']; ?></span>
            </div>
            </div> 
        </div>
        
        
<?php       
$offset_msg  = '<div style="float: left;width: 40%;border: 1px solid #CCCCCC;">';
$offset_msg  .= '<div style="float: left;width: 100%;background-color: #CCCCCC;text-align: center;font-weight: bold;font-size: 16px;line-height: 40px;">OFFSET PRINTING REQUEST</div>';
$offset_msg  .= '<div style="width: 100%;float: left;margin-top: 10px;">';
$offset_msg  .= '<ul style="width: 100%;list-style: none;float: left;">';
$offset_msg  .= '<li style="width: 100%;float: left;"><label style="float: left;width: 20%;margin-bottom: 5px;font-weight: bold;">Date :</label>'. $Date .'</li>';
$offset_msg  .= '<li style="width: 100%;float: left;"><label style="float: left;width: 20%;margin-bottom: 5px;font-weight: bold;">Name :</label>'.$customer_details[0]['cus_fname'].'&nbsp;'.$customer_details[0]['cus_lname'].'</li>';
$offset_msg  .= '<li style="width: 100%;float: left;"><label style="float: left;width: 20%;margin-bottom: 5px;font-weight: bold;">Company :</label>'.$comp_name.'</li>';
$offset_msg  .= '<li style="width: 100%;float: left;"><label style="float: left;width: 20%;margin-bottom: 5px;font-weight: bold;">Email :</label>'.$customer_details[0]['cus_contact_email'].'</li>';
$offset_msg  .= '<li style="width: 100%;float: left;"><label style="float: left;width: 20%;margin-bottom: 5px;font-weight: bold;">Phone :</label>'.$customer_details[0]['cus_contact_phone'].'</li>';
$offset_msg  .= '</ul></div>';


$offset_msg  .= '<div style="float: left;width: 90%;border: 1px solid #CCCCCC;margin-left: 25px;margin-bottom: 10px;border-radius: 3px;line-height: 25px;">';
$offset_msg  .= '<div style="width: 100%;float: left;background-color: #CCCCCC;font-weight: bold;text-transform: uppercase;text-align: center;">file options</div>';
$offset_msg  .= '<div style="width: 90%;float: left;margin-left: 25px;margin-top: 10px;">';
$offset_msg  .= '<ul style="width: 100%;list-style: none;float: left;padding: 0;">';
$off_set_files      =   OffsetFiles($order_id_offset);
foreach ($off_set_files as $files){
$offset_msg  .= '<li>';
$offset_msg  .= '<div style="width: 100%;float: left;background-color: #DDDDDD;border-radius: 3px;margin-bottom: 5px;">';
$offset_msg  .= '<label style="width: 80%;float: left;margin-left: 5px;">'.$files['file_name'].'</label><span style="width: 18%;float: left;">Download</span>';
$offset_msg  .= '</div></li>';
}                  
$offset_msg  .= '</ul></div>';

$offset_msg  .= '<div style="width: 90%;float: left;margin-left: 25px;">';
$offset_msg  .= '<span style="float: left;width: 100%;font-weight: bold;">My Question:</span>';
$offset_msg  .= '<span style="float: left;width: 100%;text-align: justify;">'.$offset_data[0]['question'].'</span>';
$offset_msg  .= '</div>';
$offset_msg  .= '</div>';
$offset_msg  .= '</div>';
        

$mail_id = getActiveOffset();
    foreach ($mail_id as $to) {
        $result[] = $to['email_id'] . ',';
    }
    array_push($result,$customer_details[0]['cus_contact_email'].',');
    //$to_address = implode("", $result);
    
    echo '<pre>';
    print_r($result);
    echo '</pre>';

 ?>      
        
        


    </body>
</html>