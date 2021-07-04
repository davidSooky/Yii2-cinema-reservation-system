
(function loadEventListener() {
    const btn = document.querySelector(".reservation");

    if(btn) {
        const numberOfSeats = document.querySelector(".seat-summary");

        const getCheckedCheckboxes = (checkBoxes) => {
            let numberOfChecked = 0;
            for(const checkbox of checkBoxes) {
                if(checkbox.checked && !checkbox.disabled) {
                    numberOfChecked++;
                }
            }
        
            return numberOfChecked;
        };
        
        const handleClick = () => {
            numberOfSeats.textContent = getCheckedCheckboxes(checkboxes);
        };

        const checkboxes = document.querySelectorAll('input[type="checkbox"]');

        checkboxes.forEach((checkbox) => {
            checkbox.addEventListener("click", handleClick);
        })
    }
}())