const main_check_box = document.querySelector("#selectAllBoxes");
main_check_box.addEventListener('click', (e) => {
    if(document.querySelector("#selectAllBoxes").checked)
    {
        let checkboxes = document.querySelectorAll(".checkBoxes");
        checkboxes.forEach((box) => {
            box.checked = true;
        });
    }
    else
    {
        let checkboxes = document.querySelectorAll(".checkBoxes");
        checkboxes.forEach((box) => {
            box.checked = false;
        });
    }
});