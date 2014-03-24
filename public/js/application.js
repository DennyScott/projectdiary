// common way to initialize jQuery
$(function() {
    // simple demo to show create something via javascript on the page
    $('#addentry').click(function(){
    	$(this).find("h3").remove();
    	$(this).parent().removeClass("col-xs-offset-2");
    	$(this).parent().removeClass("col-xs-8");
    	$(this).parent().addClass("col-xs-12");
    	$(this).removeClass("addentry");
    	$(this).toggle();

    	$(this).html("<div class='row'><form method='post' action=''><label for='inputEntryTitle' class='col-xs-12'>Entry Title</label><input type='text' class='col-xs-12 inputEntryTitle' id='inputEntryTitle' placeholder='Entry Title'><div class='col-xs-12 entryData'><label for='inputEntryData'>Entry Data</label><textarea class='col-xs-12 inputEntryData' id='inputEntryData'></textarea></div><div class='col-xs-12'><input type='submit' class='entrySubmit btn btn-primary' value='Add Entry'></div><form></div>");
    	$(this).fadeIn().slideDown();
    	$(this).off('click');

    });
});
