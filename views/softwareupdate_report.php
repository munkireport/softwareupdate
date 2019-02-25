<?php $this->view('partials/head', array(
	"scripts" => array(
		"clients/client_list.js"
	)
)); ?>

<div class="container">
    
  <div class="row">
    <?php $widget->view($this, 'softwareupdate_automaticcheckenabled'); ?>
    <?php $widget->view($this, 'softwareupdate_automaticdownload'); ?>
    <?php $widget->view($this, 'softwareupdate_auto_update'); ?>
  </div> <!-- /row -->
    
  <div class="row">
    <?php $widget->view($this, 'softwareupdate_auto_update_restart_required'); ?>
    <?php $widget->view($this, 'softwareupdate_criticalupdateinstall'); ?>
    <?php $widget->view($this, 'softwareupdate_configdatainstall'); ?>
  </div> <!-- /row -->
    
  <div class="row">
      <?php $widget->view($this, 'softwareupdate_gatekeeper_version'); ?>
      <?php $widget->view($this, 'softwareupdate_gatekeeper_disk_version'); ?>
      <?php $widget->view($this, 'softwareupdate_kext_exclude_version'); ?>
  </div> <!-- /row -->
    
  <div class="row">
      <?php $widget->view($this, 'softwareupdate_mrt_version'); ?>
      <?php $widget->view($this, 'softwareupdate_xprotect_version'); ?>
    <?php $widget->view($this, 'softwareupdate_seed'); ?>
  </div> <!-- /row -->

    
</div>  <!-- /container -->

<script src="<?php echo conf('subdirectory'); ?>assets/js/munkireport.autoupdate.js"></script>

<?php $this->view('partials/foot'); ?>
