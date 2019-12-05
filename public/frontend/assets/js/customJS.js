$(function () {

})

window.onmousedown = function (e) {
    var el = e.target;
    if (el.tagName.toLowerCase() == 'option' && el.parentNode.hasAttribute('multiple')) {
        e.preventDefault();

        // toggle selection
        if (el.hasAttribute('selected')) el.removeAttribute('selected');
        else el.setAttribute('selected', '');

        // hack to correct buggy behavior
        var select = el.parentNode.cloneNode(true);
        el.parentNode.parentNode.replaceChild(select, el.parentNode);
    }
}

function loadCities(elem) {
    $.ajax({
        type: "get",
        url: "load-cities/"+$(elem).val()
    })
    .done(function (data) {
        data = JSON.parse(data)
        $("#city").find('option').remove()
        $.each(data, function (key, value) {
            let option = new Option(value, value, false, false)
            $("#city").append(option)
        })
    })
}