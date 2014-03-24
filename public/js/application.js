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

    	$(this).html("<div class='row'><label for='inputEntryTitle' class='col-xs-12'>Entry Title</label><input type='text' class='col-xs-12 inputEntryTitle' name='inputEntryTitle' id='inputEntryTitle' placeholder='Entry Title'><div class='col-xs-12 entryData'><label for='inputEntryData'>Entry Data</label><textarea class='col-xs-12 inputEntryData' name='inputEntryData' id='inputEntryData'></textarea></div><div class='col-xs-12'><input type='submit' name='submit_add_entry' class='entrySubmit btn btn-primary' value='Add Entry'></div></div>");
    	$(this).fadeIn().slideDown();
    	$(this).off('click');

    });
});
