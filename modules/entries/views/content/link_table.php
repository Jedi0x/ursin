<?php //asort($mesagedata);  ?>
<?php
$price = array_column($mesagedata, 'category');
array_multisort($price, SORT_ASC, $mesagedata);
?>

<div class="container">
      <h1>Links for Class <?php echo $classname; ?>
        <?php if(!empty($connectedclass)){ ?>  
              <div style="float:right; font-size: 12px; color:red">Show all teachers  
                <input type="checkbox" name="" onclick="load_alldata_links('<?php echo $idofclass ?>')"></div> 
          <?php }else{ ?>
            <a href="<?php echo base_url(); ?>settings/student/student"> <div style="float:right; font-size: 12px; color:red">Connect to another teacher</div> </a>
          <?php }?>
       </h1>
      <nav>
        <ul>

    <?php  if(isset($mesagedata)){ 
        $datearrt =  array();
        $count = 0;
      foreach ($mesagedata as $key => $value) {
        if($value['teachers_name'] == get_teacher_id()){
        ?>
          <li>
            <div class="message message-link">
              <div class="container">
                  <?php if(!in_array($value['category'], $datearrt)){ ?>
                      <h3 class="form-h-text">Category <?php echo $value['category']; ?></h3>
                  <?php } ?>
                <div class="table-cont">
                  <a href="<?php echo $value['url']; ?>" target="_blank">
                  <div class="box-left-icon">
                    <?php $col = $value['color']; ?>
                    <div class="icon-box" style="background: <?php echo $col; ?>;">
                      <i style="font-size: 35px; padding: 18px; color: white;" class="<?php echo $value['icon']; ?>"></i>
                    </div>
                  </div>
                  </a>
                  <div class="box-table">
                    <span style='<?php if(isset($value[0])){?> color:gray; <?php } ?>'><?php echo $value['title']; ?></span>
                    <table style="width: 85%; <?php if(isset($value[0])){?> color:gray; <?php } ?> ">
                      <tr>
                        <td><?php echo $value['description']; ?></td>
                        <td> 
                          <?php if(!isset($value[0])){?>
                             <button style="color:none;border: none; padding: 0" class="delete delete-links" data-id="<?php echo $idofclass; ?>" data-key="<?php echo $key ?>" >&#10007;</button>
                          <?php } ?>
                       </td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </li>
    <?php
                 $datearrt[$count] = $value['category']; 
                 $count++;
     } }
      } ?>



        </ul>
      </nav>
    </div>

