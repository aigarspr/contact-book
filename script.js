function hideConfirmDialog(element) {
    element.parentElement.style.display = "none";
}


function ShowConfirmDialog(element) {
    element.nextElementSibling.style.display = "block";
}

//validadacijas logu parādīšana un slēpšana

document.querySelector('[name="search"]').addEventListener('click', function () {
    var noResult = document.querySelector('.noResult');
    noResult.style.display = 'block';
});

