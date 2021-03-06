<!DOCTYPE html>
<html lang="en">
<head>
  <base href="<?php echo base_url();?>">
  <script>
    let base_url = '<?php echo base_url(); ?>';
  </script>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{title} </title>
  {metas}

  <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
   <link rel="stylesheet" type="text/css" href="appci/assets/components/tooltipify/lib/tooltipify.min.css">


  <link rel="stylesheet" type="text/css" href="appci/assets/components/toastr/toastr.css">
  <link rel="stylesheet" type="text/css" href="appci/assets/components/jquery-confirm/jquery-confirm.min.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400&display=swap" rel="stylesheet">
  
  <link rel="stylesheet" href="<?php echo base_url(); ?>appci/assets/entries/main-style.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>appci/assets/entries/css/link-style.css">

   <link rel="stylesheet" href="<?php echo base_url(); ?>appci/assets/entries/dist/fontawesome-5.11.2/css/all.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>appci/assets/entries/dist/iconpicker-1.5.0.css">


  {styles}

  <script type="text/javascript" src="appci/assets/js/jquery.js"></script>
  <script type="text/javascript" src="appci/assets/components/toastr/toastr.min.js"></script>
  <script type="text/javascript" src="appci/assets/components/jquery-confirm/jquery-confirm.min.js"></script>
  <script type="text/javascript" src="appci/assets/components/tooltipify/lib/jquery-tooltipify.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>appci/assets/entries/js/messages.js"></script>
  <script type="text/javascript">
        
        function toasterOptions() {
          toastr.options = {
              "closeButton": true,
              "debug": false,
              "newestOnTop": false,
              "progressBar": true,
              "positionClass": "toast-bottom-right",
              "preventDuplicates": false,
              "onclick": null,
              "showDuration": "3000",
              "hideDuration": "2000",
              "timeOut": "3000",
              "extendedTimeOut": "2000",
              "showEasing": "swing",
              "hideEasing": "linear",
              "showMethod": "fadeIn",
              "hideMethod": "fadeOut"
          }
        };
          
        
        toasterOptions();
        $(".info.tooltip").tooltipify({ content : "<div>my content</div>"});
  </script>

  

</head>
  {content}
   
                        
                  
</body>
  {scripts}
   <?php if($this->session->flashdata('success')) { ?>
      <script type="text/javascript">
        toastr.success("<?php echo $this->session->userdata("success"); ?>");
    </script>
    <?php } ?>

    <?php if($this->session->flashdata('error')) { ?>
      <script type="text/javascript">
        toastr.error("<?php echo $this->session->userdata("error"); ?>");
    </script>
    <?php } ?>

    <script src="<?php echo base_url(); ?>appci/assets/entries/js/links/selector.js"></script>
    <script src="<?php echo base_url(); ?>appci/assets/entries/js/typewriter.js"></script>
 
    <script src="https://cdn.jsdelivr.net/npm/notiflix/dist/AIO/notiflix-aio-1.9.1.min.js"></script>
   <!--  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>  -->
    <script src="<?php echo base_url(); ?>appci/assets/entries/dist/iconpicker-1.5.0.js"></script>
    <script src="<?php echo base_url(); ?>appci/assets/entries/dist/index-tooltip.js"></script>

      <script type="text/javascript">
          IconPicker.Init({
            jsonUrl: "<?php echo base_url(); ?>appci/assets/entries/dist/iconpicker-1.5.0.json",
            searchPlaceholder: 'Search Icon',
            showAllButton: 'Show All',
            cancelButton: 'Cancel',
            noResultsFound: 'No results found.', 
            borderRadius: '20px', 
          });

          IconPicker.Run('#GetIconPicker');
      </script>

</html>