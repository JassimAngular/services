<?php
include './admin/config.php';
include './admin/db_connection.php';
error_reporting(0);
if($_SESSION['sohorepro_companyid']  == '')
{
  header("Location:index.php");
  exit;
}

$check_pe_null = CheckPeNull($_SESSION['sohorepro_companyid'],$_SESSION['sohorepro_userid']);
if(count($check_pe_null) > 0){
    $delete_empty = "DELETE FROM sohorepro_plotting_set WHERE company_id = '".$_SESSION['sohorepro_companyid']."' AND user_id = '".$_SESSION['sohorepro_userid']."' AND print_ea = ''";
    mysql_query($delete_empty);
}
?>

 <?php
 if($_GET['multi'] == "1"){
?>
 <script>
     function test_values(){
         alert('123');
     }
     // multiple_recipient();
 </script>
 <?php
 }
 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
 <!-- Mirrored from buckart.com/srsite/SoHoRepro-WebsitePages/store/store.html by HTTrack Website Copier/3.x [XR&CO'2013], Sat, 21 Sep 2013 08:44:50 GMT -->
 <!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
 <head>
 <meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
 <title> SohoRepro </title>

 <!-- base href="http://soho.thinkdesign.com/" -->

 <link rel="stylesheet" href="store_files/style.css" type="text/css" media="screen"> 
 <link rel="stylesheet" href="store_files/theme.css" type="text/css" media="screen"> 
 <link rel="stylesheet" href="store_files/jquery.css" type="text/css" media="screen"> 
 <link rel="stylesheet" href="store_files/tiptip.css" type="text/css" media="screen"> 
 <link rel="stylesheet" href="store_files/ajaxLoader.css" type="text/css" media="screen"> 
 <link rel="stylesheet" href="store_files/flexigrid.css" type="text/css" media="screen"> 
 <link rel="stylesheet" href="store_files/ui.css" type="text/css" media="screen"> 
 <link rel="stylesheet" href="store_files/slick.css" type="text/css" media="screen"> 
 <link rel="stylesheet" href="store_files/kendo.css" type="text/css" media="screen"> 
 <link rel="stylesheet" href="store_files/kendo_002.css" type="text/css" media="screen"> 
 <link rel="stylesheet" href="store_files/style_002.css" type="text/css" media="screen">

 
 <link href="style/popup_style.css" rel="stylesheet" type="text/css" media="all" />
 <!--<link rel="shortcut icon" href="http://soho.thinkdesign.com/favicon.ico" type="image/x-icon">-->
 <link rel="stylesheet" type="text/css" href="store_files/style_layout.css">
 <!--[if IE 7]>
 <link rel="stylesheet" type="text/css" href="css/ie_7_hacks.css" />
 <![endif]-->
 <script src="store_files/jquery.min.js"></script>
 

<link rel="stylesheet" href="js/jquery-ui.css" />
<script src="js/jquery-ui_service.js"></script>

<script type="text/javascript" src="js/jquery.timepicker.js"></script>
 <link rel="stylesheet" href="js/jquery-ui.css" />
<!--<script src="js/jquery-ui_service.js"></script>-->
<link rel="stylesheet" type="text/css" href="js/jquery.timepicker.css" media="screen" />
<!--<script src="js/jquery.js" type="text/javascript" ></script>-->
<script src="js/jquery.maskedinput.js" type="text/javascript" ></script>


<script>
$(document).ready(function() {
     $("#recipient_1").slideDown('slow');
     $("#open_accordian_1").val('1');
});
    
    
    
jQuery(function($){
   $("#zip_ship").mask("99999");
   $("#plus_4_ship").mask("9999");
   $("#phone_ship").mask("999-999-9999");
   $("#phone_plus_4_ship").mask("9999");
});


function show_time(ID)
{
    //alert(ID);
    
    $('#time_picker_icon_'+ID).timepicker({
        'minTime': '8:00am',
        'maxTime': '7:00pm',
        'showDuration': true
    });
}

function show_time_return()
{
    $('#time_picker_icon').timepicker({
        'minTime': '8:00am',
        'maxTime': '7:00pm',
        'showDuration': true
    });
}
    
    
function dtls_reveal(ID)
{
    var slide_up = $("#slide_id").val();
    $("#plotting_details_"+ID).slideToggle();
    if(slide_up != ID){
    $("#plotting_details_"+slide_up).slideUp();
    }
    $("#slide_id").val(ID);
}

function delete_plot(ID)
{
    //alert(ID);
}

 $(document).ready(function() {
var top = $('#fixed_header').offset().top - parseFloat($('#fixed_header').css('marginTop').replace(/auto/, 100));
$(window).scroll(function(event) {
    // what the y position of the scroll is
    var y = $(this).scrollTop();

    // whether that's below the form
    if (y >= top) {
        // if so, ad the fixed class
        $('#fixed_header').addClass('fixed_1');
    } else {
        // otherwise remove it
        $('#fixed_header').removeClass('fixed_1');
    }
});

});




$(window).load(function() {
    var entered_plot_already = $("#entered_plot_already").val();
    if(entered_plot_already > 0){
        document.getElementById('del_type_multi').checked = true;
        multiple_recipient();
    }    
    
    });


function select_taba(ITEMS)
{
    $(".multi_default").removeClass('multi_selected');
    $(".multi_tabs_items_"+ITEMS).addClass('multi_selected');
    $("#tab_content").removeClass('tabs_with_contents');
    $("#tab_content").addClass('tab_border');
}

function add_shipping_address_pop()
{
    $("#comp_name_ship").val('');
    $("#attention_to_ship").val('');
    $("#address_1_ship").val('');
    $("#address_2_ship").val('');
    $("#address_3_ship").val('');
    $("#city_ship").val('');
    //$("#state_ship").val('0');
    $("#zip_ship").val('');  
    $("#plus_4_ship").val('');
    $("#phone_ship").val('');
    $("#phone_plus_4_ship").val('');
    $("body").append("<div class='modal-overlay js-modal-close'></div>");
    $("#title_save").html('Add New Shipping Address');
    $("#asap_popup").fadeIn("slow"); 
}

function add_shipping_address_pop_edit()
{
   var address_book_se = $("#address_book_se").val();
   if(address_book_se != '0'){ 
   $.ajax
        ({
            type: "POST",
            url: "get_recipients.php",
            data: "recipients=123456&address_book_id="+address_book_se+"&address_book_se="+address_book_se,
            beforeSend: loadStart,
            complete: loadStop,
            success: function(option)
            {  
                var datas = option.split("~");
                $("body").append("<div class='modal-overlay js-modal-close'></div>");
                $("#title_save").html('Edit Shipping Address');
                $("#recipient_address").html(datas[0]);
                $("#shipping_address_edit_action").html(datas[1]);
                $("#asap_popup").fadeIn("slow");                
            }
        });
   
   
   }else{
       alert("Please select shipping address");
       $("#address_book_se").css("border", "1px solid #EA4335");
   }
}



function show_service_acc(ID){
    
    var open_accordian_1    =   $("#open_accordian_"+ID).val();
    if(open_accordian_1 != '1'){
    $(".service_recipient").slideUp();
    $("#recipient_"+ID).slideDown('slow');
    $(".open_accordian").val('0');
    $("#open_accordian_"+ID).val('1');
    }
}
</script>


 <style>
     .fixed_1{border-style:solid;border-width:0px; position: fixed; width: 761px; top: 0; z-index: 1; background: #DFDFDF;}
     #result_ref
{
    background-color: #f3f3f3;
    border-top: 0 none;
    box-shadow: 0 0 5px #ccc;
    display: none;
    margin-top: 0;
    overflow: hidden;
    padding: 10px;
    position: absolute;
    right: 0;
    text-align: left;
    top: 19px;
    width: 185px;
}

.auto_reference{
    cursor: pointer;
    list-style-type: none;
}

.auto_reference li:hover
{
    background:#FF7E00;
    color:#FFF;
    cursor:pointer;
}
.auto_reference li
{
    border-bottom: 1px #999 dashed;
}
.auto_reference span{
    font-size: 18px;
}
.none{
    display: none;
}
.progress { position:relative; width:100%; border: 1px solid #ddd; padding: 1px; border-radius: 3px; }
.bar { background-color: #F99B3E; width:0%; height:20px; border-radius: 3px; }
.percent { position:absolute; display:inline-block; top:3px; left:48%; }
.upload_file_prog{
width: 30% !important;
padding: 1.5px;
-webkit-border-radius: 5px;
border: 1px solid #8f8f8f !important;
}
.arch_radio li{
list-style: none;
padding: 0px !important;
padding-left: 0px !important;
padding-bottom: 0px !important;
}
.increse_act{width: 12px;float: left;}
.increse_act img{width: 12px;float: left;}

.time_picker_icon {
    background: #FFFFFF url(images/clock.png) no-repeat 4px 4px;
    padding: 5px 5px 5px 30px;
    /*height: 18px;*/
    cursor: pointer;
    width: 50px;
    width: 75px !important;
}
.shaddows{
        background: white;
        border-radius: 10px;
        -webkit-box-shadow: 0px 0px 8px rgba(0,0,0,0.3);
        -moz-box-shadow: 0px 0px 8px rgba(0,0,0,0.3);
        box-shadow: 0px 0px 8px rgba(0,0,0,0.3);
        position: relative;
        z-index: 90;
}

.modal-overlay {
  opacity: 0.7;
  filter: alpha(opacity=0);
  position: fixed;
  top: 0;
  left: 0;
  z-index: 900;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.3) !important;
}

#asap_popup{
    display: none;
    font-size: 15px;
    position: fixed !important;
    top: 40px;
    left: 35%;
    padding: 5px;
    z-index: 10;
    position: absolute;
    z-index: 1000;
    width: 40%;
    background: white;
    border-bottom: 1px solid #aaa;
    border-radius: 4px;
    box-shadow: 0 3px 9px rgba(0, 0, 0, 0.5);
    border: 1px solid rgba(0, 0, 0, 0.1);
    background-clip: padding-box;
}

.asap_orange{
    cursor: pointer;
    display: inline-block;
    background: #F99B3E;
    color: #FFF;
    padding: 5px 20px;
    border-radius: 5px;
    margin-top: 3px;
    font-weight: bold;
}

.asap_green{
    cursor: pointer;
    display: inline-block;
    background: #019E59;
    color: #FFF;
    padding: 5px 20px;
    border-radius: 5px;
    margin-top: 3px;
    font-weight: bold;
}

.select-dash { border-bottom: 1px dotted #000; }

.modal-overlay {
  opacity: 0.7;
  filter: alpha(opacity=0);
  position: fixed;
  top: 0;
  left: 0;
  z-index: 900;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.3) !important;
}

#address_container li label{
    width: 25%;
    float: left;
    margin-left: 35px;
    font-weight: bold;
}

#address_container li{
        padding-bottom: 10px;
}

.systemForm select {
    width: 20% !important;
}

#tab_multi{
    width:10%;
    height: 30px;
    display: table;
    text-align: center;
    float:left;
    border-bottom: 1px solid #e5e5e5;
    background: #fff;
    white-space: nowrap;
    box-shadow: 2px 2px 2px 2px rgba(0,0,0,.1);
    -webkit-box-shadow: 2px 2px 2px 2px rgba(0,0,0,.1);
    margin-right: 10px;
    cursor: pointer;
    position: relative;
    top: 3px;
    -webkit-transition: all 0.2s ease-in-out;
    -moz-transition: all 0.2s ease-in-out;
    -o-transition: all 0.2s ease-in-out;
    transition: all 0.2s ease-in-out;
}

#tab_multi span{
    display: table-cell;
    vertical-align: middle;
}
#tab_multi:hover{
    background: #BFC5CD;
    top: 0;
}
.multi_selected{
    background: #BFC5CD !important;
    top: 0 !important;
}

.tabs_with_contents{
    float:left;
    width: 95%;
    margin-top: 5px;
    border-bottom: 1px solid #e5e5e5;
    background: #fff;
    white-space: nowrap;
    box-shadow: 2px 2px 2px 2px rgba(0,0,0,.1);
    -webkit-box-shadow: 2px 2px 2px 2px rgba(0,0,0,.1);
    margin-bottom: 10px;
}

.tab_border{
    float:left;
    width: 100%;
    margin-top: 5px;
    border-bottom: 1px solid #e5e5e5;
    background: #fff;
    white-space: nowrap;
    box-shadow: 2px 2px 2px 4px rgba(191, 197, 205, 1);
    -webkit-box-shadow: 2px 2px 2px 4px rgba(191, 197, 205, 1);
    margin-bottom: 10px;
}

#recipient_address ul li{
    float: left;
    width: 50%;
    list-style: none;
}

#recipient_address ul li label{
    float: left;
    width: 50%;
    font-size: 14px;
    /*text-align: center;*/
}

.addinput {
    width: 180px;
    border: 1px solid #e4e4e4;
    padding: 3.5px;
    margin-bottom: 15px;
    font-size: 11px;
    font-weight: bold;
    color: #717171;
    float: left;
    /*margin-left: 50px;*/
}

.service_tab{
    float: left;
    width: 100%;
    margin-top: 10px;
    border: 1px solid #CCC;
}

.service_items{
   float: left;
   width: 100%;
   background-color: #CCC; 
   text-align: center;
   margin-top: 2px;
   font-weight: bold;
   line-height: 25px;
   cursor: pointer;
}

.service_items:nth-child(1) {
    margin-top: 0px;
}

.service_recipient{
   float: left;
   width: 100%;
   margin-left: 20px;
   display: none;
}
 </style>
 
 </head>
 <body>
    <div id="loading" class="none"  style="position: fixed;top: 10%;left: 40%;padding: 5px;z-index: 1002;">
         <img src="admin/images/loading_rainbow.gif" border="0" style="width: 200px;height: 200px;" />
    </div>
    <div id="asap_popup">
        <div style="width: 98%;float:left;text-align: center;background-color: #EEE;padding: 1%;font-weight: bold;font-size: 18px;padding-top: 10px;">
            <span id="title_save" style="text-transform: uppercase;font-size: 16px;">Edit Recipient Address</span>
        </div>
        <div id="recipient_address" style="width: 96%;padding: 2%;float: left;font-size: 14px;line-height: 18px;">
            <ul>
                <li>
                    <label>Company Name</label>
                    <input type="text" class="addinput" name="comp_name" id="comp_name_ship" onkeypress="return comp_name_ok();" />
                </li>
                <li>
                    <label>Attention To</label>
                    <input type="text" class="addinput" name="attention_to" id="attention_to_ship" onkeypress="return attention_to_ok();" />
                </li>
                <li>
                    <label>Address 1</label>
                    <input type="text" class="addinput" name="address_1" id="address_1_ship" onkeypress="return address_1_ok();" />
                </li>
                <li>
                    <label>Address 2</label>
                    <input type="text" class="addinput" name="address_2" id="address_2_ship" />
                </li>
                <li>
                    <label>Address 3</label>
                    <input type="text" class="addinput" name="address_3" id="address_3_ship" />
                </li>
                <li>
                    <label>City</label>
                    <input type="text" class="addinput" name="city" id="city_ship" onkeypress="return city_ok();" />
                </li>
                <li>
                    <?php $state_all = StateAll(); ?>
                    <label>State</label>
                    <select name="state" id="state_ship" class="addinput" style="width: 190px !important;" onchange="return state_ok();">
                        <option value="0">Select state</option>
                        <?php foreach ($state_all as $state) { ?>
                        <option value="<?php echo $state['state_id'] ?>" <?php if($state['state_id'] == '33'){ ?> selected="selected" <?php } ?>><?php echo $state['state_abbr']; ?></option>
                        <?php } ?>
                    </select>
                </li>
                </ul>
            <div style="float: left;width: 50%;">  
                <div style="float:left;width: 48%;">
                    <label style="width: 50%;float:left;">Zip</label>
                    <input type="text" class="addinput" name="zip" id="zip_ship" style="width:80px !important;" onkeypress="return zip_ok();" />
                </div>
                <div style="float:left;width: 48%;">
                    <label style="float: left;width: 50%;">+4</label>
                    <input type="text" class="addinput" name="plus_4" id="plus_4_ship" style="width:60px !important;" />
                </div>
            </div>
            <div style="width: 50%;">  
                <div style="float:left;width: 48%;">
                    <label style="float:left;width: 50%;">Phone</label>
                    <input type="text" class="addinput" name="zip" id="phone_ship" style="width:80px !important;" />
                </div>
                <div style="float:left;width: 48%;">
                    <label style="float: left;width: 50%;">Ext</label>
                    <input type="text" class="addinput" name="plus_4" id="phone_plus_4_ship" style="width:60px !important;" />
                </div>
            </div>
        </div>
        <div id="shipping_address_edit_action" style="float: right;width: 98%;background-color: #EEE;padding: 1%;">
            <span style="float: left;border: 1px solid #BBB;padding: 3px 10px;border-radius: 3px;cursor: pointer;" onclick="return save_recipient_address_new();">Save</span>
            <span style="float: right;border: 1px solid #BBB;padding: 3px 10px;border-radius: 3px;cursor: pointer;" onclick="return close_asap();">Close</span>
        </div>
    </div>
 <div id="body_container">
 <div id="body_content" class="body_wrapper">
 <div id="body_content-inner" class="body_wrapper-inner">

<?php include "includes/header_sidebar.php"; ?>
 
 <div id="content_output">

<?php include "includes/top_nav.php"; ?>
 
 <div id="content_output-data" style="margin-bottom:20px;">  
<!--- TABLE START -->
<?php // include "./service_nav.php"; ?>
<div id="orderWapper">
  <!-- 
<div class="orderBreadCrumb">
</div>
-->

<div style="width: 100%;float: left;font-size: 35px;font-weight: bold;border: 1px solid #ff7e00;border-top: 0px;border-right: 0px; border-left: 0px;" class="orange">
    
    <div style="float:left;width:100%;font-size: 35px;font-weight: bold;">CART</div>
    <span style="font-size: 20px;font-weight: bold;">Delivery Job Reference:</span> <span style="text-transform: uppercase;font-size: 20px;font-weight: bold;"><?php echo $_SESSION['ref_val']; ?></span> 
</div>

<?php
$number_of_sets = EnteredPlotttingPrimary($_SESSION['sohorepro_companyid'],$_SESSION['sohorepro_userid']);
$cust_original_order    = EnteredPlotRecipientsMulti($_SESSION['sohorepro_companyid'],$_SESSION['sohorepro_userid'], $_SESSION['ref_val']);
//echo '<pre>';
//print_r($cust_original_order);

