
<body>
  <header class="header-area .message-header">
    <div class="container">
      <div class="logo-area">
        <a href="https://edtools.io/apps/"><img src="<?php echo base_url(); ?>assets/entries/images/logo.png" alt="Logo"></a>
      </div>
      <div class="menu-area">
        <nav>
          <ul>
            
           <li><a href="<?php echo base_url('entries/Homework'); ?>">Homework</a></li> 
              <li id="ex-item"><a href="<?php echo base_url('entries/Exams'); ?>">Exams</a></li>
              <li id="ms-item"><a href="<?php echo base_url('entries/Messages'); ?>">Messages</a></li>
              <li id="lk-item"><a id="ln-active" href="<?php echo base_url('entries/Link'); ?>">Links</a></li>
              <li id="cl-item"><a href="<?php echo base_url('entries/Calendar'); ?>">Calender</a></li>

        
            
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
<form action="<?php echo base_url('entries/Exams/manage'); ?>" onsubmit="return checkvalidation_exam()" method="POST">
         <section class="class-selection exam-select">
            <div class="container">
              <div class="custom-select">

                <select name="class_id" id="class_id_exm" >
                  <option value="">Select Class</option>
                  <?php foreach ($classes as $class) { ?>
                          <option value="<?=$class['_id']?>"><?=$class['class_name']?></option>
                 <?php } ?>
                </select>
              </div>
            </div>
          </section>

          <section class="form-area exam-form">

            <div class="container">
              <h1 class="typer">Announce an exam</h1>
              <form action="">
                <label for="title">Subject</label>
                <input type="text" id="title" name="subject" placeholder="Enter subject name" required="required">
                <label for="date">Date</label>
                <input id="datepicker" name="date" onfocus="(this.type='date')" class="js-form-control" placeholder="Enter date" required="required">
                <label for="message">Description</label>
                <textarea name="message" maxlength="800" id="message" cols="30" rows="6" placeholder="Please describe" required="required"></textarea>
                <button id="send">Send</button>
              </form>
            </div>
          </section>
</form>
  <section class="bottom-area exam-bottom" id='exambox'>
    
  </section>
   <footer class="footer-area exam-footer">
    <div class="container">
      <p>The dates of exams are automatically deleted after the due date.</p>
    </div>
  </footer>


<?php }else{?>
 <section>
        <div class="container">
        <div style="padding: 20px; background-color: red; color:white">
          Messages are not shown for this class in the students dashboard. Please activate it in the settings <a href="<?php echo base_url() ?>settings/student/student"> click here</a>. 
        </div>
      </div>
 </section>
<?php } ?>