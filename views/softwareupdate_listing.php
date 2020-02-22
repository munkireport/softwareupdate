<?php $this->view('partials/head'); ?>

<div class="container">
  <div class="row">
	<div class="col-lg-12">

	  <h3><span data-i18n="softwareupdate.reporttitle"></span> <span id="total-count" class='label label-primary'>…</span></h3>

	  <table class="table table-striped table-condensed table-bordered">

		<thead>
		  <tr>
			<th data-i18n="listing.computername" data-colname='machine.computer_name'></th>
			<th data-i18n="serial" data-colname='reportdata.serial_number'></th>
			<th data-i18n="softwareupdate.recommendedupdates" data-colname='softwareupdate.recommendedupdates'></th>
			<th data-i18n="softwareupdate.lastsuccessfuldate" data-colname='softwareupdate.lastsuccessfuldate'></th>
			<th data-i18n="softwareupdate.lastbackgroundsuccessfuldate" data-colname='softwareupdate.lastbackgroundsuccessfuldate'></th>
			<th data-i18n="softwareupdate.inactiveupdates" data-colname='softwareupdate.inactiveupdates'></th>
			<th data-i18n="softwareupdate.catalogurl" data-colname='softwareupdate.catalogurl'></th>
			<th data-i18n="softwareupdate.lastupdatesavailable" data-colname='softwareupdate.lastupdatesavailable'></th>
			<th data-i18n="softwareupdate.automaticcheckenabled" data-colname='softwareupdate.automaticcheckenabled'></th>
			<th data-i18n="softwareupdate.automaticdownload" data-colname='softwareupdate.automaticdownload'></th>
			<th data-i18n="softwareupdate.configdatainstall" data-colname='softwareupdate.configdatainstall'></th>
			<th data-i18n="softwareupdate.criticalupdateinstall" data-colname='softwareupdate.criticalupdateinstall'></th>
			<th data-i18n="softwareupdate.xprotect_version" data-colname='softwareupdate.xprotect_version'></th>
			<th data-i18n="softwareupdate.gatekeeper_version" data-colname='softwareupdate.gatekeeper_version'></th>
			<th data-i18n="softwareupdate.kext_exclude_version" data-colname='softwareupdate.kext_exclude_version'></th>
			<th data-i18n="softwareupdate.mrt_version" data-colname='softwareupdate.mrt_version'></th>
			<th data-i18n="softwareupdate.program_seed" data-colname='softwareupdate.program_seed'></th>
		  </tr>
		</thead>

		<tbody>
		  <tr>
			<td data-i18n="listing.loading" colspan="17" class="dataTables_empty"></td>
		  </tr>
		</tbody>

	  </table>
	</div> <!-- /span 12 -->
  </div> <!-- /row -->
</div>  <!-- /container -->

