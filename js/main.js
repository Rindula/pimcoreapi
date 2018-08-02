function save(e) {
    if (e.value == $( e ).attr( "data-prevalue")) return;
    $(e).parents().filter("form").submit();
}

function transformTag(tagIdOrElem, tagType){
    var elem = (tagIdOrElem instanceof HTMLElement) ? tagIdOrElem : document.getElementById(tagIdOrElem);
    if(!elem || !(elem instanceof HTMLElement))return;
    var parent = elem.parentNode;
    var newNode = document.createElement(tagType||"span");
    parent.replaceChild(newNode,elem);

    return newNode;
}