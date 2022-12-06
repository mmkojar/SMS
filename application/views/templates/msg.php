<div id="flash_messages">
      <?php if($this->ion_auth->logged_in()) : ?>
            <?php if($this->session->flashdata('message')) { ?>
            <p class="alert alert-success">
              <?php echo $this->session->flashdata('message'); unset($_SESSION['message']) ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </p>
            <?php } ?>
          <?php if($this->session->flashdata('success')) { ?>
            <p class="alert alert-success">
              <?php echo $this->session->flashdata('success'); unset($_SESSION['success']) ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </p>
            <?php } ?>
          <?php if($this->session->flashdata('error')) { ?>
            <p class="alert alert-danger">
                <?php echo $this->session->flashdata('error'); unset($_SESSION['error']) ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </p>
            <?php } ?>
          <?php if($this->session->flashdata('warning')) { ?>
            <p class="alert alert-warning">
                <?php echo $this->session->flashdata('warning'); unset($_SESSION['warning']) ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </p>
          <?php } ?>
      <?php endif; ?>
  </div>