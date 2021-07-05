
(function loadEventListener() {
    const btn = document.querySelector(".reservation");

    if(btn) {
        const numberOfSeats = document.querySelector(".seat-summary");
        const amountPaid = document.querySelector(".payment-summary");
        const price = amountPaid.dataset.price;

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
            amountPaid.textContent = `EUR ${price * parseInt(numberOfSeats.textContent)}.00`;
        };

        const checkboxes = document.querySelectorAll('input[type="checkbox"]');

        checkboxes.forEach((checkbox) => {
            checkbox.addEventListener("click", handleClick);
        })
    }
}())