$number_of_sets_lfp     = EnteredLFPPrimary($_SESSION['sohorepro_companyid'],$_SESSION['sohorepro_userid']);
?>
<div class="service_tab"> 
    <?php if(count($number_of_sets) > 0){ ?>
    <div class="service_items" id="service_1" onclick="return show_service_acc('1');">
        PLOTTING & ARCHITECTURAL COPIES
    </div>
    <input type="hidden" name="open_accordian_1" class="open_accordian" id="open_accordian_1" value="" />
    <div class="service_recipient" id="recipient_1">
        
        <div style="width: 95%;float: left;">
                <span style="font-weight: bold;float: left;margin-top: 5px;margin-bottom: 5px;">ORIGINAL ORDER</span>
                <table border="1" style="width: 100%;">
                    <tr bgcolor="#F99B3E">
                        <td style="font-weight: bold;">Option</td> 
                        <td style="font-weight: bold;">Originals</td> 
                        <td style="font-weight: bold;">Sets</td> 
                        <td style="font-weight: bold;">Order Type</td>                            
                        <td style="font-weight: bold;">Size</td>
                        <td style="font-weight: bold;">Output</td>
                        <td style="font-weight: bold;">Media</td>
                        <td style="font-weight: bold;">Binding</td>
                        <td style="font-weight: bold;">Folding</td>
                    </tr>
                    <?php
                     $i = 1;
                    foreach ($cust_original_order as $original){
                        $rowColor = ($i % 2 != 0) ? '#F9F2DE' : '#FCD9A9';
                        $cust_needed_sets       = ($original['print_ea'] != '0') ? $original['print_ea'] : $original['arch_needed'];
                        $cust_order_type        = ($original['plot_arch'] == '0') ? 'Architectural Copies' : 'Plotting on Bond';  
                        $size         = ($original['size'] == 'undefined') ? $original['arch_size'] : $original['size'];
                        $output       = ($original['output'] == 'undefined') ? $original['arch_output'] : $original['output'];
                        $media        = ($original['media'] == 'undefined') ? $original['arch_media'] : $original['media'];
                        $binding      = ($original['binding'] == 'undefined') ? $original['arch_binding'] : $original['binding'];
                        $folding      = ($original['folding'] == 'undefined') ? $original['arch_folding'] : $original['folding'];    
                    ?>
                    <tr bgcolor="<?php echo $rowColor; ?>" style="height: 20px;">
                        <td><?php echo $original['options']; ?></td>
                        <td><?php echo $original['origininals']; ?></td>
                        <td><span id="available_<?php echo $original['options']; ?>"><?php echo $cust_needed_sets; ?></span></td>
                        <td><?php echo $cust_order_type; ?></td>                            
                        <td><?php echo ucwords(strtolower($size)); ?></td>
                        <td><?php echo strtoupper($output); ?></td>
                        <td><?php echo ucfirst($media); ?></td>
                        <td><?php echo ucfirst($binding); ?></td>
                        <td><?php echo ucfirst($folding); ?></td>
                    </tr>
                    <?php 
                    $i++;
                    }         
                    ?>
                </table>
            </div>
        
            <div id="set_form">
            <div id="plotting" action="" method="post" class="systemForm orderform">
                    <!--<form id="plotting" action="" method="post" class="systemForm orderform" >-->
                        
                  <input type="hidden" name="plotting_set" value="0" />
                  <input type="hidden" name="user_session" id="user_session" value="<?php echo $_SESSION['sohorepro_userid']; ?>" />
                        <input type="hidden" name="user_session_comp" id="user_session_comp" value="<?php echo $_SESSION['sohorepro_companyid']; ?>" />
                        <input type="hidden" name="jobref_id" id="jobref_id" value="" />
                        <input type="hidden" name="company_id" id="company_id" value="" />  
                <ul>
                  
                    <div  id="set_1">
                        <input type="hidden" name="pri_inc_val" id="pri_inc_val" value="1" />
                  <li class="clear">
                      
<!--                      <div style="float:left;width: 100%;">
                          <?php
                            $services_items = ServicesItemsReci(); 
                            foreach ($services_items as $items){
                            ?>
                          <div id="tab_multi" class="multi_tabs_items_<?php echo $items['int']; ?> multi_default" onclick="return select_taba('<?php echo $items['int']; ?>');"  title="<?php echo $items['services_name'] ?>">
                              <span><?php echo $items['int']; ?></span>
                          </div>
                            <?php } ?>                          
                      </div>-->
                      <div id="tab_content" class="tabs_with_contents">
                          
                     
                      <div style="width: 96%;margin: auto;margin-top: 10px;" class="serviceOrderSetHolder">
                          <?php
                          $entered_needed_sets = NeededSets($_SESSION['sohorepro_companyid'], $_SESSION['sohorepro_userid']);                          
                          ?>
                          <input type="hidden" name="entered_plot_already" id="entered_plot_already" value="<?php echo count($entered_needed_sets); ?>" />
                          <div style="background-color:#FFFFFF" class="serviceOrderSetWapper" setindex="0">                            
                            <div style="padding-top: 10px;">
                                <input type="radio" name="del_type" id="everything_return" value="1" style="width: 15% !important;" onclick="return everything_return();" /><span style="text-transform: uppercase;font-weight: bold;">Return everything to my office</span>
                            </div>
                            <div>
                                <input type="radio" name="del_type" id="send_everything_to" value="1" style="width: 15% !important;" onclick="return send_everything_to();" /><span style="text-transform: uppercase;font-weight: bold;">Send everything to :</span>                                
                                <select  name="address_book_se" id="address_book_se" class="remove_current" style="width: 20% !important;" onchange="return send_everything_to();">
                                    <option value="0">Address Book</option>
                                    <?php
                                    $address_book = AddressBookCompanyService($_SESSION['sohorepro_companyid']);
                                    foreach ($address_book as $address) { ?>                                                                                        
                                    <option value="<?php echo $address['id']; ?>"><?php echo $address['company_name']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                &nbsp;&nbsp; <span style="text-transform: uppercase;"><span onclick="return add_shipping_address_pop();" style="color: #0001fc;cursor: pointer;">Add entry</span>&nbsp;|&nbsp;<span onclick="return add_shipping_address_pop_edit();" style="color: #0001fc;cursor: pointer;">EDIT</span>&nbsp; to address book</span>
                            </div>
                            <div>
                                <input type="radio" name="del_type" id="del_type_multi" value="1" style="width: 15% !important;" onclick="return multiple_recipient();"  /><span style="text-transform: uppercase;font-weight: bold;">Distribute to one or more locations</span>
                            </div>
                            <div>
                                <input type="radio" name="del_type" id="pickup_soho" value="1" style="width: 15% !important;" onclick="return pickup_soho();" /><span style="text-transform: uppercase;font-weight: bold;">WILL PICKUP FROM SOHO REPRO</span>                                
                                <select style="width: 20% !important;" id="pickup_soho_add" name="pickup_soho_add" onchange="return pickup_soho();">
                                    <option value="1" selected="selected">381 Broome St</option>
                                    <option value="2" >307 7th Ave, 5th Floor</option>
                                </select>
                            </div>
                        </div>
                            <div style="background-color:#FFFFFF" class="serviceOrderSetWapper" setindex="0">
                               
                                <div id="entered_sets">

                                </div>
                                
                                <div id="multi_recipients">

                                </div>
                            
                            <div style="float:right;">
                                <!--<input class="addNewOrderSet" value="Add Set" style="float:right;cursor: pointer;font-size:12px; padding:1.5px; width: 100px;margin-top:-51px; -moz-border-radius: 5px; -webkit-border-radius: 5px;border:1px solid #8f8f8f;" type="button" onclick="return validate_plotting();" />-->
                                <input class="all_are_done" value="Save and Continue" style="display: none;cursor: pointer;font-size: 12px; padding: 1.5px; width: 135px; margin-right: 14px; -moz-border-radius: 5px; -webkit-border-radius: 5px;border:1px solid #8f8f8f;margin-top: -0px !important;" type="button"  />
                            </div>
                              
                          </div>
                          
                          
                        </div>
                    </div>
                      <div style="width:100%;float: left;"> 
                        
                        <div style="float:right;margin-right: 12px;">
                            <input class="addrecipientActionLink" id="add_recipients" value="Add Recipient" style="display: none;margin-left: 5px;float:left;cursor: pointer;font-size:12px; padding:1.5px; width: 100px;margin-top:-51px; -moz-border-radius: 5px; -webkit-border-radius: 5px;border:1px solid #8f8f8f;" type="button" onclick="return add_recipients();" />
                        </div>
                          
                        <div style="float:right;">
                            <!--<input class="addNewOrderSet" value="Add Set" style="float:right;cursor: pointer;font-size:12px; padding:1.5px; width: 100px;margin-top:-51px; -moz-border-radius: 5px; -webkit-border-radius: 5px;border:1px solid #8f8f8f;" type="button" onclick="return validate_plotting();" />-->
                            <input class="addproductActionLink" value="Continue" style="cursor: pointer;font-size: 12px; padding: 1.5px; width: 135px; margin-right: 37px; -moz-border-radius: 5px; -webkit-border-radius: 5px;border:1px solid #8f8f8f;margin-top: -0px !important;" type="button" onclick="return continue_recipient();" />
                        </div>
                      </div>
                      <div id="remain_options" style="float: left;width: 100%;">
                          
                      </div>
              </span>
              </li>
              <li class="clear">
                <span>
                  <div style="height:29px;">
                    &nbsp;
                  </div>
                    
                  <div style="clear:both">
                  </div>
                </span>
              </li>
              </ul>
              
                </div>
            </div>
        
    </div>
    <?php     
    }if (count($number_of_sets_lfp) > 0) {
        $number_of_lfp     = EnteredLFPPrimary($_SESSION['sohorepro_companyid'],$_SESSION['sohorepro_userid']);
    ?>
    <div class="service_items" id="service_2" onclick="return show_service_acc('2');">
     LARGE FORMAT COLOR & BW
    </div>
    <input type="hidden" name="open_accordian_2" class="open_accordian" id="open_accordian_2" value="" />
    <div class="service_recipient" id="recipient_2">
        
        <!--- Fine Art Printing Services Start -->
        
        <div style="width: 95%;float: left;">
                <span style="font-weight: bold;float: left;margin-top: 5px;margin-bottom: 5px;">ORIGINAL ORDER</span>
                <table border="1" style="width: 100%;">
                    <tr bgcolor="#F99B3E">
                        <td style="font-weight: bold;">Option</td> 
                        <td style="font-weight: bold;">Originals</td> 
                        <td style="font-weight: bold;">Sets</td> 
                        <td style="font-weight: bold;">Order Type</td>                            
                        <td style="font-weight: bold;">Size</td>
                        <td style="font-weight: bold;">Output</td>
                        <td style="font-weight: bold;">Media</td>
                        <td style="font-weight: bold;">Binding</td>
                    </tr>
                    <?php
                     $i = 1;
                    foreach ($number_of_lfp as $original){
                        $rowColor = ($i % 2 != 0) ? '#F9F2DE' : '#FCD9A9';
                        $cust_needed_sets       = $original['print_of_each'];
                        $cust_order_type        = "LFP";  
                        $size         = $original['size'];
                        $output       = $original['output'];
                        $media        = $original['media'];
                        $binding      = $original['binding'];
                    ?>
                    <tr bgcolor="<?php echo $rowColor; ?>" style="height: 20px;">
                        <td><?php echo $original['option_id']; ?></td>
                        <td><?php echo $original['original']; ?></td>
                        <td><span id="available_<?php echo $original['options']; ?>"><?php echo $cust_needed_sets; ?></span></td>
                        <td><?php echo $cust_order_type; ?></td>                            
                        <td><?php echo ucwords(strtolower($size)); ?></td>
                        <td><?php echo strtoupper($output); ?></td>
                        <td><?php echo ucfirst($media); ?></td>
                        <td><?php echo ucfirst($binding); ?></td>
                    </tr>
                    <?php 
                    $i++;
                    }         
                    ?>
                </table>
            </div>
        
            <div id="set_form">
            <div id="plotting" action="" method="post" class="systemForm orderform">
                    <!--<form id="plotting" action="" method="post" class="systemForm orderform" >-->
                        
                  <input type="hidden" name="plotting_set" value="0" />
                  <input type="hidden" name="user_session" id="user_session" value="<?php echo $_SESSION['sohorepro_userid']; ?>" />
                        <input type="hidden" name="user_session_comp" id="user_session_comp" value="<?php echo $_SESSION['sohorepro_companyid']; ?>" />
                        <input type="hidden" name="jobref_id" id="jobref_id" value="" />
                        <input type="hidden" name="company_id" id="company_id" value="" />  
                <ul>
                  
                    <div  id="set_1">
                        <input type="hidden" name="pri_inc_val" id="pri_inc_val" value="1" />
                  <li class="clear">
                      
<!--                      <div style="float:left;width: 100%;">
                          <?php
                            $services_items = ServicesItemsReci(); 
                            foreach ($services_items as $items){
                            ?>
                          <div id="tab_multi" class="multi_tabs_items_<?php echo $items['int']; ?> multi_default" onclick="return select_taba('<?php echo $items['int']; ?>');"  title="<?php echo $items['services_name'] ?>">
                              <span><?php echo $items['int']; ?></span>
                          </div>
                            <?php } ?>                          
                      </div>-->
                      <div id="tab_content" class="tabs_with_contents">
                          
                     
                      <div style="width: 96%;margin: auto;margin-top: 10px;" class="serviceOrderSetHolder">
                          <?php
                          $entered_needed_sets = NeededSets($_SESSION['sohorepro_companyid'], $_SESSION['sohorepro_userid']);                          
                          ?>
                          <input type="hidden" name="entered_plot_already" id="entered_plot_already" value="<?php echo count($entered_needed_sets); ?>" />
                          <div style="background-color:#FFFFFF" class="serviceOrderSetWapper" setindex="0">                            
                            <div style="padding-top: 10px;">
                                <input type="radio" name="del_type" id="everything_return" value="1" style="width: 15% !important;" onclick="return everything_return();" /><span style="text-transform: uppercase;font-weight: bold;">Return everything to my office</span>
                            </div>
                            <div>
                                <input type="radio" name="del_type" id="send_everything_to" value="1" style="width: 15% !important;" onclick="return send_everything_to();" /><span style="text-transform: uppercase;font-weight: bold;">Send everything to :</span>                                
                                <select  name="address_book_se" id="address_book_se" class="remove_current" style="width: 20% !important;" onchange="return send_everything_to();">
                                    <option value="0">Address Book</option>
                                    <?php
                                    $address_book = AddressBookCompanyService($_SESSION['sohorepro_companyid']);
                                    foreach ($address_book as $address) { ?>                                                                                        
                                    <option value="<?php echo $address['id']; ?>"><?php echo $address['company_name']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                &nbsp;&nbsp; <span style="text-transform: uppercase;"><span onclick="return add_shipping_address_pop();" style="color: #0001fc;cursor: pointer;">Add entry</span>&nbsp;|&nbsp;<span onclick="return add_shipping_address_pop_edit();" style="color: #0001fc;cursor: pointer;">EDIT</span>&nbsp; to address book</span>
                            </div>
                            <div>
                                <input type="radio" name="del_type" id="del_type_multi" value="1" style="width: 15% !important;" onclick="return multiple_recipient();"  /><span style="text-transform: uppercase;font-weight: bold;">Distribute to one or more locations</span>
                            </div>
                            <div>
                                <input type="radio" name="del_type" id="pickup_soho" value="1" style="width: 15% !important;" onclick="return pickup_soho();" /><span style="text-transform: uppercase;font-weight: bold;">WILL PICKUP FROM SOHO REPRO</span>                                
                                <select style="width: 20% !important;" id="pickup_soho_add" name="pickup_soho_add" onchange="return pickup_soho();">
                                    <option value="1" selected="selected">381 Broome St</option>
                                    <option value="2" >307 7th Ave, 5th Floor</option>
                                </select>
                            </div>
                        </div>
                            <div style="background-color:#FFFFFF" class="serviceOrderSetWapper" setindex="0">
                               
                                <div id="entered_sets">

                                </div>
                                
                                <div id="multi_recipients">

                                </div>
                            
                            <div style="float:right;">
                                <!--<input class="addNewOrderSet" value="Add Set" style="float:right;cursor: pointer;font-size:12px; padding:1.5px; width: 100px;margin-top:-51px; -moz-border-radius: 5px; -webkit-border-radius: 5px;border:1px solid #8f8f8f;" type="button" onclick="return validate_plotting();" />-->
                                <input class="all_are_done" value="Save and Continue" style="display: none;cursor: pointer;font-size: 12px; padding: 1.5px; width: 135px; margin-right: 14px; -moz-border-radius: 5px; -webkit-border-radius: 5px;border:1px solid #8f8f8f;margin-top: -0px !important;" type="button"  />
                            </div>
                              
                          </div>
                          
                          
                        </div>
                    </div>
                      <div style="width:100%;float: left;"> 
                        
                        <div style="float:right;margin-right: 12px;">
                            <input class="addrecipientActionLink" id="add_recipients" value="Add Recipient" style="display: none;margin-left: 5px;float:left;cursor: pointer;font-size:12px; padding:1.5px; width: 100px;margin-top:-51px; -moz-border-radius: 5px; -webkit-border-radius: 5px;border:1px solid #8f8f8f;" type="button" onclick="return add_recipients();" />
                        </div>
                          
                        <div style="float:right;">
                            <!--<input class="addNewOrderSet" value="Add Set" style="float:right;cursor: pointer;font-size:12px; padding:1.5px; width: 100px;margin-top:-51px; -moz-border-radius: 5px; -webkit-border-radius: 5px;border:1px solid #8f8f8f;" type="button" onclick="return validate_plotting();" />-->
                            <input class="addproductActionLink" value="Continue" style="cursor: pointer;font-size: 12px; padding: 1.5px; width: 135px; margin-right: 37px; -moz-border-radius: 5px; -webkit-border-radius: 5px;border:1px solid #8f8f8f;margin-top: -0px !important;" type="button" onclick="return continue_recipient();" />
                        </div>
                      </div>
                      <div id="remain_options" style="float: left;width: 100%;">
                          
                      </div>
              </span>
              </li>
              <li class="clear">
                <span>
                  <div style="height:29px;">
                    &nbsp;
                  </div>
                    
                  <div style="clear:both">
                  </div>
                </span>
              </li>
              </ul>
              
                </div>
            </div>
         <!--- LFP Services End --> 
    <?php    
    }else{    
    ?>    
    <div class="service_items" id="service_2" onclick="return show_service_acc('2');">
        FINE ART PRINTING
    </div>
    <input type="hidden" name="open_accordian_2" class="open_accordian" id="open_accordian_2" value="" />
    <div class="service_recipient" id="recipient_2">
        
        <!--- Fine Art Printing Services Start -->
        
        <div style="width: 95%;float: left;">
                <span style="font-weight: bold;float: left;margin-top: 5px;margin-bottom: 5px;">ORIGINAL ORDER</span>
                <table border="1" style="width: 100%;">
                    <tr bgcolor="#F99B3E">
                        <td style="font-weight: bold;">Option</td> 
                        <td style="font-weight: bold;">Originals</td> 
                        <td style="font-weight: bold;">Sets</td> 
                        <td style="font-weight: bold;">Order Type</td>                            
                        <td style="font-weight: bold;">Size</td>
                        <td style="font-weight: bold;">Output</td>
                        <td style="font-weight: bold;">Media</td>
                        <td style="font-weight: bold;">Binding</td>
                        <td style="font-weight: bold;">Folding</td>
                    </tr>
                    <?php
                     $i = 1;
                    foreach ($cust_original_order as $original){
                        $rowColor = ($i % 2 != 0) ? '#F9F2DE' : '#FCD9A9';
                        $cust_needed_sets       = ($original['print_ea'] != '0') ? $original['print_ea'] : $original['arch_needed'];
                        $cust_order_type        = ($original['plot_arch'] == '0') ? 'Architectural Copies' : 'Plotting on Bond';  
                        $size         = ($original['size'] == 'undefined') ? $original['arch_size'] : $original['size'];
                        $output       = ($original['output'] == 'undefined') ? $original['arch_output'] : $original['output'];
                        $media        = ($original['media'] == 'undefined') ? $original['arch_media'] : $original['media'];
                        $binding      = ($original['binding'] == 'undefined') ? $original['arch_binding'] : $original['binding'];
                        $folding      = ($original['folding'] == 'undefined') ? $original['arch_folding'] : $original['folding'];    
                    ?>
                    <tr bgcolor="<?php echo $rowColor; ?>" style="height: 20px;">
                        <td><?php echo $original['options']; ?></td>
                        <td><?php echo $original['origininals']; ?></td>
                        <td><span id="available_<?php echo $original['options']; ?>"><?php echo $cust_needed_sets; ?></span></td>
                        <td><?php echo $cust_order_type; ?></td>                            
                        <td><?php echo ucwords(strtolower($size)); ?></td>
                        <td><?php echo strtoupper($output); ?></td>
                        <td><?php echo ucfirst($media); ?></td>
                        <td><?php echo ucfirst($binding); ?></td>
                        <td><?php echo ucfirst($folding); ?></td>
                    </tr>
                    <?php 
                    $i++;
                    }         
                    ?>
                </table>
            </div>
        
            <div id="set_form">
            <div id="plotting" action="" method="post" class="systemForm orderform">
                    <!--<form id="plotting" action="" method="post" class="systemForm orderform" >-->
                        
                  <input type="hidden" name="plotting_set" value="0" />
                  <input type="hidden" name="user_session" id="user_session" value="<?php echo $_SESSION['sohorepro_userid']; ?>" />
                        <input type="hidden" name="user_session_comp" id="user_session_comp" value="<?php echo $_SESSION['sohorepro_companyid']; ?>" />
                        <input type="hidden" name="jobref_id" id="jobref_id" value="" />
                        <input type="hidden" name="company_id" id="company_id" value="" />  
                <ul>
                  
                    <div  id="set_1">
                        <input type="hidden" name="pri_inc_val" id="pri_inc_val" value="1" />
                  <li class="clear">
                      
<!--                      <div style="float:left;width: 100%;">
                          <?php
                            $services_items = ServicesItemsReci(); 
                            foreach ($services_items as $items){
                            ?>
                          <div id="tab_multi" class="multi_tabs_items_<?php echo $items['int']; ?> multi_default" onclick="return select_taba('<?php echo $items['int']; ?>');"  title="<?php echo $items['services_name'] ?>">
                              <span><?php echo $items['int']; ?></span>
                          </div>
                            <?php } ?>                          
                      </div>-->
                      <div id="tab_content" class="tabs_with_contents">
                          
                     
                      <div style="width: 96%;margin: auto;margin-top: 10px;" class="serviceOrderSetHolder">
                          <?php
                          $entered_needed_sets = NeededSets($_SESSION['sohorepro_companyid'], $_SESSION['sohorepro_userid']);                          
                          ?>
                          <input type="hidden" name="entered_plot_already" id="entered_plot_already" value="<?php echo count($entered_needed_sets); ?>" />
                          <div style="background-color:#FFFFFF" class="serviceOrderSetWapper" setindex="0">                            
                            <div style="padding-top: 10px;">
                                <input type="radio" name="del_type" id="everything_return" value="1" style="width: 15% !important;" onclick="return everything_return();" /><span style="text-transform: uppercase;font-weight: bold;">Return everything to my office</span>
                            </div>
                            <div>
                                <input type="radio" name="del_type" id="send_everything_to" value="1" style="width: 15% !important;" onclick="return send_everything_to();" /><span style="text-transform: uppercase;font-weight: bold;">Send everything to :</span>                                
                                <select  name="address_book_se" id="address_book_se" class="remove_current" style="width: 20% !important;" onchange="return send_everything_to();">
                                    <option value="0">Address Book</option>
                                    <?php
                                    $address_book = AddressBookCompanyService($_SESSION['sohorepro_companyid']);
                                    foreach ($address_book as $address) { ?>                                                                                        
                                    <option value="<?php echo $address['id']; ?>"><?php echo $address['company_name']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                &nbsp;&nbsp; <span style="text-transform: uppercase;"><span onclick="return add_shipping_address_pop();" style="color: #0001fc;cursor: pointer;">Add entry</span>&nbsp;|&nbsp;<span onclick="return add_shipping_address_pop_edit();" style="color: #0001fc;cursor: pointer;">EDIT</span>&nbsp; to address book</span>
                            </div>
                            <div>
                                <input type="radio" name="del_type" id="del_type_multi" value="1" style="width: 15% !important;" onclick="return multiple_recipient();"  /><span style="text-transform: uppercase;font-weight: bold;">Distribute to one or more locations</span>
                            </div>
                            <div>
                                <input type="radio" name="del_type" id="pickup_soho" value="1" style="width: 15% !important;" onclick="return pickup_soho();" /><span style="text-transform: uppercase;font-weight: bold;">WILL PICKUP FROM SOHO REPRO</span>                                
                                <select style="width: 20% !important;" id="pickup_soho_add" name="pickup_soho_add" onchange="return pickup_soho();">
                                    <option value="1" selected="selected">381 Broome St</option>
                                    <option value="2" >307 7th Ave, 5th Floor</option>
                                </select>
                            </div>
                        </div>
                            <div style="background-color:#FFFFFF" class="serviceOrderSetWapper" setindex="0">
                               
                                <div id="entered_sets">

                                </div>
                                
                                <div id="multi_recipients">

                                </div>
                            
                            <div style="float:right;">
                                <!--<input class="addNewOrderSet" value="Add Set" style="float:right;cursor: pointer;font-size:12px; padding:1.5px; width: 100px;margin-top:-51px; -moz-border-radius: 5px; -webkit-border-radius: 5px;border:1px solid #8f8f8f;" type="button" onclick="return validate_plotting();" />-->
                                <input class="all_are_done" value="Save and Continue" style="display: none;cursor: pointer;font-size: 12px; padding: 1.5px; width: 135px; margin-right: 14px; -moz-border-radius: 5px; -webkit-border-radius: 5px;border:1px solid #8f8f8f;margin-top: -0px !important;" type="button"  />
                            </div>
                              
                          </div>
                          
                          
                        </div>
                    </div>
                      <div style="width:100%;float: left;"> 
                        
                        <div style="float:right;margin-right: 12px;">
                            <input class="addrecipientActionLink" id="add_recipients" value="Add Recipient" style="display: none;margin-left: 5px;float:left;cursor: pointer;font-size:12px; padding:1.5px; width: 100px;margin-top:-51px; -moz-border-radius: 5px; -webkit-border-radius: 5px;border:1px solid #8f8f8f;" type="button" onclick="return add_recipients();" />
                        </div>
                          
                        <div style="float:right;">
                            <!--<input class="addNewOrderSet" value="Add Set" style="float:right;cursor: pointer;font-size:12px; padding:1.5px; width: 100px;margin-top:-51px; -moz-border-radius: 5px; -webkit-border-radius: 5px;border:1px solid #8f8f8f;" type="button" onclick="return validate_plotting();" />-->
                            <input class="addproductActionLink" value="Continue" style="cursor: pointer;font-size: 12px; padding: 1.5px; width: 135px; margin-right: 37px; -moz-border-radius: 5px; -webkit-border-radius: 5px;border:1px solid #8f8f8f;margin-top: -0px !important;" type="button" onclick="return continue_recipient();" />
                        </div>
                      </div>
                      <div id="remain_options" style="float: left;width: 100%;">
                          
                      </div>
              </span>
              </li>
              <li class="clear">
                <span>
                  <div style="height:29px;">
                    &nbsp;
                  </div>
                    
                  <div style="clear:both">
                  </div>
                </span>
              </li>
              </ul>
              
                </div>
            </div>
         <!--- Fine Art Printing Services End -->
    <?php } ?>
    </div>
</div>

<div class="bkgd-stripes-orange" style="margin-bottom: 0px !important;">
    &nbsp;
  </div>
    <?php
    if ($result == "success_plotting") {
        ?>
        <div style="color:#007F2A; text-align:center; padding-bottom:10px;">Set Added Successfully</div>
        <script>setTimeout("location.href=\'service_plotting.php\'", 1000);</script>
        <?php
    } elseif ($result == "failure_plotting") {
        ?>
        <div style="color:#F00; text-align:center; padding-bottom:10px;">Set Added Not Successfully</div>
        <script>setTimeout("location.href=\'service_plotting.php\'", 1000);</script>       
        <?php
    }  elseif($_GET['save_set'] == "1") { ?>
        <div style="color:#007F2A; text-align:center; padding-bottom:10px;">Set Added Successfully</div>
        <script>setTimeout("location.href=\'service_plotting.php\'", 1000);</script>
    <?php
    }
    ?>
    
        
        </div>
        <style>
            .set_ul{
                list-style: none;
                width: 90%;
                margin: 0 auto;
                margin-top: 10px;   
            }
            .set_ul li{               
                width: 100%;
                float: left;
                padding: 5px;                
            }
            .head_plat{
                background: #ff7e00 !important;
                padding: 5px;
            }
            .head_plat span{
                font-size: 14px !important;
                font-weight: bold;           
            }
            .set_ul li span{              
                width: 33%;
                text-align: center;
                float: left;                
            }
            .picker_icon{
                background : #FFFFFF url(images/datepicker-20.png) no-repeat 4px 4px;
                padding: 5px 5px 5px 25px;
                /*height:18px;*/
                cursor: pointer;
                width: 75px !important;
            }
        </style>
        
        
</div>


 <div class="login_loader"></div>
 <div id="backgroundPopup"></div>

<?php
//echo '<pre>';
//print_r($_SESSION);
//echo '</pre>';  
     ?>
     
<!-----TABLE END--->     
 </div>

 <div class="clear"></div>
 </div>
 <div class="clear"></div>

 <div class="footerSRwapper" style="margin:auto;height:61px;">
 <div id="body_footer-inner" class="body_wrapper-inner">
 <ul class="navigation footer">
 <li><a href="#"><span>About SohoRepro</span></a></li>
 <li><a href="#"><span>FAQs</span></a></li>
 <li><a href="#"><span>Privacy Policy</span></a></li>
 <li><a href="#"><span>Security</span></a></li>
 <li><a href="#"><span>Terms of Use</span></a></li>
 <li><a href="#"><span>Contact</span></a></li>
 <div class="clear"></div>
 </ul>
 </div>
 </div>

 </div>
 </div>
 <div class="clear"></div>



 </div>

 <div id="dynamicAppender" style="postion:absolute;top:-5000px"></div>


 <script>    
 
 function multiple_recipient()
 {
     var multi = document.getElementById('del_type_multi').checked;
     if(multi == true){ 
          $.ajax
                ({
                    type: "POST",
                    url: "get_recipients.php",
                    data: "recipients=1",
                    beforeSend: loadStart,
                    complete: loadStop,
                    success: function(option)
                    {  
                        var options_divide = option.split('~');
                        $('#multi_recipients').slideDown();
                        $('#multi_recipients').html(options_divide[0]);
                        $('.addproductActionLink').hide();
                        //$('#remain_options').html(options_divide[1]);
                        //$('#add_recipients').slideDown();
                    }
                });
     }else{
         alert('Mohamed');
     }
 }
 
 function everything_return()
 {
     $("body").append("<div class='modal-overlay'></div>");
     var everything_return = document.getElementById('everything_return').checked;
     if(everything_return == true){ 
         $.ajax
                ({
                    type: "POST",
                    url: "everything_return.php",
                    data: "everything_return=1",
                    beforeSend: loadStart,
                    complete: loadStop,
                    success: function(option)
                    {  
                        $('#multi_recipients').slideDown();
                        $('#multi_recipients').html(option);
                        $('#add_recipients').slideUp();
                        $(".addproductActionLink").hide();
                        $( ".modal-overlay" ).remove();
                    }
                });
     }else{
         $('#multi_recipients').slideUp();
         $('#add_recipients').slideUp();
     }
 }
 
 function continue_recipient_everyting_return()
 {
     var pickup_soho_chk        = document.getElementById('pickup_soho').checked;
     var shipping_id_pre        = $("#address_book_rp").val();
     var shipping_id            = (pickup_soho_chk == true) ? 'P'+shipping_id_pre : shipping_id_pre;
     var user_session           = $("#user_session").val(); 
     var user_session_comp      = $("#user_session_comp").val(); 
     var delivery_type_option   = $("#delivery_type_option").val();
     var delivery_type          = $("#delivery_comp").val();
     
     var avl_sets_1             = $("#avl_sets_1").val();
     var need_sets_1            = $("#need_sets_1").val();
     var size_sets_1            = $("#size_sets_1").val();
     var output_sets_1          = $("#output_sets_1").val();
     var media_sets_1           = $("#media_sets_1").val();
     var binding_sets_1_pre     = $("#binding_sets_1").val();
     var folding_sets_1         = $("#folding_sets_1").val();
     var binding_sets_1         = (binding_sets_1_pre != '') ? binding_sets_1_pre : '0' ;
     
     var avl_sets_2             = $("#avl_sets_2").val();
     var need_sets_2            = $("#need_sets_2").val();
     var size_sets_2            = $("#size_sets_2").val();
     var output_sets_2          = $("#output_sets_2").val();
     var binding_sets_2_pre     = $("#binding_sets_2").val();
     var binding_sets_2         = (binding_sets_2_pre != '') ? binding_sets_2_pre : '0' ;
     var folding_sets_2         = $("#folding_sets_2").val();
     var date_needed            = $("#date_needed").val();
     var time_needed            = $("#time_picker_icon").val();
     var spl_recipient          = $("#spl_recipient").val();
     var contact_ph             = $("#contact_ph").val();
     
     var shipp_att              = $("#shipp_att").val();
     
     var option_id              =   $("#option_id").val();
     
     var size_custom_details    = (size_sets_1 == 'Custom') ? document.getElementById("size_custom_details").value : '0';
     
     var output_page_details    = (output_sets_1 == 'Both') ? document.getElementById("output_page_details").value : '0';
     
     var preffer_del            = document.getElementById('preffer_del').checked;  
     
     var arrange_del            = document.getElementById('arrange_del').checked;
     
     var delivery_type          = (arrange_del == false) ? $("#delivery_comp").val() : '0';
     
     var delivery_comp          = (arrange_del == false) ? document.getElementById("delivery_comp").value : '0';
     var bill_number            = (arrange_del == false) ? document.getElementById("bill_number").value : '0';
     if(arrange_del == false)
     {
        var shipp_comp_1        =   document.getElementById('shipp_comp_1').checked;
            var shipp_comp_1_f  =   (shipp_comp_1 == true) ? document.getElementById("shipp_comp_1").value : '0';
        var shipp_comp_2        =   document.getElementById('shipp_comp_2').checked;
            var shipp_comp_2_f  =   (shipp_comp_2 == true) ? document.getElementById("shipp_comp_2").value : '0';
        var shipp_comp_3        =   document.getElementById('shipp_comp_3').checked;
            var shipp_comp_3_f  =   (shipp_comp_3 == true) ? document.getElementById("other_shipp_type").value : '0';
     }else{
            var shipp_comp_1_f  =   '0';
            var shipp_comp_2_f  =   '0';
            var shipp_comp_3_f  =   '0';
     }      
     
     
     if(shipping_id == '0'){
         alert('Please select send to address');
         $("#address_book_rp").focus();
         return false;
     }
     
//     if(shipp_att == ''){
//         alert('Please enter the attention to');
//         $("#shipp_att").focus();
//         return false;
//     }
     
     if(date_needed == ''){
         alert('Please select when needed');
         $("#date_needed").focus();
         return false;
     }
     
     $.ajax
        ({
            type: "POST",
            url: "get_recipients.php",                  
            data: "recipients=4_4&shipping_id_rec="+encodeURIComponent(shipping_id)+"&avl_sets_1="+encodeURIComponent(avl_sets_1)+"&need_sets_1="+encodeURIComponent(need_sets_1)+"&size_sets_1="+encodeURIComponent(size_sets_1)+"&output_sets_1="+encodeURIComponent(output_sets_1)+"&binding_sets_1="+encodeURIComponent(binding_sets_1)+"&avl_sets_2="+encodeURIComponent(avl_sets_2)+"&need_sets_2="+encodeURIComponent(need_sets_2)+"&size_sets_2="+encodeURIComponent(size_sets_2)+"&output_sets_2="+encodeURIComponent(output_sets_2)+"&binding_sets_2="+encodeURIComponent(binding_sets_2)+"&user_session="+encodeURIComponent(user_session)+"&user_session_comp="+encodeURIComponent(user_session_comp)+"&date_needed="+encodeURIComponent(date_needed)+"&spl_recipient="+encodeURIComponent(spl_recipient)+"&folding_sets_1="+encodeURIComponent(folding_sets_1)+"&folding_sets_2="+encodeURIComponent(folding_sets_2)+"&time_needed="+encodeURIComponent(time_needed)+"&size_custom_details="+encodeURIComponent(size_custom_details)+"&output_page_details="+encodeURIComponent(output_page_details)+"&attention_to="+encodeURIComponent(shipp_att)+"&media_sets_1="+encodeURIComponent(media_sets_1)+"&contact_ph="+encodeURIComponent(contact_ph)+"&option_id="+encodeURIComponent(option_id)+"&delivery_type_option="+encodeURIComponent(delivery_type_option)+"&bill_number="+encodeURIComponent(bill_number)+"&shipp_comp_1_f="+encodeURIComponent(shipp_comp_1_f)+"&shipp_comp_2_f="+encodeURIComponent(shipp_comp_2_f)+"&shipp_comp_3_f="+encodeURIComponent(shipp_comp_3_f)+"&delivery_type="+encodeURIComponent(delivery_type),
            beforeSend: loadStart,
            complete: loadStop,
            success: function(option)
            {  
                if(option == '1'){
                    window.location = "view_all_recipients.php";
                }
            }
        });
 }
 
 function everything_return_arch()
 {
     var everything_return = document.getElementById('everything_return').checked;
     if(everything_return == true){ 
         $.ajax
                ({
                    type: "POST",
                    url: "everything_return.php",
                    data: "everything_return=1_99",
                    beforeSend: loadStart,
                    complete: loadStop,
                    success: function(option)
                    {  
                        $('#multi_recipients').slideDown();
                        $('#multi_recipients').html(option);
                        $('#add_recipients').slideUp();
                    }
                });
     }else{
         $('#multi_recipients').slideUp();
         $('#add_recipients').slideUp();
     }
 }
 
 function send_everything_to()
 {
      $("#send_everything_to").attr('checked', 'checked');
     var send_everything_to = document.getElementById('send_everything_to').checked;
     var address_book_se    = document.getElementById('address_book_se').value;
     $("#address_book_se").css("border", "1px solid #e4e4e4"); 
     if(send_everything_to == true){
         
         if(address_book_se != '0'){
             $.ajax
                ({
                    type: "POST",
                    url: "everything_return_to.php",
                    data: "everything_return_to=1&address_book_se="+address_book_se,
                    beforeSend: loadStart,
                    complete: loadStop,
                    success: function(option)
                    {  
                        $('#multi_recipients').slideDown();
                        $('#multi_recipients').html(option);
                        $('#add_recipients').slideDown();
                        $('.addrecipientActionLink').hide();
                        $(".addproductActionLink").hide();
                    }
                });
         }else{
            alert("Select the address.");
            document.getElementById('address_book_se').focus();
            document.getElementById('send_everything_to').checked = false;
         }
     }else{
         $('#multi_recipients').slideUp();
         $('#add_recipients').slideUp();
     }
 }
 
 function send_everything_to_cancel()
 {
     var send_everything_to = document.getElementById('send_everything_to').checked;
     var address_book_se    = document.getElementById('address_book_se').value;
     if(send_everything_to == true){
         if(address_book_se != '0'){
             $.ajax
                ({
                    type: "POST",
                    url: "everything_return_to.php",
                    data: "everything_return_to=1&address_book_se="+address_book_se,                   
                    success: function(option)
                    {  
                        $('#multi_recipients').slideDown();
                        $('#multi_recipients').html(option);
                        $('#add_recipients').slideDown();
                        $('.addrecipientActionLink').hide();
                        $(".addproductActionLink").hide();
                    }
                });
         }else{
            alert("Select the address.");
            document.getElementById('address_book_se').focus();
            document.getElementById('send_everything_to').checked = false;
         }
     }else{
         $('#multi_recipients').slideUp();
         $('#add_recipients').slideUp();
     }
 }
 
 function pickup_soho()
 {
     // $("body").append("<div class='modal-overlay'></div>");
     var pickup_soho             = document.getElementById('pickup_soho').checked;
     var pickup_from_soho_add    = document.getElementById('pickup_soho_add').value;
     if(pickup_soho == true){
         $.ajax
                ({
                    type: "POST",
                    url: "pickup_from_soho.php",
                    data: "pickup_from_soho=1&pickup_from_soho_add="+pickup_from_soho_add,
                    beforeSend: loadStart,
                    complete: loadStop,
                    success: function(option)
                    {  
                        $('#multi_recipients').slideDown();
                        $('#multi_recipients').html(option);
                        $('#add_recipients').slideDown();
                        $('.addrecipientActionLink').hide();
                        $(".addproductActionLink").hide();
                        //$( ".modal-overlay" ).remove();
                    }
                });
     }else{
         $('#multi_recipients').slideUp();
         $('#add_recipients').slideUp();
     }
 }
 
 function pickup_soho_p()
 {
     var pickup_soho             = document.getElementById('pickup_soho').checked;
     var pickup_from_soho_add    = document.getElementById('address_book_rp').value;
     if(pickup_soho == true){
         $.ajax
                ({
                    type: "POST",
                    url: "pickup_from_soho.php",
                    data: "pickup_from_soho=1&pickup_from_soho_add="+pickup_from_soho_add,
                    beforeSend: loadStart,
                    complete: loadStop,
                    success: function(option)
                    {  
                        $('#multi_recipients').slideDown();
                        $('#multi_recipients').html(option);
                        $('#add_recipients').slideDown();
                    }
                });
     }else{
         $('#multi_recipients').slideUp();
         $('#add_recipients').slideUp();
     }
 }
 
 function add_recipients(){
     
     var pickup_soho_chk        = document.getElementById('pickup_soho').checked;
     var shipping_id_pre        = $("#address_book_rp").val();
     var shipping_id            = (pickup_soho_chk == true) ? 'P'+shipping_id_pre : shipping_id_pre;
     var user_session           = $("#user_session").val(); 
     var user_session_comp      = $("#user_session_comp").val(); 
     
     var avl_sets_1             = $("#avl_sets_1").val();
     var need_sets_1            = $("#need_sets_1").val();
     var size_sets_1            = $("#size_sets_1").val();
     var output_sets_1          = $("#output_sets_1").val();
     var media_sets_1           = $("#media_sets_1").val();
     var binding_sets_1_pre     = $("#binding_sets_1").val();
     var folding_sets_1         = $("#folding_sets_1").val();
     var binding_sets_1         = (binding_sets_1_pre != '') ? binding_sets_1_pre : '0' ;
     
     var avl_sets_2             = $("#avl_sets_2").val();
     var need_sets_2            = $("#need_sets_2").val();
     var size_sets_2            = $("#size_sets_2").val();
     var output_sets_2          = $("#output_sets_2").val();
     var binding_sets_2_pre     = $("#binding_sets_2").val();
     var binding_sets_2         = (binding_sets_2_pre != '') ? binding_sets_2_pre : '0' ;
     var folding_sets_2         = $("#folding_sets_2").val();
     var date_needed            = $("#date_needed").val();
     var time_needed            = $("#time_picker_icon").val();
     var spl_recipient          = $("#spl_recipient").val();
     var contact_ph             = $("#contact_ph").val();
     
     var shipp_att              = $("#shipp_att").val();
     
     var option_id              =   $("#option_id").val();
     
     var size_custom_details    = (size_sets_1 == 'Custom') ? document.getElementById("size_custom_details").value : '0';
     
     var output_page_details    = (output_sets_1 == 'Both') ? document.getElementById("output_page_details").value : '0';
     
     var preffer_del            = document.getElementById('preffer_del').checked;  
     
     var arrange_del            = document.getElementById('arrange_del').checked;
     var delivery_comp          = (arrange_del == false) ? document.getElementById("delivery_comp").value : '0';
     var bill_number            = (arrange_del == false) ? document.getElementById("bill_number").value : '0';
     if(arrange_del == false)
     {
        var shipp_comp_1        =   document.getElementById('shipp_comp_1').checked;
            var shipp_comp_1_f  =   (shipp_comp_1 == true) ? document.getElementById("shipp_comp_1").value : '0';
        var shipp_comp_2        =   document.getElementById('shipp_comp_2').checked;
            var shipp_comp_2_f  =   (shipp_comp_2 == true) ? document.getElementById("shipp_comp_2").value : '0';
        var shipp_comp_3        =   document.getElementById('shipp_comp_3').checked;
            var shipp_comp_3_f  =   (shipp_comp_3 == true) ? document.getElementById("other_shipp_type").value : '0';
     }else{
            var shipp_comp_1_f  =   '0';
            var shipp_comp_2_f  =   '0';
            var shipp_comp_3_f  =   '0';
     }      
     
     
     if(shipping_id == '0'){
         alert('Please select send to address');
         $("#address_book_rp").focus();
         return false;
     }
     
//     if(shipp_att == ''){
//         alert('Please enter the attention to');
//         $("#shipp_att").focus();
//         return false;
//     }
     
     if(date_needed == ''){
         alert('Please select when needed');
         $("#date_needed").focus();
         return false;
     }
           
     if(preffer_del == true){
        var bill_number = $("#bill_number").val(); 
        if(bill_number ==''){
        alert('Please enter the account number');
        $("#bill_number").focus();
        return false;
        }
    }
     
     $.ajax
        ({
            type: "POST",
            url: "get_recipients.php",                  
            data: "recipients=9&shipping_id_rec="+encodeURIComponent(shipping_id)+"&avl_sets_1="+encodeURIComponent(avl_sets_1)+"&need_sets_1="+encodeURIComponent(need_sets_1)+"&size_sets_1="+encodeURIComponent(size_sets_1)+"&output_sets_1="+encodeURIComponent(output_sets_1)+"&binding_sets_1="+encodeURIComponent(binding_sets_1)+"&avl_sets_2="+encodeURIComponent(avl_sets_2)+"&need_sets_2="+encodeURIComponent(need_sets_2)+"&size_sets_2="+encodeURIComponent(size_sets_2)+"&output_sets_2="+encodeURIComponent(output_sets_2)+"&binding_sets_2="+encodeURIComponent(binding_sets_2)+"&user_session="+encodeURIComponent(user_session)+"&user_session_comp="+encodeURIComponent(user_session_comp)+"&date_needed="+encodeURIComponent(date_needed)+"&spl_recipient="+encodeURIComponent(spl_recipient)+"&delivery_type="+encodeURIComponent(delivery_comp)+"&bill_number="+encodeURIComponent(bill_number)+"&shipp_comp_1_f="+encodeURIComponent(shipp_comp_1_f)+"&shipp_comp_2_f="+encodeURIComponent(shipp_comp_2_f)+"&shipp_comp_3_f="+encodeURIComponent(shipp_comp_3_f)+"&folding_sets_1="+encodeURIComponent(folding_sets_1)+"&folding_sets_2="+encodeURIComponent(folding_sets_2)+"&time_needed="+encodeURIComponent(time_needed)+"&size_custom_details="+encodeURIComponent(size_custom_details)+"&output_page_details="+encodeURIComponent(output_page_details)+"&attention_to="+encodeURIComponent(shipp_att)+"&media_sets_1="+encodeURIComponent(media_sets_1)+"&contact_ph="+encodeURIComponent(contact_ph)+"&option_id="+encodeURIComponent(option_id),
            beforeSend: loadStart,
            complete: loadStop,
            success: function(option)
            {  
                var element = option.split("~");
                if(element[0] == element[1]){
                window.location = "view_all_recipients.php";  
                }else{
                $('#multi_recipients').slideDown();
                $('#multi_recipients').html(element[2]);
//                $('#remain_options').html(element[3]);
//                $('#add_recipients').slideDown();
                }
            }
        });
 }
 
 
 function add_recipients_dynamic(OPTION_ID,ID){
     
     var pickup_soho_chk        = document.getElementById('pickup_soho').checked;
     var shipping_id_pre        = $("#address_book_rp_"+OPTION_ID).val();
     var shipping_id            = (pickup_soho_chk == true) ? 'P'+shipping_id_pre : shipping_id_pre;
     var user_session           = $("#user_session").val(); 
     var user_session_comp      = $("#user_session_comp").val(); 
     
     var avl_sets_1             = $("#avl_sets_"+OPTION_ID).val();
     var need_sets_1            = $("#need_sets_"+OPTION_ID).val();
     var size_sets_1            = $("#size_sets_1").val();
     var output_sets_1          = $("#output_sets_1").val();
     var media_sets_1           = $("#media_sets_1").val();
     var binding_sets_1_pre     = $("#binding_sets_1").val();
     var folding_sets_1         = $("#folding_sets_1").val();
     var binding_sets_1         = (binding_sets_1_pre != '') ? binding_sets_1_pre : '0' ;
     
     var avl_sets_2             = $("#avl_sets_2").val();
     var need_sets_2            = $("#need_sets_2").val();
     var size_sets_2            = $("#size_sets_2").val();
     var output_sets_2          = $("#output_sets_2").val();
     var binding_sets_2_pre     = $("#binding_sets_2").val();
     var binding_sets_2         = (binding_sets_2_pre != '') ? binding_sets_2_pre : '0' ;
     var folding_sets_2         = $("#folding_sets_2").val();
     var date_needed            = $("#date_needed_"+OPTION_ID).val();
     var time_needed            = $("#time_picker_icon_"+OPTION_ID).val();
     var spl_recipient          = $("#spl_recipient_"+OPTION_ID).val();
     var contact_ph             = $("#contact_ph_"+OPTION_ID).val();
     var option_type            = $("#option_type_"+OPTION_ID).val();
     
     var shipp_att              = $("#shipp_att_"+OPTION_ID).val();
     
     var option_id              =   $("#option_id_"+OPTION_ID).val();
     
     var size_custom_details    = (size_sets_1 == 'Custom') ? document.getElementById("size_custom_details").value : '0';
     
     var output_page_details    = (output_sets_1 == 'Both') ? document.getElementById("output_page_details").value : '0';
     
     var preffer_del            = document.getElementById("preffer_del_"+OPTION_ID).checked;  
     
     var arrange_del            = document.getElementById("arrange_del_"+OPTION_ID).checked;
     
     var delivery_comp          = (arrange_del == false) ? document.getElementById("delivery_comp_"+OPTION_ID).value : '0';
     var bill_number            = (arrange_del == false) ? document.getElementById("bill_number_"+OPTION_ID).value : '0';
     if(arrange_del == false)
     {
        var shipp_comp_1        =   document.getElementById("shipp_comp_1_"+OPTION_ID).checked;
            var shipp_comp_1_f  =   (shipp_comp_1 == true) ? document.getElementById("shipp_comp_1_"+OPTION_ID).value : '0';
        var shipp_comp_2        =   document.getElementById("shipp_comp_2_"+OPTION_ID).checked;
            var shipp_comp_2_f  =   (shipp_comp_2 == true) ? document.getElementById("shipp_comp_2_"+OPTION_ID).value : '0';
        var shipp_comp_3        =   document.getElementById("shipp_comp_3_"+OPTION_ID).checked;
            var shipp_comp_3_f  =   (shipp_comp_3 == true) ? document.getElementById("other_shipp_type_"+OPTION_ID).value : '0';
     }else{
            var shipp_comp_1_f  =   '0';
            var shipp_comp_2_f  =   '0';
            var shipp_comp_3_f  =   '0';
     }          
     
     
     if(shipping_id == '0'){
         alert('Please select send to address');
         $("#address_book_rp").focus();
         return false;
     }
     
//     if(shipp_att == ''){
//         alert('Please enter the attention to');
//         $("#shipp_att").focus();
//         return false;
//     }
     
     if(date_needed == ''){
         alert('Please select when needed');
         $("#date_needed").focus();
         return false;
     }
           
     if(preffer_del == true){
        var bill_number = $("#bill_number_"+OPTION_ID).val(); 
        if(bill_number ==''){
        alert('Please enter the account number');
        $("#bill_number_"+OPTION_ID).focus();
        return false;
        }
    }
     
    if(avl_sets_1 == '1'){
        one_more_set(ID);
        top_order_summary(OPTION_ID);
       // return false;
    }
     $.ajax
        ({
            type: "POST",
            url: "get_recipients.php",                  
            data: "recipients=22&shipping_id_rec="+encodeURIComponent(shipping_id)+"&avl_sets_1="+encodeURIComponent(avl_sets_1)+"&need_sets_1="+encodeURIComponent(need_sets_1)+"&size_sets_1="+encodeURIComponent(size_sets_1)+"&output_sets_1="+encodeURIComponent(output_sets_1)+"&binding_sets_1="+encodeURIComponent(binding_sets_1)+"&avl_sets_2="+encodeURIComponent(avl_sets_2)+"&need_sets_2="+encodeURIComponent(need_sets_2)+"&size_sets_2="+encodeURIComponent(size_sets_2)+"&output_sets_2="+encodeURIComponent(output_sets_2)+"&binding_sets_2="+encodeURIComponent(binding_sets_2)+"&user_session="+encodeURIComponent(user_session)+"&user_session_comp="+encodeURIComponent(user_session_comp)+"&date_needed="+encodeURIComponent(date_needed)+"&spl_recipient="+encodeURIComponent(spl_recipient)+"&delivery_type="+encodeURIComponent(delivery_comp)+"&bill_number="+encodeURIComponent(bill_number)+"&shipp_comp_1_f="+encodeURIComponent(shipp_comp_1_f)+"&shipp_comp_2_f="+encodeURIComponent(shipp_comp_2_f)+"&shipp_comp_3_f="+encodeURIComponent(shipp_comp_3_f)+"&folding_sets_1="+encodeURIComponent(folding_sets_1)+"&folding_sets_2="+encodeURIComponent(folding_sets_2)+"&time_needed="+encodeURIComponent(time_needed)+"&size_custom_details="+encodeURIComponent(size_custom_details)+"&output_page_details="+encodeURIComponent(output_page_details)+"&attention_to="+encodeURIComponent(shipp_att)+"&media_sets_1="+encodeURIComponent(media_sets_1)+"&contact_ph="+encodeURIComponent(contact_ph)+"&option_id="+encodeURIComponent(option_id)+"&option_type="+encodeURIComponent(option_type),
            beforeSend: loadStart,
            complete: loadStop,
            success: function(option)
            {  
//                var element = option.split("~");
//                if(element[0] == element[1]){
//                window.location = "view_all_recipients.php";  
//                }else{                
//                //$('#optiond_dynamic_'+OPTION_ID).html(element[2]);
//                $('#multi_recipients').slideDown();
//                $('#multi_recipients').html(element[2]);
//                }
                  multiple_recipient_nmjk();
                  
            }
        });
 }
 
 function one_more_set(ID)
 {
     $.ajax
        ({
            type: "POST",
            url: "get_recipients.php",                  
            data: "recipients=95&one_more_set_id="+encodeURIComponent(ID),
            beforeSend: loadStart,
            complete: loadStop,
            success: function(option)
            {  
                
            }
        });
 }
 
 function add_recipients_dynamic_go_next()
 {
     window.location = "view_all_recipients.php"; 
 }
 
 function add_recipients_dynamic_go_next_jk(OPTION_ID)
 {
     
     var pickup_soho_chk        = document.getElementById('pickup_soho').checked;
     var shipping_id_pre        = $("#address_book_rp_"+OPTION_ID).val();
     var shipping_id            = (pickup_soho_chk == true) ? 'P'+shipping_id_pre : shipping_id_pre;
     var user_session           = $("#user_session").val(); 
     var user_session_comp      = $("#user_session_comp").val(); 
     
     var avl_sets_1             = $("#avl_sets_"+OPTION_ID).val();
     var need_sets_1            = $("#need_sets_"+OPTION_ID).val();
     var size_sets_1            = $("#size_sets_"+OPTION_ID).val();
     var output_sets_1          = $("#output_sets_"+OPTION_ID).val();
     var media_sets_1           = $("#media_sets_"+OPTION_ID).val();
     var binding_sets_1_pre     = $("#binding_sets_"+OPTION_ID).val();
     var folding_sets_1         = $("#folding_sets_"+OPTION_ID).val();
     var binding_sets_1         = (binding_sets_1_pre != '') ? binding_sets_1_pre : '0' ;
     
     var avl_sets_2             = $("#avl_sets_2").val();
     var need_sets_2            = $("#need_sets_2").val();
     var size_sets_2            = $("#size_sets_2").val();
     var output_sets_2          = $("#output_sets_2").val();
     var binding_sets_2_pre     = $("#binding_sets_2").val();
     var binding_sets_2         = (binding_sets_2_pre != '') ? binding_sets_2_pre : '0' ;
     var folding_sets_2         = $("#folding_sets_2").val();
     var date_needed            = $("#date_needed_"+OPTION_ID).val();
     var time_needed            = $("#time_picker_icon_"+OPTION_ID).val();
     var spl_recipient          = $("#spl_recipient_"+OPTION_ID).val();
     var contact_ph             = $("#contact_ph_"+OPTION_ID).val();
     var option_type            = $("#option_type_"+OPTION_ID).val();
     
     var shipp_att              = $("#shipp_att_"+OPTION_ID).val();
     
     var option_id              =   $("#option_id_"+OPTION_ID).val();
     
     var size_custom_details    = (size_sets_1 == 'Custom') ? document.getElementById("size_custom_details").value : '0';
     
     var output_page_details    = (output_sets_1 == 'Both') ? document.getElementById("output_page_details").value : '0';
     
     var preffer_del            = document.getElementById("preffer_del_"+OPTION_ID).checked;  
     
     var arrange_del            = document.getElementById("arrange_del_"+OPTION_ID).checked;
     
     var delivery_comp          = (arrange_del == false) ? document.getElementById("delivery_comp_"+OPTION_ID).value : '0';
     var bill_number            = (arrange_del == false) ? document.getElementById("bill_number_"+OPTION_ID).value : '0';
     if(arrange_del == false)
     {
        var shipp_comp_1        =   document.getElementById("shipp_comp_1_"+OPTION_ID).checked;
            var shipp_comp_1_f  =   (shipp_comp_1 == true) ? document.getElementById("shipp_comp_1_"+OPTION_ID).value : '0';
        var shipp_comp_2        =   document.getElementById("shipp_comp_2_"+OPTION_ID).checked;
            var shipp_comp_2_f  =   (shipp_comp_2 == true) ? document.getElementById("shipp_comp_2_"+OPTION_ID).value : '0';
        var shipp_comp_3        =   document.getElementById("shipp_comp_3_"+OPTION_ID).checked;
            var shipp_comp_3_f  =   (shipp_comp_3 == true) ? document.getElementById("other_shipp_type_"+OPTION_ID).value : '0';
     }else{
            var shipp_comp_1_f  =   '0';
            var shipp_comp_2_f  =   '0';
            var shipp_comp_3_f  =   '0';
     }          
     
     
     if(shipping_id == '0'){
         alert('Please select send to address');
         $("#address_book_rp").focus();
         return false;
     }
     
//     if(shipp_att == ''){
//         alert('Please enter the attention to');
//         $("#shipp_att").focus();
//         return false;
//     }
     
     if(date_needed == ''){
         alert('Please select when needed');
         $("#date_needed").focus();
         return false;
     }
           
     if(preffer_del == true){
        var bill_number = $("#bill_number_"+OPTION_ID).val(); 
        if(bill_number ==''){
        alert('Please enter the account number');
        $("#bill_number_"+OPTION_ID).focus();
        return false;
        }
    }
    
     $.ajax
        ({
            type: "POST",
            url: "get_recipients.php",                  
            data: "recipients=22&shipping_id_rec="+encodeURIComponent(shipping_id)+"&avl_sets_1="+encodeURIComponent(avl_sets_1)+"&need_sets_1="+encodeURIComponent(need_sets_1)+"&size_sets_1="+encodeURIComponent(size_sets_1)+"&output_sets_1="+encodeURIComponent(output_sets_1)+"&binding_sets_1="+encodeURIComponent(binding_sets_1)+"&avl_sets_2="+encodeURIComponent(avl_sets_2)+"&need_sets_2="+encodeURIComponent(need_sets_2)+"&size_sets_2="+encodeURIComponent(size_sets_2)+"&output_sets_2="+encodeURIComponent(output_sets_2)+"&binding_sets_2="+encodeURIComponent(binding_sets_2)+"&user_session="+encodeURIComponent(user_session)+"&user_session_comp="+encodeURIComponent(user_session_comp)+"&date_needed="+encodeURIComponent(date_needed)+"&spl_recipient="+encodeURIComponent(spl_recipient)+"&delivery_type="+encodeURIComponent(delivery_comp)+"&bill_number="+encodeURIComponent(bill_number)+"&shipp_comp_1_f="+encodeURIComponent(shipp_comp_1_f)+"&shipp_comp_2_f="+encodeURIComponent(shipp_comp_2_f)+"&shipp_comp_3_f="+encodeURIComponent(shipp_comp_3_f)+"&folding_sets_1="+encodeURIComponent(folding_sets_1)+"&folding_sets_2="+encodeURIComponent(folding_sets_2)+"&time_needed="+encodeURIComponent(time_needed)+"&size_custom_details="+encodeURIComponent(size_custom_details)+"&output_page_details="+encodeURIComponent(output_page_details)+"&attention_to="+encodeURIComponent(shipp_att)+"&media_sets_1="+encodeURIComponent(media_sets_1)+"&contact_ph="+encodeURIComponent(contact_ph)+"&option_id="+encodeURIComponent(option_id)+"&option_type="+encodeURIComponent(option_type),
            beforeSend: loadStart,
            complete: loadStop,
            success: function(option)
            {  
//                var element = option.split("~");
//                if(element[0] == element[1]){
//                window.location = "view_all_recipients.php";  
//                }else{                
//                //$('#optiond_dynamic_'+OPTION_ID).html(element[2]);
//                $('#multi_recipients').slideDown();
//                $('#multi_recipients').html(element[2]);
//                }
                  multiple_recipient_nmjk();
                  //top_order_summary(OPTION_ID);
            }
        });
     
 }
 
 function multiple_recipient_nmjk(){
        
    var multi = document.getElementById("del_type_multi").checked;         
     if(multi == true){
		$.ajax
                ({
                    type: "POST",
                    url: "get_recipients.php",
                    data: "recipients=234",
                    beforeSend: loadStart,
                    complete: loadStop,
                    success: function(option)
                    {  
					var element = option.split("~");
					if(element[0] == element[1]){
					window.location = "view_all_recipients.php";  
					}else{
					$('#multi_recipients').slideDown();
					$('#multi_recipients').html(element[7]);
                                        $("#entered_sets").slideDown();
					$("#entered_sets").html(element[3]);  
                                        
                                        $(".all_are_done").show();    
                                        $(".all_are_done").attr('onclick', 'return add_recipients_dynamic_go_next('+element[2]+');');
					}
				}
                });
	}
 }
 
 function top_order_summary(OPTION_ID)
 {
     var current_sets = $("#available_"+OPTION_ID).html();
     $("#available_"+OPTION_ID).html((Number(current_sets) + 1));
 }
 
 function asap_dynamic(OPTION_ID)
{
    var current_status  =   $("#asap_status_"+OPTION_ID).attr('class');
    var change_status   =   (current_status == "asap_orange") ? 'asap_green' : 'asap_orange';    
    
    var current_dte_neede    = $("#date_needed_"+OPTION_ID).val();
    var current_time_neede   = $("#time_picker_icon_"+OPTION_ID).val();
    var change_date          = (current_dte_neede == 'ASAP') ? '' : 'ASAP';
    var change_time          = (current_time_neede == 'ASAP') ? '' : 'ASAP';
       
    
    if(OPTION_ID != '0'){
        
     var pickup_soho_chk        = document.getElementById('pickup_soho').checked;
     var shipping_id_pre        = $("#address_book_rp_"+OPTION_ID).val();
     var shipping_id            = (pickup_soho_chk == true) ? 'P'+shipping_id_pre : shipping_id_pre;
     var user_session           = $("#user_session").val(); 
     var user_session_comp      = $("#user_session_comp").val(); 
     
     var avl_sets_1             = $("#avl_sets_"+OPTION_ID).val();
     var need_sets_1            = $("#need_sets_"+OPTION_ID).val();
     var size_sets_1            = $("#size_sets_"+OPTION_ID).val();
     var output_sets_1          = $("#output_sets_"+OPTION_ID).val();
     var media_sets_1           = $("#media_sets_"+OPTION_ID).val();
     var binding_sets_1_pre     = $("#binding_sets_"+OPTION_ID).val();
     var folding_sets_1         = $("#folding_sets_"+OPTION_ID).val();
     var binding_sets_1         = (binding_sets_1_pre != '') ? binding_sets_1_pre : '0' ;
     
     var avl_sets_2             = $("#avl_sets_2").val();
     var need_sets_2            = $("#need_sets_2").val();
     var size_sets_2            = $("#size_sets_2").val();
     var output_sets_2          = $("#output_sets_2").val();
     var binding_sets_2_pre     = $("#binding_sets_2").val();
     var binding_sets_2         = (binding_sets_2_pre != '') ? binding_sets_2_pre : '0' ;
     var folding_sets_2         = $("#folding_sets_2").val();
     var date_needed            = $("#date_needed_"+OPTION_ID).val();
     var time_needed            = $("#time_picker_icon_"+OPTION_ID).val();
     var spl_recipient          = $("#spl_recipient_"+OPTION_ID).val();
     var contact_ph             = $("#contact_ph_"+OPTION_ID).val();
     var option_type            = $("#option_type_"+OPTION_ID).val();
     
     var shipp_att              = $("#shipp_att_"+OPTION_ID).val();
     
     var option_id              =   $("#option_id_"+OPTION_ID).val();
     
     var size_custom_details    = (size_sets_1 == 'Custom') ? document.getElementById("size_custom_details").value : '0';
     
     var output_page_details    = (output_sets_1 == 'Both') ? document.getElementById("output_page_details").value : '0';
     
     //var preffer_del            = document.getElementById("preffer_del_"+OPTION_ID).checked;  
     
     var arrange_del            = document.getElementById("arrange_del_"+OPTION_ID).checked;
     
     var delivery_comp          = (arrange_del == false) ? document.getElementById("delivery_comp_"+OPTION_ID).value : '0';
     var bill_number            = (arrange_del == false) ? document.getElementById("bill_number_"+OPTION_ID).value : '0';
     if(arrange_del == false)
     {
        var shipp_comp_1        =   document.getElementById("shipp_comp_1_"+OPTION_ID).checked;
            var shipp_comp_1_f  =   (shipp_comp_1 == true) ? document.getElementById("shipp_comp_1_"+OPTION_ID).value : '0';
        var shipp_comp_2        =   document.getElementById("shipp_comp_2_"+OPTION_ID).checked;
            var shipp_comp_2_f  =   (shipp_comp_2 == true) ? document.getElementById("shipp_comp_2_"+OPTION_ID).value : '0';
        var shipp_comp_3        =   document.getElementById("shipp_comp_3_"+OPTION_ID).checked;
            var shipp_comp_3_f  =   (shipp_comp_3 == true) ? document.getElementById("other_shipp_type_"+OPTION_ID).value : '0';
     }else{
            var shipp_comp_1_f  =   '0';
            var shipp_comp_2_f  =   '0';
            var shipp_comp_3_f  =   '0';
     }      
     
     $.ajax
        ({
            type: "POST",
            url: "get_recipients.php",                  
            data: "recipients=31&shipping_id_rec="+encodeURIComponent(shipping_id)+"&avl_sets_1="+encodeURIComponent(avl_sets_1)+"&need_sets_1="+encodeURIComponent(need_sets_1)+"&size_sets_1="+encodeURIComponent(size_sets_1)+"&output_sets_1="+encodeURIComponent(output_sets_1)+"&binding_sets_1="+encodeURIComponent(binding_sets_1)+"&avl_sets_2="+encodeURIComponent(avl_sets_2)+"&need_sets_2="+encodeURIComponent(need_sets_2)+"&size_sets_2="+encodeURIComponent(size_sets_2)+"&output_sets_2="+encodeURIComponent(output_sets_2)+"&binding_sets_2="+encodeURIComponent(binding_sets_2)+"&user_session="+encodeURIComponent(user_session)+"&user_session_comp="+encodeURIComponent(user_session_comp)+"&date_needed="+encodeURIComponent(date_needed)+"&spl_recipient="+encodeURIComponent(spl_recipient)+"&delivery_type="+encodeURIComponent(delivery_comp)+"&bill_number="+encodeURIComponent(bill_number)+"&shipp_comp_1_f="+encodeURIComponent(shipp_comp_1_f)+"&shipp_comp_2_f="+encodeURIComponent(shipp_comp_2_f)+"&shipp_comp_3_f="+encodeURIComponent(shipp_comp_3_f)+"&folding_sets_1="+encodeURIComponent(folding_sets_1)+"&folding_sets_2="+encodeURIComponent(folding_sets_2)+"&time_needed="+encodeURIComponent(time_needed)+"&size_custom_details="+encodeURIComponent(size_custom_details)+"&output_page_details="+encodeURIComponent(output_page_details)+"&attention_to="+encodeURIComponent(shipp_att)+"&media_sets_1="+encodeURIComponent(media_sets_1)+"&contact_ph="+encodeURIComponent(contact_ph)+"&option_id="+encodeURIComponent(option_id)+"&option_type="+encodeURIComponent(option_type),           
            success: function(option)
            {  
                //console.log('Added Previous!!!');
                $("#asap_status_"+OPTION_ID).removeClass(current_status);
                $("#asap_status_"+OPTION_ID).addClass(change_status);
                
                $("#date_needed_"+OPTION_ID).val(change_date);
                $("#time_picker_icon_"+OPTION_ID).val(change_time);
                
            }
        });
            
        }else{
            //console.log('Mohamed')
        }

}
 
 function update_current_option(OPTION_ID){
  
     var pickup_soho_chk        = document.getElementById('pickup_soho').checked;
     var shipping_id_pre        = $("#address_book_rp_"+OPTION_ID).val();
     var shipping_id            = (pickup_soho_chk == true) ? 'P'+shipping_id_pre : shipping_id_pre;
     var user_session           = $("#user_session").val(); 
     var user_session_comp      = $("#user_session_comp").val(); 
     
     var avl_sets_1             = $("#avl_sets_"+OPTION_ID).val();
     var need_sets_1            = $("#need_sets_"+OPTION_ID).val();
     var size_sets_1            = $("#size_sets_"+OPTION_ID).val();
     var output_sets_1          = $("#output_sets_"+OPTION_ID).val();
     var media_sets_1           = $("#media_sets_"+OPTION_ID).val();
     var binding_sets_1_pre     = $("#binding_sets_"+OPTION_ID).val();
     var folding_sets_1         = $("#folding_sets_"+OPTION_ID).val();
     var binding_sets_1         = (binding_sets_1_pre != '') ? binding_sets_1_pre : '0' ;
     
     var avl_sets_2             = $("#avl_sets_2").val();
     var need_sets_2            = $("#need_sets_2").val();
     var size_sets_2            = $("#size_sets_2").val();
     var output_sets_2          = $("#output_sets_2").val();
     var binding_sets_2_pre     = $("#binding_sets_2").val();
     var binding_sets_2         = (binding_sets_2_pre != '') ? binding_sets_2_pre : '0' ;
     var folding_sets_2         = $("#folding_sets_2").val();
     var date_needed            = $("#date_needed_"+OPTION_ID).val();
     var time_needed            = $("#time_picker_icon_"+OPTION_ID).val();
     var spl_recipient          = $("#spl_recipient_"+OPTION_ID).val();
     var contact_ph             = $("#contact_ph_"+OPTION_ID).val();
     var option_type            = $("#option_type_"+OPTION_ID).val();
     
     var shipp_att              = $("#shipp_att_"+OPTION_ID).val();
     
     var option_id              =   $("#option_id_"+OPTION_ID).val();
     
     var size_custom_details    = (size_sets_1 == 'Custom') ? document.getElementById("size_custom_details").value : '0';
     
     var output_page_details    = (output_sets_1 == 'Both') ? document.getElementById("output_page_details").value : '0';
     
     //var preffer_del            = document.getElementById("preffer_del_"+OPTION_ID).checked;  
     
     var arrange_del            = document.getElementById("arrange_del_"+OPTION_ID).checked;
     
     var delivery_comp          = (arrange_del == false) ? document.getElementById("delivery_comp_"+OPTION_ID).value : '0';
     var bill_number            = (arrange_del == false) ? document.getElementById("bill_number_"+OPTION_ID).value : '0';
     if(arrange_del == false)
     {
        var shipp_comp_1        =   document.getElementById("shipp_comp_1_"+OPTION_ID).checked;
            var shipp_comp_1_f  =   (shipp_comp_1 == true) ? document.getElementById("shipp_comp_1_"+OPTION_ID).value : '0';
        var shipp_comp_2        =   document.getElementById("shipp_comp_2_"+OPTION_ID).checked;
            var shipp_comp_2_f  =   (shipp_comp_2 == true) ? document.getElementById("shipp_comp_2_"+OPTION_ID).value : '0';
        var shipp_comp_3        =   document.getElementById("shipp_comp_3_"+OPTION_ID).checked;
            var shipp_comp_3_f  =   (shipp_comp_3 == true) ? document.getElementById("other_shipp_type_"+OPTION_ID).value : '0';
     }else{
            var shipp_comp_1_f  =   '0';
            var shipp_comp_2_f  =   '0';
            var shipp_comp_3_f  =   '0';
     } 
     
      $.ajax
        ({
            type: "POST",
            url: "get_recipients.php",                  
            data: "recipients=40&shipping_id_rec="+encodeURIComponent(shipping_id)+"&avl_sets_1="+encodeURIComponent(avl_sets_1)+"&need_sets_1="+encodeURIComponent(need_sets_1)+"&size_sets_1="+encodeURIComponent(size_sets_1)+"&output_sets_1="+encodeURIComponent(output_sets_1)+"&binding_sets_1="+encodeURIComponent(binding_sets_1)+"&avl_sets_2="+encodeURIComponent(avl_sets_2)+"&need_sets_2="+encodeURIComponent(need_sets_2)+"&size_sets_2="+encodeURIComponent(size_sets_2)+"&output_sets_2="+encodeURIComponent(output_sets_2)+"&binding_sets_2="+encodeURIComponent(binding_sets_2)+"&user_session="+encodeURIComponent(user_session)+"&user_session_comp="+encodeURIComponent(user_session_comp)+"&date_needed="+encodeURIComponent(date_needed)+"&spl_recipient="+encodeURIComponent(spl_recipient)+"&delivery_type="+encodeURIComponent(delivery_comp)+"&bill_number="+encodeURIComponent(bill_number)+"&shipp_comp_1_f="+encodeURIComponent(shipp_comp_1_f)+"&shipp_comp_2_f="+encodeURIComponent(shipp_comp_2_f)+"&shipp_comp_3_f="+encodeURIComponent(shipp_comp_3_f)+"&folding_sets_1="+encodeURIComponent(folding_sets_1)+"&folding_sets_2="+encodeURIComponent(folding_sets_2)+"&time_needed="+encodeURIComponent(time_needed)+"&size_custom_details="+encodeURIComponent(size_custom_details)+"&output_page_details="+encodeURIComponent(output_page_details)+"&attention_to="+encodeURIComponent(shipp_att)+"&media_sets_1="+encodeURIComponent(media_sets_1)+"&contact_ph="+encodeURIComponent(contact_ph)+"&option_id="+encodeURIComponent(option_id)+"&option_type="+encodeURIComponent(option_type),           
            success: function(option)
            {  
                //console.log('Added Previous!!!');  
            }
        });
 }
 
 
 
 function update_current_option_jk(OPTION_ID)
 {
     if(OPTION_ID != '0'){
        
     var pickup_soho_chk        = document.getElementById('pickup_soho').checked;
     var shipping_id_pre        = $("#address_book_rp_"+OPTION_ID).val();
     var shipping_id            = (pickup_soho_chk == true) ? 'P'+shipping_id_pre : shipping_id_pre;
     var user_session           = $("#user_session").val(); 
     var user_session_comp      = $("#user_session_comp").val(); 
     
     var avl_sets_1             = $("#avl_sets_"+OPTION_ID).val();
     var need_sets_1            = $("#need_sets_"+OPTION_ID).val();
     var size_sets_1            = $("#size_sets_"+OPTION_ID).val();
     var output_sets_1          = $("#output_sets_"+OPTION_ID).val();
     var media_sets_1           = $("#media_sets_"+OPTION_ID).val();
     var binding_sets_1_pre     = $("#binding_sets_"+OPTION_ID).val();
     var folding_sets_1         = $("#folding_sets_"+OPTION_ID).val();
     var binding_sets_1         = (binding_sets_1_pre != '') ? binding_sets_1_pre : '0' ;
     
     var avl_sets_2             = $("#avl_sets_2").val();
     var need_sets_2            = $("#need_sets_2").val();
     var size_sets_2            = $("#size_sets_2").val();
     var output_sets_2          = $("#output_sets_2").val();
     var binding_sets_2_pre     = $("#binding_sets_2").val();
     var binding_sets_2         = (binding_sets_2_pre != '') ? binding_sets_2_pre : '0' ;
     var folding_sets_2         = $("#folding_sets_2").val();
     var date_needed            = $("#date_needed_"+OPTION_ID).val();
     var time_needed            = $("#time_picker_icon_"+OPTION_ID).val();
     var spl_recipient          = $("#spl_recipient_"+OPTION_ID).val();
     var contact_ph             = $("#contact_ph_"+OPTION_ID).val();
     var option_type            = $("#option_type_"+OPTION_ID).val();
     
     var shipp_att              = $("#shipp_att_"+OPTION_ID).val();
     
     var option_id              =   $("#option_id_"+OPTION_ID).val();
     
     var size_custom_details    = (size_sets_1 == 'Custom') ? document.getElementById("size_custom_details").value : '0';
     
     var output_page_details    = (output_sets_1 == 'Both') ? document.getElementById("output_page_details").value : '0';
     
     //var preffer_del            = document.getElementById("preffer_del_"+OPTION_ID).checked;  
     
     var arrange_del            = document.getElementById("arrange_del_"+OPTION_ID).checked;
     
     var delivery_comp          = (arrange_del == false) ? document.getElementById("delivery_comp_"+OPTION_ID).value : '0';
     var bill_number            = (arrange_del == false) ? document.getElementById("bill_number_"+OPTION_ID).value : '0';
     if(arrange_del == false)
     {
        var shipp_comp_1        =   document.getElementById("shipp_comp_1_"+OPTION_ID).checked;
            var shipp_comp_1_f  =   (shipp_comp_1 == true) ? document.getElementById("shipp_comp_1_"+OPTION_ID).value : '0';
        var shipp_comp_2        =   document.getElementById("shipp_comp_2_"+OPTION_ID).checked;
            var shipp_comp_2_f  =   (shipp_comp_2 == true) ? document.getElementById("shipp_comp_2_"+OPTION_ID).value : '0';
        var shipp_comp_3        =   document.getElementById("shipp_comp_3_"+OPTION_ID).checked;
            var shipp_comp_3_f  =   (shipp_comp_3 == true) ? document.getElementById("other_shipp_type_"+OPTION_ID).value : '0';
     }else{
            var shipp_comp_1_f  =   '0';
            var shipp_comp_2_f  =   '0';
            var shipp_comp_3_f  =   '0';
     }      
     
     $.ajax
        ({
            type: "POST",
            url: "get_recipients.php",                  
            data: "recipients=31&shipping_id_rec="+encodeURIComponent(shipping_id)+"&avl_sets_1="+encodeURIComponent(avl_sets_1)+"&need_sets_1="+encodeURIComponent(need_sets_1)+"&size_sets_1="+encodeURIComponent(size_sets_1)+"&output_sets_1="+encodeURIComponent(output_sets_1)+"&binding_sets_1="+encodeURIComponent(binding_sets_1)+"&avl_sets_2="+encodeURIComponent(avl_sets_2)+"&need_sets_2="+encodeURIComponent(need_sets_2)+"&size_sets_2="+encodeURIComponent(size_sets_2)+"&output_sets_2="+encodeURIComponent(output_sets_2)+"&binding_sets_2="+encodeURIComponent(binding_sets_2)+"&user_session="+encodeURIComponent(user_session)+"&user_session_comp="+encodeURIComponent(user_session_comp)+"&date_needed="+encodeURIComponent(date_needed)+"&spl_recipient="+encodeURIComponent(spl_recipient)+"&delivery_type="+encodeURIComponent(delivery_comp)+"&bill_number="+encodeURIComponent(bill_number)+"&shipp_comp_1_f="+encodeURIComponent(shipp_comp_1_f)+"&shipp_comp_2_f="+encodeURIComponent(shipp_comp_2_f)+"&shipp_comp_3_f="+encodeURIComponent(shipp_comp_3_f)+"&folding_sets_1="+encodeURIComponent(folding_sets_1)+"&folding_sets_2="+encodeURIComponent(folding_sets_2)+"&time_needed="+encodeURIComponent(time_needed)+"&size_custom_details="+encodeURIComponent(size_custom_details)+"&output_page_details="+encodeURIComponent(output_page_details)+"&attention_to="+encodeURIComponent(shipp_att)+"&media_sets_1="+encodeURIComponent(media_sets_1)+"&contact_ph="+encodeURIComponent(contact_ph)+"&option_id="+encodeURIComponent(option_id)+"&option_type="+encodeURIComponent(option_type),           
            success: function(option)
            {  
                //console.log('Added Previous!!!');
//                $("#asap_status_"+OPTION_ID).removeClass(current_status);
//                $("#asap_status_"+OPTION_ID).addClass(change_status);
//                
//                $("#date_needed_"+OPTION_ID).val(change_date);
//                $("#time_picker_icon_"+OPTION_ID).val(change_time);
                
            }
        });
            
        }else{
            //console.log('Mohamed')
        }
 }
 
 
 
 function add_prvious_dis(OPTION_ID){
     
     if(OPTION_ID != '0'){
        
     var pickup_soho_chk        = document.getElementById('pickup_soho').checked;
     var shipping_id_pre        = $("#address_book_rp_"+OPTION_ID).val();
     var shipping_id            = (pickup_soho_chk == true) ? 'P'+shipping_id_pre : shipping_id_pre;
     var user_session           = $("#user_session").val(); 
     var user_session_comp      = $("#user_session_comp").val(); 
     
     var avl_sets_1             = $("#avl_sets_"+OPTION_ID).val();
     var need_sets_1            = $("#need_sets_"+OPTION_ID).val();
     var size_sets_1            = $("#size_sets_1").val();
     var output_sets_1          = $("#output_sets_1").val();
     var media_sets_1           = $("#media_sets_1").val();
     var binding_sets_1_pre     = $("#binding_sets_1").val();
     var folding_sets_1         = $("#folding_sets_1").val();
     var binding_sets_1         = (binding_sets_1_pre != '') ? binding_sets_1_pre : '0' ;
     
     var avl_sets_2             = $("#avl_sets_2").val();
     var need_sets_2            = $("#need_sets_2").val();
     var size_sets_2            = $("#size_sets_2").val();
     var output_sets_2          = $("#output_sets_2").val();
     var binding_sets_2_pre     = $("#binding_sets_2").val();
     var binding_sets_2         = (binding_sets_2_pre != '') ? binding_sets_2_pre : '0' ;
     var folding_sets_2         = $("#folding_sets_2").val();
     var date_needed            = $("#date_needed_"+OPTION_ID).val();
     var time_needed            = $("#time_picker_icon_"+OPTION_ID).val();
     var spl_recipient          = $("#spl_recipient_"+OPTION_ID).val();
     var contact_ph             = $("#contact_ph_"+OPTION_ID).val();
     var option_type            = $("#option_type_"+OPTION_ID).val();
     
     var shipp_att              = $("#shipp_att_"+OPTION_ID).val();
     
     var option_id              =   $("#option_id_"+OPTION_ID).val();
     
     var size_custom_details    = (size_sets_1 == 'Custom') ? document.getElementById("size_custom_details").value : '0';
     
     var output_page_details    = (output_sets_1 == 'Both') ? document.getElementById("output_page_details").value : '0';
     
     //var preffer_del            = document.getElementById("preffer_del_"+OPTION_ID).checked;  
     
     var arrange_del            = document.getElementById("arrange_del_"+OPTION_ID).checked;
     
     var delivery_comp          = (arrange_del == false) ? document.getElementById("delivery_comp_"+OPTION_ID).value : '0';
     var bill_number            = (arrange_del == false) ? document.getElementById("bill_number_"+OPTION_ID).value : '0';
     if(arrange_del == false)
     {
        var shipp_comp_1        =   document.getElementById("shipp_comp_1_"+OPTION_ID).checked;
            var shipp_comp_1_f  =   (shipp_comp_1 == true) ? document.getElementById("shipp_comp_1_"+OPTION_ID).value : '0';
        var shipp_comp_2        =   document.getElementById("shipp_comp_2_"+OPTION_ID).checked;
            var shipp_comp_2_f  =   (shipp_comp_2 == true) ? document.getElementById("shipp_comp_2_"+OPTION_ID).value : '0';
        var shipp_comp_3        =   document.getElementById("shipp_comp_3_"+OPTION_ID).checked;
            var shipp_comp_3_f  =   (shipp_comp_3 == true) ? document.getElementById("other_shipp_type_"+OPTION_ID).value : '0';
     }else{
            var shipp_comp_1_f  =   '0';
            var shipp_comp_2_f  =   '0';
            var shipp_comp_3_f  =   '0';
     }      
     
     $.ajax
        ({
            type: "POST",
            url: "get_recipients.php",                  
            data: "recipients=31&shipping_id_rec="+encodeURIComponent(shipping_id)+"&avl_sets_1="+encodeURIComponent(avl_sets_1)+"&need_sets_1="+encodeURIComponent(need_sets_1)+"&size_sets_1="+encodeURIComponent(size_sets_1)+"&output_sets_1="+encodeURIComponent(output_sets_1)+"&binding_sets_1="+encodeURIComponent(binding_sets_1)+"&avl_sets_2="+encodeURIComponent(avl_sets_2)+"&need_sets_2="+encodeURIComponent(need_sets_2)+"&size_sets_2="+encodeURIComponent(size_sets_2)+"&output_sets_2="+encodeURIComponent(output_sets_2)+"&binding_sets_2="+encodeURIComponent(binding_sets_2)+"&user_session="+encodeURIComponent(user_session)+"&user_session_comp="+encodeURIComponent(user_session_comp)+"&date_needed="+encodeURIComponent(date_needed)+"&spl_recipient="+encodeURIComponent(spl_recipient)+"&delivery_type="+encodeURIComponent(delivery_comp)+"&bill_number="+encodeURIComponent(bill_number)+"&shipp_comp_1_f="+encodeURIComponent(shipp_comp_1_f)+"&shipp_comp_2_f="+encodeURIComponent(shipp_comp_2_f)+"&shipp_comp_3_f="+encodeURIComponent(shipp_comp_3_f)+"&folding_sets_1="+encodeURIComponent(folding_sets_1)+"&folding_sets_2="+encodeURIComponent(folding_sets_2)+"&time_needed="+encodeURIComponent(time_needed)+"&size_custom_details="+encodeURIComponent(size_custom_details)+"&output_page_details="+encodeURIComponent(output_page_details)+"&attention_to="+encodeURIComponent(shipp_att)+"&media_sets_1="+encodeURIComponent(media_sets_1)+"&contact_ph="+encodeURIComponent(contact_ph)+"&option_id="+encodeURIComponent(option_id)+"&option_type="+encodeURIComponent(option_type),           
            success: function(option)
            {  
                console.log('Added Previous!!!');
            }
        });
            
        }else{
            //console.log('Mohamed')
        }
 }
 
 function continue_recipient(){
     
     var pickup_soho_chk        = document.getElementById('pickup_soho').checked;
     var shipping_id_pre        = $("#address_book_rp").val();
     var shipping_id            = (pickup_soho_chk == true) ? 'P'+shipping_id_pre : shipping_id_pre;
     var user_session           = $("#user_session").val(); 
     var user_session_comp      = $("#user_session_comp").val(); 
     
     var avl_sets_1             = $("#avl_sets_1").val();
     var need_sets_1            = $("#need_sets_1").val();
     var size_sets_1            = $("#size_sets_1").val();
     var output_sets_1          = $("#output_sets_1").val();
     var media_sets_1           = $("#media_sets_1").val();
     var binding_sets_1_pre     = $("#binding_sets_1").val();
     var folding_sets_1         = $("#folding_sets_1").val();
     var binding_sets_1         = (binding_sets_1_pre != '') ? binding_sets_1_pre : '0' ;
     
     var avl_sets_2             = $("#avl_sets_2").val();
     var need_sets_2            = $("#need_sets_2").val();
     var size_sets_2            = $("#size_sets_2").val();
     var output_sets_2          = $("#output_sets_2").val();
     var binding_sets_2_pre     = $("#binding_sets_2").val();
     var binding_sets_2         = (binding_sets_2_pre != '') ? binding_sets_2_pre : '0' ;
     var folding_sets_2         = $("#folding_sets_2").val();
     var media_sets_2           = $("#media_sets_2").val();
     var date_needed            = $("#date_needed").val();
     var time_needed            = $("#time_picker_icon").val();
     var spl_recipient          = $("#spl_recipient").val();
     
     var shipp_att              = $("#shipp_att").val();
     var contact_ph             = $("#contact_ph").val();
     
     var size_custom_details    = (size_sets_1 == 'Custom') ? document.getElementById("size_custom_details").value : '0';
     
     var output_page_details    = (output_sets_1 == 'Both') ? document.getElementById("output_page_details").value : '0';
     
     var need_sets              =   $(".need_sets").val();
     var avl_sets               =   $(".avl_sets").val();
     var arch_exist             =   $("#arch_exist").val();     
    
     var tot_avl_options        =   $("#tot_avl_options").val();
     var rem_avl_options        =   $("#rem_avl_options").val();
     
     var option_id              =   $("#option_id").val();
     
     var preffer_del            = document.getElementById('preffer_del').checked;  
         
     var arrange_del            = document.getElementById('arrange_del').checked;
     var delivery_comp          = (arrange_del == false) ? document.getElementById("delivery_comp").value : '0';
     var bill_number            = (arrange_del == false) ? document.getElementById("bill_number").value : '0';
     if(arrange_del == false)
     {
        var shipp_comp_1        =   document.getElementById('shipp_comp_1').checked;
            var shipp_comp_1_f  =   (shipp_comp_1 == true) ? document.getElementById("shipp_comp_1").value : '0';
        var shipp_comp_2        =   document.getElementById('shipp_comp_2').checked;
            var shipp_comp_2_f  =   (shipp_comp_2 == true) ? document.getElementById("shipp_comp_2").value : '0';
        var shipp_comp_3        =   document.getElementById('shipp_comp_3').checked;
            var shipp_comp_3_f  =   (shipp_comp_3 == true) ? document.getElementById("other_shipp_type").value : '0';
     }else{
            var shipp_comp_1_f  =   '0';
            var shipp_comp_2_f  =   '0';
            var shipp_comp_3_f  =   '0';
     }      
     
     //alert(tot_avl_options+' '+rem_avl_options);
     if(shipping_id == '0'){
         alert('Please select send to address');
         $("#address_book_rp").focus();
         return false;
     }
     
//      if(shipp_att == ''){
//         alert('Please enter the attention to');
//         $("#shipp_att").focus();
//         return false;
//     }
     
     if(date_needed == ''){
         alert('Please select when needed');
         $("#date_needed").focus();
         return false;
     }
     
     if(need_sets != avl_sets){
         add_recipients();
         return false;
     }
     
     if(tot_avl_options != rem_avl_options){       
         add_recipients();
         return false;
     }else{
         return true;
     }
     
     if(preffer_del == true){
        var bill_number = $("#bill_number").val(); 
        if(bill_number ==''){
        alert('Please enter the account number');
        $("#bill_number").focus();
        return false;
        }
    }
     
     $.ajax
        ({
            type: "POST",
            url: "get_recipients.php",                  
            data: "recipients=9&shipping_id_rec="+encodeURIComponent(shipping_id)+"&avl_sets_1="+encodeURIComponent(avl_sets_1)+"&need_sets_1="+encodeURIComponent(need_sets_1)+"&size_sets_1="+encodeURIComponent(size_sets_1)+"&output_sets_1="+encodeURIComponent(output_sets_1)+"&binding_sets_1="+encodeURIComponent(binding_sets_1)+"&avl_sets_2="+encodeURIComponent(avl_sets_2)+"&need_sets_2="+encodeURIComponent(need_sets_2)+"&size_sets_2="+encodeURIComponent(size_sets_2)+"&output_sets_2="+encodeURIComponent(output_sets_2)+"&binding_sets_2="+encodeURIComponent(binding_sets_2)+"&user_session="+encodeURIComponent(user_session)+"&user_session_comp="+encodeURIComponent(user_session_comp)+"&date_needed="+encodeURIComponent(date_needed)+"&spl_recipient="+encodeURIComponent(spl_recipient)+"&delivery_type="+encodeURIComponent(delivery_comp)+"&bill_number="+encodeURIComponent(bill_number)+"&shipp_comp_1_f="+encodeURIComponent(shipp_comp_1_f)+"&shipp_comp_2_f="+encodeURIComponent(shipp_comp_2_f)+"&shipp_comp_3_f="+encodeURIComponent(shipp_comp_3_f)+"&folding_sets_1="+encodeURIComponent(folding_sets_1)+"&folding_sets_2="+encodeURIComponent(folding_sets_2)+"&time_needed="+encodeURIComponent(time_needed)+"&size_custom_details="+encodeURIComponent(size_custom_details)+"&output_page_details="+encodeURIComponent(output_page_details)+"&attention_to="+encodeURIComponent(shipp_att)+"&media_sets_1="+encodeURIComponent(media_sets_1)+"&contact_ph="+encodeURIComponent(contact_ph)+"&option_id="+encodeURIComponent(option_id),
            beforeSend: loadStart,
            complete: loadStop,
            success: function(option)
            {  
                window.location = "view_all_recipients.php";
            }
        });
 }
 
 
 
 function increase_qty(ID){
     
     var need_sets      =   $("#need_sets_"+ID).val();
     var avl_sets       =   $("#avl_sets_"+ID).val();
     
        need_sets++;
        if(need_sets <= avl_sets){
        $('#need_sets_'+ID).val(need_sets);
        }
 }
 
  function increase_qty_dy(OPTION_ID){
     
     var need_sets      =   $("#need_sets_"+OPTION_ID).val();
     var avl_sets       =   $("#avl_sets_"+OPTION_ID).val();
     
        need_sets++;
        if(need_sets <= avl_sets){
        $('#need_sets_'+OPTION_ID).val(need_sets);
        }
 }
 
 function decrease_qty_dy(ID)
 {
     var need_sets      =   $("#need_sets_"+ID).val();
     var avl_sets       =   $("#avl_sets_"+ID).val();
     
        need_sets--;
        if(need_sets != '0')
        {
        $('#need_sets_'+ID).val(need_sets);
        }
 }
 
 
 function decrease_qty_return(ID)
 {
     var need_sets      =   $("#need_sets_"+ID).val();
     var avl_sets       =   $("#avl_sets_"+ID).val();
     
        need_sets--;
        if(need_sets != '0')
        {
        $('#need_sets_'+ID).val(need_sets);
        }
 }
 
 function increase_qty_avl(ID,USR_ID,COMP_ID,TYPE,REC_ID)
{   
    var avl_sets       =   $("#avl_sets_"+ID).val();
    var need_sets_1    =   $("#need_sets_1").val();
    var need_sets_2    =   $("#need_sets_2").val();
    avl_sets++;
    if(avl_sets != '0'){    
        $('#avl_sets_'+ID).val(avl_sets);
        $.ajax
            ({
                type: "POST",
                url: "get_recipients.php",
                data: "recipients=5&inc_avl_user_id="+USR_ID+"&inc_avl_comp_id="+COMP_ID+"&inc_avl_type="+TYPE+"&inc_avl_rec_id="+REC_ID+"&need_sets_current_1="+need_sets_1+"&need_sets_current_2="+need_sets_2+"&need_sets_avl_sets="+avl_sets,
                success: function(option)
                {                    
                    $('#sets_grid_new').html(option);                             
                }
            });
    }
}
 
 function increase_qty_avl_copies(ID,USR_ID,COMP_ID,TYPE)
 {
     var avl_sets       =   $("#avl_sets_"+ID).val();
    avl_sets++;
    if(avl_sets != '0'){    
        $('#avl_sets_'+ID).val(avl_sets);
        $.ajax
            ({
                type: "POST",
                url: "get_recipients.php",
                data: "recipients=55&inc_avl_user_id="+USR_ID+"&inc_avl_comp_id="+COMP_ID+"&inc_avl_type="+TYPE,
                success: function(option)
                {                    
                    $('#sets_grid_new').html(option);                             
                }
            });
    }
 }
 
 function increase_qty_avl_plot(ID,USR_ID,COMP_ID,TYPE,OPTION_ID)
 {
    var avl_sets       =   $("#avl_sets_"+OPTION_ID).val();
    var avl_sets_span  =   $("#available_"+OPTION_ID).html();
    avl_sets++;
    if(avl_sets != '0'){    
        $('#avl_sets_'+ID).val(avl_sets);
        $.ajax
            ({
                type: "POST",
                url: "get_recipients.php",
                data: "recipients=55&inc_avl_user_id="+USR_ID+"&inc_avl_comp_id="+COMP_ID+"&inc_avl_type="+TYPE+"&option_id="+OPTION_ID+"&available_sets="+avl_sets,
                success: function(option)
                {                    
                    //$('#sets_grid_new').html(option); 
                    var increase_set    =   '1';
                    $("#avl_sets_"+OPTION_ID).val(avl_sets);
                    $("#available_"+OPTION_ID).html(Number(avl_sets_span) + Number(increase_set));
                }
            });
    }
     
 }
 
 function decrease_qty_avl(ID,USR_ID,COMP_ID,TYPE,REC_ID,OPTION_ID)
 {
     var avl_sets       =   $("#avl_sets_"+OPTION_ID).val();
     var need_sets_1    =   $("#need_sets_1").val();
     var need_sets_2    =   $("#need_sets_2").val();
     
        avl_sets--;
        if(avl_sets != '0')
        {
            $('#avl_sets_'+ID).val(avl_sets);
            $.ajax
            ({
                type: "POST",
                url: "get_recipients.php",
                data: "recipients=4&inc_avl_user_id="+USR_ID+"&inc_avl_comp_id="+COMP_ID+"&inc_avl_type="+TYPE+"&inc_avl_rec_id="+REC_ID+"&need_sets_current_1="+need_sets_1+"&need_sets_current_2="+need_sets_2+"&decrese_avl_sets="+avl_sets+"&option_id="+OPTION_ID,
                success: function(option)
                {                    
                    //$('#sets_grid_new').html(option); 
                    $("#avl_sets_"+OPTION_ID).val(avl_sets);
                    $("#available_"+OPTION_ID).html(avl_sets);
                }
            });
        
        }
 }
 
 function delete_recipient(ID)
 {  
    var are_you_sure           = confirm("Are you sure.");    
    var user_session           = $("#user_session").val(); 
    var user_session_comp      = $("#user_session_comp").val(); 
     
    if(are_you_sure == true){
    $.ajax
        ({
            type: "POST",
            url: "get_recipients.php",                  
            data: "recipients=8&delete_rec_id="+encodeURIComponent(ID)+"&user_session="+encodeURIComponent(user_session)+"&user_session_comp="+encodeURIComponent(user_session_comp),
            beforeSend: loadStart,
            complete: loadStop,
            success: function(option)
            {  
                $('#multi_recipients').slideDown();
                $('#multi_recipients').html(option);
                $('#add_recipients').slideDown();
            }
        });
    }
 } 
 
 function edit_recipient(ID)
 {    
    var are_you_sure           = confirm("Are you sure.");    
    var user_session           = $("#user_session").val(); 
    var user_session_comp      = $("#user_session_comp").val(); 
     
    if(are_you_sure == true){
    $.ajax
        ({
            type: "POST",
            url: "get_recipients.php",                  
            data: "recipients=7&edit_rec_id="+encodeURIComponent(ID)+"&user_session="+encodeURIComponent(user_session)+"&user_session_comp="+encodeURIComponent(user_session_comp),
            beforeSend: loadStart,
            complete: loadStop,
            success: function(option)
            {  
                $('#multi_recipients').slideDown();
                $('#multi_recipients').html(option);
                $('#add_recipients').slideDown();
            }
        });
    }
 }
 
 
 function edit_recipient_dynamic(ID)
 {
     //alert(ID+"_EDIT");
     $.ajax
        ({
            type: "POST",
            url: "get_recipients.php",                  
            data: "recipients=501&edit_rec_id="+encodeURIComponent(ID),
            beforeSend: loadStart,
            complete: loadStop,
            success: function(option)
            {  
                //$('#multi_recipients').slideDown();
                $('#dynamic_edit_'+ID).html(option);
                //$('#add_recipients').slideDown();
            }
        });
 }
 
 function update_recipient(ID)
 {
     var shipping_id            = $("#address_book_rp").val();
     var user_session           = $("#user_session").val(); 
     var user_session_comp      = $("#user_session_comp").val(); 
     
     var avl_sets_1             = $("#avl_sets_1").val();
     var need_sets_1            = $("#need_sets_1").val();
     var size_sets_1            = $("#size_sets_1").val();
     var output_sets_1          = $("#output_sets_1").val();
     var binding_sets_1_pre     = $("#binding_sets_1").val();
     var binding_sets_1         = (binding_sets_1_pre != '') ? binding_sets_1_pre : '0' ;
     var folding_sets_1         = $("#folding_sets_1").val();
     
     var avl_sets_2             = $("#avl_sets_2").val();
     var need_sets_2            = $("#need_sets_2").val();
     var size_sets_2            = $("#size_sets_2").val();
     var output_sets_2          = $("#output_sets_2").val();
     var binding_sets_2_pre     = $("#binding_sets_2").val();
     var binding_sets_2         = (binding_sets_2_pre != '') ? binding_sets_2_pre : '0' ;
     var folding_sets_2         = $("#folding_sets_2").val();
     var date_needed            = $("#date_needed").val();
     var time_needed            = $("#time_picker_icon").val();
     var spl_recipient          = $("#spl_recipient").val();
     
     var shipp_att              = $("#shipp_att").val();
     
     var size_custom_details    = (size_sets_1 == 'Custom') ? document.getElementById("size_custom_details").value : '0';
     
     var arrange_del            = document.getElementById('arrange_del').checked;
     var delivery_comp          = (arrange_del == false) ? document.getElementById("delivery_comp").value : '0';
     var bill_number            = (arrange_del == false) ? document.getElementById("bill_number").value : '0';
     if(arrange_del == false)
     {
        var shipp_comp_1        =   document.getElementById('shipp_comp_1').checked;
            var shipp_comp_1_f  =   (shipp_comp_1 == true) ? document.getElementById("shipp_comp_1").value : '0';
        var shipp_comp_2        =   document.getElementById('shipp_comp_2').checked;
            var shipp_comp_2_f  =   (shipp_comp_2 == true) ? document.getElementById("shipp_comp_2").value : '0';
        var shipp_comp_3        =   document.getElementById('shipp_comp_3').checked;
            var shipp_comp_3_f  =   (shipp_comp_3 == true) ? document.getElementById("other_shipp_type").value : '0';
     }else{
            var shipp_comp_1_f  =   '0';
            var shipp_comp_2_f  =   '0';
            var shipp_comp_3_f  =   '0';
     }      
     
     
     if(shipping_id == '0'){
         alert('Please select send to address');
         $("#address_book_rp").focus();
         return false;
     }
     
     if(date_needed == ''){
         alert('Please select when needed');
         $("#date_needed").focus();
         return false;
     }
     
     $.ajax
        ({
            type: "POST",
            url: "get_recipients.php",                  
            data: "recipients=6&shipping_id_rec="+encodeURIComponent(shipping_id)+"&avl_sets_1="+encodeURIComponent(avl_sets_1)+"&need_sets_1="+encodeURIComponent(need_sets_1)+"&size_sets_1="+encodeURIComponent(size_sets_1)+"&output_sets_1="+encodeURIComponent(output_sets_1)+"&binding_sets_1="+encodeURIComponent(binding_sets_1)+"&avl_sets_2="+encodeURIComponent(avl_sets_2)+"&need_sets_2="+encodeURIComponent(need_sets_2)+"&size_sets_2="+encodeURIComponent(size_sets_2)+"&output_sets_2="+encodeURIComponent(output_sets_2)+"&binding_sets_2="+encodeURIComponent(binding_sets_2)+"&user_session="+encodeURIComponent(user_session)+"&user_session_comp="+encodeURIComponent(user_session_comp)+"&date_needed="+encodeURIComponent(date_needed)+"&spl_recipient="+encodeURIComponent(spl_recipient)+"&edit_recipient_id="+ID+"&delivery_type="+encodeURIComponent(delivery_comp)+"&bill_number="+encodeURIComponent(bill_number)+"&shipp_comp_1_f="+encodeURIComponent(shipp_comp_1_f)+"&shipp_comp_2_f="+encodeURIComponent(shipp_comp_2_f)+"&shipp_comp_3_f="+encodeURIComponent(shipp_comp_3_f)+"&folding_sets_1="+encodeURIComponent(folding_sets_1)+"&folding_sets_2="+encodeURIComponent(folding_sets_2)+"&time_needed="+encodeURIComponent(time_needed)+"&size_custom_details="+encodeURIComponent(size_custom_details)+"&attention_to="+encodeURIComponent(shipp_att),
            beforeSend: loadStart,
            complete: loadStop,
            success: function(option)
            {  
                $('#multi_recipients').slideDown();
                $('#multi_recipients').html(option);
                $('#add_recipients').slideDown();
            }
        });
 }
 
 function uncheck_delivery()
 {
     var arrange_del = document.getElementById('arrange_del').checked;     
     if(arrange_del == false){          
     $('#preffered_info').slideDown();      
     document.getElementById("preffer_del").checked = true;
    }else{
     $('#preffered_info').slideUp();  
     document.getElementById("preffer_del").checked = false;
    }    
 }
 
 function check_prefer_delivery()
 {
     var preff_del = document.getElementById('preffer_del').checked;     
     if(preff_del == true){          
     $('#preffered_info').slideDown(); 
     $('#delivery_info').slideUp();
     document.getElementById("arrange_del").checked = false;
    }else{
     $('#preffered_info').slideUp();        
     $('#delivery_info').slideDown();
     document.getElementById("arrange_del").checked = true;
    }    
 }
 
 
 function uncheck_delivery_dynamic(option_id)
 {
     var arrange_del = document.getElementById('arrange_del_'+option_id).checked;     
     if(arrange_del == false){          
     $('#preffered_info_'+option_id).slideDown();      
     document.getElementById("preffer_del_"+option_id).checked = true;
    }else{
     $('#preffered_info_'+option_id).slideUp();  
     document.getElementById("preffer_del_"+option_id).checked = false;
    }    
 }
 
 function check_prefer_delivery_dynamic(option_id)
 {
     var preff_del = document.getElementById("preffer_del_"+option_id).checked;     
     if(preff_del == true){          
     $('#preffered_info_'+option_id).slideDown(); 
     $('#delivery_info_'+option_id).slideUp();
     document.getElementById("arrange_del_"+option_id).checked = false;
    }else{
     $('#preffered_info_'+option_id).slideUp();        
     $('#delivery_info_'+option_id).slideDown();
     document.getElementById("arrange_del_"+option_id).checked = true;
    }    
 }
 
 
 
 
 
 function delete_recipient_empty()
 {
     alert('Empty');
 }
 
 function loadStart() {
$('#loading').show();
}

function loadStop() {
$('#loading').hide();
}

function show_address()
{
    var shipping_id     = $("#address_book_rp").val();
    if(shipping_id == "P1"){
       $("#show_address").html("381 Broome Street New York, NY 10013"); 
       $("#shipp_att").val("");
    }else if(shipping_id == "P2"){
       $("#show_address").html("307 7th Ave, 5th Floor New York, NY 10013"); 
       $("#shipp_att").val("");
    }else{
        $.ajax
            ({
                type: "POST",
                url: "shipping_address_rec.php",
                data: "shipping_id_rp=" + shipping_id,
                success: function(option)
                {  
                    var myarr = option.split("~");
                    $("#show_address").html(myarr[0]);
                    $("#shipp_att").val(myarr[1]);
                }
            });
    }
}



function show_address_dynamic(option_id)
{
    var shipping_id     = $("#address_book_rp_"+option_id).val();
    if(shipping_id == "P1"){
       $("#show_address").html("381 Broome Street New York, NY 10013"); 
       $("#shipp_att_"+option_id).val("");
    }else if(shipping_id == "P2"){
       $("#show_address").html("307 7th Ave, 5th Floor New York, NY 10013"); 
       $("#shipp_att_"+option_id).val("");
    }else if(shipping_id == "NEW"){
       window.location = "service_add_address.php?serivice_plotting=1"; 
    }else if(shipping_id == "NEW-MULTI"){
       window.location = "service_add_address.php?serivice_plotting=1&multi=1"; 
    }else{
        $.ajax
            ({
                type: "POST",
                url: "shipping_address_rec.php",
                data: "shipping_id_rp=" + shipping_id,
                success: function(option)
                {  
                    var myarr = option.split("~");
                    $("#show_address_"+option_id).html(myarr[0]);
                    $("#shipp_att_"+option_id).val(myarr[1]);
                    $("#edit_address_"+option_id).fadeIn();
                }
            });
    }
}


function show_address_dynamic_nmjk(option_id)
{
    var shipping_id     = $("#address_book_rp_"+option_id).val();
    if(shipping_id == "P1"){
       $("#show_address").html("381 Broome Street New York, NY 10013"); 
       $("#shipp_att_"+option_id).val("");
    }else if(shipping_id == "P2"){
       $("#show_address").html("307 7th Ave, 5th Floor New York, NY 10013"); 
       $("#shipp_att_"+option_id).val("");
    }else if(shipping_id == "NEW"){
       window.location = "service_add_address.php?serivice_plotting=1"; 
    }else if(shipping_id == "NEW-MULTI"){
       window.location = "service_add_address.php?serivice_plotting=1&multi=1"; 
    }else{
        $.ajax
            ({
                type: "POST",
                url: "shipping_address_rec_nmjk_new.php",
                data: "shipping_id_rp="+shipping_id+"&option_id="+option_id,
                success: function(option)
                {  
                    var myarr = option.split("~");
                    $("#show_address_"+option_id).html(myarr[0]);
                    $("#shipp_att_"+option_id).val(myarr[1]);
                    $("#edit_address_"+option_id).fadeIn();
                    $("."+myarr[2]).hide();
                    $(".all_are_done").show();
                    $("#address_book_rp_"+option_id).removeClass("remove_current");
                    $(".all_are_done").attr('onclick', 'return add_recipients_dynamic_go_next_jk('+myarr[2]+');');
                }
            });
    }
}

$(function() {
    var all_exist_date_needed      = $("#all_exist_date").val();
    var split_element_needed       = all_exist_date_needed.split(","); 
    var disabledSpecificDays_needed = [split_element_needed[0],split_element_needed[1],split_element_needed[2],split_element_needed[3],split_element_needed[4],split_element_needed[5],split_element_needed[6],split_element_needed[7],split_element_needed[8],split_element_needed[8],split_element_needed[9],split_element_needed[10],split_element_needed[11],split_element_needed[12],split_element_needed[13],split_element_needed[14],split_element_needed[15],split_element_needed[16],split_element_needed[17],split_element_needed[18],split_element_needed[19]];

    function disableSpecificDaysAndWeekends(date) {
    var m = date.getMonth();
    var d = date.getDate();
    var y = date.getFullYear();

    for (var i = 0; i < disabledSpecificDays_needed.length; i++) {
    if ($.inArray((m + 1) + '-' + d + '-' + y, disabledSpecificDays_needed) != -1 ) {
    return [false];
    }
    }

    var noWeekend = $.datepicker.noWeekends(date);
    return !noWeekend[0] ? noWeekend : [true];
    } 
}); 

function date_reveal(ID)
{    
    var all_exist_date_needed      = $("#all_exist_date").val();
    var split_element_needed       = all_exist_date_needed.split(","); 
    var disabledSpecificDays_needed = [split_element_needed[0],split_element_needed[1],split_element_needed[2],split_element_needed[3],split_element_needed[4],split_element_needed[5],split_element_needed[6],split_element_needed[7],split_element_needed[8],split_element_needed[8],split_element_needed[9],split_element_needed[10],split_element_needed[11],split_element_needed[12],split_element_needed[13],split_element_needed[14],split_element_needed[15],split_element_needed[16],split_element_needed[17],split_element_needed[18],split_element_needed[19]];

    function disableSpecificDaysAndWeekends(date) {
    var m = date.getMonth();
    var d = date.getDate();
    var y = date.getFullYear();

    for (var i = 0; i < disabledSpecificDays_needed.length; i++) {
    if ($.inArray((m + 1) + '-' + d + '-' + y, disabledSpecificDays_needed) != -1 ) {
    return [false];
    }
    }

    var noWeekend = $.datepicker.noWeekends(date);
    return !noWeekend[0] ? noWeekend : [true];
    } 
$("#date_needed_"+ID).datepicker({minDate: 0,
            dateFormat: 'mm/dd/yy',
            inline: true,
            dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
            beforeShowDay: disableSpecificDaysAndWeekends}); 
$("#date_needed_"+ID).focus();
show_time(ID);
}


function date_reveal_return()
{    
    var all_exist_date_needed      = $("#all_exist_date").val();
    var split_element_needed       = all_exist_date_needed.split(","); 
    var disabledSpecificDays_needed = [split_element_needed[0],split_element_needed[1],split_element_needed[2],split_element_needed[3],split_element_needed[4],split_element_needed[5],split_element_needed[6],split_element_needed[7],split_element_needed[8],split_element_needed[8],split_element_needed[9],split_element_needed[10],split_element_needed[11],split_element_needed[12],split_element_needed[13],split_element_needed[14],split_element_needed[15],split_element_needed[16],split_element_needed[17],split_element_needed[18],split_element_needed[19]];

    function disableSpecificDaysAndWeekends(date) {
    var m = date.getMonth();
    var d = date.getDate();
    var y = date.getFullYear();

    for (var i = 0; i < disabledSpecificDays_needed.length; i++) {
    if ($.inArray((m + 1) + '-' + d + '-' + y, disabledSpecificDays_needed) != -1 ) {
    return [false];
    }
    }

    var noWeekend = $.datepicker.noWeekends(date);
    return !noWeekend[0] ? noWeekend : [true];
    } 
$("#date_needed").datepicker({minDate: 0,
            dateFormat: 'mm/dd/yy',
            inline: true,
            dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
            beforeShowDay: disableSpecificDaysAndWeekends}); 
$("#date_needed").focus();
show_time_return();
}


function other_shipp_type()
{
    $("#shipp_comp_3").attr("checked", true);
}

function field_color()
{
    $("#bill_number").css("background-color", "#F3FA2F");
    $("#bill_number").focus();
}

function field_color_dynamic(OPTION_ID)
{
    $("#bill_number_"+OPTION_ID).css("background-color", "#F3FA2F");
    $("#bill_number_"+OPTION_ID).focus();
}

function asap()
{
    var current_status  =   $("#asap_status").attr('class');
    var change_status   =   (current_status == "asap_orange") ? 'asap_green' : 'asap_orange';
    $("#asap_status").removeClass(current_status);
    $("#asap_status").addClass(change_status);
    
    var current_dte_neede    = $("#date_needed").val();
    var current_time_neede   = $("#time_picker_icon").val();
    
    var change_date          = (current_status == "asap_orange") ? 'ASAP' : '';
    var change_time          = (current_status == "asap_orange") ? 'ASAP' : '';
    
    //alert(current_dte_neede+' '+current_time_neede);
    
    $("#date_needed").val(change_date);
    $("#time_picker_icon").val(change_time);

}

function close_asap()
{
    //$("body").append("<div class='modal-overlay js-modal-close'></div>");
    $(".modal-overlay").fadeOut();
    $("#asap_popup").fadeOut("slow"); 
}


function edit_recipient_address(option_id)
{  
    var shipping_id     = $("#address_book_rp_"+option_id).val();
    if(shipping_id != ''){
        $.ajax
        ({
            type: "POST",
            url: "get_recipients.php",
            data: "recipients=77&address_book_id="+shipping_id+"&option_id="+option_id,
            beforeSend: loadStart,
            complete: loadStop,
            success: function(option)
            {  
                $("body").append("<div class='modal-overlay'></div>");
                $("#asap_popup").show();
                $("#recipient_address").html(option);
            }
        });    
    }
    
}

function save_recipient_address()
{
    var address_1               = $("#address_1").val();
    var address_2               = $("#address_2").val();
    var address_3               = $("#address_3").val();
    var edit_city               = $("#edit_city").val();
    var edit_state              = $("#edit_state").val();
    var edit_zip                = $("#edit_zip").val();
    var edit_address_id         = $("#edit_address_id").val();
    var edit_address_option_id  = $("#edit_option_id").val();
    
    //console.log(address_1+' '+address_2+' '+address_3+' '+edit_city+' '+edit_state+' '+edit_zip);
    
    if(edit_zip != ''){
        $.ajax
        ({
            type: "POST",
            url: "get_recipients.php",
            data: "recipients=78&edit_address_1="+encodeURIComponent(address_1)+"&edit_address_2="+encodeURIComponent(address_2)+
                  "&edit_address_3="+encodeURIComponent(address_3)+"&edit_city="+encodeURIComponent(edit_city)+"&edit_state="+encodeURIComponent(edit_state)+
                  "&edit_zip="+encodeURIComponent(edit_zip)+"&edit_address_id="+encodeURIComponent(edit_address_id)+"&edit_address_option_id="+edit_address_option_id,
            beforeSend: loadStart,
            complete: loadStop,
            success: function(option)
            {                  
                $("#show_address_"+edit_address_option_id).html(option);
                $("#asap_popup").hide();
                $(".modal-overlay").fadeOut();
            }
        });    
    }
    
}


function comp_name_ok()
{
    var comp_name_ship          = $("#comp_name_ship").val();
    if(comp_name_ship != ''){
    $("#comp_name_ship").css("border", "1px solid #e4e4e4");    
    }
}

function attention_to_ok()
{
    var attention_to_ship       = $("#attention_to_ship").val();
    if(attention_to_ship != ''){
    $("#attention_to_ship").css("border", "1px solid #e4e4e4");    
    }
}

function address_1_ok()
{
    var address_1_ship          = $("#address_1_ship").val();
    if(address_1_ship != ''){
    $("#address_1_ship").css("border", "1px solid #e4e4e4");    
    }
}

function city_ok()
{
    var city_ship               = $("#city_ship").val();
    if(city_ship != ''){
    $("#city_ship").css("border", "1px solid #e4e4e4");    
    }
}

function state_ok()
{
    var state_ship              = $("#state_ship").val();
    if(state_ship != '0'){
    $("#state_ship").css("border", "1px solid #e4e4e4");    
    }
}

function zip_ok()
{
    var zip_ship                = $("#zip_ship").val();    
    if(zip_ship != ''){
    $("#zip_ship").css("border", "1px solid #e4e4e4");    
    }
}

function save_recipient_address_new()
{       
    var comp_name_ship          = $("#comp_name_ship").val();
    var attention_to_ship       = $("#attention_to_ship").val();
    
    var address_1_ship          = $("#address_1_ship").val();
    var address_2_ship          = $("#address_2_ship").val();
    var address_3_ship          = $("#address_3_ship").val();
    
    var city_ship               = $("#city_ship").val();
    var state_ship              = $("#state_ship").val();
    var zip_ship                = $("#zip_ship").val();    
    var plus_4_ship             = $("#plus_4_ship").val();
    
    var phone_ship  		= $("#phone_ship").val();
    var phone_plus_4_ship  	= $("#phone_plus_4_ship").val();
    
    if(comp_name_ship == ''){
       $("#comp_name_ship").css("border", "1px solid #EA4335");
       $("#comp_name_ship").focus();
       return false;
    }else{
       $("#comp_name_ship").css("border", "1px solid #e4e4e4"); 
    }
    
    if(attention_to_ship == ''){
       $("#attention_to_ship").css("border", "1px solid #EA4335");
       $("#attention_to_ship").focus();
       return false;
    }else{
       $("#attention_to_ship").css("border", "1px solid #e4e4e4"); 
    }
    
    if(address_1_ship == ''){
       $("#address_1_ship").css("border", "1px solid #EA4335");
       $("#address_1_ship").focus();
       return false;
    }else{
       $("#address_1_ship").css("border", "1px solid #e4e4e4"); 
    }
    
    if(city_ship == ''){
       $("#city_ship").css("border", "1px solid #EA4335");
       $("#city_ship").focus();
       return false;
    }else{
       $("#city_ship").css("border", "1px solid #e4e4e4"); 
    }
    
    if(state_ship == '0'){
       $("#state_ship").css("border", "1px solid #EA4335");
       $("#state_ship").focus();
       return false;
    }else{
       $("#state_ship").css("border", "1px solid #e4e4e4"); 
    }
    
    if(zip_ship == ''){
       $("#zip_ship").css("border", "1px solid #EA4335");
       $("#zip_ship").focus();
       return false;
    }else{
       $("#zip_ship").css("border", "1px solid #e4e4e4"); 
    }
    
    if(comp_name_ship != ''){
        $.ajax
        ({
            type: "POST",
            url: "get_recipients.php",
            data: "recipients=111&comp_name_ship="+encodeURIComponent(comp_name_ship)+"&attention_to_ship="+encodeURIComponent(attention_to_ship)+"&address_1_ship="+encodeURIComponent(address_1_ship)+
                  "&address_2_ship="+encodeURIComponent(address_2_ship)+"&address_3_ship="+encodeURIComponent(address_3_ship)+"&city_ship="+encodeURIComponent(city_ship)+"&state_ship="+encodeURIComponent(state_ship)+
                  "&zip_ship="+encodeURIComponent(zip_ship)+"&plus_4_ship="+encodeURIComponent(plus_4_ship)+"&phone_ship="+encodeURIComponent(phone_ship)+"&phone_plus_4_ship="+phone_plus_4_ship,
            beforeSend: loadStart,
            complete: loadStop,
            success: function(option)
            {                  
                $("#address_book_se").html(option);
                $("#asap_popup").fadeOut('slow');
                $(".modal-overlay").fadeOut('slow');
                $("#send_everything_to").attr('checked', 'checked');
                send_everything_to();   
            }
        });    
    }
    
}

function update_recipient_address_new(ID)
{
    var comp_name_ship          = $("#comp_name_ship").val();
    var attention_to_ship       = $("#attention_to_ship").val();
    
    var address_1_ship          = $("#address_1_ship").val();
    var address_2_ship          = $("#address_2_ship").val();
    var address_3_ship          = $("#address_3_ship").val();
    
    var city_ship               = $("#city_ship").val();
    var state_ship              = $("#state_ship").val();
    var zip_ship                = $("#zip_ship").val();    
    var plus_4_ship             = $("#plus_4_ship").val();
    
    var phone_ship  		= $("#phone_ship").val();
    var phone_plus_4_ship  	= $("#phone_plus_4_ship").val();
    //alert(ID);
    
    if(ID != ''){
        $.ajax
        ({
            type: "POST",
            url: "get_recipients.php",
            data: "recipients=654321&comp_name_ship="+encodeURIComponent(comp_name_ship)+"&attention_to_ship="+encodeURIComponent(attention_to_ship)+"&address_1_ship="+encodeURIComponent(address_1_ship)+
                  "&address_2_ship="+encodeURIComponent(address_2_ship)+"&address_3_ship="+encodeURIComponent(address_3_ship)+"&city_ship="+encodeURIComponent(city_ship)+"&state_ship="+encodeURIComponent(state_ship)+
                  "&zip_ship="+encodeURIComponent(zip_ship)+"&plus_4_ship="+encodeURIComponent(plus_4_ship)+"&phone_ship="+encodeURIComponent(phone_ship)+"&phone_plus_4_ship="+phone_plus_4_ship+"&address_book_se="+ID,
            beforeSend: loadStart,
            complete: loadStop,
            success: function(option)
            {                  
                $("#address_book_se").html(option);
                $("#asap_popup").fadeOut('slow');
                $(".modal-overlay").fadeOut('slow');
                $("#send_everything_to").attr('checked', 'checked');
                send_everything_to();
            }
        });    
    }
}


function ste_function(){
        //alert('jassim');
        document.getElementById("send_everything_to").checked = true;
        $('#address_book_se option:last-child').attr('selected', 'selected');
        var send_everything_to = document.getElementById('send_everything_to').checked;
        var address_book_se    = document.getElementById('address_book_se').value;
        if(send_everything_to == true){            
                $.ajax
                   ({
                       type: "POST",
                       url: "everything_return_to.php",
                       data: "everything_return_to=1&address_book_se="+address_book_se,
                       beforeSend: loadStart,
                       complete: loadStop,
                       success: function(option)
                       {  
                           $('#multi_recipients').slideDown();
                           $('#multi_recipients').html(option);
                           $('#add_recipients').slideDown();
                       }
                   });            
        }else{
            $('#multi_recipients').slideUp();
            $('#add_recipients').slideUp();
        }
 }
 
 function edit_binding(ID)
 {
     $("#binding_select_"+ID).show();
     $("#binding_"+ID).hide();
 }
 
 function change_binding(ID)
 {
    var binding_dtls    = $("#binding_select_"+ID).val(); 
    var binding_caps    = binding_dtls.toUpperCase();
    $.ajax
    ({
       type: "POST",
       url: "admin/get_child.php",
       data: "binding_id="+ID+"&binding_dtls="+binding_dtls,
       beforeSend: loadStart,
       complete: loadStop,
       success: function(option)
       {  
           if(option == true){
               $("#binding_"+ID).html(binding_caps);
               $("#binding_select_"+ID).hide();
               $("#binding_"+ID).show();
           }
       }
    });  
 }
 
 function edit_folding(ID)
 {
     $("#folding_select_"+ID).show();
     $("#folding_"+ID).hide();
 }
 
  function change_folding(ID)
 {
    var folding_dtls = $("#folding_select_"+ID).val();    
    var folding_caps    = folding_dtls.toUpperCase();
    $.ajax
    ({
       type: "POST",
       url: "admin/get_child.php",
       data: "folding_id="+ID+"&folding_dtls="+folding_dtls,
       beforeSend: loadStart,
       complete: loadStop,
       success: function(option)
       {  
           if(option == true){
               $("#folding_"+ID).html(folding_caps);
               $("#folding_select_"+ID).hide();
               $("#folding_"+ID).show();
           }
       }
    });  
 }
 
 function contact_phone(){
 $("#contact_ph").mask("999-999-9999");
 }
 
 function contact_phone_dynamic(OPTION_ID){
 $("#contact_ph_"+OPTION_ID).mask("999-999-9999");
 }
 
 function contact_phone_dynamic_1(){
 $(".contact_ph").mask("999-999-9999");
 }
 
 
 function show_address_recipient_1(ID)
 {
     $("#address_1_span_"+ID).hide();
     $("#address_1_"+ID).show();
     $("#address_1_buttons_"+ID).show();
     $("#show_address_buttons_to_"+ID).slideDown();
 }
 
  function cancel_address_1(ID)
 {
     $("#address_1_span_"+ID).show();
     $("#address_1_"+ID).hide();
     $("#address_1_buttons_"+ID).hide();     
 }
 
 function show_address_recipient_1_j(ID, OPTION_ID)
 {
     $("#address_1_span_"+ID+"_"+OPTION_ID).hide();
     $("#address_1_"+ID+"_"+OPTION_ID).show();
     $("#address_1_buttons_"+ID+"_"+OPTION_ID).show();
     $("#show_address_buttons_"+ID+"_"+OPTION_ID).slideDown();
 }
 
  function cancel_address_1_j(ID, OPTION_ID)
 {
     $("#address_1_span_"+ID+"_"+OPTION_ID).show();
     $("#address_1_"+ID+"_"+OPTION_ID).hide();
     $("#address_1_buttons_"+ID+"_"+OPTION_ID).hide();     
 }
 
 function show_address_recipient_2(ID)
 {
     $("#address_2_span_"+ID).hide();
     $("#address_2_"+ID).show();
     $("#address_2_buttons_"+ID).show();
     $("#show_address_buttons_to_"+ID).slideDown();
 }
 
  function cancel_address_2(ID)
 {
     $("#address_2_span_"+ID).show();
     $("#address_2_"+ID).hide();
     $("#address_2_buttons_"+ID).hide();
 }
 
 
 function show_address_recipient_2_j(ID, OPTION_ID)
 {
     $("#address_2_span_"+ID+"_"+OPTION_ID).hide();
     $("#address_2_"+ID+"_"+OPTION_ID).show();
     $("#address_2_buttons_"+ID+"_"+OPTION_ID).show();
     $("#show_address_buttons_"+ID+"_"+OPTION_ID).slideDown();
 }
 
  function cancel_address_2_j(ID, OPTION_ID)
 {
     $("#address_2_span_"+ID+"_"+OPTION_ID).show();
     $("#address_2_"+ID+"_"+OPTION_ID).hide();
     $("#address_2_buttons_"+ID+"_"+OPTION_ID).hide();     
 }
 
 
 function show_address_recipient_3(ID)
 {
     $("#address_3_span_"+ID).hide();
     $("#address_3_"+ID).show();
     $("#address_3_buttons_"+ID).show();
     $("#show_address_buttons_to_"+ID).slideDown();
 }
 
  function cancel_address_3(ID)
 {
     $("#address_3_span_"+ID).show();
     $("#address_3_"+ID).hide();
     $("#address_3_buttons_"+ID).hide();
 }
 
 
 function show_address_recipient_3_j(ID, OPTION_ID)
 {
     $("#address_3_span_"+ID+"_"+OPTION_ID).hide();
     $("#address_3_"+ID+"_"+OPTION_ID).show();
     $("#address_3_buttons_"+ID+"_"+OPTION_ID).show();
     $("#show_address_buttons_"+ID+"_"+OPTION_ID).slideDown();
 }
 
  function cancel_address_3_j(ID, OPTION_ID)
 {
     $("#address_3_span_"+ID+"_"+OPTION_ID).show();
     $("#address_3_"+ID+"_"+OPTION_ID).hide();
     $("#address_3_buttons_"+ID+"_"+OPTION_ID).hide();    
 }
 
 
 function show_address_recipient_city(ID)
 {
     $("#address_city_span_"+ID).hide();
     $("#address_city_"+ID).show();
     $("#address_city_buttons_"+ID).show();
     $("#show_address_buttons_to_"+ID).slideDown();
 }
 
  function cancel_address_city(ID)
 {
     $("#address_city_span_"+ID).show();
     $("#address_city_"+ID).hide();
     $("#address_city_buttons_"+ID).hide();
 }
 
 
 function show_address_recipient_city_j(ID, OPTION_ID)
 {
     $("#address_city_span_"+ID+"_"+OPTION_ID).hide();
     $("#address_city_"+ID+"_"+OPTION_ID).show();
     $("#address_city_buttons_"+ID+"_"+OPTION_ID).show();
     $("#show_address_buttons_"+ID+"_"+OPTION_ID).slideDown();
 }
 
  function cancel_address_city_j(ID, OPTION_ID)
 {
     $("#address_city_span_"+ID+"_"+OPTION_ID).show();
     $("#address_city_"+ID+"_"+OPTION_ID).hide();
     $("#show_address_buttons_"+ID+"_"+OPTION_ID).hide();
 }
 
 
 function show_address_recipient_state(ID)
 {
     $("#address_state_span_"+ID).hide();
     $("#address_state_select_"+ID).show();   
     $("#show_address_buttons_to_"+ID).slideDown();
 }
 
 
 function show_address_recipient_state_j(ID, OPTION_ID)
 {
     $("#address_state_span_"+ID+"_"+OPTION_ID).hide();
     $("#address_state_select_"+ID+"_"+OPTION_ID).show();   
     $("#show_address_buttons_"+ID+"_"+OPTION_ID).slideDown();
 }
 
 function show_address_recipient_zip(ID)
 {
     $("#address_zip_span_"+ID).hide();
     $("#address_zip_"+ID).show();
     $("#address_zip_"+ID).mask("99999");
     $("#address_zip_buttons_"+ID).show();
     $("#show_address_buttons_to_"+ID).slideDown();
 }
 
 function cancel_address_zip(ID)
 {
     $("#address_zip_span_"+ID).show();
     $("#address_zip_"+ID).hide();
     $("#address_zip_buttons_"+ID).hide();
 }
 
 
 function show_address_recipient_zip_j(ID, OPTION_ID)
 {
     $("#address_zip_span_"+ID+"_"+OPTION_ID).hide();
     $("#address_zip_"+ID+"_"+OPTION_ID).show();
     $("#address_zip_"+ID+"_"+OPTION_ID).mask("99999");
     $("#address_zip_buttons_"+ID+"_"+OPTION_ID).show();
     $("#show_address_buttons_"+ID+"_"+OPTION_ID).slideDown();
 }
 
 function cancel_address_zip_j(ID, OPTION_ID)
 {
     $("#address_zip_span_"+ID+"_"+OPTION_ID).show();
     $("#address_zip_"+ID+"_"+OPTION_ID).hide();
     $("#address_zip_buttons_"+ID+"_"+OPTION_ID).hide();
 }
 
 
 function show_address_recipient_phone(ID)
 {
     $("#address_phone_span_"+ID).hide();
     $("#address_phone_"+ID).show();
     $("#address_phone_"+ID).mask("999-999-9999");
     $("#address_phone_buttons_"+ID).show();
     $("#show_address_buttons_to_"+ID).slideDown();
 }
 
 function cancel_address_phone(ID)
 {
     $("#address_phone_span_"+ID).show();
     $("#address_phone_"+ID).hide();
     $("#address_phone_buttons_"+ID).hide();
 }
 
 
 function show_address_recipient_phone_j(ID, OPTION_ID)
 {
     $("#address_phone_span_"+ID+"_"+OPTION_ID).hide();
     $("#address_phone_"+ID+"_"+OPTION_ID).show();
     $("#address_phone_"+ID+"_"+OPTION_ID).mask("999-999-9999");
     $("#address_phone_buttons_"+ID+"_"+OPTION_ID).show();
     $("#show_address_buttons_"+ID+"_"+OPTION_ID).slideDown();
 }
 
 function cancel_address_phone_j(ID, OPTION_ID)
 {
     $("#address_phone_span_"+ID+"_"+OPTION_ID).show();
     $("#address_phone_"+ID+"_"+OPTION_ID).hide();
     $("#address_phone_buttons_"+ID+"_"+OPTION_ID).hide();
 }
 
 
 function update_exist_address(ID)
 {
     var address_1                  = $("#address_1_"+ID).val();
     var address_2                  = $("#address_2_"+ID).val();
     var address_3                  = $("#address_3_"+ID).val();
     var address_city               = $("#address_city_"+ID).val();
     var address_state_select       = $("#address_state_select_"+ID).val();
     var address_zip                = $("#address_zip_"+ID).val();
     var address_phone              = $("#address_phone_"+ID).val();
     
     $.ajax
        ({
           type: "POST",
           url: "get_recipients.php",
           data: "recipients=85&address_1="+encodeURIComponent(address_1)+"&address_2="+encodeURIComponent(address_2)+"&address_3="+encodeURIComponent(address_3)+"&address_city="+encodeURIComponent(address_city)+"&address_state_select="+address_state_select+"&address_zip="+encodeURIComponent(address_zip)+"&address_phone="+encodeURIComponent(address_phone)+"&address_id="+ID,
           beforeSend: loadStart,
           complete: loadStop,
           success: function(option)
           {  
               if(option == true){
                   
                   $("#address_1_"+ID).hide();
                   $("#address_1_span_"+ID).html(address_1);
                   $("#address_1_span_"+ID).show();
                   $("#address_1_buttons_"+ID).hide();
                   
                   $("#address_2_"+ID).hide();
                   $("#address_2_span_"+ID).html(address_2);
                   $("#address_2_span_"+ID).show();
                   $("#address_2_buttons_"+ID).hide();
                   
                   $("#address_3_"+ID).hide();
                   $("#address_3_span_"+ID).html(address_3);
                   $("#address_3_span_"+ID).show();
                   $("#address_3_buttons_"+ID).hide();
                   
                   $("#address_city_"+ID).hide();
                   $("#address_city_span_"+ID).html(address_city+",&nbsp;");
                   $("#address_city_span_"+ID).show();
                   $("#address_city_buttons_"+ID).hide();
                   
                   $("#address_state_select_"+ID).hide(); 
                   $("#address_state_span_"+ID).html(address_state_select+"&nbsp;");
                   $("#address_state_span_"+ID).show();
                   
                   
                   $("#address_zip_"+ID).hide();
                   $("#address_zip_span_"+ID).html(address_zip);
                   $("#address_zip_span_"+ID).show();
                   $("#address_zip_buttons_"+ID).hide();
                   
                   $("#address_phone_"+ID).hide();
                   $("#address_phone_span_"+ID).html(address_phone);
                   $("#address_phone_span_"+ID).show();
                   $("#address_phone_buttons_"+ID).hide();
                   
                   $("#show_address_buttons_to_"+ID).slideUp();
               }
           }
        }); 
 }
 
 
 function update_exist_address_j(ID, OPTION_ID)
 {
     var address_1                  = $("#address_1_"+ID+"_"+OPTION_ID).val();
     var address_2                  = $("#address_2_"+ID+"_"+OPTION_ID).val();
     var address_3                  = $("#address_3_"+ID+"_"+OPTION_ID).val();
     var address_city               = $("#address_city_"+ID+"_"+OPTION_ID).val();
     var address_state_select       = $("#address_state_select_"+ID+"_"+OPTION_ID).val();
     var address_zip                = $("#address_zip_"+ID+"_"+OPTION_ID).val();
     var address_phone              = $("#address_phone_"+ID+"_"+OPTION_ID).val();
     
     $.ajax
        ({
           type: "POST",
           url: "get_recipients.php",
           data: "recipients=85&address_1="+encodeURIComponent(address_1)+"&address_2="+encodeURIComponent(address_2)+"&address_3="+encodeURIComponent(address_3)+"&address_city="+encodeURIComponent(address_city)+"&address_state_select="+address_state_select+"&address_zip="+encodeURIComponent(address_zip)+"&address_phone="+encodeURIComponent(address_phone)+"&address_id="+ID,
           beforeSend: loadStart,
           complete: loadStop,
           success: function(option)
           {  
               if(option == true){
                   
                   $("#address_1_"+ID+"_"+OPTION_ID).hide();
                   $("#address_1_span_"+ID+"_"+OPTION_ID).html(address_1);
                   $("#address_1_span_"+ID+"_"+OPTION_ID).show();
                   $("#address_1_buttons_"+ID+"_"+OPTION_ID).hide();
                   
                   $("#address_2_"+ID+"_"+OPTION_ID).hide();
                   $("#address_2_span_"+ID+"_"+OPTION_ID).html(address_2);
                   $("#address_2_span_"+ID+"_"+OPTION_ID).show();
                   $("#address_2_buttons_"+ID+"_"+OPTION_ID).hide();
                   
                   $("#address_3_"+ID+"_"+OPTION_ID).hide();
                   $("#address_3_span_"+ID+"_"+OPTION_ID).html(address_3);
                   $("#address_3_span_"+ID+"_"+OPTION_ID).show();
                   $("#address_3_buttons_"+ID+"_"+OPTION_ID).hide();
                   
                   $("#address_city_"+ID+"_"+OPTION_ID).hide();
                   $("#address_city_span_"+ID+"_"+OPTION_ID).html(address_city+",&nbsp;");
                   $("#address_city_span_"+ID+"_"+OPTION_ID).show();
                   $("#address_city_buttons_"+ID+"_"+OPTION_ID).hide();
                   
                   $("#address_state_select_"+ID+"_"+OPTION_ID).hide(); 
                   $("#address_state_span_"+ID+"_"+OPTION_ID).html(address_state_select+"&nbsp;");
                   $("#address_state_span_"+ID+"_"+OPTION_ID).show();
                   
                   
                   $("#address_zip_"+ID+"_"+OPTION_ID).hide();
                   $("#address_zip_span_"+ID+"_"+OPTION_ID).html(address_zip);
                   $("#address_zip_span_"+ID+"_"+OPTION_ID).show();
                   $("#address_zip_buttons_"+ID+"_"+OPTION_ID).hide();
                   
                   $("#address_phone_"+ID+"_"+OPTION_ID).hide();
                   $("#address_phone_span_"+ID+"_"+OPTION_ID).html(address_phone);
                   $("#address_phone_span_"+ID+"_"+OPTION_ID).show();
                   $("#address_phone_buttons_"+ID+"_"+OPTION_ID).hide();
                   
                   $("#show_address_buttons_"+ID+"_"+OPTION_ID).slideUp();
               }
           }
        }); 
 }
 
 function save_new_address(ID, OPTION_ID)
 {  
    $.ajax
        ({
           type: "POST",
           url: "add_new_address_closer.php",
           data: "address_closer=1_1&address_id="+ID,
           beforeSend: loadStart,
           complete: loadStop,
           success: function(option)
           {  
               $("#show_address_"+OPTION_ID).css("height", "125px");
               $("#jumbalakka_nmj_"+OPTION_ID).css("margin-top", "85px");
               $("#show_address_inside_"+OPTION_ID).html(option);
               $("#company_phone_closer_"+ID).mask("999-999-9999");
               $("#company_zip_closer_"+ID).mask("99999");
               $("#save_only_"+OPTION_ID).hide();
               $("#show_save_new_"+OPTION_ID).hide();
               $("#save_new_"+OPTION_ID).show();
               $("#show_save_new_cancel_"+OPTION_ID).show();               
           }
        });     
         
 }
 
 function save_new_address_to(ID, OPTION_ID)
 {  
    $.ajax
        ({
           type: "POST",
           url: "add_new_address_closer.php",
           data: "address_closer=1_1&address_id="+ID,
           beforeSend: loadStart,
           complete: loadStop,
           success: function(option)
           {  
               $("#show_address").css("height", "125px");
               //$("#jumbalakka_nmj_"+OPTION_ID).css("margin-top", "85px");
               $("#show_address").html(option);
               $("#company_phone_closer_"+ID).mask("999-999-9999");
               $("#company_zip_closer_"+ID).mask("99999");
               $("#save_only").hide();
               $("#show_save_new").hide();
               $("#save_new").show();
               $("#show_save_new_cancel").show();               
           }
        });     
         
 }
 
 function save_new_address_cancel(ID, option_id)
 {  
    var shipping_id     = ID;
    if(shipping_id == "P1"){
       $("#show_address").html("381 Broome Street New York, NY 10013"); 
       $("#shipp_att_"+option_id).val("");
    }else if(shipping_id == "P2"){
       $("#show_address").html("307 7th Ave, 5th Floor New York, NY 10013"); 
       $("#shipp_att_"+option_id).val("");
    }else if(shipping_id == "NEW"){
       window.location = "service_add_address.php?serivice_plotting=1"; 
    }else if(shipping_id == "NEW-MULTI"){
       window.location = "service_add_address.php?serivice_plotting=1&multi=1"; 
    }else{
        $.ajax
            ({
                type: "POST",
                url: "shipping_address_rec_nmjk.php",
                data: "shipping_id_rp="+shipping_id+"&option_id="+option_id,
                success: function(option)
                {  
                    var myarr = option.split("~");
                    $("#show_address_"+option_id).html(myarr[0]);
                    $("#shipp_att_"+option_id).val(myarr[1]);
                    $("#edit_address_"+option_id).fadeIn();
                }
            });
    }    
 }
 
 function save_new_address_cancel_to(ID)
 {  
    var send_everything_to = document.getElementById('send_everything_to').checked;
    var address_book_se    = document.getElementById('address_book_se').value;
     if(send_everything_to == true){
         if(address_book_se != '0'){
             $.ajax
                ({
                    type: "POST",
                    url: "everything_return_to.php",
                    data: "everything_return_to=1&address_book_se="+address_book_se,
                    beforeSend: loadStart,
                    complete: loadStop,
                    success: function(option)
                    {  
                        $('#multi_recipients').slideDown();
                        $('#multi_recipients').html(option);
                        $('#add_recipients').slideDown();
                        $('.addrecipientActionLink').hide();
                        $(".addproductActionLink").hide();
                    }
                });
         }else{
            alert("Select the address.");
            document.getElementById('address_book_se').focus();
            document.getElementById('send_everything_to').checked = false;
         }
     }else{
         $('#multi_recipients').slideUp();
         $('#add_recipients').slideUp();
     } 
 }
 
 
 function save_new_address_cancel_to_2(ID)
 {
     var shipping_id     = ID;
    
    if(shipping_id == "P1"){
       $("#show_address").html("381 Broome Street New York, NY 10013"); 
       $("#shipp_att_"+option_id).val("");
    }else if(shipping_id == "P2"){
       $("#show_address").html("307 7th Ave, 5th Floor New York, NY 10013"); 
       $("#shipp_att_"+option_id).val("");
    }else if(shipping_id == "NEW"){
       window.location = "service_add_address.php?serivice_plotting=1"; 
    }else if(shipping_id == "NEW-MULTI"){
       window.location = "service_add_address.php?serivice_plotting=1&multi=1"; 
    }else{
        $.ajax
            ({
                type: "POST",
                url: "shipping_address_rec_nmjk.php",
                data: "shipping_id_rp="+shipping_id+"&option_id=0",
                success: function(option)
                {  
                    var myarr = option.split("~");
                    $("#show_address").show();
                    $("#show_address").html(myarr[0]);
                    $("#shipp_att").val(myarr[1]);
                    $("#edit_address").fadeIn(); 
                    send_everything_to_cancel();
                }
            });
    }  
 }
 
 
 function save_new_record(ID,OPTION_ID)
 {
     var company_name               = $("#company_name_closer_"+ID).val();
     var attention_to               = $("#attention_to_closer_"+ID).val();
     var address_1                  = $("#address_1_closer_"+ID).val();
     var address_2                  = $("#address_2_closer_"+ID).val();
     var address_3                  = $("#address_3_closer_"+ID).val();
     var address_city               = $("#city_closer_"+ID).val();
     var address_state_select       = $("#state_closer_"+ID).val();
     var address_zip                = $("#company_zip_closer_"+ID).val();
     var phone                      = $("#company_phone_closer_"+ID).val();
     
     if(company_name == ''){
         $("#company_name_closer_"+ID).css("border", "1px solid #EA4335");
         $("#company_name_closer_"+ID).focus();
         return false;
     }else{
         $("#company_name_closer_"+ID).css("border", "1px solid #ccc");        
     }
     
     if(attention_to == ''){
         $("#attention_to_closer_"+ID).css("border", "1px solid #EA4335");
         $("#attention_to_closer_"+ID).focus();
         return false;
     }else{
         $("#attention_to_closer_"+ID).css("border", "1px solid #ccc");
     }
     
     if(address_1 == ''){
         $("#address_1_closer_"+ID).css("border", "1px solid #EA4335");
         $("#address_1_closer_"+ID).focus();
         return false;
     }else{
         $("#address_1_closer_"+ID).css("border", "1px solid #ccc");
     }
          
     if(address_city == ''){
         $("#city_closer_"+ID).css("border", "1px solid #EA4335");
         $("#city_closer_"+ID).focus();
         return false;
     }else{
         $("#city_closer_"+ID).css("border", "1px solid #ccc");
     }
     
     if(address_state_select == '0'){
         $("#state_closer_"+ID).css("border", "1px solid #EA4335");
         $("#state_closer_"+ID).focus();
         return false;
     }else{
         $("#state_closer_"+ID).css("border", "1px solid #ccc");
     }
     
     if(address_zip == ''){
         $("#company_zip_closer_"+ID).css("border", "1px solid #EA4335");
         $("#company_zip_closer_"+ID).focus();
         return false;
     }else{
         $("#company_zip_closer_"+ID).css("border", "1px solid #ccc");
     }
     
     if(phone == ''){
         $("#company_phone_closer_"+ID).css("border", "1px solid #EA4335");
         $("#company_phone_closer_"+ID).focus();
         return false;
     }else{
         $("#company_phone_closer_"+ID).css("border", "1px solid #ccc");
     }
     
     $.ajax
        ({
           type: "POST",
           url: "get_recipients.php",
           data: "recipients=86&company_name="+encodeURIComponent(company_name)+"&attention_to="+encodeURIComponent(attention_to)+"&address_1="+encodeURIComponent(address_1)+"&address_2="+encodeURIComponent(address_2)+"&address_3="+encodeURIComponent(address_3)+"&address_city="+encodeURIComponent(address_city)+"&address_state_select="+encodeURIComponent(address_state_select)+"&address_zip="+encodeURIComponent(address_zip)+"&phone="+phone+"&address_id="+ID,
           beforeSend: loadStart,
           complete: loadStop,
           success: function(option)
           {  
               var options_divide = option.split('~');
               $("#address_book_rp").html(options_divide[3]);
               if(OPTION_ID != ''){
               $("#address_book_rp_"+OPTION_ID).html(options_divide[3]);
               }
               if(options_divide[0] == true){
                   $('.remove_current').html(options_divide[4]);
                   $("#add_new_address_block_"+ID).hide();
                   $("#show_address_inside_"+OPTION_ID).html(options_divide[1]);
                   $("#shipp_att_"+OPTION_ID).val(options_divide[2]);
                   $("#show_address_buttons_to_"+ID).slideUp();
                   $("#show_address").css("height", "80px");
                   $("#save_new_"+OPTION_ID).hide();
                   $("#show_save_new_"+OPTION_ID).show();
                   var drop_down_val    = $("#last_entered_add_id").val();
                   $("#show_save_new_"+OPTION_ID).attr("onclick", "save_new_address("+drop_down_val+","+OPTION_ID+");");
                   $("#save_new_"+OPTION_ID).attr("onclick", "save_new_record("+drop_down_val+","+OPTION_ID+");");
                   $("#show_save_new_cancel_"+OPTION_ID).attr("onclick", "save_new_address_cancel("+drop_down_val+","+OPTION_ID+");");
               }else{
                   alert('Company Name Already Exist.');
                   $("#company_name_closer_"+ID).focus();
               }
           }
        }); 
 }
 
 function save_new_record_to(ID,OPTION_ID)
 {
     var company_name               = $("#company_name_closer_"+ID).val();
     var attention_to               = $("#attention_to_closer_"+ID).val();
     var address_1                  = $("#address_1_closer_"+ID).val();
     var address_2                  = $("#address_2_closer_"+ID).val();
     var address_3                  = $("#address_3_closer_"+ID).val();
     var address_city               = $("#city_closer_"+ID).val();
     var address_state_select       = $("#state_closer_"+ID).val();
     var address_zip                = $("#company_zip_closer_"+ID).val();
     var phone                      = $("#company_phone_closer_"+ID).val();
     
     if(company_name == ''){
         $("#company_name_closer_"+ID).css("border", "1px solid #EA4335");
         $("#company_name_closer_"+ID).focus();
         return false;
     }else{
         $("#company_name_closer_"+ID).css("border", "1px solid #ccc");        
     }
     
     if(attention_to == ''){
         $("#attention_to_closer_"+ID).css("border", "1px solid #EA4335");
         $("#attention_to_closer_"+ID).focus();
         return false;
     }else{
         $("#attention_to_closer_"+ID).css("border", "1px solid #ccc");
     }
     
     if(address_1 == ''){
         $("#address_1_closer_"+ID).css("border", "1px solid #EA4335");
         $("#address_1_closer_"+ID).focus();
         return false;
     }else{
         $("#address_1_closer_"+ID).css("border", "1px solid #ccc");
     }
          
     if(address_city == ''){
         $("#city_closer_"+ID).css("border", "1px solid #EA4335");
         $("#city_closer_"+ID).focus();
         return false;
     }else{
         $("#city_closer_"+ID).css("border", "1px solid #ccc");
     }
     
     if(address_state_select == '0'){
         $("#state_closer_"+ID).css("border", "1px solid #EA4335");
         $("#state_closer_"+ID).focus();
         return false;
     }else{
         $("#state_closer_"+ID).css("border", "1px solid #ccc");
     }
     
     if(address_zip == ''){
         $("#company_zip_closer_"+ID).css("border", "1px solid #EA4335");
         $("#company_zip_closer_"+ID).focus();
         return false;
     }else{
         $("#company_zip_closer_"+ID).css("border", "1px solid #ccc");
     }
     
     if(phone == ''){
         $("#company_phone_closer_"+ID).css("border", "1px solid #EA4335");
         $("#company_phone_closer_"+ID).focus();
         return false;
     }else{
         $("#company_phone_closer_"+ID).css("border", "1px solid #ccc");
     }
     
     $.ajax
        ({
           type: "POST",
           url: "get_recipients.php",
           data: "recipients=86&company_name="+encodeURIComponent(company_name)+"&attention_to="+encodeURIComponent(attention_to)+"&address_1="+encodeURIComponent(address_1)+"&address_2="+encodeURIComponent(address_2)+"&address_3="+encodeURIComponent(address_3)+"&address_city="+encodeURIComponent(address_city)+"&address_state_select="+encodeURIComponent(address_state_select)+"&address_zip="+encodeURIComponent(address_zip)+"&phone="+phone+"&address_id="+ID,
           beforeSend: loadStart,
           complete: loadStop,
           success: function(option)
           {  
               var options_divide = option.split('~');
               $("#address_book_rp").html(options_divide[3]);
               $("#address_book_se").html(options_divide[3]);
               if(OPTION_ID != ''){
               $("#address_book_rp_"+OPTION_ID).html(options_divide[3]);
               }
               if(options_divide[0] == true){
                   
                   $("#add_new_address_block_"+ID).hide();
                   $("#show_address").html(options_divide[1]);
                   $("#shipp_att").val(options_divide[2]);
                   $("#show_address_buttons_to").slideUp();
                   $("#show_address").css("height", "80px");
                   $("#save_new").hide();
                   $("#show_save_new").show();
                   
                   var drop_down_val    = $("#last_entered_add_id").val();
                   $("#show_save_new").attr("onclick", "save_new_address_to("+drop_down_val+","+OPTION_ID+");");
                   $("#save_new").attr("onclick", "save_new_record_to("+drop_down_val+","+OPTION_ID+");");
                   $("#show_save_new_cancel").attr("onclick", "send_everything_to_cancel("+drop_down_val+","+OPTION_ID+");");
                   //$("show_address_buttons_to_"+ID).hide();
               }else{
                   alert('Company Name Already Exist.');
                   $("#company_name_closer_"+ID).focus();
               }
           }
        }); 
 }
 
 function update_recipient_dynamic(ID)
 {
     var shipping_id            = $("#address_book_rp_"+ID).val();
     var user_session           = $("#user_session").val(); 
     var user_session_comp      = $("#user_session_comp").val(); 
     
     var avl_sets_1             = $("#avl_sets_1").val();
     var need_sets_1            = $("#need_sets_1").val();
     var size_sets_1            = $("#size_sets_1").val();
     var output_sets_1          = $("#output_sets_1").val();
     var binding_sets_1_pre     = $("#binding_sets_1").val();
     var binding_sets_1         = (binding_sets_1_pre != '') ? binding_sets_1_pre : '0' ;
     var folding_sets_1         = $("#folding_sets_1").val();
     
     var avl_sets_2             = $("#avl_sets_2").val();
     var need_sets_2            = $("#need_sets_2").val();
     var size_sets_2            = $("#size_sets_2").val();
     var output_sets_2          = $("#output_sets_2").val();
     var binding_sets_2_pre     = $("#binding_sets_2").val();
     var binding_sets_2         = (binding_sets_2_pre != '') ? binding_sets_2_pre : '0' ;
     var folding_sets_2         = $("#folding_sets_2").val();
     var date_needed            = $("#date_needed").val();
     var time_needed            = $("#time_picker_icon").val();
     var spl_recipient          = $("#spl_recipient").val();
     
     var shipp_att              = $("#shipp_att").val();
     
     var size_custom_details    = (size_sets_1 == 'Custom') ? document.getElementById("size_custom_details").value : '0';
     
     var arrange_del            = document.getElementById('arrange_del_'+ID).checked;
     var delivery_comp          = (arrange_del == false) ? document.getElementById("delivery_comp").value : '0';
     var bill_number            = (arrange_del == false) ? document.getElementById("bill_number").value : '0';
     if(arrange_del == false)
     {
        var shipp_comp_1        =   document.getElementById('shipp_comp_1').checked;
            var shipp_comp_1_f  =   (shipp_comp_1 == true) ? document.getElementById("shipp_comp_1").value : '0';
        var shipp_comp_2        =   document.getElementById('shipp_comp_2').checked;
            var shipp_comp_2_f  =   (shipp_comp_2 == true) ? document.getElementById("shipp_comp_2").value : '0';
        var shipp_comp_3        =   document.getElementById('shipp_comp_3').checked;
            var shipp_comp_3_f  =   (shipp_comp_3 == true) ? document.getElementById("other_shipp_type").value : '0';
     }else{
            var shipp_comp_1_f  =   '0';
            var shipp_comp_2_f  =   '0';
            var shipp_comp_3_f  =   '0';
     }      
     
     
     if(shipping_id == '0'){
         alert('Please select send to address');
         $("#address_book_rp").focus();
         return false;
     }
     
     if(date_needed == ''){
         alert('Please select when needed');
         $("#date_needed").focus();
         return false;
     }
     
     $.ajax
        ({
            type: "POST",
            url: "get_recipients.php",                  
            data: "recipients=502&shipping_id_rec="+encodeURIComponent(shipping_id)+"&avl_sets_1="+encodeURIComponent(avl_sets_1)+"&need_sets_1="+encodeURIComponent(need_sets_1)+"&size_sets_1="+encodeURIComponent(size_sets_1)+"&output_sets_1="+encodeURIComponent(output_sets_1)+"&binding_sets_1="+encodeURIComponent(binding_sets_1)+"&avl_sets_2="+encodeURIComponent(avl_sets_2)+"&need_sets_2="+encodeURIComponent(need_sets_2)+"&size_sets_2="+encodeURIComponent(size_sets_2)+"&output_sets_2="+encodeURIComponent(output_sets_2)+"&binding_sets_2="+encodeURIComponent(binding_sets_2)+"&user_session="+encodeURIComponent(user_session)+"&user_session_comp="+encodeURIComponent(user_session_comp)+"&date_needed="+encodeURIComponent(date_needed)+"&spl_recipient="+encodeURIComponent(spl_recipient)+"&edit_recipient_id="+ID+"&delivery_type="+encodeURIComponent(delivery_comp)+"&bill_number="+encodeURIComponent(bill_number)+"&shipp_comp_1_f="+encodeURIComponent(shipp_comp_1_f)+"&shipp_comp_2_f="+encodeURIComponent(shipp_comp_2_f)+"&shipp_comp_3_f="+encodeURIComponent(shipp_comp_3_f)+"&folding_sets_1="+encodeURIComponent(folding_sets_1)+"&folding_sets_2="+encodeURIComponent(folding_sets_2)+"&time_needed="+encodeURIComponent(time_needed)+"&size_custom_details="+encodeURIComponent(size_custom_details)+"&attention_to="+encodeURIComponent(shipp_att)+"&jumbalakka_id="+ID,
            beforeSend: loadStart,
            complete: loadStop,
            success: function(option)
            {  
                $('#dynamic_edit_'+ID).html(option);
            }
        });
 }
 
 
 function continue_recipient_everyting_return_4()
 {  
     var pickup_soho_add        = $("#pickup_soho_add").val();  
     var date_needed            = $("#date_needed").val();
     var time_needed            = $("#time_picker_icon").val();
     var spl_recipient          = $("#spl_recipient").val();
     
     if(date_needed == ''){
         alert('Please select when needed');
         $("#date_needed").focus();
         return false;
     }
     
     $.ajax
        ({
            type: "POST",
            url: "get_recipients.php",                  
            data: "recipients=786&date_needed="+encodeURIComponent(date_needed)+"&spl_recipient="+encodeURIComponent(spl_recipient)+"&time_needed="+encodeURIComponent(time_needed)+"&pickup_soho_add="+pickup_soho_add+"&delivery_type_option=3",
            beforeSend: loadStart,
            complete: loadStop,
            success: function(option)
            {  
                if(option == '1'){
                    window.location = "view_all_recipients.php";
                }
            }
        });
 }
 
 
 </script>


<?php
if($_GET['address_ste'] == '1'){      
?>
<script>
ste_function();
</script>
<?php
}
?>

 </body>
 <!-- Mirrored from buckart.com/srsite/SoHoRepro-WebsitePages/store/store.html by HTTrack Website Copier/3.x [XR&CO'2013], Sat, 21 Sep 2013 08:45:26 GMT -->
 </html>
