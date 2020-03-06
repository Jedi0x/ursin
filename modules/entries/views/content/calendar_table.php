<?php
  function date_compare($a, $b)
  {
      $t1 = strtotime($a['activity_date']);
      $t2 = strtotime($b['activity_date']);
      return $t1 - $t2;
  }  

  usort($mesagedata, "date_compare"); 
 ?>
  <section class="bottom-area message-cont">
    <div class="container">
       <h1>Calendar for Class <?php echo $classname; ?> 

        <?php if(!empty($connectedclass)){ ?>  
            <div style="float:right; font-size: 12px; color:red">Show all teachers  
              <input type="checkbox" name="" onclick="load_alldata_calendar('<?php echo $idofclass ?>')"></div> 
        <?php }else{ ?>
          <a href="<?php echo base_url(); ?>settings/student/student"> <div style="float:right; font-size: 12px; color:red">Connect to another teacher</div> </a>
        <?php }?>
       </h1>

        <div class="message">
          <nav>
            <ul>
            <?php  if(isset($mesagedata)){ 
              foreach ($mesagedata as $key => $value) {
                 if($value['teachers_name'] == get_teacher_id()){
                ?>
              <li>
                <table style="width: 100%; <?php if(isset($value[0])){?> color:gray; <?php } ?> " >
                  <tr>
                    <td><?php echo $value['activity_date']; ?></td>
                     <td><?php echo $value['title']; ?></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td><?php echo $value['description']; ?></td>
                    <td>
                        <?php if(!isset($value[0])){?>
                           <button style="color:none;border: none; padding: 0" class="delete delete-calendar" data-id="<?php echo $idofclass; ?>" data-key="<?php echo $key ?>" >&#10007;</button>
                         <?php } ?>
                    </td>
                  </tr>
                </table>
              </li>
            <?php } } }?> 
            </ul>
          </nav>
        </div>
      </div>
  </section>


