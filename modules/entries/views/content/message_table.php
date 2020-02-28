<?php
  function date_compare($a, $b)
  {
      $t1 = strtotime($a['due_date']);
      $t2 = strtotime($b['due_date']);
      return $t1 - $t2;
  }  

  usort($mesagedata, "date_compare"); 
 ?>
  <section class="bottom-area message-cont">
    <div class="container">
      
      <h1>Message for Class <?php echo $classname; ?> 

      <?php if(!  empty($connectedclass)){ ?>  
          <div style="float:right; font-size: 12px; color:red">Show all teachers  
            <input type="checkbox" name="" onclick="load_alldata_teacher('<?php echo $idofclass ?>')"></div> 
      <?php }else{ ?>
        <a href="<?php echo base_url(); ?>settings/student/student"> <div style="float:right; font-size: 12px; color:red">Connect to another teacher</div> </a>
      <?php }?>
     </h1>

      <nav>
        <ul>
          
         <?php  if(isset($mesagedata)){ 
            foreach ($mesagedata as $key => $value) {
              if($value['teachers_name'] == get_teacher_id()){ ?>
          <li>
            <div class="message">
              <div class="container">

                <table style="width: 100%; <?php if(isset($value[0])){?> color:gray; <?php } ?> " >
                  <tr>
                    <td><?php echo $value['title']; ?></td>
                    <td></td>
                    <td><?php echo $value['date']; ?></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td colspan="3" ><?php echo $value['message']; ?></td>
                    <td>
                      <?php if(!isset($value[0])){?>
                         <button style="color:none;border: none; padding: 0" class="delete delete-message" data-id="<?php echo $idofclass; ?>" data-key="<?php echo $key ?>" >&#10007;</button>
                       <?php } ?>
                      </td>
                  </tr>
                </table>
              </div>
            </div>
          </li>
         
          <?php } } }?> 
        </ul>
      </nav>
    </div>
  </section>
