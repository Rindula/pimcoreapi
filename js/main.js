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
    var children = elem.childNodes;
    var parent = elem.parentNode;
    var newNode = document.createElement(tagType||"span");
    for(var a=0;a<elem.attributes.length;a++){
        newNode.setAttribute(elem.attributes[a].nodeName, elem.attributes[a].value);
    }
    for(var i= 0,clen=children.length;i<clen;i++){
        newNode.appendChild(children[0]); //0...always point to the first non-moved element
    }
    newNode.style.cssText = elem.style.cssText;
    parent.replaceChild(newNode,elem);

    return newNode;
}