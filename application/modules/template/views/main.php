<?php
  // jika headernya di set, maka load
  if (isset($header))
  {
    $this->load->view($header);
  }

  // jika topbarnya di set, maka load
  if (isset($topbar))
  {
    $this->load->view($topbar);
  }

  // jika sidebarnya di set, maka load
  if (isset($sidebar))
  {
    $this->load->view($sidebar);
  }

?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <?php

      // jika contentnya di set, maka load
      if (isset($content_header)) {
        echo $this->load->view($content_header);
      }

      // jika contentnya di set, maka load
      if (isset($content)) {
        echo $this->load->view($content);
      }
    ?>
  </div>
  <!-- /.content-wrapper -->

<?php
  if (isset($control_sidebar)) {
    $this->load->view($control_sidebar);
  }

  if (isset($footer)) {
    $this->load->view($footer);
  }
?>
