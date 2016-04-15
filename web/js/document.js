       
var $collectionHolder;

// setup an "adauga o proba" link
var $addTagLink = $('<td colspan="6"><a href="#" class="btn btn-sm btn-primary add_tag_link">Add new item</a></td>');
var $newLinkLi = $('<tr class="kta_documentline"></tr>').append($addTagLink);

function addTagForm($collectionHolder, $newLinkLi) {
    // Get the data-prototype explained earlier
    var prototype = $collectionHolder.data('prototype');


    // get the new index
    var index = $collectionHolder.data('index');

    // Replace '__name__' in the prototype's HTML to
    // instead be a number based on how many items we have
    var newForm = prototype.replace(/__name__/g, index);

    // increase the index with one for the next item
    $collectionHolder.data('index', index + 1);

    // Display the form in the page in an li, before the link li
    var $newFormLi = $('<tr></tr>').append(newForm);
    //console.log($newFormLi);
    
    $newLinkLi.before($newFormLi);

    // add a delete link to the new form
    addTagFormDeleteLink($newFormLi);    
}

function addTagFormDeleteLink($tagFormLi) {
    var $removeFormA = $('<td><a href="#" class="btn btn-sm btn-danger">Remove item</a></td>');
    $tagFormLi.append($removeFormA);

    $removeFormA.on('click', function(e) {
    // prevent the link from creating a "#" on the URL
    e.preventDefault();

    // remove the li for the tag form
    $tagFormLi.remove();
    });
}

function getVat(){
    
}
function getPaymentAmount(){
    
}
function getTaxBase(){
    
}

$(document).ready(function(){

    // add active class to 'clicked' links from sidebar
    $(".sidebar table > tr").click(function () {
       $('table > tr').removeClass('active'); 
       $(this).addClass('active');   

    });
    //end 


    // Get the ul that holds the collection of tags
    $collectionHolder = $('table.documentLines');
    
    // add the "add a tag" anchor and li to the tags ul
    $collectionHolder.append($newLinkLi);

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionHolder.data('index', $collectionHolder.find(':input').length);
    
    //console.log($collectionHolder.find(':input').length);
    $addTagLink.on('click', function(e) {
    // prevent the link from creating a "#" on the URL
    e.preventDefault();

    // add a new tag form (see next code block)
    addTagForm($collectionHolder, $newLinkLi);
    });

    // add a delete link to all of the existing tag form li elements
    $collectionHolder.find('tr:not(.kta_documentline)').each(function() {
    addTagFormDeleteLink($(this));
    });  
    //////// end of code used to Embed a Collection of Forms Playlists emdeb with Playvideos

});    
