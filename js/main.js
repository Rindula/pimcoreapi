function save(e) {
    if (e.value == $( e ).attr( "data-prevalue")) return;
    $(e).parents().filter("form").submit();
}