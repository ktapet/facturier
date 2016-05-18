var $collectionHolder;
var $collectionHolder_image;

// setup an "adauga o proba" link
var $addTagLink = $('<a href="#" class="btn btn-default add_tag_link">Adaugă proprietate</a>');
var $addTagLink_image = $('<a href="#" class="btn btn-default add_tag_link">Adaugă imagine</a>');

var $newLinkLi = $('<li class="kta_feature"></li>').append($addTagLink);
var $newLinkLi_image = $('<li class="kta_image"></li>').append($addTagLink_image);

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

    // Display the form in the page in an li, before the "dauaga o proba" link li
    var $newFormLi = $('<li></li>').append(newForm);
    $newLinkLi.before($newFormLi);

    // add a delete link to the new form
    addTagFormDeleteLink($newFormLi);
}

function addTagFormDeleteLink($tagFormLi) {
    var $removeFormA = $('<a href="#" class="btn btn-danger top-buffer">Șterge</a>');
    $tagFormLi.append($removeFormA);

    $removeFormA.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // remove the li for the tag form
        $tagFormLi.remove();
    });
}

$(document).ready(function(){

    // add active class to 'clicked' links from sidebar
    $(".sidebar ul > li").click(function () {
        $('ul > li').removeClass('active');
        $(this).addClass('active');

    });
    //end

    //////// code used to Embed a Collection of Forms Playlists emdeb with Playvideos

    // Get the ul that holds the collection of tags
    $collectionHolder = $('ul.features');
    $collectionHolder_image = $('ul.images');

    // add the "add a tag" anchor and li to the tags ul
    $collectionHolder.append($newLinkLi);
    $collectionHolder_image.append($newLinkLi_image);

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionHolder.data('index', $collectionHolder.find(':input').length);
    $collectionHolder_image.data('index', $collectionHolder_image.find(':input').length);

    $addTagLink.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // add a new tag form (see next code block)
        addTagForm($collectionHolder, $newLinkLi);
    });
    $addTagLink_image.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();


        // add a new tag form (see next code block)
        addTagForm($collectionHolder_image, $newLinkLi_image);
    });

    // add a delete link to all of the existing tag form li elements
    $collectionHolder.find('li:not(.kta_feature)').each(function() {
        addTagFormDeleteLink($(this));
    });
    $collectionHolder_image.find('li:not(.kta_image)').each(function() {

        addTagFormDeleteLink($(this));
    });

    //////// end of code used to Embed a Collection of Forms Playlists emdeb with Playvideos

});