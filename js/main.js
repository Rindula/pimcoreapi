function titleOnClick(e) {
    var text = e.innerHTML;
    elem = transformTag(e, "input");

    elem.value = text;

    elem.focus();
    elem.addEventListener("blur", save(elem));
}

function save(e) {
    var text = e.value;
    elem = transformTag(e, "h2");

    elem.innerHTML = text;

    elem.addEventListener("click", titleOnClick(elem));
}

function transformTag(tagIdOrElem, tagType){
    var elem = (tagIdOrElem instanceof HTMLElement) ? tagIdOrElem : document.getElementById(tagIdOrElem);
    if(!elem || !(elem instanceof HTMLElement))return;
    var parent = elem.parentNode;
    var newNode = document.createElement(tagType||"span");
    parent.replaceChild(newNode,elem);

    return newNode;
}