                </div>

            </div>

        </div>
    </div>
    <?php
        $link = $_SERVER['PHP_SELF'];
        $link_array = explode('/',$link);
        $page = end($link_array);
    ?>
    <script type="text/javascript">
        const pathname = window.location.href;
        const lastSegment = pathname.substring(pathname.lastIndexOf('/') + 1);
        const base_url = "<?php echo base_url() ?>";
        const lastSegment2 = "<?php echo isset($page1) ? $page1 : '' ?>";
        const grp_name = "<?php echo $this->ion_auth->user()->row()->group_name ?>";
    </script>
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
    <!-- <script src="<?php //echo base_url(); ?>assets/js/popper.min.js"></script> -->
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/custom.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/script.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/datatables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>assets/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>assets/js/dataTables.rowGroup.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>   
</body>
</html>
