
<body>
  <header class="header-area .message-header">
    <div class="container">
      <div class="logo-area">
        <a href="https://edtools.io/apps/"><img src="<?php echo base_url(); ?>assets/entries/images/logo.png" alt="Logo"></a>
      </div>
      <div class="menu-area">
        <nav>
          <ul>
            <li id="wh-item"><a href="homework.html">Homework</a></li>
            <li id="ex-item"><a href="exams.html">Exams</a></li>
            <li id="ms-item"><a id="meg-active" href="<?php echo base_url('entries/messages'); ?>">Messages</a></li>
            <li id="lk-item"><a href="links.html">Links</a></li>
            <li id="cl-item"><a href="calender.html">Calender</a></li>

        
            
            <li class="drp-itm" id="mr-item"><a href="">More<i class="fas fa-angle-down"></i></a>
              <ul>
                <li><a href="#">Open Task</a></li>
                <li><a href="#">Checklist</a></li>
                <li><a href="#">Settings</a></li>
              </ul>
            </li>
            <li id="ques-mark"><a class="ques-mark" href="#"><img src="<?php echo base_url(); ?>assets/entries/images/question.png" alt=""></a></li>
          </ul>
        </nav>
      </div>
    </div>
  </header>
<?php if(!isset($showbanner)){ ?>
<form action="<?php echo base_url('entries/Messages/manage'); ?>" method="POST">
    <section class="class-selection message-select">
      <div class="container">
        <div class="custom-select">
          <select name="class_id" id="clasid">
            <option value="" selected="">Select Class</option>
              <?php foreach ($classes as $class) { ?>
                  <option value="<?=$class['_id']?>"><?=$class['class_name']?></option>
              <?php } ?>
          </select>
        </div>
      </div>
    </section>

    <section class="form-area message-form">
      <div class="container">
        <h1 class="typer">Create a new message</h1>
       
        <?php if(empty($notshowform)){ ?>
          <label for="title">Title</label>
          <input type="text" id="title" name="title" placeholder="Enter title" required>
          <label for="date">Date of delation</label>
          <input id="datepicker" onfocus="(this.type='date')" name="date" class="js-form-control" placeholder="Optional expiration date" required>
          <label for="message">Message</label>
          <textarea name="message" id="message" cols="30" maxlength="800" rows="6" placeholder="Write your message" required></textarea>
            <p><input type="radio" id="recipient_identifier1" onclick="showmailcheckbox(this.value)" name="recipient_identifier" value="0" style="width: 15px;">  Publish to all my classes</p>
            <p><input type="radio" id="recipient_identifier1" onclick="showmailcheckbox(this.value)" name="recipient_identifier" value="2" style="width: 15px;">  Visible for parents only</p>
          <!--   <p><input type="radio" id="male" name="gender" value="male" style="width: 15px;">  Mail notification to all parents</p> -->

         
          

          <!-- <input type="radio" id="check" name="recipient_identifier" value="0">
          <label id="check-text" for="check">Publish to all my classes</label> -->

          <!-- <input type="radio" id="check" name="recipient_identifier" value="1">
          <label id="check-text" for="check">Visible for parents only</label>-->
          <div style="margin-left: 30px; display: none;" id="idofmailcheckbox">
            <input type="checkbox" id="check" name="emailsendofall" value="mail">
            <label id="check-text" for="check">Mail notification to all parents</label> 
          </div>

          <button type="submit" id="send">Send</button>
        <?php }else{ ?>
           <label for="date"> <?php echo $notshowform; ?></label>
        <?php } ?>
        
      </div>
    </section>
</form>
  <section class="bottom-area message-cont" id="messagebox">
    <div class="container">
     
      <nav>
        <ul>
          
          <?php if(isset($messagesdata)){ foreach (uksort($messagesdata) as $key => $value) {?>
            
        
         
          <?php } }?>
        </ul>
      </nav>
    </div>
  </section>
<?php }else{?>
   <section >
    <div class="alert alert-primary" role="alert">
      Messages are not shown for this class in the students dashboard. Please activate it in the settings <a href="<?php echo base_url() ?>/settings/student/student/<?php echo base_url() ?>"> click here</a>. 
    </div>
   </section>
<?php } ?>
  <footer class="footer-area message-footer">
    <div class="container">
      <p>Keep your messages up to date and relevant at all times. Therefore, the number of messages is limited to 5 (gold) or 20 (diamond). Here you can update subscriptions.</p>
    </div>
  </footer>
  <script type="text/javascript">

      

  </script>

<script src="<?php echo base_url(); ?>assets/entries/js/selector.js"></script>
<script src="<?php echo base_url(); ?>assets/entries/js/typewriter.js"></script>