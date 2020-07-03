var softwareupdate_seed = function(colNumber, row){

    var col = $('td:eq('+colNumber+')', row),
        colvar = col.text();

    colvar = colvar == '3' ? '<span class="label label-warning">'+i18n.t('softwareupdate.publicseed')+'</span>' :
    colvar = colvar == '2' ? '<span class="label label-danger">'+i18n.t('softwareupdate.developerseed')+'</span>' :
    colvar = colvar == '1' ? '<span class="label label-warning">'+i18n.t('softwareupdate.customerseed')+'</span>' :
    (colvar === '0' ? '<span class="label label-success">'+i18n.t('softwareupdate.unenrolled')+'</span>' : colvar)
    col.html(colvar)
}