<script type="text/javascript">

	$(document).on('appUpdate', function(e){

		var oTable = $('.table').DataTable();
		oTable.ajax.reload();
		return;

	});

	$(document).on('appReady', function(e, lang) {

        // Get modifiers from data attribute
        var mySort = [], // Initial sort
            hideThese = [], // Hidden columns
            col = 0, // Column counter
            runtypes = [], // Array for runtype column 
            columnDefs = [{ visible: false, targets: hideThese }]; //Column Definitions

        $('.table th').map(function(){

            columnDefs.push({name: $(this).data('colname'), targets: col});

            if($(this).data('sort')){
              mySort.push([col, $(this).data('sort')])
            }

            if($(this).data('hide')){
              hideThese.push(col);
            }

            col++
        });

	    oTable = $('.table').dataTable( {
            ajax: {
                url: appUrl + '/datatables/data',
                type: "POST",
                data: function(d){
                     d.mrColNotEmpty = "lastsuccessfuldate";
                    
                    // Check for column in search
                    if(d.search.value){
                        $.each(d.columns, function(index, item){
                            if(item.name == 'softwareupdate.' + d.search.value){
                                d.columns[index].search.value = '> 0';
                            }
                        });
                    }
                }
            },
            dom: mr.dt.buttonDom,
            buttons: mr.dt.buttons,
            order: mySort,
            columnDefs: columnDefs,
		    createdRow: function( nRow, aData, iDataIndex ) {
	        	// Update name in first column to link
	        	var name=$('td:eq(0)', nRow).html();
	        	if(name == ''){name = "No Name"};
	        	var sn=$('td:eq(1)', nRow).html();
	        	var link = mr.getClientDetailLink(name, sn, '#tab_softwareupdate-tab');
	        	$('td:eq(0)', nRow).html(link);
                
	        	// Format Successful Date timestamp
	        	var checkin = $('td:eq(3)', nRow).html();
	        	if(checkin !== "" && checkin.indexOf('-') === -1){
                    var date = new Date(checkin * 1000);
                    $('td:eq(3)', nRow).html('<span title="'+moment(date).format('llll')+'">'+moment(date).fromNow()+'</span>');
	        	} else if (checkin !== ""){
                    $('td:eq(3)', nRow).html('<span title="' + checkin + '">' + moment(checkin).fromNow()+'</span>');   
                }
                
	        	// Format Background Successful Date timestamp
	        	var checkin = $('td:eq(4)', nRow).html();
	        	if(checkin !== "" && checkin.indexOf('-') === -1){
                    var date = new Date(checkin * 1000);
                    $('td:eq(4)', nRow).html('<span title="'+moment(date).format('llll')+'">'+moment(date).fromNow()+'</span>');
	        	} else if (checkin !== ""){
                    $('td:eq(4)', nRow).html('<span title="' + checkin + '">' + moment(checkin).fromNow()+'</span>');   
                }

	        	// automaticcheckenabled
	        	var automaticcheckenabled=$('td:eq(8)', nRow).html();
	        	automaticcheckenabled = automaticcheckenabled == '1' ? i18n.t('yes') :
	        	(automaticcheckenabled === '0' ? i18n.t('no') : '')
	        	$('td:eq(8)', nRow).html(automaticcheckenabled)
                
	        	// automaticdownload
	        	var automaticdownload=$('td:eq(9)', nRow).html();
	        	automaticdownload = automaticdownload == '1' ? i18n.t('yes') :
	        	(automaticdownload === '0' ? i18n.t('no') : '')
	        	$('td:eq(9)', nRow).html(automaticdownload)
                
	        	// configdatainstall
	        	var configdatainstall=$('td:eq(10)', nRow).html();
	        	configdatainstall = configdatainstall == '1' ? i18n.t('yes') :
	        	(configdatainstall === '0' ? i18n.t('no') : '')
	        	$('td:eq(10)', nRow).html(configdatainstall)
                
	        	// criticalupdateinstall
	        	var criticalupdateinstall=$('td:eq(11)', nRow).html();
	        	criticalupdateinstall = criticalupdateinstall == '1' ? i18n.t('yes') :
	        	(criticalupdateinstall === '0' ? i18n.t('no') : '')
	        	$('td:eq(11)', nRow).html(criticalupdateinstall)
                
	        	// seed
	        	var colvar=$('td:eq(16)', nRow).html();
	        	colvar = colvar == '3' ? '<span class="label label-warning">'+i18n.t('softwareupdate.publicseed')+'</span>' :
	        	colvar = colvar == '2' ? '<span class="label label-danger">'+i18n.t('softwareupdate.developerseed')+'</span>' :
	        	colvar = colvar == '1' ? '<span class="label label-warning">'+i18n.t('softwareupdate.customerseed')+'</span>' :
	        	(colvar === '0' ? '<span class="label label-success">'+i18n.t('softwareupdate.unenrolled')+'</span>' : colvar)
	        	$('td:eq(16)', nRow).html(colvar)
		    }
	    });

	});
</script>

<?php $this->view('partials/foot'); ?>
