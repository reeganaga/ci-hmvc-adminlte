<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>
<!-- FastClick -->
<script src="<?php echo base_url('assets/plugins/fastclick/fastclick.js') ?>"></script>

<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/dist/js/app.min.js') ?>"></script>
<!-- Sparkline -->
<script src="<?php echo base_url('assets/plugins/sparkline/jquery.sparkline.min.js') ?>"></script>
<!-- jvectormap -->
<script src="<?php echo base_url('assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') ?>"></script>
<!-- SlimScroll 1.3.0 -->
<script src="<?php echo base_url('assets/plugins/slimScroll/jquery.slimscroll.min.js') ?>"></script>
<!-- ChartJS 1.0.1 -->
<script src="<?php echo base_url('assets/plugins/chartjs/Chart.min.js') ?>"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="<?php echo base_url('assets/dist/js/pages/dashboard2.js') ?>"></script> -->
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('assets/dist/js/demo.js') ?>"></script>
<script src="<?php echo base_url('assets/plugins/toastr/toastr.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/jquery-confirm/jquery-confirm.min.js'); ?>"></script>

<!-- datatables -->
<script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js'); ?>"></script>

<!-- datepicker -->
<script src="<?php echo base_url('assets/plugins/datepicker/bootstrap-datepicker.js'); ?>"></script>

<!-- iCheck -->
<script src="<?php echo base_url('assets/plugins/iCheck/icheck.min.js') ?>"></script>

<!--  Select 2 -->
<script src="<?php echo base_url('assets/plugins/select2/select2.full.min.js') ?>"></script>


<!-- <script src="<?= base_url('assets/plugins/jsPDF/html2canvas.js'); ?>"></script>
<script src="<?= base_url('assets/plugins/jsPDF/html.js'); ?>"></script> -->

<script src="<?= base_url('assets/plugins/jsPDF/jspdf.min.js'); ?>"></script>


<!-- jquery validation -->
<!-- <script src="<?= base_url('assets/plugins/jquery-validation/jquery.validate.min.js'); ?>"></script> -->
<!-- <script src="<?= base_url('assets/plugins/jquery-validation/additional-methods.min.js'); ?>"></script> -->

<!-- print pdf -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/0.9.0rc1/jspdf.min.js"></script> -->


<?php 
//localize variable by php
$url = base_url();
echo "<script>var kpi_data={'base_url':'{$url}'};</script>";
?>

<!-- custom js -->
<script src="<?php echo base_url('assets/custom/custom.js') ?>"></script>


<?php
alert('success', $this->session->flashdata('success'));
alert('error', $this->session->flashdata('error'));
alert('warning', $this->session->flashdata('warning'));
alert('info', $this->session->flashdata('info'));
?>