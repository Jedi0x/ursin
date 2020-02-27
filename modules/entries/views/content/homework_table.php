
    <h1>Exam in Class <?php echo $classname; ?>

        <?php if(!  empty($connectedclass)){ ?>  
          <div style="float:right; font-size: 12px; color:red">Show all teachers  
            <input type="checkbox" name="" onclick="load_alldata_homework('<?php echo $idofclass ?>')"></div> 
        <?php }else{ ?>
          <a href="<?php echo base_url(); ?>settings/student/student"> <div style="float:right; font-size: 12px; color:red">Connect to another teacher</div> </a>
        <?php }?>
    </h1>

        <div class="message" id="home_work">
          <nav>
            <ul>
          <?php  if(isset($mesagedata)){ 
           foreach ($mesagedata as $key => $value) {?>
              <li>
                <table style="width: 100%; <?php if(isset($value[0])){?> color:gray; <?php } ?> " >
                  <tr>
                    <td><?php echo $value['due_date']; ?></td>
                    <td><?php echo $value['subject']; ?></td>
                    <td>
                      <?php echo $value['description']; ?>
                    </td>
                    <td>
                   <?php if(!isset($value[0])){?>
                         <button style="color:none;border: none; padding: 0" class="delete delete-homework" data-id="<?php echo $idofclass; ?>" data-key="<?php echo $key ?>" >&#10007;</button>
                    <?php } ?>
                     </td>
                  </tr>
                </table>
              </li>
           <?php } }?>
            </ul>
          </nav>
        </div>

